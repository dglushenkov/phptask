<?php

$exp = '))';
$expArr = str_split($exp);

$stack = array();
$isValid = true;
$closeBrackets = array(
    '}' => '{',
    ')' => '(',
    ']' => '['
);
foreach ($expArr as $bracket) {
    if (!$closeBrackets[$bracket]) {
        array_push($stack, $bracket);
    } else {
        $topStack = array_pop($stack);
        if ($topStack !== $closeBrackets[$bracket]) {
            $isValid = false;
            break;
        }
    }
}

if ($isValid && !count($stack)) {
    print "Expression is valid";
} else {
    print "Expression is not valid";
}
