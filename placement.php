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

function placements2($a, $b = [])
{
    $diff = array_diff($a, $b);
    foreach ($diff as $char) {
        $bNew = $b;
        $bNew[] = $char;
        echo implode('', $bNew).'<br>';
        placements2($a, $bNew);
    }
}

placements2(['a', 'b', 'c', 'd']);
