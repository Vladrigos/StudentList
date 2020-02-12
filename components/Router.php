<?php  

class Router
{
    
    private $routes;
    
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    
    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    
    public function run()
    {
        //Получить строку запроса
        $uri = $this->getURI();
        //Отделить GET-запрос от пути
        $uri = parse_url($uri);
        $uri = trim($uri["path"], '/');

        $result = 0;
        //Проверить наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path) 
        {
            //Сравниваем $uriPattern и $uri
            if(preg_match("!$uriPattern!", $uri))
            {
                //Определить какой контроллер
                //и action обрабатывают запрос         
                $segments = explode('/', $path);
                
                //удаляем первый элемент массива и добавляем Controller
                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);             
                $actionName = 'action' . ucfirst(array_shift($segments));
                
                //Подключаем файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' .
                        $controllerName . '.php';
                
                if(file_exists($controllerFile))
                {
                    include_once($controllerFile);
                }
                
                //Создаем обьект, вызываем метод(action)
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                //если нашли - выходим с цикла
                if($result != null)
                {
                    break;
                }
            }
            
        }
        //Если пути нет, 404
        if($result == 0)
        {
            include_once("views/404.html");
        }

        //Если есть совпадение, определить какой контроллер и action обрабатывает запрос
        
        //Подключить файл класса-контроллера
        
        //Создать обьект, вызвать метод(т.е. action)
        
    }
    
}