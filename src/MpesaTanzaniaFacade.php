<?php

namespace Epmnzava\MpesaTanzania;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Epmnzava\MpesaTanzania\Skeleton\SkeletonClass
 */
class MpesaTanzaniaFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mpesa-tanzania';
    }
}
