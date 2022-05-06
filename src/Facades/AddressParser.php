<?php

namespace Zifan\LaravelAddressParser\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AddressParser
 * @method static array smart(string $address)
 * @method static array|false|string[]|null handle(string $address)
 * @method static array getAreas()
 * @method static \Zifan\AddressParser\AddressParser release()
 * @method static \Zifan\AddressParser\AddressParser config()
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
