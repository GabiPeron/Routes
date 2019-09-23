<?php

    class Router {

        private $serv_url;

        public function __construct($serv_url) {
            $this->serv_url = $serv_url;
        }

        public function route() {
            $routes = json_decode(file_get_contents("./routes/routes.json"));
            
            if (in_array($this->serv_url, $routes->routes)) {
                $this->register_route($this->serv_ur, $routes);
            }    
        }

        public function call($call) {
            if (file_exists("./controllers/".$call[0]."Controller.php")) {
                require_once "./controllers/".$call[0]."Controller.php";

                $class = $call[0]."Controller";
                $controller = new $class();
                $method = $call[1];
                
                $controller->$method();
            }else{
                echo "Controller: "."./controllers/".$call[0]."Controller.php does not exist!";
            }
        }

        public function get($url, $method) {
            $routes = json_decode(file_get_contents("./routes/routes.json"));
            
            if (!in_array($url, $routes->routes)) {
                $this->register_route($url, $routes);
            }

            $call = explode(":", $method);

            $this->call($call);
        }

        public function register_route($url, $routes) {
            array_push($routes->routes, $url);
            $jsondata = json_encode($routes, JSON_PRETTY_PRINT);
            file_put_contents("./routes/routes.json", $jsondata);
        }
        

    }

?>