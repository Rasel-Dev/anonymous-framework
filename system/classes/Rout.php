<?php

class Rout
{
    /**
     * Default Controller
     */
    private $controller  = 'user';
    private $method      = 'index';
    private $params      = [];

    public function __construct()
    {
        $rout = $this->url();
        if (!empty($rout)) {

            $file_path = '../app/controllers/' . $rout[0] . '.php';
            if (file_exists($file_path)) {
                $this->controller = $rout[0];
                unset($rout[0]);
            } else {
                if (DEBUG_MODE) {
                    echo '<div style="padding:10px;font-family:sans-serif;background:#FFD2D2;color:#D8000C;">
                            <strong>Controller Error:</strong> this <b>' . $rout[0] . '</b> Controller not found...!
                        </div>';
                }
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        if (isset($rout[1]) && !empty($rout[1])) {

            if (method_exists($this->controller, $rout[1])) {

                $this->method = $rout[1];
                unset($rout[1]);
            } else {
                if (DEBUG_MODE) {
                    echo '<div style="padding:10px;font-family:sans-serif;background:#FFD2D2;color:#D8000C;">
                            <strong>Method Error:</strong> this <b>' . $rout[1] . '</b> Method not found...!
                        </div>';
                }
            }
        }

        if (isset($rout)) {

            $this->params = $rout;
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function url()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
