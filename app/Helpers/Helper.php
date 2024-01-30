<?php

function storage($path)
{
    return asset('storage/' . $path);
}

function getExtension($url): bool|string
{
    $ext = explode('.', $url);
    return end($ext);
}

function formatPhone($phone)
{
    if (strlen($phone) > 10) {
        $phone = str_replace([' ', '(', ')', '+9'], '', $phone);
        $phone = ltrim($phone, '9');
        $newPhone = $phone[0];
        $newPhone .= '(';
        $newPhone .= $phone[1] . $phone[2] . $phone[3];
        $newPhone .= ') ';
        $newPhone .= $phone[4] . $phone[5] . $phone[6];
        $newPhone .= ' ';
        $newPhone .= $phone[7] . $phone[8];
        $newPhone .= ' ';
        $newPhone .= $phone[9] . $phone[10];
        return $newPhone;
    }
    return $phone;
}

function turkishToEnglish($text) {
    $search = ['ç', 'ı', 'ğ', 'ö', 'ş', 'ü', 'Ç', 'İ', 'Ğ', 'Ö', 'Ş', 'Ü'];
    $replace = ['c', 'i', 'g', 'o', 's', 'u', 'C', 'I', 'G', 'O', 'S', 'U'];
    $text = str_replace($search, $replace, $text);
    return $text;
}


function formatTurkcellPhone($phone)
{
    $phone = formatPhone("0" . $phone);
    $phone = str_replace(['(', ')'], '', $phone);
    return $phone;
}

function clearPhone($phone)
{
    return ltrim(str_replace(['(', ')', ' ', "\r", "\n", "\t"], '', $phone), '0,9,+');
}

function create_show_button($route, $additional_class = null)
{
    return html()->a($route, html()->i('')->class('bx bx-show'))->class('btn btn-info btn-sm me-1 ' . $additional_class);
}

function create_edit_button($route, $additional_class = null)
{
    return html()->a($route, html()->i('')->class('bx bx-edit'))->class('btn btn-primary btn-sm me-1 ' . $additional_class);
}

function create_delete_button($route, $additional_class = null)
{
    return html()->a($route, html()->i('')->class('bx bx-trash'))->class('btn btn-danger btn-sm me-1 delete-btn ' . $additional_class);
}

function create_switch($id, $checked, $model, $colum = 'featured'): \Spatie\Html\BaseElement|\Spatie\Html\Elements\Div
{
    $input = html()->input('checkbox', 'featured', $id)
        ->checked($checked)
        ->class('form-check-input ajax-switch')
        ->attribute('data-model', 'App\Models\\' . str_replace('App\Models\\', '', $model))
        ->attribute('data-column', $colum);

    return html()->div($input)->class('form-check form-switch');
}

function createCookie($key, $value, $time)
{
    Cookie::queue($key, $value, $time);
    return true;
}

function getCookie($name)
{
    return request()->cookie($name);
}

function setting($key, $default = null, $isFile = false)
{
    if ($isFile) {
        return storage(config('setting.' . $key, $default));
    }
    return config('setting.' . $key, $default);
}


function file_get_contents_curl($url): bool|string
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function mungXML($xml): array|bool|string|null
{
    $xml = iconv('UTF-8', 'UTF-8//IGNORE', $xml);
    $obj = SimpleXML_Load_String($xml);
    if ($obj === FALSE) return $xml;

    // GET NAMESPACES, IF ANY
    $nss = $obj->getNamespaces(TRUE);
    if (empty($nss)) return $xml;

    // CHANGE ns: INTO ns_
    $nsm = array_keys($nss);
    foreach ($nsm as $key) {
        // A REGULAR EXPRESSION TO MUNG THE XML
        $rgx
            = '#'               // REGEX DELIMITER
            . '('               // GROUP PATTERN 1
            . '\<'              // LOCATE A LEFT WICKET
            . '/?'              // MAYBE FOLLOWED BY A SLASH
            . preg_quote($key)  // THE NAMESPACE
            . ')'               // END GROUP PATTERN
            . '('               // GROUP PATTERN 2
            . ':{1}'            // A COLON (EXACTLY ONE)
            . ')'               // END GROUP PATTERN
            . '#'               // REGEX DELIMITER
        ;
        // INSERT THE UNDERSCORE INTO THE TAG NAME
        $rep
            = '$1'          // BACKREFERENCE TO GROUP 1
            . '_'           // LITERAL UNDERSCORE IN PLACE OF GROUP 2
        ;
        // PERFORM THE REPLACEMENT
        $xml = preg_replace($rgx, $rep, $xml);
    }

    return $xml;

}


