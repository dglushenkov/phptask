<?php

$elems = array('a', 'b', 'c', 'd');

permutations(array(), $elems);

function permutations($prefix, $sufix) {
    if (count($prefix)) {
        printPermutation($prefix);
    }
    if (count($sufix)) {
        for ($i = 0; $i < count($sufix); $i++) {
            $newPrefix = $prefix;
            array_push($newPrefix, $sufix[$i]);
            $newSufix = $sufix;
            array_splice($newSufix, $i, 1);
            permutations($newPrefix, $newSufix);
        }
    }
}

function printPermutation($permutation) {
    print "<div>";
    foreach ($permutation as $elem) {
        print "$elem";
    }
    print "</div>";
}