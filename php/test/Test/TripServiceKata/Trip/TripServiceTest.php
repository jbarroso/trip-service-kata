<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\User\User;
use TripServiceKata\Trip\TripService;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripServiceTest extends TestCase
{

    /**
     * @var TripService
     */
    private $tripService;

    protected function setUp()
    {
        $loggedUser = null;
        $this->tripService = new TestableTripService($loggedUser);
    }

    public function testShouldThrowUserNotLoggedInException()
    {
        $this->expectException(UserNotLoggedInException::class);
        $user = new User('myUserName');
        $this->tripService->getTripsByUser($user);
    }
}
