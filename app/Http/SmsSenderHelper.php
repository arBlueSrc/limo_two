<?php

namespace App\Http;

class SmsSenderHelper
{
    public function peyk($text, $phone)
    {

        $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
        $dataArray = array(
            'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
            'number' => "660005",
            'text' => $text,
            'isFlash' => "true",
            'udh' => 1,
            'mobiles' => $phone,
            'clientIDs' => 1,
        );
        $data = http_build_query($dataArray);

        $getUrl = $url . "?" . $data;
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $contents = file_get_contents($getUrl, false, stream_context_create($arrContextOptions));

        $response = json_decode($contents, true);

        return ($response['Error'] != null);

    }

}
