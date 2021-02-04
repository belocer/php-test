<?php

namespace TestWorks;

class View
{
    public function render(string $filename, array $data = [])
    {
        require_once __DIR__ . '/../views/' . $filename . '.php';
    }
}