<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Scalar\String_;

class SMSController extends Controller
{

    public function sendSms()
    {

        $send_req_count =  0;
        $for_counter = 0;

        for ($i = 1; $i < 4; $i++){
            $result = true;
            while ($result){
                $result = $this->peyk();
                sleep(0.5);
                $send_req_count++;
            }
            $for_counter++;
        }

        echo $send_req_count . " - " . $for_counter;

    }

    public function peyk()
    {

        $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
        $dataArray = array(
            'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
            'number' => "660005",
            'text' => "تست",
            'isFlash' => "true",
            'udh' => 1,
            'mobiles' => '09127305627',
            'clientIDs' => 1,
        );
        $data = http_build_query($dataArray);

        $getUrl = $url . "?" . $data;
        $contents = file_get_contents($getUrl, false);

        $response = json_decode($contents, true);

        return ($response['Error'] != null);

    }

}
