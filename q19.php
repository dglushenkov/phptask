<?php

$words = <<<'EOD'
dfkjsdlkfjc
a123a
c123e
b123d
dd
ab
ab
eb
ab
ba
ab
ba
bb
bb
bb
aa
aa
aa
ba
ba
xy
yz
zx
ax
xa
EOD;

$wordList = preg_split("/\s+/", $words);
$adjacency = array(); //Adjacency Matrix
$allVertex = array(); //All vertixes with their degreeses;

foreach ($wordList as $word) {
    $firstLetter = substr($word, 0, 1);
    $lastLetter = substr($word, -1, 1);
    if (!$adjacency[$firstLetter]) {
        $adjacency[$firstLetter] = array();
    }
    if (!$adjacency[$firstLetter][$lastLetter]) {
        $adjacency[$firstLetter][$lastLetter] = array(
            count => 1,
            words => array($word)
        );
    } else {
        $adjacency[$firstLetter][$lastLetter]['count']++;
        array_push($adjacency[$firstLetter][$lastLetter]['words'], $word);
    }

    if (!$allVertex[$firstLetter]) {
        $allVertex[$firstLetter] = array(
            in => 0,
            out => 1
        );
    } else {
        $allVertex[$firstLetter]['out']++;
    }
    if (!$allVertex[$lastLetter]) {
        $allVertex[$lastLetter] = array(
            in => 1,
            out => 0
        );
    } else {
        $allVertex[$lastLetter]['in']++;
    }
}

//Check if in deegree equals to out deegree for each vertex
$isEulerCircuitPossible = true;
foreach ($allVertex as $vertex) {
    if ($vertex['in'] !== $vertex['out']) {
        $isEulerCircuitPossible = false;
        break;
    }
}

//Check if graph is connected
if ($isEulerCircuitPossible) {
    reset($allVertex);
    $firstVertex = key($allVertex);
    $vertexConnected = array();
    checkConnected(array(
        $firstVertex => true
    ), $vertexConnected, $adjacency);

   if (count($vertexConnected) !== count($allVertex)) {
       $isEulerCircuitPossible = false;
   }

}

if (!$isEulerCircuitPossible) {
    print "No Euler Circuit is possible";
} else {
    reset($allVertex);
    $firstVertex = key($allVertex);
    $path = array();
    $vertexStack = array();
    eulerPath($vertexStack, $firstVertex, $path, $adjacency);
    for ($i = 0; $i < count($path); $i++) {
       print "<div>$path[$i]</div>";
    }
}

function checkConnected($currentVertexes, &$vertexConnected, &$adjacency) {
    $newVertexes = array();
    foreach ($currentVertexes as $vertex => $vertexValue) {
        $vertexConnected[$vertex] = true;
        foreach ($adjacency[$vertex] as $newVertex => $newVertextValue) {
            if (!$newVertexes[$newVertex] && !$vertexConnected[$newVertex]) {
                $newVertexes[$newVertex] = true;
            }
        }
    }

    if (count($newVertexes)) {
        checkConnected($newVertexes, $vertexConnected, $adjacency);
    }
}


function eulerPath(&$vertexStack, $location, &$path, &$adjacency) {
    if (count($adjacency[$location])) {
        reset($adjacency[$location]);
        $newVertex = key($adjacency[$location]);

        $word = array_pop($adjacency[$location][$newVertex]['words']);
        $adjacency[$location][$newVertex]['count']--;

        if (!$adjacency[$location][$newVertex]['count']) {
            unset($adjacency[$location][$newVertex]);
        }

        array_push($vertexStack, array(
            vertex => $location,
            word => $word
        ));

        eulerPath($vertexStack, $newVertex, $path, $adjacency);

    } else {
        if (count($vertexStack)) {
            $topStack = array_pop($vertexStack);
            array_unshift($path, $topStack['word']);
            eulerPath($vertexStack, $topStack['vertex'], $path, $adjacency);
        }
    }
}










