<?php

namespace app\core;

class Router
{
    protected  $routes = [];

    public  $request;
    public  $response;


    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        // this makes get requsests posible
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        // this maker post requests posible
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {

        $path = $this->request->getPath();

        $method = $this->request->method();
        // if there is a route with this method and path, it will return an object,
        // else null which will be set to false with the help of ??
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false)
        {
            // Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        // if the $callback is a string(not a function) render the view with the name of that string
        if(is_string($callback))
        {
            return $this->renderView($callback);
        }
        // if the $callback is an array make the first element of array an object.
        // $this->render() in  controller works if it is an instance of class(object)
        if(is_array($callback))
        {
            $callback[0] = new $callback[0]();
        }

        // else call the $callback function, and pass the request so in controller I can use $request
        return call_user_func($callback, $this->request, $this->response ?? "");

    }

    public function renderView($view, $param = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $param);

        // find the string "{{content}}" in $layoutContent and replace it with $viewContent
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        // include but dont show yet(creates an output buffer)
        ob_start();
        include_once __DIR__."/../views/layouts.php";
        // returns the contents of the output buffer and then deletes the contents from the buffer.
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $param = [])
    {
        foreach ($param as $key => $value) {
            // one $ returns the variables value the second makes variable with that namespace
            // (the variable which is named as the keys is in parameters key value pares)
            $$key = $value; //($data as in FormController)
        }

        // include but dont show yet(creates an output buffer)
        ob_start();
        include_once __DIR__."/../views/$view.php";
        // returns the contents of the output buffer and then deletes the contents from the buffer.
        return ob_get_clean();
    }
}
