<?php

/**
 * Find index of a unique char in a string. If there are no unique char return -1.
 * @param string $s
 * @return int
 */
function findUniqueString(string $s): int
{
    $stringArray = [];

    for ($i = 0; $i < strlen($s); $i++){
        if (isset($stringArray[$s[$i]])){
            $stringArray[$s[$i]]['count'] +=1;
        }else {
            $stringArray[$s[$i]] = ['position' => $i+1, 'count' => 1];
        }
    }

    foreach ($stringArray as $data){
        if ($data['count'] == 1){
            return $data['position'];
        }
    }

    return -1;
}

echo findUniqueString('hashthegame');

exit('test');
