<?php
require_once 'core/view.php';

// Отображаю ошибки
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$routes = explode('/', $_SERVER['REQUEST_URI']); // Разбиваем uri на элементы и кладём в массив

$controller_name = 'Main';
$action_name = 'index';

/*// получаем контроллер
if (!empty($routes[1])) {
    // Если первый элемент массива routes не пустой тогда кладём его в $controller_name иначе там остаётся слово Main
    $controller_name = $routes[1];
}

// получаем действие
if (!empty($routes[2])) { // Здесь второй эелемент массива т.е. метод который обработает запрос
    $action_name = $routes[2];
}*/

$filename = './controllers/' . ucfirst($controller_name) . '.php'; // Путь до файла в маленьком регистре

try {
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
        // method_exists — Проверяет, существует ли метод в данном классе, и вызываем его без параметров или с
        @$controller->$action_name($routes[2] ? $routes[2] : '');
    } else {
        throw new Exception("Method not found");
    }

} catch (Exception $e) { // В случае ошибки подключается файл 404.php
    require 'errors/404.php';
}

// Третий($routes[3]) ложится параметром для метода!!!!!!!!!!!!!!!!!!