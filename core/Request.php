<?php

class Request{
    private static $php_self="";
    private static $request_uri="";
    private static $script_filename="";
    private static $document_root="";
    function __construct()
    {   
        //Obtiene la url de referencia al archivo que se accede
        self::$php_self = $_SERVER['PHP_SELF']; // /Chevez-IT/GestorSolicitudes/index.php/hola
        //echo self::$php_self ."<br>";

        //Obtiene la uri de la solicitud
        self::$request_uri = $_SERVER['REQUEST_URI'];// /Chevez-IT/GestorSolicitudes/hola
        //echo self::$request_uri."<br>";

        //Obteniene la url completa del archivo que se accede
        self::$script_filename = $_SERVER['SCRIPT_FILENAME'];// D:/xampp/htdocs/Chevez-IT/GestorSolicitudes/index.php
        //echo self::$script_filename."<br>";

        //Obtiene el direcctorio del proyecto
        self::$document_root = $_SERVER['DOCUMENT_ROOT'];// D:/xampp/htdocs
        //echo self::$document_root."<br>";
    }
    public static function getUrl(){
        // Ruta completa al script PHP actual
        $path_origin = self::$script_filename; // D:/xampp/htdocs/Chevez-IT/GestorSolicitudes/index.php
        // echo $path_origin;
    
        // Ruta principal del documento root al script PHP actual
        $path_main = self::$document_root . self::$php_self;// D:/xampp/htdocs/Chevez-IT/GestorSolicitudes/index.php/hola
        // echo $path_main ;
    
        // Obtener solo la URI, es decir, la parte después del script PHP actual
        $request_url = str_replace($path_origin, '', $path_main); // /hola
        //echo $request_url;
        
        // Obtener / siempre que la uri sea vacia
        return empty($request_url)?'/' :$request_url;

    }

    public static function getPublicUrl(){
        $path_origin = self::$script_filename;
        $request_uri = self::$request_uri;
        $path_main = self::$document_root.self::$php_self;
        $request_url = str_replace($path_origin,'',$path_main);
        $public_path= str_replace($request_url, '', $request_uri);
        return $public_path;
    }

    
   public function validate($routes,$url){
    foreach ($routes as $route) {
        $regex_route = preg_replace_callback(
            '/{([^}]+)}/',
            function ($matches) {
                return "(?P<" . $matches[1] . ">[^/]+)";
            },
            $route['path']
        );
        $regex_route = str_replace("/", "\/", $regex_route);
        $regex_route = '/^' . $regex_route . '$/';
        if (preg_match($regex_route, $url,$matches)) {
            //Coincidencia encontrada
            foreach ($matches as $key => $value) {
                $params[$key]=$value;
            }
            unset($params[0]);
            if(is_callable($route['class'])){
                $response = $route['class']($params);
                if(is_array($response)){
                    $response = json_encode($response);
                    header('Content-Type: application/json');
                    echo $response; 
                    return false;
                }else{
                    return $response;
                }
            }   
            if(is_string($route['class'])){
                $route_class = $route['class'];
                $array_class = explode('@', $route_class);
                $controller = new $array_class[0]();
                $method = $array_class[1];
               
                $response = $controller->$method(...array_values($params));
                if(is_array($response)){
                    $response = json_encode($response);
                    header('Content-Type: application/json');
                    echo $response; 
                    return false;
                }else{
                    return $response;
                }
            }
        }
    }
    return view("error.404");
   }
}