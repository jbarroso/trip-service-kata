<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    public function getTripsByUser(User $user) {
        $loggedUser = $this->getLoggedUser();
        if ($loggedUser === null) {
            throw new UserNotLoggedInException();
        }

        return $user->isFriendOf($loggedUser) ?
            $this->findTripsByUser($user) : [];
    }

    protected function getLoggedUser()
    {
        return UserSession::getInstance()->getLoggedUser();
    }

    protected function findTripsByUser(User $user)
    {
        return TripDAO::findTripsByUser($user);
    }
}
