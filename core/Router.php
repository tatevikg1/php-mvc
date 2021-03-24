<?php

declare(strict_types=1);

namespace app\core;

use app\core\exception\NotFoundException;

class Router
{
    protected  $routes = [];
    public  $request;
    public  $response;

    /**
     * @param Request $request
     * @param Response $response
    */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * This makes get requests possible
     * @param string $path
     * @param callable $callback
     */
    public function get(string $path, callable $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * This makes post requests possible
     * @param string $path
     * @param callable $callback
     */
    public function post(string $path, callable $callback)
    {
        $this->routes['post'][$path] = $callback;
    }


    /**
     * @throws NotFoundException
     */
    public function resolve()
    {
        $path = $this->request->getPath();

        $method = $this->request->method();
        // if there is a route with this method and path, it will return an object,
        // else null which will be set to false with the help of ??
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            // Application::$app->response->setStatusCode(404); (it is done in Application::run function)
            throw new NotFoundException();
        }
        // if the $callback is a string(not a function) render the view with the name of that string
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        // if the $callback is an array make the first element of array an object.
        // $this->render() in  controller works if it is an instance of class(object)
        if (is_array($callback)) {
            Application::$app->controller = new $callback[0]();
            $controller = Application::$app->controller;
            $callback[0] = $controller;

            // callback at index one is the action of controller
            $controller->action =  $callback[1];
            // get all middlewares for the action and execute them
            foreach($controller->getMiddlewares() as $middleware){
                $middleware->execute();
            }
        }

        // else call the $callback function, and pass the request so in controller I can use $request
        return call_user_func($callback, $this->request, $this->response ?? "");
    }

    /**
     * Renders the view, replacing layouts {{ content }} with view content.
     * @param string $view
     * @param array $param
     * @return string|false
    */
    public function renderView(string $view, array $param = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $param);

        // find the string "{{content}}" in $layoutContent and replace it with $viewContent
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Includes the layout template for the page view.
    */
    protected function layoutContent()
    {
        // include but don't show yet(creates an output buffer)
        ob_start();
        include_once __DIR__."/../views/_layouts.php";
        // returns the contents of the output buffer and then deletes the contents from the buffer.
        return ob_get_clean();
    }

    /**
     * Includes the view content (changing the variables in template with parameters passed) for the page view
     * @param string $view
     * @param array $param
     * @return string|false
    */
    protected function renderOnlyView(string $view, array $param = [])
    {
        foreach ($param as $key => $value) {
            // one $ returns the variables value the second makes variable with that namespace
            // (the variable which is named as the keys is in parameters key value pares)
            $$key = $value; //($data as in FormController)
        }

        // include but don't show yet(creates an output buffer)
        ob_start();
        include_once __DIR__."/../views/$view.php";
        // returns the contents of the output buffer and then deletes the contents from the buffer.
        return ob_get_clean();
    }
}
