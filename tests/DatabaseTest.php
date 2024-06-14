<?php

use PHPUnit\Framework\TestCase;

require_once 'Database.php'; 

class DatabaseTest extends TestCase
{
    protected static $db;

    public static function setUpBeforeClass(): void
    {
        self::$db = Database::getInstance();
    }

    public function testConnection()
    {
        $connection = self::$db->getConnection(); 
        $this->assertInstanceOf(PDO::class, $connection);
    }

    public function testSingletonInstance()
    {
        $dbInstance1 = Database::getInstance();
        $dbInstance2 = Database::getInstance();

        $this->assertSame($dbInstance1, $dbInstance2);
    }

}


