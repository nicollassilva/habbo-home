<?php

namespace App\Services;

use App\Models\User;
use HabboAPI\HabboAPI;
use HabboAPI\HabboParser;

class HabboService
{
    /** @var object */
    protected $api;

    /** @var object */
    protected $user;

    /**
     * Method responsible for starting the API process
     * 
     * @return this
     */
    public function make(User $user)
    {
        $this->user = $user;

        $this->instanciateHabboApi('com.br');

        return $this;
    }

    /**
     * Method responsible for instantiating the Habbo API
     */
    protected function instanciateHabboApi(String $userDomain)
    {
        $parser = new HabboParser($userDomain);
        
        $this->api = new HabboAPI($parser);
    }

    /**
     * Return all user information
     */
    public function getHabbo()
    {
        return $this->api->getHabbo($this->user->username);
    }

    /**
     * Return user profile
     */
    public function profile()
    {
        return $this->api->getProfile(
            $this->getHabbo()->getId()
        );
    }

    /**
     * Return all user badges
     */
    public function badges()
    {
        return $this->profile()->getBadges();
    }
}