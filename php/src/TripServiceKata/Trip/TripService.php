<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    /**
     * @var UserSession
     */
    private $userSession;

    function __construct(UserSession $userSession)
    {
        $this->userSession = $userSession;
    }

    public function getTripsByUser(User $user) {
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
        return TripDAO::findTripsByUser($user);
    }

}
