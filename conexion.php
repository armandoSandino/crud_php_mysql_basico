<?php
class Conexion
{
    private static $db = 'crud_mysql';
    private static $server = 'localhost' ;
    private static $user = 'sandino';
    private static $passwd = 'sandino';
    private static $cont  = null;
    public function __construct() {
        die('Init function is not allowed');
    }
    public static function Conectar()
    {
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$server.";"."dbname=".self::$db, self::$user, self::$passwd); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
    public static function Desconectar()
    {
        self::$cont = null;
    }
}
?>