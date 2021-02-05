<?php

namespace TestWorks;

use Dbconnect;

require_once __DIR__ . '/../models/db/dbconnect.php';

class Comments
{
    private $db;

    public function __construct()
    {
        mb_internal_encoding('UTF-8');
        $this->db = new Dbconnect;
    }

    public function getComments()
    {
        $query = 'SELECT * FROM `comments`';
        return $this->db->getRows($query);
    }

    public function commentsCreate($user_name, $user_email, $comment_title, $comment_text)
    {
        $query = "INSERT INTO `comments` (`user_name`, `user_email`, `comment_title`, `comment_text`) VALUES (?, ?, ?, ?);";
        return $this->db->insertRow($query, [$user_name, $user_email, $comment_title, $comment_text]);
    }
}