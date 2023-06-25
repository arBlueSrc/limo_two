<?php

namespace App\Http\Controllers;

use App\Http\SmsSenderHelper;
use App\Models\Major;
use App\Models\SingleResult;
use App\Models\SmsLog;

class SMSController extends Controller
{

    public function sendSms()
    {

        $send_req_count = 0;
        $for_counter = 0;

        for ($i = 1; $i < 4; $i++) {
            $result = true;
            while ($result) {
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


    public function sendSingleResultSms()
    {

        for ($i = 0; $i < 4; $i++) {


            $last_send_message = SmsLog::orderBy('id', 'DESC')->first() ?? null;

            if ($last_send_message == null) {
                $single_result = SingleResult::first();
            } else {
                $last_send_id = $last_send_message->ref_id;
                $single_result = SingleResult::where('id', '>', $last_send_id)->first();
            }

            if ($single_result != null) {

                $major = Major::find($single_result->major)->name ?? "قرآن";
                $message = 'شرکت کننده مسابقات قران، ' . $single_result->name . ' عزیز' . "\r\n";
                $message = $message . "شما در سامانه مسابقات در بخش فردی و در رشته " . str_replace(",", "", $major) . "، ثبت نام کرده اید. این پیام صرفا جهت یادآوری می باشد. تمامی اطلاع رسانی های بعدی از طریق پیامک به شما اطلاع رسانی خواهد گردید." . "\r\n";
                $message = $message . "\r\n";
                $message = $message . "عضو کانال دارالقرآن بسیج شوید" . "\r\n";
                $message = $message . "eitaa.com/quranbsj_ir" . "\r\n";
                $message = $message . "rubika.ir/quranbsj_ir" . "\r\n";

                $sms_log = SmsLog::create([
                    'ref_id' => $single_result->id,
                    'ref_type' => 1,
                    'is_sended' => 0,
                    'message' => $message
                ]);

                //send message
                $sms_sender = new SmsSenderHelper();

                $result = true;
                while ($result) {
                    $result = $sms_sender->peyk($message, $single_result->phone);
                    if (!$result) {
                        //here message sended
                        $sms_log->update([
                            'is_sended' => 1
                        ]);


                    }
                    sleep(0.5);
                }

            }

        }

        echo "message sended!";

    }

}
