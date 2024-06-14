<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../src/repository/EmployeeOrdersRepository.php';
require_once __DIR__.'/../src/media/employeeOrders.php';


class EmployeeOrdersRepositoryTest extends TestCase
{
    protected static $employeeOrdersRepository;

    public static function setUpBeforeClass(): void
    {
        self::$employeeOrdersRepository = new EmployeeOrdersRepository();
    }

    public function testGetObjects()
    {
        $employeeOrders = self::$employeeOrdersRepository->getObjects();

        $this->assertIsArray($employeeOrders);
        $this->assertGreaterThan(0, count($employeeOrders));
        $this->assertInstanceOf(EmployeeOrders::class, $employeeOrders[0]);
    }

    public function testGetObjectsById()
    {
        $userId = 164; 

        $employeeOrders = self::$employeeOrdersRepository->getObjectsById($userId);

        $this->assertIsArray($employeeOrders);
        foreach ($employeeOrders as $order) {
            $this->assertInstanceOf(EmployeeOrders::class, $order);
            $this->assertEquals($userId, $order->getUserId());
        }
    }

    public function testGetObject()
    {
        $orderId = 107; 

        $result = self::$employeeOrdersRepository->getObject($orderId);

        $this->assertTrue($result);
    }

}

