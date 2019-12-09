<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Package\SendEmailLib;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class HomeController extends Controller
{
    public function getLogin()
    {
        try {
            // $this->clearCache();
            // dd(env('DB_DATABASE'));
            // if(env('DB_DATABASE')){
            $locale = DB::table('tbl_settings')->where('setting_key', 'default_language')->get();
            $logoImage = DB::table('tbl_settings')->where('setting_key', 'choose_logo')->get();
            $backgroundImage = DB::table('tbl_settings')->where('setting_key', 'choose_background')->get();
            if (Session::has('locale')) {
                $language = Session::get('locale');
            } else {
                $language = isset($locale) ? $locale[0]->setting_value : 'en';
            }

            $logo = isset($logoImage) && $logoImage[0]->setting_value != null ? $logoImage[0]->setting_value : 'admin_css/assets/logo/logo.png';
            $background = isset($backgroundImage) && $backgroundImage[0]->setting_value != null ? $backgroundImage[0]->setting_value : 'assets/images/photo-wide-4.jpg';
            if (Auth::user()) {
                Session::put('locale', $language);
                App::setLocale($language);
                return redirect()->route('dashboard');
            } else {
                Session::put('locale', $language);
                App::setLocale($language);
                return view('admin.login', compact('language', 'logo', 'background'));
            }
            // }else{
            //     Session::put('locale','ar');
            //     App::setLocale('ar');
            //     return view('admin.configDatabase');
            // }
        } catch (Exception $e) {
            // dd($e);
        }

    }
    public function clearCache()
    {
        \Artisan::call('config:cache');
        \Artisan::call('config:clear');
        \Artisan::call('view:clear');
        \Artisan::call('route:clear');
        \Artisan::call('cache:clear');
    }
    public function database_config(Request $request)
    {
        try {

            $envFile = app()->environmentFilePath();
            $str = file_get_contents($envFile);
            // dd($str);
            $url = $request->get('url');
            $url = str_replace('/admin', '', $url);
            $values = [
                "DB_DATABASE" => $request->get('database'),
                "DB_USERNAME" => $request->get('username'),
                "DB_PASSWORD" => $request->get('password'),
                "APP_URL" => $url,
            ];
            // $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME =  ?";
            $query = mysqli_connect('localhost', $request->get('username'), $request->get('password'), $request->get('database'));
            if ($query->connect_error) {
                return redirect()->back()->with('error_msg', 'No database exist of that name!');
            }

            if (count($values) > 0) {
                foreach ($values as $envKey => $envValue) {

                    $str .= "\n"; // In case the searched variable is in the last line without \n
                    $keyPosition = strpos($str, "{$envKey}=");
                    $endOfLinePosition = strpos($str, "\n", $keyPosition);
                    $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                    // If key does not exist, add it
                    if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                        $str .= "{$envKey}={$envValue}\n";
                    } else {
                        $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                    }

                }
            }

            $str = substr($str, 0, -1);
            if (!file_put_contents($envFile, $str)) {
                return false;
            }

            // dd(\DB::unprepared(file_get_contents(public_path('erjaan.sql'))));
            \Artisan::call('config:cache');
            $this->clearCache();

            return redirect()->to('admin/admin_edit');
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->back()->with('error_msg', 'Something went wrong in input!');

        }
    }
    public function admin_edit()
    {
        Session::put('locale', 'ar');
        App::setLocale('ar');
        \DB::unprepared(file_get_contents(public_path('erjaan.sql')));
        return view('admin.configAdmin');
    }
    public function admin_config(Request $request)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ]);
        try {
            User::where('id', 1)->update([
                'user_name' => $request->get('user_name'),
                'email' => $request->get('email'),
                'password' => \Hash::make($request->get('password')),
            ]);
            $this->clearCache();
            return redirect()->to('/admin');
        } catch (\Exception $e) {
            // dd($e);
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }
    public function postLogin(LoginRequest $request)
    {
        // dd($request,\Session::get('url'));
        $auth = array('email' => $request->input('email'), 'password' => $request->input('password'));
        if (!Auth::attempt($auth)) {
            return redirect()->back()->with('error_msg', __('message.please') . ' ' . __('message.check') . ' ' . __('message.your') . ' ' . __('message.login') . ' ' . __('message.creadential'));
        } else {
            $locale = DB::table('tbl_settings')->where('setting_key', 'default_language')->get();
            $language = isset($locale) ? $locale[0]->setting_value : 'en';
            Session::put('locale', $language);
            App::setLocale($language);
            if (\Session::has('url')) {
                $tempUrl = \Session::get('url');
                $url = str_replace('/erjaan/', '/', $tempUrl);
                \Session::forget('url');
                return redirect()->intended($url['intended']);
            }
            return redirect()->route('dashboard');
        }
    }

    //register reapairmens

    public function getRegister()
    {
        $this->data['country'] = Country::Select('id', 'name')->get();
        return view('admin.register', $this->data);
    }

    public function postRegister(RegisterRequest $request)
    {

        $user = new User;
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
        $user->business_name = $request->input('business_name');
        $user->mobile_number = $request->input('mobile_number');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->terms_condition = $request->input('terms_condition');
        $user->save();
        if ($user) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'User registered successfully!');
            return redirect()->route('admin');
        } else {
            $request->session()->flash('message.level', 'Danger');
            $request->session()->flash('message.content', 'Something went wrong!');
            return redirect()->route('register');
        }
    }

    //forgot password

    public function forgotPassword()
    {
        $this->data['country'] = Country::Select('id', 'name')->get();
        return view('admin.forgot_password', $this->data);
    }

    //send password
    public function forgotPasswordRequest(ForgotRequest $request)
    {
        $email = $request->input('email');
        $result = User::Select('id', 'name', 'email')->where('email', $email)->first();
        if (!empty($result)) {
            $user_id = $result->id;
            $pass = rand();
            $new_password = Hash::make($pass);
            $user_data = User::findOrfail($user_id);
            $user_data->password = $new_password;
            $user_data->save();
            if ($user_data) {
                $mail = new SendEmailLib();
                $to = $email;
                $subject = "New Password";
                $message = "This is your new password : " . $pass;

                if ($mail->sendEmail($to, $subject, $message)) {
                    $request->session()->flash('message.level', 'success');
                    $request->session()->flash('message.content', 'Please check your email we have sent you a new password!');
                    return redirect()->route('admin');
                } else {
                    $request->session()->flash('message.level', 'Danger');
                    $request->session()->flash('message.content', 'Something went wrong!');
                    return redirect()->route('admin');
                }
            } else {
                $request->session()->flash('message.level', 'Danger');
                $request->session()->flash('message.content', 'Something went wrong!');
                return redirect()->route('admin');
            }
        } else {
            $request->session()->flash('message.level', 'Danger');
            $request->session()->flash('message.content', 'Email not registered!');
            return redirect()->route('admin');
        }
    }

}
