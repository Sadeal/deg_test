<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>11-20</title>
</head>
<body>
<?php
include_once "codeFirst.php";

for($i = 0; $i<2; $i++){
    echo '<div class="box">';
    echo 'Задача ' . $i+1 . '<br />';
    echo $e[$i](rand(1,100));
    echo '</div>';
}
for($i = 2; $i<4; $i++){
    echo '<div class="box"><pre>';
    echo 'Задача ' . $i+1 . '<br />';
    print_r($e[$i]());
    echo '</div>';
}
for($i = 4; $i<6; $i++){
    echo '<div class="box"><pre>';
    echo 'Задача 4';
    echo '<form method="post"> 
        <input type="submit" name="button' . $i . '"
                class="button" value="Button' . $i . '" /> 
    </form> ';
    echo '</div>';
}

echo '<div class="box"><pre>';
echo 'Задача 5<br />';
echo $e[6]('+');
echo '</div>';

if(array_key_exists('button4', $_POST)) {
    button4();
}
else if(array_key_exists('button5', $_POST)) {
    button5();
}
function button4() {
    global $e;
    $e[4]('200');
}
function button5() {
    global $e;
    $e[5]('404');
}
?>
</body>

<style>
    .box {
        min-width: 400px;
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