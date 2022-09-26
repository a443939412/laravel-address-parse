<?php

namespace Zifan\LaravelAddressParser;

use Zifan\AddressParser\AddressParser;
use Zifan\LaravelAddressParser\Events\AfterFailedParsing;

class SmartParser extends AddressParser
{
    public function smart(string $address): array
    {
        $origin = $address;

        // 排除干扰词：过滤掉收货地址中的常用说明字符
        if ($search = $this->config['interference_words'] ?? null) {
            $replace = array_fill(0, count($search), ' ');
            $address = str_replace($search, $replace, $address);
        }

        $result = parent::handle($address);

        // Dispatch event
        if (!isset($result['province'], $result['city'])) {
            event(new AfterFailedParsing($origin, $result)); // $result = event(...);
        }

        return $result ?: array_fill_keys(['province', 'city', 'district'], null) + ['address' => $address];
    }

    /**
     * Return the AddressParser instance.
     *
     * @return $this
     */
    public function instance()
    {
        return $this;
    }
}
