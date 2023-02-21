<?php
declare(strict_types=1);

namespace Radoslaw\CurlTest;

use Exception;
use Radek011200\CurlClientPhp\Curl;
use Radek011200\CurlClientPhp\Request\Header;
use Radek011200\CurlClientPhp\Request\Options;

class CurlTest
{
    const URL = "https://433o2.wiremockapi.cloud/json";
    private Curl $curl;
    private Options $options;
    public function __construct()
    {
        $this->curl = new Curl();
        $this->options = new Options();
    }

    /**
     * @return array
     */
    public function createSomeObject(): array
    {
        $this->options
            ->addHeader(new Header('Accept', 'application/json'));

        try {
            $response = $this->curl->Post(self::URL, $this->options, [
                    "id"=> 11,
                    "value"=> "Some value"
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
            $response = $this->curl->Get(self::URL . '/' . $id, $this->options);
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
            $response = $this->curl->Put(self::URL . '/' . $id, $this->options, [
                "value"=> "Update"
            ]);
        } catch (Exception $exception) {
            return ['error' => $exception->getMessage()];
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}