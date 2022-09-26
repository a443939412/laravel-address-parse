<?php

namespace Zifan\LaravelAddressParser\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AddressParser
 * @method static array smart(string $address)
 * @method static array|false|string[]|null handle(string $address)
 * @method static array getAreas()
 * @method static \Zifan\LaravelAddressParser\SmartParser release()
 * @method static \Zifan\LaravelAddressParser\SmartParser config()
 * @method static \Zifan\LaravelAddressParser\SmartParser instance()
 */
class AddressParser extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'addressparser';
    }
}
