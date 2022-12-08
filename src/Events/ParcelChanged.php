<?php

namespace ReinVanOyen\CopiaSendcloud\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ParcelChanged
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var array $parcel
     */
    public array $parcel;

    /**
     * @param array $parcel
     */
    public function __construct(array $parcel)
    {
        $this->parcel = $parcel;
    }
}
