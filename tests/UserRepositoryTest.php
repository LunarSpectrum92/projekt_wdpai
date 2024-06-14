<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../src/repository/UserRepository.php';
require_once __DIR__.'/../src/media/User.php';



class UserRepositoryTest extends TestCase
{
    protected static $userRepository;

    public static function setUpBeforeClass(): void
    {
        self::$userRepository = new UserRepository();
    }

    public function testGetObject()
    {
        $email = 'admin@admin.pl';
        $user = self::$userRepository->getObject($email);

        $this->assertEquals($email, $user->getEmail());
    }

    public function testGetObjects()
    {
        $users = self::$userRepository->getObjects();

        $this->assertIsArray($users);
        $this->assertGreaterThan(0, count($users));
        $this->assertInstanceOf(User::class, $users[0]);
    }

    public function testGetObjectsById()
    {
        $role = 'admin';
        $users = self::$userRepository->getObjectsById($role);

        $this->assertIsArray($users);
        foreach ($users as $user) {
            $this->assertInstanceOf(User::class, $user);
            $this->assertEquals($role, $user->getRole());
        }
    }

    public function testCreateUser()
    {
        $name = 'John';
        $surname = 'Doe';
        $email = 'john.dsoe@example.com';
        $password = 'password';
        $phonenumber = '123456789';
        $street = '123 Main St';
        $city = 'Anytown';

        self::$userRepository->createUser($name, $surname, $email, $password, $phonenumber, $street, $city);

        $createdUser = self::$userRepository->getObject($email);

        $this->assertEquals($name, $createdUser->getName());
        $this->assertEquals($surname, $createdUser->getSurname());
        $this->assertEquals($email, $createdUser->getEmail());
    }

    public function testDeleteObject()
    {
        $email = 'delete@example.com';

        self::$userRepository->createUser('Delete', 'Me', $email, 'password', '123456789', '123 Main St', 'Anytown');

        $createdUser = self::$userRepository->getObject($email);
        $this->assertInstanceOf(User::class, $createdUser);

        $result = self::$userRepository->deleteObject($email);
        $this->assertTrue($result);

        $deletedUser = self::$userRepository->getObject($email);
        $this->assertNull($deletedUser);
    }

}

?>
