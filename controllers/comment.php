<?php

namespace TestWorks;

use Clean;

require_once __DIR__ . '/../classes/clean.php';

class Comment
{
    public $errors = [];
    public $user_name;
    public $user_email;
    public $comment_title;
    public $comment_text;

    public function __construct()
    {
        mb_internal_encoding('UTF-8');
        $clean_data = new Clean();
        $this->user_name = $clean_data->cleanData($_POST['user_name']);
        $this->user_email = $clean_data->cleanData($_POST['user_email']);
        $this->comment_title = $clean_data->cleanData($_POST['comment_title']);
        $this->comment_text = $clean_data->cleanData($_POST['comment_text']);
    }

    public function write_comment()
    {
        $this->errors = [];

        $this->validateData();
        if (count($this->errors) === 0) {
            // Если ошибок нет, пишем в БД
            require_once __DIR__ . '/../models/Comments.php';
            $store = new Comments;
            $idRecord = $store->commentsCreate($this->user_name, $this->user_email, $this->comment_title, $this->comment_text);
            echo $idRecord;
        } else {
            echo json_encode($this->errors);
        }
    }

    private function validateData()
    {
        $this->errors = [];
        if (empty($this->user_name)
            || (mb_strlen($this->user_name) < 3)
            || (mb_strlen($this->user_name) > 50)
        ) {
            array_push($this->errors, 'Поле Имя - указано не верно!');
        }

        if (empty($this->user_email) ||
            !filter_var($this->user_email, FILTER_VALIDATE_EMAIL)
            || (mb_strlen($this->user_email) < 3)
            || (mb_strlen($this->user_email) > 50)
        ) {
            array_push($this->errors, 'Указан неверный E-mail !');
        }

        if (empty($this->comment_title)
            || (mb_strlen($this->comment_title) < 3)
            || (mb_strlen($this->comment_title) > 50)
        ) {
            array_push($this->errors, 'Заголовок - должен быть больше 3 символов и меньше 50!');
        }

        if (empty($this->comment_text)
            || (mb_strlen($this->comment_text) < 3)
            || (mb_strlen($this->comment_text) > 500)
        ) {
            array_push($this->errors, 'Комментарий - должен быть больше 3 символов но меньше 500!');
        }
    }

    public function getComment()
    {
        // Беру из БД комментарии
        require_once __DIR__ . '/../models/comments.php';
        $obj_comments = new Comments;
        echo json_encode($obj_comments->getComments());
    }
}