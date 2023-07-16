<?php

namespace QDenka\LandingGenerator\Services;

class HttpRequester
{
    /**
     * @var string[]
     */
    private array $params;
    /**
     * @var string[]
     */
    private array $headers;

    /**
     * @return HttpRequester
     */
    public static function init(): HttpRequester
    {
        return new self();
    }

    /**
     * @param array $params
     * @return void
     */
    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    /**
     * @param array $headers
     * @return void
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @param string $url
     * @return bool|string
     */
    public function get(string $url)
    {
        return $this->request($url, 'GET');
    }

    /**
     * @param string $url
     * @return bool|string
     */
    public function post(string $url)
    {
        return $this->request($url, 'POST');
    }

    /**
     * @param string $url
     * @param string $method
     * @return bool|string
     */
    private function request(string $url, string $method)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        if (!empty($this->params)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $this->params);
        }
        if (!empty($this->headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}