<?php

namespace Test\TripServiceKata\Trip;

use TripServiceKata\Trip\TripService;

/**
 * Description of TestableTripService
 *
 * @author jbarroso
 */
class TestableTripService extends TripService
{

    private $loggedUser;

    function __construct($loggedUser)
    {
        $this->loggedUser = $loggedUser;
    }

    protected function getLoggedUser()
    {
        return $this->loggedUser;
    }
}
