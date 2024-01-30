<?php

namespace App\Services;

use App\Models\SmsLog;
use Illuminate\Support\Facades\Http;

class Sms
{
    private static string $apiUrl = "https://petamobil.mobikob.com/sms/send?api_user={username}&api_pass={password}&head={title}&to=90{receiver}&msg={message}/";
    const username = 'info@zgkurumsal.com';
    const password = '196574Zg';
    const title = 'PetaMobil';

    private static function getApiUrl($number, $message)
    {
        return str_replace(
            ['{receiver}', '{message}', '{title}', '{username}', '{password}'],
            [clearPhone($number), $message, self::title, self::username, self::password],
            self::$apiUrl
        );
    }

    public static function send($number, $message)
    {
        $request = Http::get(self::getApiUrl($number, rawurlencode($message)));

        $smsLog = new SmsLog();
        $smsLog->phone = $number;
        $smsLog->message = $message;
        $smsLog->save();

        return $request->body();
    }

}
