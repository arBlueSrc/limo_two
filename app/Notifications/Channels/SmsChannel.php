<?php

namespace App\Notifications\Channels;

use Exception;
use Illuminate\Notifications\Notification;
class SmsChannel
{

    public function send($notifiable, Notification $notification)
    {

        $otp_code = $notification->toSms($notifiable)[0];
        $mobile=$notification->toSms($notifiable)[1];


        return $this->sendSmsPeyk($otp_code, $mobile, $notifiable);

    }

    /**
     * @param mixed $otp_code
     * @param mixed $mobile
     * @param $notifiable
     * @return \Illuminate\Http\RedirectResponse|true
     * @throws Exception
     */
    public function sendSmsPeyk(mixed $otp_code, mixed $mobile, $notifiable): \Illuminate\Http\RedirectResponse|bool
    {
//send sms here
// send code to user
        //API Url
        $i = 1;
        while ($i <= 70) {
            $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
            $dataArray = array(
                'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
                'number' => "660005",
                'text' => "کد تایید : " . $otp_code,
                'mobiles' => $mobile ?? $notifiable->mobile,
                'clientIDs' => 1,
            );
            $data = http_build_query($dataArray);
            $getUrl = $url . "?" . $data;
//                                dd($getUrl);
            $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $contents = file_get_contents($getUrl, false, stream_context_create($arrContextOptions));
            if ($error = json_decode($contents)->Error) {
//                dd($error->ID);
                if ($error->ID == 1) {
                    return redirect()->back()->with('sms_error', $error->Message);
//                    return $error->ID;
                }
                $status = false;
            } else {
                $status = true;
                break;
            }
            $i++;
            sleep(.5);
        }
        if ($status) {
            return true;
        } else {
            throw new Exception ('The message params are not valid');
        }
        /*catch(HttpException $e){
            throw $e;
        }*/
        /*if (json_decode($contents)->Error){
            throw new Exception ('The message params are not valid');
        }
        else{
            return true;
//            return false;
        }*/
//        dd(json_decode($contents)->Error);
        /*if(json_decode($contents)){
        }*/
    }

}
