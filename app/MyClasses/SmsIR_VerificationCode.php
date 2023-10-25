<?php

namespace App\MyClasses ;

class SmsIR_VerificationCode
 {


	protected function getAPIVerificationCodeUrl() {
		return "http://RestfulSms.com/api/VerificationCode";
	}
	protected function getApiTokenUrl(){
		return "http://RestfulSms.com/api/Token";
	}
    public function __construct()
    {
        // parent::__construct();
    }
	public function constructor($APIKey,$SecretKey){
		$this->APIKey = $APIKey;
		$this->SecretKey = $SecretKey;
    }

	public function VerificationCode($Code, $MobileNumber) {

		$token = $this->GetToken($this->APIKey, $this->SecretKey);
		if($token != false){
			$postData = array(
				'Code' => $Code,
				'MobileNumber' => $MobileNumber,
			);
			$url = $this->getAPIVerificationCodeUrl();
			$VerificationCode = $this->execute($postData, $url, $token);
			$object = json_decode($VerificationCode);
//            dd($object);
			if(is_object($object)){
				$array = get_object_vars($object);
				if(is_array($array)){
					$result = $array['Message'];
				} else {
					$result = false;
				}
			} else {
				$result = false;
			}

		} else {
			$result = false;
		}
		return $result;
	}

	private function GetToken(){
		$postData = array(
			'UserApiKey' => $this->APIKey,
			'SecretKey' => $this->SecretKey,
			'System' => 'php_rest_v_1_2'
		);
		$postString = json_encode($postData);

		$ch = curl_init($this->getApiTokenUrl());
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: application/json'
                                            ));
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POST, count($postData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

		$result = curl_exec($ch);
		curl_close($ch);

		$response = json_decode($result);

		if(is_object($response)){
			$resultVars = get_object_vars($response);
			if(is_array($resultVars)){
				@$IsSuccessful = $resultVars['IsSuccessful'];
				if($IsSuccessful == true){
					@$TokenKey = $resultVars['TokenKey'];
					$resp = $TokenKey;
				} else {
					$resp = false;
				}
			}
		}

		return $resp;
	}

	private function execute($postData, $url, $token){

		$postString = json_encode($postData);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
											'Content-Type: application/json',
											'x-sms-ir-secure-token: '.$token
											));
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POST, count($postData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);

		$result = curl_exec($ch);
		curl_close($ch);


		return $result;

	}
}

?>
