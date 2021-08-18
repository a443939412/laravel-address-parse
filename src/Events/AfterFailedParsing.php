<?php

namespace Zifan\LaravelAddressParser\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AfterFailedParsing
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    protected $origin;

    /**
     * @var mixed
     */
    protected $result;

    /**
     * AfterFailedParsing constructor.
     * @param string $origin
     * @param mixed $result
     */
    public function __construct(string $origin, $result)
    {
        $this->origin = $origin;

        $this->result = $result;
    }

    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->origin;
    }
}