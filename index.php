<?php

function revertPunctuationMarks($inputString, $letterPattern = '/[\wа-я]/i'){
    if (empty($inputString)) {
        return $inputString;
    }
    $index = 0;
    $length = mb_strlen($inputString);
    $charsList = array();
    while ($index < $length) {
        $charsList[] = mb_substr($inputString, $index++, 1);
    }
    $indexFromBegin = 0;
    $indexFromEnd = count($charsList) - 1;
    while ($indexFromBegin < $indexFromEnd) {
        while (preg_match($letterPattern, $charFromBegin = $charsList[$indexFromBegin]) && $indexFromBegin < $indexFromEnd) {
            $indexFromBegin++;
        }
        while (preg_match($letterPattern, $charFromEnd = $charsList[$indexFromEnd]) && $indexFromBegin < $indexFromEnd) {
            $indexFromEnd--;
        }
        if ($indexFromBegin < $indexFromEnd) {
            $charsList[$indexFromBegin] = $charFromEnd;
            $charsList[$indexFromEnd] = $charFromBegin;
            $indexFromBegin++;
            $indexFromEnd--;
        }
    }
    return implode('', $charsList);
}

