<?php
#App Core Class
#Create URL & loads core Controller
#URL FORMAT = /controller/method/params

class Core{
    protected $currentController = "Pages";
    protected $currentMethod = "index";
    protected $params = []; // empty array by default

    #constructor
    public function __construct(){
        //print_r($this->getURL());
        $url = $this->getURL();

        // Look in controllers for first value
        // ucwords PHP function makes first letter uppercase
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            // if exists, set as controller
            $this->currentController = ucwords($url[0]);
            // unset 0 Index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // instantiate controller class
        // eg $page = new Pages;
        $this->currentController = new $this->currentController;

        // check for second part of URL
        if(isset($url[1])){
            // check to see if method from controller exists
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                // unset 1 index
                unset($url[1]);
            }
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getURL(){
       if(isset($_GET['url'])){
           // remove the last bit at the end of the url if it has a slash
           // e.g change /mvc/post/ to /mvc/post
           $url = rtrim($_GET['url'], '/');
           // remove any characters that a URL should not have
           $url = filter_var($url, FILTER_SANITIZE_URL);
           // store url in an array
           $url = explode('/', $url);
           return $url;
       }
    }
}
?>
