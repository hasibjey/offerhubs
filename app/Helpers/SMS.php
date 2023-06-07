<?php

namespace App\Helpers;

class SMS
{
    public static function SMS_API($receiver_number, $sms_text)
    {
        // $api = "http://portal.metrotel.com.bd/smsapi?api_key=C20011126155691f874ec0.03527889&type=text&contacts=" . $receiver_number . "&senderid=8809612441392&msg=" . urlencode($sms_text);
        $api = "http://188.138.41.146:7788/sendtext?apikey=c398877d57348702&secretkey=dcdef86d&callerID=8801969910560&toUser=" . $receiver_number . "&messageContent=" . urlencode($sms_text);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic QWxhZGRpbjpvcGVuIHNlc2FtZQ=="
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }
}
