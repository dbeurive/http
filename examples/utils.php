<?php

function format_code($in_code) {
    return preg_replace('/^/m', "\t", $in_code);
}