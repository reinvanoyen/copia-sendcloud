<?php

namespace ReinVanOyen\CopiaSendcloud\Client;

use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class SendcloudClient
{
    /**
     * @var ClientInterface $httpClient
     */
    private ClientInterface $httpClient;

    /**
     * @param ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $endPoint
     * @param array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $endPoint, array $params = []): array
    {
        return $this->parseResponse($this->httpClient->get($endPoint, ['query' => $params]));
    }

    /**
     * @param string $endPoint
     * @param $body
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post(string $endPoint, $body = []): array
    {
        return $this->parseResponse($this->httpClient->post($endPoint, ['body' => json_encode($body),]));
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws \Exception
     */
    private function parseResponse(ResponseInterface $response): array
    {
        $responseBody = $response->getBody()->getContents();
        $resultArray = json_decode($responseBody, true);

        if (! is_array($resultArray)) {
            throw new \Exception(sprintf('SendCloud error %s: %s', $response->getStatusCode(), $responseBody), $response->getStatusCode());
        }

        if (array_key_exists('error', $resultArray)
            && is_array($resultArray['error'])
            && array_key_exists('message', $resultArray['error'])
        ) {
            throw new \Exception('SendCloud error: ' . $resultArray['error']['message'], $resultArray['error']['code']);
        }

        return $resultArray;
    }
}
