<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    public function getTripsByUser(User $user) {
        $loggedUser = $this->getLoggedUser();
        $this->validateLoggedUser($loggedUser);

        return $user->isFriendOf($loggedUser) ?
            $this->findTripsByUser($user) : [];
    }

    protected function getLoggedUser()
    {
        return UserSession::getInstance()->getLoggedUser();
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
