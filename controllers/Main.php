<?php // Главная страница

namespace TestWorks;


class Main
{

    public function Index()
    {
        // Беру категории
        require_once __DIR__ . '/../models/comments.php';
        $obj_comments = new Comments;
        $data = $obj_comments->CommentsGet();

        $view = new View();
        $view->render('index', $data);
    }
}