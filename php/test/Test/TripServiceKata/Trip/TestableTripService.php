<?php

namespace Test\TripServiceKata\Trip;

use TripServiceKata\Trip\TripService;
use TripServiceKata\User\User;

/**
 * Description of TestableTripService
 *
 * @author jbarroso
 */
class TestableTripService extends TripService
{

    protected function findTripsByUser(User $user)
    {
        return $user->getTrips();
    }
}
