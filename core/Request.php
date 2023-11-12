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


}

