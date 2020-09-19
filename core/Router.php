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

        $method = $this->request->getMethod();
        // if there is a route with this method and path, it will return an object,
        // else null which will be set to false with the help of ??
        $callback = $this->routes[$method][$path] ?? false;

        if($callback === false)
        {
            // Application::$app->response->setStatusCode(404);
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }

        if(is_string($callback))
        {
            return $this->renderView($callback);
        }

        return call_user_func($callback);

    }

    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);

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

    protected function renderOnlyView($view)
    {
        // include but dont show yet(creates an output buffer)
        ob_start();
        include_once __DIR__."/../views/$view.php";
        // returns the contents of the output buffer and then deletes the contents from the buffer.
        return ob_get_clean();
    }
}
