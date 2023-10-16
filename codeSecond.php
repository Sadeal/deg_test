<?php

$first_name_boy = ['Александр', 'Фёдор', 'Савелий', 'Максим', 'Виктор', 'Кирилл'];
$first_name_girl = ['Мария', 'Анна', 'Александра', 'Юлия'];
$second_name = ['Иванов', 'Дегтярев', 'Жиленков', 'Тимофеев', 'Турин', 'Комаров', 'Панищев'];
$position = array (
    0 =>
        array (
            'position' => 'junior',
            'salary' =>
                array (
                    'fixed_part' => 50000,
                    'bonuses' =>
                        array (
                            0 => 5000,
                            1 => 3000,
                            2 => 550,
                            3 => 450,
                        ),
                ),
        ),
    1 =>
        array (
            'position' => 'middle',
            'salary' =>
                array (
                    'fixed_part' => 70000,
                    'bonuses' =>
                        array (
                            0 => 8000,
                            1 => 5000,
                            2 => 750,
                            3 => 1650,
                            4 => 1000,
                        ),
                ),
        ),
    2 =>
        array (
            'position' => 'senior',
            'salary' =>
                array (
                    'fixed_part' => 90000,
                    'bonuses' =>
                        array (
                            0 => 10000,
                            1 => 1000,
                            2 => 500,
                            3 => 2000,
                            4 => 1500,
                            5 => 6000,
                        ),
                ),
        ),);


function createMail(...$name) : string {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',  'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr(mb_substr($name[0], 0, 1), $converter) . '_' . strtr($name[1], $converter) . '@' . explode(' ', 'gmail.com yandex.ru mail.ru')[rand(0, 2)];
}

function createBirthday($max, $min = '11.11.1980') {
    $minTimestamp = strtotime($min);
    $maxTimestamp = strtotime($max);
    $randomTimestamp = rand($minTimestamp, $maxTimestamp);
    $randomDate = date('d.m.Y', $randomTimestamp);
    return $randomDate;
}

function calcSalary($fix, $bonus){
    return ($fix+$bonus)-($fix+$bonus)/100*13;
}

function calcAge($birthday) {
    return DateTime::createFromFormat('d.m.Y', $birthday)
        ->diff(new DateTime('now'))
        ->y;
}

function createUsers(int $size) : array {
    $arr = [];
    global $first_name_boy, $first_name_girl, $second_name, $position;
    for($i = 0; $i<$size; $i++){
        $gender = rand(0,1) == 0 ? 'Мужчина' : 'Женщина';
        $sname = $gender == 'male' ? $second_name[rand(0, count($second_name)-1)] : $second_name[rand(0, count($second_name)-1)] . 'а';
        $name = $gender == 'male' ? $first_name_boy[rand(0, count($first_name_boy)-1)] : $first_name_girl[rand(0, count($first_name_girl)-1)];
        $email = createMail($name, $sname);
        $email = substr($email, 0, strpos($email, '@')) . $i . substr($email, strpos($email, '@'));
        $birthday = createBirthday('19.11.2005');
        $pos_id = rand(0,2);
        $pos = $position[$pos_id]['position'];
        $salary = calcSalary($position[$pos_id]['salary']['fixed_part'], $position[$pos_id]['salary']['bonuses'][rand(0,count($position[$pos_id]['salary']['bonuses'])-1)]);
        $age = calcAge($birthday);
        $arr[$i] = [
            $i =>
            array (
                'id' => $i,
                'gender' => $gender,
                'second_name' => $sname,
                'name' => $name,
                'email' => $email,
                'birthday' => $birthday,
                'position_id' => $pos_id,
                'position' => $pos,
                'salary' => $salary,
                'age' => $age,
            )
        ];
    }
    return array_merge(...$arr);
}

?>