<?php

namespace Dataxl\NovaChat\Policies;

class MessagePolicy
{
    public function create()
    {
        return true;
    }

    public function view()
    {
        return true;
    }
}
