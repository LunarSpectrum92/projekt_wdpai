<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../src/repository/ServiceRepository.php';
require_once __DIR__.'/../src/media/Service.php';

class ServiceRepositoryTest extends TestCase
{
    protected static $serviceRepository;

    public static function setUpBeforeClass(): void
    {
        self::$serviceRepository = new ServiceRepository();
    }

    public function testGetObjects()
    {
        $services = self::$serviceRepository->getObjects();

        $this->assertIsArray($services);
        $this->assertGreaterThan(0, count($services));
        $this->assertInstanceOf(Service::class, $services[0]);
    }

    public function testGetObject()
    {
        $serviceId = 1;
        $service = self::$serviceRepository->getObject($serviceId);

        $this->assertInstanceOf(Service::class, $service);
        $this->assertEquals($serviceId, $service->getserviceId());
    }

}
