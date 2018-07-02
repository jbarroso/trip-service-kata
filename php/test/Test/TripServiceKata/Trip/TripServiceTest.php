<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\User\User;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripServiceTest extends TestCase
{

    public function testShouldThrowUserNotLoggedInException()
    {
        $this->expectException(UserNotLoggedInException::class);

        $loggedUser = null;
        $tripService = new TestableTripService($loggedUser);

        $user = new User('myUserName');
        $tripService->getTripsByUser($user);
    }

    public function testShouldReturnAnEmptyTripListWhenUsersAreNotFriends()
    {
        $loggedUser = new User('loggedUserName');
        $tripService = new TestableTripService($loggedUser);

        $user = new User('myUserName');
        $trips = $tripService->getTripsByUser($user);

        $this->assertEquals([], $trips);
    }
}
