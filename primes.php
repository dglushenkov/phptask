<?php

function getPrimes1($maxCount)
{
    $primes= array(2);
    $count = 1;
    $i = 3;

    while ($count < $maxCount) {
        $sqrt = sqrt($i);
        $isPrime = true;
        foreach ($primes as $prime) {
            if ($prime > $sqrt) break;

            if ($i % $prime == 0) {
                $isPrime = false;
                break;
            }
        }

        if ($isPrime) {
            $primes[] = $i;
            $count++;
        }

        $i++;
    }

    return $primes;
}

function getPrimes2($maxCount)
{
    $primes = array(2);
    $count = 1;
    $i = 3;

    while ($count < $maxCount) {
        $isPrime = true;
        foreach ($primes as $prime) {
            if ($i % $prime == 0) {
                $isPrime = false;
                break;
            }
        }

        if ($isPrime) {
            $primes[] = $i;
            $count++;
        }

        $i++;
    }

    return $primes;
}

function bench($funcName, $maxCount, $times)
{
    $timeStart = microtime(true);

    for ($i = 0; $i < $times; $i++) {
        $funcName($maxCount);
    }

    return microtime(true) - $timeStart;
}

function printPrimes($primes)
{
    echo 'Primes: '.count($primes).'<br>';
    $i = 0;
    foreach ($primes as $prime) {
        echo $i.' = '.$prime.'<br>';
        $i++;
    }
}

//printPrimes(getPrimes1(1000));
//printPrimes(getPrimes2(1000));
echo 'Oksana : '.bench('getPrimes1', 10000, 20).'<br>';
echo 'Dmitry : '.bench('getPrimes2', 10000, 20).'<br>';

