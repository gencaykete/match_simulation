<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TraccarService
{
    private string $api_url = 'http://213.238.190.93:8082/api/{endpoint}';
    private string $endpoint;
    private array $params = [];
    private string $method = 'post';
    private string $username = 'info@petamobil.com';
    private string $password = '123465';

    public function get()
    {
        try {
            $method = $this->getMethod();

            switch ($method) {
                case 'GET':
                    $request = Http::withBasicAuth($this->username, $this->password)
                        ->withHeaders([
                            'Content-Type:application/json'
                        ])
                        ->get($this->createEndpointUrl(), $this->getParams());
                    break;
                case 'POST':
                    $request = Http::withBasicAuth($this->username, $this->password)
                        ->withHeaders([
                            'Content-Type:application/json'
                        ])
                        ->post($this->createEndpointUrl(), $this->getParams());
                    break;
                case 'PUT':
                    $request = Http::withBasicAuth($this->username, $this->password)
                        ->withHeaders([
                            'Content-Type:application/json'
                        ])
                        ->put($this->createEndpointUrl(), $this->getParams());
                    break;
                case 'DELETE':
                    $request = Http::withBasicAuth($this->username, $this->password)
                        ->withHeaders([
                            'Content-Type:application/json'
                        ])
                        ->delete($this->createEndpointUrl(), $this->getParams());
                    break;
            }

            if ($request->clientError() || $request->serverError()) {
                //throw new \Exception($request->reason());
                //return $request->body();
            }
        }catch (\Exception $exception){
            return '';
        }

        return $request;
    }

    public function getUsers()
    {
        try {
            $client = new TraccarService();
            $client->setEndpoint('users');
            $client->setMethod('get');
            $request = $client->get();
        }catch (\Exception $exception){
            return [];
        }

        return $request->object();
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
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
        return $this->api_url;
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
        return strtoupper($this->method);
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
