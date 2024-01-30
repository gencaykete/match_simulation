<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BackendService
{
    private string $api_url = 'https://manager.petamobil.com/index.asp';
    private string $test_api_url = 'http://localhost:4859/api/{endpoint}';
    private string $endpoint;
    private array $params;
    private string $method = 'post';
    private string $token = "186396be78aad04b236e1ef795adfeaf";
    private bool $test_mode = false;

    public function get()
    {
        $method = $this->getMethod();
        $this->addParam('token', $this->token);
        if ($method == 'post') {
            $request = Http::post($this->createEndpointUrl(), $this->getParams());
        } else {
            $request = Http::get($this->createEndpointUrl(), $this->getParams());
        }

        if ($request->clientError() || $request->serverError()) {
            //throw new \Exception($request->reason());
            return $request->body();
        }

        return $request->object();
    }

    public function createEndpointUrl(): array|string
    {
        return str_replace('{endpoint}', $this->endpoint, $this->getApiUrl());
    }

    public function addParam($key, $value)
    {
        return $this->params[$key] = $value;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->test_mode ? $this->test_api_url :$this->api_url;
    }

    /**
     * @param string $api_url
     */
    public function setApiUrl(string $api_url): void
    {
        $this->api_url = $api_url;
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

}
