<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\MyClasses\SmsIR_VerificationCode;
use App\Providers\RouteServiceProvider;
use BadFunctionCallException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Cryptommer\Smsir\Smsir;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function handleLogin(Request $request)
    {
        /*$valid_data = $request->validate([
            'mobile' => 'required|min:11|max:11'
        ]);*/
        if(session('register_data.mobile') && session('register_data.mobile') != $request->mobile){
            session()->forget(['otp','register_data']);
            session()->forget('register_data');
        };
        //redirect to login otp page
        session(['register_data' => [
            'mobile' => $request->mobile,
            'register' => false,
        ]]);

        return redirect(route('otp.view'));

    }

    public function otpView()
    {
        if ((session()->missing('register_data') || (session()->has('register_data.step') && session('register_data')['step'] < 3)) && (session()->missing('register_data.register'))) {
            return redirect(route('login'));
        }

        if (session()->missing('otp') || ( !session()->missing('otp') && now()->isAfter(session('otp.otp_expired_at'))) ) {
            $otp_code = rand(100000, 999999);
            $otp_time_remain = 120;

            $otp_expired_at = Carbon::now()->addMinutes(2);
            $mobile = session('register_data')['mobile'];
            session(['otp' => [
                'otp_code' => $otp_code,
                'otp_expired_at' => $otp_expired_at
            ]]);




            $user = User::where('mobile', session('register_data')['mobile'])->first();

            if (!$user){
                $user=User::create([
                    'mobile'=>session('register_data')['mobile']
                ]);
            }

            //send sms sms.ir
            try {

                // your code
//                $Code = $otp_code;
//
//                // your mobile number
//                $MobileNumber = $user->mobile;
//
//                $send = smsir::Send();
//                $parameter = new \Cryptommer\Smsir\Objects\Parameters("Code", $Code);
//                $parameters = array($parameter) ;
//                $send->Verify($MobileNumber, "100000", $parameters);


                // send code to user
                //API Url
                $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
                $dataArray = array(
                    'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
                    'number' => "660005",
                    'text' => "کد تایید : " . $otp_code,
                    'mobiles' => session('register_data')['mobile'],
                    'clientIDs' => 1,
                );
                $data = http_build_query($dataArray);

                $getUrl = $url . "?" . $data;
//                                dd($getUrl);
                $contents = file_get_contents($getUrl, false);

            } catch (BadFunctionCallException  $e) {
                echo 'Error VerificationCode : ' . $e->getMessage();
            }
        }

        $now = Carbon::now();
        $otp_expire_time = session('otp.otp_expired_at');
        if ($now->isAfter($otp_expire_time)) {
            $otp_time_remain = 0;
        } else {
            $otp_time_remain = $now->diffInSeconds($otp_expire_time);
        }
        if (session('sms_error')){
            session()->forget('otp');
            session()->forget('register_data');
            session()->keep('sms_error');
//            dd(session()->all());

//                dd(session('otp_password')['otp_expired_at']);
            return back();
        }
        return view('auth.otp', compact('otp_time_remain'));
    }
    public function resendCode(Request $request)
    {
//        $user=User::where('mobile',session('register_data')['mobile'])->first();
//        dd($user);

//        dd(session()->all());
        if (session()->missing('register_data') || (session()->has('register_data.step') && session('register_data')['step'] < 3)) {
            return redirect(route('login'));
        }

        $now = Carbon::now();
        if (session()->missing('otp')) {

        } elseif (!$now->isBefore(session('otp')['otp_expired_at'])) {

            $otp_code = rand(100000, 999999);
            $otp_expired_at = Carbon::now()->addMinutes(2);

            $mobile = session('register_data')['mobile'];
            session(['otp' => [
                'otp_code' => $otp_code,
                'otp_expired_at' => $otp_expired_at
            ]]);
            //send code to user

           /* //API Url
            $url = 'https://peyk313.ir/API/V1.0.0/Send.ashx';
            $dataArray = array(
                'privateKey' => "67d84858-50c4-4dd1-9ad1-c4f1ae758462",
                'number' => "660005",
                'text' => "کد تایید : " . $otp_code,
                'mobiles' => session('register_data')['mobile'],
                'clientIDs' => 1,

            );
            $data = http_build_query($dataArray);

            $getUrl = $url . "?" . $data;
            $contents = file_get_contents($getUrl, false);*/

//            dd($otp_code);

            $user=User::where('mobile',session('register_data')['mobile'])->first();
            if (!$user){
                $user=User::create([
                    'mobile'=>session('register_data')['mobile']
                ]);
            }
            //send sms sms.ir
            try {
                date_default_timezone_set("Asia/Tehran");
                // your sms.ir panel configuration
                $APIKey = "755fc457df1274c68b61c457";
                $SecretKey = "lms.N@sra";

                // your code
                $Code = $otp_code;
                // your mobile number
                $MobileNumber = $user->mobile;

                $sms_handler = new SmsIR_VerificationCode();
                $sms_handler->constructor($APIKey, $SecretKey);
                $res=$sms_handler->VerificationCode($Code, $MobileNumber);

            } catch (BadFunctionCallException  $e) {
                echo 'Error VerificationCode : ' . $e->getMessage();
            }

//dd('send by');
//            $response=$user->notify(new \App\Notifications\SendCodeNotification($otp_code));

            return back()->with('message', 'کد با موفقیت برای شما ارسال شد');
        }
//        $user=User::where('mobile','09380969944')->first();
//dd($user);
        /*$response=$user->notify(new \App\Notifications\SendCodeNotification('11111',));
        dd('done');*/


        return back()->with('message', 'زمان کد قبلی به پایان نرسیده');
    }
    public function otpHandle(Request $request)
    {
        $valid = $request->validate([
            'otp_code' => ''
        ]);

        if (session()->missing('register_data.register')) {
            return redirect(route('login'));
        }

        $now = Carbon::now();
        if (session()->missing('otp')) {

            $this->otpView();

        } elseif (!$now->isBefore(session('otp')['otp_expired_at'])) {
            return back()->with('message', 'کد منقضی شده,کد جدید دریافت کنید');
        } elseif (session('register_data.register') == false && ($now->isBefore(session('otp')['otp_expired_at']) && session('otp')['otp_code'] == $valid['otp_code'])) {
            //login the user

            $mobile = session('register_data')['mobile'];
            $user = User::where('mobile', $mobile)->first();
            if ($user == null){
                $user = User::create([
//                    'name' => null,
                    'mobile' => session('register_data')['mobile'],
                ]);
            }

            session()->forget(['register_data', 'otp']);
            session()->flush();
            Auth::login($user);
//            dd($user);

            return redirect('/showForm');

        } elseif (($now->isBefore(session('otp')['otp_expired_at']) && session('otp')['otp_code'] == $valid['otp_code'])) {

          	$mobile = session('register_data')['mobile'];
            $user = User::where('mobile', $mobile)->first();
            if ($user == null){
              $user = User::create([
                  'name' => session('register_data')['name'],
                  'mobile' => session('register_data')['mobile'],
                  'role' => 0,
                  'status' => 1,
              ]);
            }
            session()->forget(['register_data', 'otp']);
            session()->flush();

            Auth::login($user);

            return redirect()->route('/showForm')->with(['code' => '1', 'register' => '1']);

        }
        return back()->with('message', 'کد وارد شده اشتباه است');

        //send code to user
//        dd($otp_code);
//        dd(session()->all());
    }
}
