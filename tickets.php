<?php

//echo strAdd('1', '1', '5').'<br>';
//echo strMultiply('6', '6');
echo getTicketsNumber(20);

function getTicketsNumber($n) {
    $sumsLeft = array();
    $sumsRight = array();
    $counter = str_pad('1', $n / 2, '0', STR_PAD_LEFT);

    while (strlen($counter) <= ($n / 2)) {
        $sum = getCharSum($counter);
        $sumsRight[$sum] = (isset($sumsRight[$sum])) ? strIncrement($sumsRight[$sum]) : '1';

        if ($counter[0] != '0') {
            $sumsLeft[$sum] = (isset($sumsLeft[$sum])) ? strIncrement($sumsLeft[$sum]) : '1';
        }

        $counter = strIncrement($counter);
    }

    $sumsCount = '0';
    foreach ($sumsLeft as $key => $sum) {
        $sumsCount = strAdd($sumsCount, strMultiply($sum, $sumsRight[$key]));
    }

    return $sumsCount;
}

function strIncrement($s) {
    return strAdd($s, '1');
}

function getCharSum($s) {
    $len = strlen($s);
    for ($sum = 0, $i = 0; $i < $len; $sum += $s[$i], $i++);
    return $sum;
}

function strAdd($str) {
    $args = (is_array($str)) ? $str : func_get_args();

    $maxLen = 0;
    foreach ($args as $arg) {
        $len = strlen($arg);
        if ($len > $maxLen) { $maxLen = $len; }
    }
    foreach ($args as $key => $value) { $args[$key] = str_pad($value, $maxLen, '0', STR_PAD_LEFT); }

    $rest = 0;
    $result = '';
    for ($i = $maxLen - 1; $i >= 0; $i--) {
        $digitSum = $rest;
        foreach ($args as $arg) { $digitSum += $arg[$i]; };

        if ($digitSum > 9) {
            $rest = floor($digitSum / 10);
            $digitSum = $digitSum % 10;
        } else { $rest = 0; }

        $result = $digitSum.$result;
    }
    if ($rest > 0) { $result = $rest.$result; }

    return $result;
}

function strMultiply($a, $b) {
    $lastIndexA = strlen($a) - 1;
    $lastIndexB = strlen($b) - 1;
    $subResults = array();

    for ($i = $lastIndexB; $i >= 0; $i--) {
        $subResult = '';
        $rest = 0;
        for ($j = $lastIndexA; $j >= 0; $j--) {
            $digitMltpl = $b[$i] * $a[$j] + $rest;

            if ($digitMltpl > 9) {
                $rest = floor($digitMltpl / 10);
                $digitMltpl = $digitMltpl % 10;
            } else { $rest = 0; }

            $subResult = $digitMltpl.$subResult;
        }

        if ($rest > 0) { $subResult = $rest.$subResult; }
        $subResults[] = str_pad($subResult, strlen($subResult) + $lastIndexB - $i, '0', STR_PAD_RIGHT);
    }

    return strAdd($subResults);
}

