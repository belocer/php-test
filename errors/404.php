<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once __DIR__ . '/../views/header.php';
echo "<h1 style='margin: 5rem auto 0; text-align: center;'>404!</h1>";
?>

    <img src="/../views/img/batman_vs_superman.gif" alt="batman vs superman">

<?php

if (file_exists('debug')) {
    echo $e->getMessage();
}
require_once __DIR__ . '/../views/footer.php';