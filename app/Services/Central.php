<?php

namespace App\Services;

class Central
{
    private string $apiUrl = "https://petamobil.mobikob.com/fs_management/xmlrpc/originate/user_contact/{caller}/outbound_number/{receiver}/bridge/";
    private string $username = 'info@zgkurumsal.com';
    private string $password = '196574Zg';

    private string $caller = '201';
    private string $receiver = '';

    public function devices()
    {
        $api_url = "https://petamobil.mobikob.com/authentications/user/me/agent/active/fetch/";

        $headers = array(
            'Content-Type:application/json',
            'Authorization: Basic ' . base64_encode("info@zgkurumsal.com:196574Zg")
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return json_decode($result);
    }

    public function call()
    {
        $api_url = $this->getApiUrl();

        $headers = [
            'Content-Type:application/json',
            'Authorization: Basic ' . base64_encode("info@zgkurumsal.com:196574Zg")
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);
        return $httpCode;
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return str_replace(
            ['{caller}', '{receiver}'],
            [$this->getCaller(), $this->getReceiver()],
            $this->apiUrl
        );
    }

    /**
     * @param string $apiUrl
     */
    public function setApiUrl(string $apiUrl): void
    {
        $this->apiUrl = $apiUrl;
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

    /**
     * @return string
     */
    public function getCaller(): string
    {
        $devices = $this->devices();
        return $this->caller;
    }

    /**
     * @param string $caller
     */
    public function setCaller(string $caller): void
    {
        $this->caller = $caller;
    }

    /**
     * @return string
     */
    public function getReceiver(): string
    {
        return '90' . clearPhone($this->receiver);
    }

    /**
     * @param string $receiver
     */
    public function setReceiver(string $receiver): void
    {
        $this->receiver = $receiver;
    }


}
