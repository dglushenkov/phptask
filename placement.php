<?php

function placements()
{
    $A = ['a', 'b', 'c', 'd'];
    foreach ($A as $char) {
        getPlacement($char, $A);
    }
}

function getPlacement($char, $A, $B = [])
{
    $B[] = $char;
    echo implode('', $B) . '<br>';

    $diffA = array_diff($A, $B);
    foreach ($diffA as $newChar) {
        getPlacement($newChar, $A, $B);
    }
}

function placements2($a, $b = [], $char = '')
{
    if ($char) {
        $b[] = $char;
        echo implode('', $b).'<br>';
    }

    $diffA = array_diff($a, $b);
    foreach ($diffA as $newChar) {
        placements2($a, $b, $newChar);
    }
}

placements2(['a', 'b', 'c', 'd']);
