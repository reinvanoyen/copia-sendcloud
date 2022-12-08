<?php

namespace ReinVanOyen\CopiaSendcloud\Client;

class Api
{
    /**
     * @var SendcloudClient $client
     */
    private SendcloudClient $client;

    /**
     * @param SendcloudClient $client
     */
    public function __construct(SendcloudClient $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getParcels()
    {
        return $this->client->get('parcels')['parcels'];
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getParcel(int $id)
    {
        return $this->client->get('parcels/'.$id)['parcel'];
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getLabel(int $id)
    {
        return $this->client->get('labels/'.$id)['label'];
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getParcelStatuses()
    {
        return $this->client->get('parcels/statuses');
    }

    /**
     * @param array $parcel
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createParcel(array $parcel)
    {
        return $this->client->post('parcels', $parcel)['parcel'];
    }

    /**
     * @param int $id
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function cancelParcel(int $id)
    {
        return $this->client->post('parcels/'.$id.'/cancel');
    }

    /**
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getShippingMethods(array $params = [])
    {
        return $this->client->get('shipping_methods', $params)['shipping_methods'];
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getShippingPrice(array $params)
    {
        return $this->client->get('shipping-price', $params);
    }

    public function getShippingProducts(array $params)
    {
        return $this->client->get('shipping-products', $params);
    }
}
