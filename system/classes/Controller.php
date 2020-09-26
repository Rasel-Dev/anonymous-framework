<?php

/**
 * Main Controller
 */
class Controller
{

   public function view($viewName, $data = [])
   {

      if (file_exists("../app/views/" . $viewName . ".php")) {
         // $cache = new Cache();
         // $url = $cache->startFullCache();
         require_once "../app/views/$viewName.php";
         // $cache->endFullCache($url);
      } else {
         echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry $viewName.php file not found </div>";
      }
   }

   public function model($modelName)
   {

      if (file_exists("../app/models/" . $modelName . ".php")) {

         require_once "../app/models/$modelName.php";
         return new $modelName;
      } else {
         echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry $modelName Model file not found </div>";
      }
   }

   public function input($inputName)
   {

      if ($_SERVER['REQUEST_METHOD'] == "POST" || $_SERVER['REQUEST_METHOD'] == 'post') {

         return trim(strip_tags($_POST[$inputName]));
      } else if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'get') {

         return trim(strip_tags($_GET[$inputName]));
      }
   }

   public function helper($helperName)
   {

      if (file_exists("../system/helpers/" . $helperName . ".php")) {

         require_once "../system/helpers/" . $helperName . ".php";
      } else {
         echo "<div style='margin:0;padding: 10px;background-color:silver;'>Sorry helper $helperName file not found </div>";
      }
   }

   // Set session
   public function setSession($sessionName, $sessionValue)
   {


      if (!empty($sessionName) && !empty($sessionValue)) {
         $_SESSION[$sessionName] = $sessionValue;
      }
   }

   // Get session
   public function getSession($sessionName)
   {

      if (!empty($sessionName)) {
         return $_SESSION[$sessionName];
      }
   }

   // Unset session
   public function unsetSession($sessionName)
   {

      if (!empty($sessionName)) {

         unset($_SESSION[$sessionName]);
      }
   }

   // Destroy whole sessions
   public function destroy()
   {
      session_destroy();
   }


   // Set flash message
   public function setFlash($flashes = [])
   {
      if (!empty($flashes)) {

         foreach ($flashes as $name => $message) {
            $_SESSION[$name] = $message;
         }
      }
   }

   //Show flash message
   public function getFlash($sessionName)
   {

      if (!empty($sessionName) && isset($_SESSION[$sessionName])) {

         echo $_SESSION[$sessionName];
         unset($_SESSION[$sessionName]);
      }
   }

   public function redirect($path)
   {
      $path = $path === '/' ? '' : $path;
      header("location:" . BASEURL . $path);
   }
}
