<?php

require '../.env.local.php';

/**
 * Class PDOFactory
 */
class PDOFactory {
    
    protected static $db;
    
    const HOST = _MYSQL_DNS;
    const USER = _USER;
    const PASSWORD = _PASSWORD;

    /**
     * PDOFactory constructor.
     */
    private function __construct() {}
    private function __clone() {}

    /**
     * @return PDO
     */
    public static function getMysqlConnection() {
        
        if (!isset(self::$db)) {
            self::$db = new PDO(PDOFactory::HOST, PDOFactory::USER, PDOFactory::PASSWORD);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$db;
    }
}
