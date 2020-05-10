<?php

namespace xnf4o\Megogo\Facades;

use Illuminate\Support\Facades\Facade;

class Megogo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'megogo';
    }
}
