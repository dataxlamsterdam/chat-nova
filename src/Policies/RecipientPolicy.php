<?php

namespace Dataxl\NovaChat\Policies;

class RecipientPolicy
{
    public function create()
    {
        return false;
    }

    public function view($user, $chat)
    {
        return true;
    }
}
