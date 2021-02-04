<?php

namespace Shop;


class Errors
{
    private $errors;
    private $fileName;

    public function __construct($error, $headerTitle, $fileName, $data)
    {
        $this->errors = $error;
        $this->fileName = $fileName;
        $data["errors"][] = $this->errors;
        $view = new View();
        $view->renderAdmin($this->fileName, $headerTitle, $data);
    }
}