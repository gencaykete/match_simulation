<?php

namespace App\Services;

class Netgsm
{
    private static string $apiUrl = "https://petamobil.mobikop.com/sms/bulk/api";
    const username = '8503057382';
    const password = 'a3489250a25a';
    const title = 'PetaMobil';

    public static function login()
    {
        $ADRESS = 'crmsntrl.netgsm.com.tr';
        $PORT = '9110'; //port

        if (($sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) === false) {
            echo "socket_create()  başarısız oldu: sebep: " . socket_strerror(socket_last_error()) . "\n";
        }

        if (socket_connect($sock, $ADRESS, $PORT) === false) {
            echo "socket_bind()  başarısız oldu: sebep: " . socket_strerror(socket_last_error($sock)) . "\n";
        }

        socket_set_option($sock, SOL_SOCKET, SO_RCVTIMEO, array("sec" => 15, "usec" => 0));

        $msgsock = '{ "command" : "login", "crm_id" : "12345", "username" : "'.self::username.'", "password" : '.self::password.'"}';

        socket_write($sock, $msgsock, strlen($msgsock));

        usleep(500);

        $isReload = false;
        while ($out = socket_read($sock, 1024)) {
            echo $out;
            break;
        }
    }

    public static function call($phoneNumber)
    {
        $url= "http://crmsntrl.netgsm.com.tr:9111/".self::username."/originate?username=".self::username."&password=".self::password."&customer_num=".$phoneNumber."&pbxnum=XXX&internal_num=XXX&ring_timeout=20&crm_id=XXX&wait_response=1&originate_order=of&trunk=XXX";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $http_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($http_code != 200){
            echo "$http_code $http_response\n";
            return false;
        }
        $Info = $http_response;
        echo "cevap : $Info";
        return $Info;
    }
}
