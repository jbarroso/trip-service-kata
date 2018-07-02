<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
use TripServiceKata\Trip\TripDAO;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{

    /**
     * @var UserSession
     */
    private $userSession;

    /**
     * @var TripDAO
     */
    private $tripDAO;

    function __construct(UserSession $userSession, TripDAO $tripDAO)
    {
        $this->userSession = $userSession;
        $this->tripDAO = $tripDAO;
    }

    public function getTripsByUser(User $user)
    {
        $loggedUser = $this->getLoggedUser();
        $this->validateLoggedUser($loggedUser);

        return $user->isFriendOf($loggedUser) ?
            $this->findTripsByUser($user) : [];
    }

    private function getLoggedUser()
    {
        return $this->userSession->getLoggedUser();
    }

    private function validateLoggedUser($loggedUser)
    {
        if ($loggedUser === null) {
            throw new UserNotLoggedInException();
        }
    }

    protected function findTripsByUser(User $user)
    {
        return $this->tripDAO->findTripsBy($user);
    }
}
