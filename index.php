<?php

    require_once "./routes/Router.php";

    $router = new Router();

    $router->get('/teste', 'Contato::teste');

?>