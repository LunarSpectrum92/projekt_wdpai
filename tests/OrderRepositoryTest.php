<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../src/repository/OrderRepository.php';
require_once __DIR__.'/../src/media/Order.php';
class OrderRepositoryTest extends TestCase
{
    protected static $orderRepository;

    public static function setUpBeforeClass(): void
    {
        self::$orderRepository = new OrderRepository();
    }

    public function testGetObjects()
    {
        $orders = self::$orderRepository->getObjects();

        $this->assertIsArray($orders);
        $this->assertGreaterThan(0, count($orders));
        $this->assertInstanceOf(Order::class, $orders[0]);
    }

    public function testGetObjectsById()
    {
        $userId = 164; 

        $orders = self::$orderRepository->getObjectsById($userId);

        $this->assertIsArray($orders);
        foreach ($orders as $order) {
            $this->assertInstanceOf(Order::class, $order);
            $this->assertEquals($userId, $order->getUserId());
        }
    }

    public function testGetObject()
    {
        $orderId = 107;

        $order = self::$orderRepository->getObject($orderId);

        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($orderId, $order->getId());
    }

 

    public function testChangeObject()
    {
        $orderId = 107; 
        $newStatus = 'w trakcie realizacji';

        $result = self::$orderRepository->changeObject($orderId, $newStatus);

        $this->assertTrue($result);
    }

}

?>
