<?php

/*
 * Чистим приходящие данные и возвращаем
 * */

class Clean
{
    public $value;

    public function cleanData($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }
}