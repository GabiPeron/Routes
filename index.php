<?php

    require_once "./routes/Router.php";

    $url = $_SERVER['REQUEST_URI'];

    $url = str_replace("/routes", '', $url);

    $router = new Router($url);

    $router->get('/teste', 'Contato:teste');
    $router->get('/xd', 'Xd:teste');
?>