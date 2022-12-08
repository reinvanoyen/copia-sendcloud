<?php

namespace ReinVanOyen\CopiaSendcloud\Listeners;

use ReinVanOyen\Copia\Models\Order;
use ReinVanOyen\CopiaSendcloud\Events\ParcelChanged;

class UpdateOrder
{
    /**
     * @param ParcelChanged $event
     * @return void
     */
    public function handle(ParcelChanged $event)
    {
        $parcel = $event->parcel;

        $order = Order::where('order_id', $parcel['order_number'])->firstOrFail();

        // Store some data we received from Sendcloud
        $order->setFulfilmentData([
            'sendcloud_parcel_id' => $parcel['id'] ?? '',
            'sendcloud_tracking_number' => $parcel['tracking_number'] ?? '',
            'sendcloud_status' => $parcel['status']['message'] ?? '',
        ]);
    }
}
