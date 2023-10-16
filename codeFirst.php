<?php

$e = [];

// 1
$e[0] = function($num) {
    if($num % 2 == 0)
        return 'Число ' . $num . ' чётное';
    else
        return 'Число ' . $num . ' не чётное';
};

// 2
$e[1] = function($num) {
    return $num % 2 == 0
        ? 'Число ' . $num . ' чётное'
        : 'Число ' . $num . ' не чётное';
};

// 3.1
$e[2] = function() {
    $array = [23, 3, 5, 1, 6, 34, 100, 10, 45, 5, 0];
    for($j = 0; $j<=121; $j++)
        for($i = 0; $i<count($array)-1; $i++){
            if($array[$i]>$array[$i+1]) {
                $temp = $array[$i];
                $array[$i] = $array[$i+1];
                $array[$i+1] = $temp;
            }
        }
    return $array;
};

// 3.2
function is_sort($array) : bool {
    for($i=0; $i<count($array)-1; $i++){
        if($array[$i]>$array[$i+1]){
            return false;
        }
    }
    return true;
}

$e[3] = function() {
    $array = [23, 3, 5, 1, 6, 34, 100, 10, 45, 5, 0];
    $i = 0;
    while(!is_sort($array)) {
        if($i==count($array)-1) $i = 0;
        if($array[$i]>$array[$i+1]) {
            $temp = $array[$i];
            $array[$i] = $array[$i+1];
            $array[$i+1] = $temp;
        }
        $i++;
    }
    return $array;
};


// 4.1 & 4.2
$e[4] = function(string $code) {
    switch($code){
        case '200':
            http_response_code(200);
            header('Location: /index.php?code=200');
            exit;
        case '404':
            http_response_code(404);
            header('Location: /404.php');
            exit;
        default: echo '4to?';
            break;
    }
};

// 4.3
$e[5] = function(string $code) {
    match($code){
        '200' => http_response_code(200) & header('Location: /index.php?code=200') & exit,
        '404' =>http_response_code(404) & header('Location: /404.php') & exit,
        default => print('4to?'),
    };
};

$e[6] = function(string $symbol) {
    $arr = array (
        'error-control' => '@',
        'arithmetic' => '+ - / % **',
        'assignment' => '= += -= *= /= %= **=',
        'string' => '. .=',
        'comparison' => '== === != !== <> <= >= ?? ?:',
        'logical' => 'or || && and !',
        'in/de-crement' => '-- ++',
        'bitwise' => '~ ^ & | << >>',
        'array' => '+ == === != <> !==',
        'execution' => '``',
        'type' => 'instanceof',
        'nullsafe' => '?',
    );
    $ans = '';
    foreach($arr as $key => $item) {
        $newItem = explode(' ', $item);
        foreach($newItem as $new){
            if(strcmp($new, $symbol) === 0) {
                $ans .= $key . ', ';
                break;
            }
        }
    }
    $returnString = $symbol . ' => относится к операторам ' . substr($ans, 0, -2);
    return $returnString;
};