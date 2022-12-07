<?php

namespace ReinVanOyen\CopiaSendcloud\Fulfilment;

use ReinVanOyen\Copia\Cart\CartManager;
use ReinVanOyen\Copia\Contracts\Fulfilment;
use ReinVanOyen\Copia\Contracts\Orderable;
use ReinVanOyen\Copia\Fulfilment\FulfilmentStatus;
use ReinVanOyen\CopiaSendcloud\Client\Api;

class SendcloudShipping implements Fulfilment
{
    /**
     * @var Api $sendcloud
     */
    private $sendcloud;

    /**
     * @param Api $sendcloud
     */
    public function __construct(Api $sendcloud)
    {
        $this->sendcloud = $sendcloud;
    }

    public function getId()
    {
        return 'sendcloud';
    }

    public function getCost(CartManager $cart): float
    {
        return 20;
    }

    public function getTitle(): string
    {
        return 'Sendcloud';
    }

    /**
     * @param Orderable $order
     * @return mixed|void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function process(Orderable $order)
    {
        $customer = $order->getCustomer();
        $items = $order->getItems();

        $parcels = [];
        foreach ($items as $item) {
            $parcels[] = [
                'description' => $item->buyable->getBuyableTitle(),
                'product_id' => $item->buyable->getBuyableId(),
                'weight' => $item->buyable->getBuyableWeight(),
                'value' => $item->buyable->getBuyablePrice(),
                'quantity' => $item->quantity,
            ];
        }

        // Create a new parcel
        $response = $this->sendcloud->createParcel([
            'parcel' => [
                'order_number' => $order->getOrderId(),
                'name' => $customer->getFullName(), // required
                'address' => $customer->getAddress(), // required
                'house_number' => $customer->getHouseNumber(), // required
                'postal_code' => $customer->getPostalCode(), // required
                'city' => $customer->getCity(), // required
                'country' => $customer->getCountryISO(), // required
                "telephone" => $customer->getTelephoneNumber(),
                'email' => $customer->getEmail(),
                "weight" => $order->getWeight(),
                'request_label' => false,
                "insured_value" => 0,
                "total_order_value_currency" => 'EUR',
                "total_order_value" => $order->getTotal(),
                "quantity" => 1,
                'parcel_items' => $parcels,
            ]]);

        $order->setFulfilmentStatus(FulfilmentStatus::UNFULFILLED);
    }
}
