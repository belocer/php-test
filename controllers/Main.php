<?php // Главная страница

namespace TestWorks;


class Main
{

    public function Index()
    {
        $view = new View();
        $view->render('index');
    }
}