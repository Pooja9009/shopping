<?php

function filled_out($form_vars): bool
{
    // test that each variable has a value
    foreach ($form_vars as $key => $value) {
        if (!isset($key) || '') {
            return false;
        }
    }
    return true;
}

