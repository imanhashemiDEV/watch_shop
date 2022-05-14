<?php

namespace App\Helpers;

class Zarinpal
{

    private static $merchantId = "995b6873-f34b-433c-abb2-8aa071a6e7a1";

    public static function request($data)
    {
        $data = [
            'MerchantID' => self::$merchantId,
            'Amount' => $data['amount'],
            'CallbackURL' => $data['callbackUrl'],
            'Description' => $data['description']];
        $jsonData = json_encode($data);

        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json'); #main
        #$ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json'); #sandbox

        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
        ]);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if ($err) {
            $response = ['result' => false, 'message' => ''];
            // echo "cURL Error #:" . $err;
        } else {
            if ($result["Status"] == 100) {
                $url = "https://www.zarinpal.com/pg/StartPay/" . $result["Authority"] . "/ZarinGate"; #main
              #$url = "https://sandbox.zarinpal.com/pg/StartPay/" . $result["Authority"] . "/ZarinGate"; #sandbox

                $response = ['result' => true, 'message' => '', 'url' => $url, 'authority' => $result['Authority']];
                // return "https://www.zarinpal.com/pg/StartPay/" . $result["Authority"];
            } else {
                $response = ['result' => false, 'message' => $result["Status"]];
                // echo'ERR: ' . $result["Status"];
            }
        }
        return $response;
    }

    public static function verify($data)
    {
        $data = [
            'MerchantID' => self::$merchantId,
            'Authority' => $data['authority'],
            'Amount' => $data['amount'],
        ];

        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json'); #main
        #$ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json'); #sandbox

        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData),
        ]);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);

        if ($err) {
            return ['statusCode' => -10000, 'message' => ''];
            echo "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == 100 or $result['Status'] == 101) {
                return ['statusCode' => $result['Status'], 'refId' => $result['RefID'], 'fullResult' => $result];
                echo 'Transation success. RefID:' . $result['RefID'];
            } else {
                return ['statusCode' => $result['Status']];
                echo 'Transation failed. Status:' . $result['Status'];
            }
        }
    }

}

