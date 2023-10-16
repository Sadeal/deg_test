<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>21-26</title>
</head>
<body style="width: 100%; display: flex;justify-content:center;">
<div style="display: flex; flex-direction: column;">
    <div style="display: flex; flex-direction:row">
        <form action="/second.php" method="get">
            <label for="size">Вывести сотрудников (кол-во):</label>
            <input type="text" id="size" name="size" <?php if(isset($_GET['size'])) echo 'value="' . $_GET['size'] . '"' ?>value=""><br><br>
            <label for="sort">Сортировать по:</label>
            <select name="sort" id="sort">
                <option value="none" <?php if(isset($_GET['sort'])) if($_GET['sort']=='none') echo 'selected'; ?>>Не сортировать</option>
                <option value="age" <?php if(isset($_GET['sort'])) if($_GET['sort']=='age') echo 'selected'; ?>>Возраст</option>
                <option value="second_name" <?php if(isset($_GET['sort'])) if($_GET['sort']=='second_name') echo 'selected';?>>Фамилия</option>
            </select><br>
            <label for="filter">Фильтр по разнице в 1 символ</label>
            <select name="filter" id="filter">
                <option value="0" <?php if(isset($_GET['filter'])) if($_GET['filter']=='0') echo 'selected';?>>Не фильтровать</option>
                <option value="1" <?php if(isset($_GET['filter'])) if($_GET['filter']=='1') echo 'selected';?>>Фильтровать</option>
            </select><br>
            <input type="submit" value="Submit">
        </form>
    </div>
        <?php

        include_once "codeSecond.php";
        if(isset($_GET['size'])){
            $user = createUsers($_GET['size']);
            if(isset($_GET['sort'])) {
                if ($_GET['sort'] == 'age') {
                    usort($user, function ($a, $b) {
                        return $a['age'] > $b['age']
                            ? 1
                            : ($a['age'] == $b['age']
                                ? 0
                                : -1);
                    }
                    );
                }
                if ($_GET['sort'] == 'second_name') {
                    usort($user, function ($a, $b) {
                        return $a['second_name'] > $b['second_name']
                            ? 1
                            : ($a['second_name'] == $b['second_name']
                                ? 0
                                : -1);
                    }
                    );
                }
            }
            if(isset($_GET['filter'])){
                if($_GET['filter'] == '1'){
                    $user = array_filter($user, function($user1) use ($user) {
                        foreach ($user as $user2) {
                            if ($user1['id'] != $user2['id'] && levenshtein($user1['second_name'], $user2['second_name']) <= 1) {
                                return true;
                            }
                        }
                        return false;
                    });
                }
            }
            foreach($user as $usr){
                echo '<div class="box" style="display: flex; flex-direction: row">';
                echo '<pre>';
                echo 'ID: ' . $usr['id'] . '<br/>';
                echo 'Пол: ' . $usr['gender'] . '<br/>';
                echo 'Фамилия: ' . $usr['second_name'] . '<br/>';
                echo 'Имя: ' . $usr['name'] . '<br/>';
                echo 'email: ' . $usr['email'] . '<br/>';
                echo 'День рождения: ' . $usr['birthday'] . '<br/>';
                echo 'Позиция: ' . $usr['position'] . '<br/>';
                echo 'Зарплата (после вычета налогов): ' . $usr['salary'] . '<br/>';
                echo 'Возраст: ' . $usr['age'] . '<br/>';
                echo '</pre>';
                echo '</div>';
            }
        }

        ?>
</div>
</body>
<style>
    .box {
        min-width: 300px;
        width: fit-content;
        height: fit-content;
        border: 2px solid #aaa;
        margin: 0 auto 15px;
        text-align: center;
        padding: 50px;
        font-weight: bold;
        border-radius: 10px;
        background-color: #ddd;
    }
</style>
</html>