<?php

function isNotNull($input):bool {

    return !empty($input);
}

function isInt($input):bool {

    return is_numeric($input);
}