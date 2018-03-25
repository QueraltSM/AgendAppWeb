<?php
class DB{
    private static $connection = null;
    
    public static function get(){
        
        if(self::$connection === null){
            self::$connection = $bd = new PDO('sqlite:C:\xampp\htdocs\Agendapp\Database\data.db');  
            self::$connection->exec('PRAGMA foreign_keys = ON;');
            self::$connection->exec('PRAGMA encoding="UTF-8";');
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$connection;
    }
    public static function execute_sql($sql,$parms=null){
        try {
            $db = self::get();
            $ints= $db->prepare ( $sql );
            if ($ints->execute($parms)) {
                return $ints;
            }
        }
        catch (PDOException $e) {
            echo '';
        }
        return false;
    }
    public static function user_exists($usuario,$pass, &$res){
        $db = self::get();
        $inst=$db->prepare('SELECT * FROM usuarios WHERE cuenta=? and clave=?');
        $inst->execute(array($usuario,$pass));
        $inst->setFetchMode(PDO::FETCH_NAMED);
        $res=$inst->fetchAll();
        return count($res) == 1;
    }
}