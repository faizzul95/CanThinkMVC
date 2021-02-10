<?php

class App
{
    protected $controller = 'Auth';
    protected $method = 'index';
    protected $params = [];

    function __construct()
    {
        $this->session = new \Configuration\SessionManager();
        $url = $this->urlParse();

        // Controller
        if ( file_exists('../app/controllers/'. ucfirst($url[0]) . '.php') ) {
            $this->controller = ucfirst($url[0]);
            unset($url[0]);
        } else if ( !file_exists('../app/controllers/'. ucfirst($url[0]) . '.php') AND !empty($url[0]) ) {
            $this->controller = 'Errorpage';
        }

        // check permission
        $this->permission($this->controller);

        require_once '../app/controllers/'. $this->controller . '.php';
        $this->controller = new $this->controller;

        // method / function name
        if ( isset($url[1]) ) {
            if ( method_exists($this->controller, $url[1]) ) {
                $this->method =  $url[1];
                unset($url[1]);
            }
        }

        // parameter
        if ( !empty($url) ) {
           $this->params = array_values($url);
        }

        // Run 
        call_user_func_array([$this->controller, $this->method], $this->params);

    }

    public function urlParse()
    {

        if (isset($_GET['url'])) {

            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }

    }

    public function permission($controllerName)
    {
        // check with controller name
        $arrSuperAdminController = array('');
        $arrAdminController = array('');
        $arrSupportController = array('');

        $sessionRoleID = $this->session->get('roleID');

        $result = false;
        
        if ($sessionRoleID == 1 && in_array($controllerName, $arrSuperAdminController))
        {
          $result = true;
        }else if ($sessionRoleID == 2 && in_array($controllerName, $arrAdminController)) {
          $result = true;
        }else if ($sessionRoleID == 3 && in_array($controllerName, $arrSupportController)) {
          $result = true;
        }else if (empty($sessionRoleID)) {
           $result = true;
        }

        if (!$result) {
            $this->controller = 'Errorpage';
        }

    }

}