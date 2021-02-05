<?php
require_once 'core/view.php';

$routes = explode('/', $_SERVER['REQUEST_URI']); // Разбиваем uri на элементы и кладём в массив

$controller_name = 'Main';
$action_name = 'index';

// получаем контроллер
if (!empty($routes[1])) {
    // Если первый элемент массива routes не пустой тогда кладём его в $controller_name иначе там остаётся слово Main
    $controller_name = $routes[1];
}

// получаем метод(действие)
if (!empty($routes[2])) { // Здесь второй эелемент массива т.е. метод который обработает запрос
    $action_name = $routes[2];
}

try {

    //if($controller_name == 'comment') {
    //$filename = 'controllers/comment.php';
    //} else {
    $filename = 'controllers/' . $controller_name . '.php'; // Путь до файла в маленьком регистре
    //$filename = 'controllers/comment.php'; // Путь до файла в маленьком регистре
    //}

    // Если файл контроллера существует мы его подключаем
    if (file_exists($filename)) {
        require_once $filename;
    } else {
        throw new Exception('File not found');
    }

    // Если если класс существует создаём экземпляр класса
    // ucfirst — Преобразует первый символ строки в верхний регистр
    $className = '\TestWorks\\' . ucfirst($controller_name);

    if (class_exists($className)) {
        $controller = new $className();
    } else {
        throw new Exception('File found but class not found');
    }

    // Если метод существует выполняем его
    if (method_exists($controller, $action_name)) {
        // method_exists — Проверяет, существует ли метод в данном классе, и вызываем его без параметров или с парам
        $controller->$action_name($routes[3] = '');
    } else {
        throw new Exception("Method not found");
    }

} catch (Exception $e) { // В случае ошибки подключается файл 404.php
    require 'errors/404.php';
}



// Третий($routes[3]) ложится параметром для метода!!!!!!!!!!!!!!!!!!