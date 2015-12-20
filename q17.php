<?php

$n = 100000;
$numbers = array();
for ($i = 1; $i <= $n; $i++) {
    $numbers[$i] = true;
}

$i = 2;
while ($i <= $n / 2) {
    if ($numbers[$i]) {
        $j = 2;
        while ($j * $i <= $n) {
            $numbers[$j * $i] = false;
            $j++;
        }
    }
    $i++;
}

$j = 0;
for ($i = 1; $i <= $n; $i++) {
    if ($numbers[$i]) {
        print "$i ";
        $j++;
    }
}

print "<div>Count: $j</div>";
