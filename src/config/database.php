<?php 

function getPDO() : PDO {
    static $pdo = null;

    if($pdo === null) {
        $config = require __DIR__.'/config.php';
        $db = $config['db'];

        try {
            $pdo = new PDO("{$db['connection']}:host={$db['host']};dbname={$db['name']};charset={$db['charset']}", 
            $db['user'], 
            $db['password']);
        }catch(PDOException $e) {
            die('Error al conectarse a la base de datos: ' . $e->getMessage());
        }
    }
    return $pdo;
}