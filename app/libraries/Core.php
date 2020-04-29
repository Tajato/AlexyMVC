<?php
/* 
    *App Core Class
    *Creates URL & loads Controller
    *URL FORMAT - /controller/method/params 
*/


class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
    // print_r($this->getUrl()); // returning an array, so use print_r
        $url = $this->getUrl();
        //Look in the controllers folder for the first index(eg.pages.php,posts.php)
        if (isset($url[0])) 
        {

            if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php'))
            {
            // if file exists, set it to the current controller
            $this->currentController = ucwords($url[0]);

            //Unset the index, so that 0 doesn't stay in there
            unset($url[0]);
            }
        }
        // require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        // instantiate controller class
        $this->currentController = new $this->currentController;
        /* the above is Pages = new Pages; */

        // Check for second part of url which is the method
        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
            }
            // Unset the index
            unset($url[1]);
        }
        

        // Get the parameters now
         $this->params = ($url) ? array_values($url) : [];

         // call a call back with array of parameters
            call_user_func_array([$this->currentController,$this->currentMethod],$this->params);

    }

    public function getUrl()
     {
       if (isset($_GET['url']))
        {
           $url = rtrim($_GET['url'],'/'); // removes slash(/) from url
           $url = filter_var($url, FILTER_SANITIZE_URL); // sanitize the url so PHP knows it's a url and treats it strictly as one
           $url = explode('/',$url);//break it into an array and each element should be an element that was separated by slash
           return $url;// url was posts/edit/1 , these functions turn it into an array of posts, edit, 1
       } 
    }

}
