<?php

$s = 'abcabcd';
$hasPeriod = false;

for ($periodLen = 1; $periodLen <= strlen($s) / 2; $periodLen++) {
    if (strlen($s) % $periodLen != 0) continue;

    $period = substr($s, 0, $periodLen);
    $startPos = $periodLen;
    $hasPeriod = true;
    while ($startPos < strlen($s)) {
        if (strpos($s, $period, $startPos) == $startPos) {
            $startPos += $periodLen;
        } else {
            $hasPeriod = false;
            break;
        }
    }

    if ($hasPeriod) break;
}

if ($hasPeriod) {
    echo "Period: $period";
} else {
    echo "No period in string";
}