<?php

/*
 * TOKENIZER lib
 * v.2023.10.18
 * Stefano Braconi
 */

// Sort token separator from large to small.
function separators_sort(&$separators) {
    $count = count($separators);
    $swapstring = '';

    for ($i = 0; $i < $count; $i++) {
        for ($j = $i + 1; $j < $count; $j++) {
            if (strlen($separators[$i]) < strlen($separators[$j])) {
                $swapstring = $separators[$i];
                $separators[$i] = $separators[$j];
                $separators[$j] = $swapstring;
            }
        }
    }
}

// This function search for all delimiter and merge in one string.
function excluder($tokens, $excludestringin, $excludestringout) {
    $filtered = [];
    $flag_found = false;
    $idx_target = 0;
    for ($idx = 0; $idx <= count($tokens); $idx++) {
        if ($tokens[$idx] == $excludestringin && $flag_found == false) {
            $flag_found = true;
            $idx++;
        }
        if ($flag_found == false && $tokens[$idx] != $excludestringin) {
            $filtered[$idx_target] = $tokens[$idx];
            $idx_target++;
        }
        if ($flag_found == true && $tokens[$idx] != $excludestringout) {
            $filtered[$idx_target] .= $tokens[$idx];
        }
        if ($flag_found == true && $tokens[$idx] == $excludestringout) {
            $idx_target++;

            $flag_found = false;
        }
    }
    return $filtered;
}

function tokenizer($sourcetext, $separators, $excludestart = null, $excludestop = null, $deleteblank = false) {
    separators_sort($separators);
    $tokens = [];
    $source_cursor = 0;
    $create_string = "";
    $test = "";
    $found = false;
    $sourcetext_len = strlen($sourcetext);

    while ($source_cursor < $sourcetext_len) {
        // For every delimiter tokens scan if present in current position. 
        foreach ($separators as $sep) {
            if (!$found) {
                $test = substr($sourcetext, $source_cursor, strlen($sep));
                if ($test == $sep) {
                    $tokens[] = $create_string;
                    $tokens[] = $test;
                    $source_cursor += strlen($test) - 1; // Shift cursor index after separator token found
                    $create_string = "";
                    $found = true;
                } else {
                    $found = false;
                }
            }
        }
        if (!$found) {
            $create_string .= $sourcetext[$source_cursor];
        }
        $source_cursor++;
        $found = false;
    }

    // If flag is true, delete initial and final blank
    if ($deleteblank) {
        foreach ($tokens as &$token) {
            $token = trim($token);
        }
    }

    // Delete blank or null tokens
    $tokens = array_filter($tokens, function ($token) {
        return !empty($token) && $token != " ";
    });

    if (isset($excludestart) && isset($excludestop)) {

        $tokens = excluder($tokens, $excludestart, $excludestop);
        // Eliminiamo elementi che contengono solo spazi
        $tokens = array_filter($tokens, function ($element) {
            // Utilizza trim() per rimuovere gli spazi in eccesso e controlla se la stringa risulta vuota

            return !empty(trim($element));
        });
    } else {

        $tokens = array_filter($tokens, function ($element) {
            // Utilizza trim() per rimuovere gli spazi in eccesso e controlla se la stringa risulta vuota

            return !empty(trim($element));
        });
    }

    return $tokens;
}

?>