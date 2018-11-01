<?php

$specifications = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'http-status-codes.csv');

$lines = preg_split('/\r?\n/', $specifications);
unset($lines[0]);
$constants = array();
$switch = array();
foreach ($lines as $_index => $_content) {
    if (1 === preg_match('/^\s*$/', $_content)) {
        continue;
    }
    $matches = array();
    if (1 === preg_match('/^([^,]+),([^,]+),(.*)$/', $_content, $matches)) {
        if ('Unassigned' == $matches[2]) {
            continue;
        } elseif (strlen($matches[3]) > 0) {
            $name = description_to_name($matches[2]);
            $constants[] = sprintf('const HTTP_%s = %d;', $name, $matches[1]);
            $switch[] = sprintf('case self::HTTP_%s: { return "See %s"; }', $name, reference_to_string($matches[3]));
        } else {
            print "Invalid CSV line found (missing reference): [$_content]\n";
            exit(1);
        }
    } else {
        print "Invalid CSV line found: [$_content]\n";
        exit(1);
    }
}

printf("%s\n\n%s", join("\n", $constants), join("\n", $switch));


function description_to_name($in_description) {

    if ('(Unused)' == $in_description) {
        return 'UNUSED';
    }

    $in_description = preg_replace('/\-/', '_', $in_description);
    $in_description = preg_replace('/ /', '_', $in_description);
    return strtoupper($in_description);
}

function reference_to_string($in_reference) {
    $in_reference = preg_replace('/^"/', '', $in_reference);
    return preg_replace('/"$/', '', $in_reference);
}