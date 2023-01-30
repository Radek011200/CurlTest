<?php
declare(strict_types=1);

namespace Radoslaw\CurlTest;

use Exception;
use Radek011200\CurlClientPhp\Curl;

class CurlTest
{
    const URL = "https://433o2.wiremockapi.cloud/json";
    private Curl $curl;
    public function __construct()
    {
        $this->curl = new Curl();
    }

    /**
     * @return array
     */
    public function createSomeObject(): array
    {
        try {
            $response = $this->curl->Post(self::URL, [
                "headers" => [
                    "Accept" => "application/json",
                ],
                "body" => [
                    "id"=> 11,
                    "value"=> "Some value"
                ]
            ]);
        } catch (Exception $exception) {
            return ['error' => $exception->getMessage()];
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getObject(int $id): array
    {
        try {
            $response = $this->curl->Get(self::URL . '/' . $id);
        } catch (Exception $exception) {
            return ['error' => $exception->getMessage()];
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param int $id
     * @return array
     */
    public function updateObject(int $id): array
    {
        try {
            $response = $this->curl->Put(self::URL . '/' . $id,[
                "headers" => [
                    "Accept" => "application/json",
                ],
                "body" => [
                    "value"=> "Update"
                ]
            ]);
        } catch (Exception $exception) {
            return ['error' => $exception->getMessage()];
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}