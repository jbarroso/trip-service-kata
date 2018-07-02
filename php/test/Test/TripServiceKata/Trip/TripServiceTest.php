<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
use TripServiceKata\Trip\Trip;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripServiceTest extends TestCase
{

    /**
     * @var User
     */
    private $loggedUser;

    /**
     * @var User
     */
    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->loggedUser = new User('loggedUserName');
        $this->user = new User('myUserName');
    }

    public function testShouldThrowUserNotLoggedInException()
    {
        $this->expectException(UserNotLoggedInException::class);

        $this->loggedUser = null;

        $this->getTripsByUser();
    }

    public function testShouldReturnAnEmptyTripListWhenUsersAreNotFriends()
    {
        $this->assertEquals([], $this->getTripsByUser());
    }

    public function testShouldReturnATripListWhenUsersAreFriends()
    {
        $this->user->addFriend($this->loggedUser);
        $trip = new Trip();
        $this->user->addTrip($trip);

        $this->assertEquals([$trip], $this->getTripsByUser());
    }

    private function getTripsByUser()
    {
        $tripService = new TestableTripService($this->getUserSessionMock());
        return $tripService->getTripsByUser($this->user);
    }

    private function getUserSessionMock()
    {
        $userSession = $this->createMock(UserSession::class);
        $userSession->expects($this->once())
            ->method('getLoggedUser')
            ->willReturn($this->loggedUser);
        return $userSession;
    }
}
