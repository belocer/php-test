<?php

class Clean
{
    public $value;

    public function cleanData($value = '')
    {
        if (is_string($value)) {

            $value = trim($value);
            //$value = stripslashes($value); // Убирает слэши
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
        }

        return $value;
    }

    public function cleanDataHTML($value = '')
    {
        if (is_string($value)) {
            $value = trim($value);
            //$value = htmlentities($value);
        }
        return $value;
    }
}