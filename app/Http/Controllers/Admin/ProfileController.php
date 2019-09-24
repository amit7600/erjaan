<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Input;
use App\Country;
use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\RepairmanRequest;
use Auth;
use Session;
use App\Package\MediaUploadLib;

class ProfileController extends Controller {

    //

    public function getProfile() {
        $this->data['menu_type'] = 1;
        $this->data['city'] = City::Select('id', 'cityName')->get();
        $this->data['country'] = Country::Select('id', 'name')->get();
        $this->data['user_data'] = Auth::user();
        return view('admin.profile.view_profile', $this->data);
    }

    public function updateProfile(Request $request) {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->business_name = $request->input('business_name');
        $user->mobile_number = $request->input('mobile_number');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        
        if (!empty(Input::file('user_image')) && Input::file('user_image')->getError() == 0) {

            if (!empty($user->user_image) && file_exists($user->user_image)) {
                unlink($user->user_image);
            }

            $image = new MediaUploadLib();
            $path = public_path('uploads/Users');
            list($fileNameImg, $size) = $image->fileUpload(Input::file('user_image'), $path, '', '');
            $user->user_image = 'uploads/Users/' . $fileNameImg;
        }
        
        if (!empty(Input::file('user_logo_image')) && Input::file('user_logo_image')->getError() == 0) {

            if (!empty($user->user_logo) && file_exists($user->user_logo)) {
                unlink($user->user_logo);
            }

            $image = new MediaUploadLib();
            $path = public_path('uploads/users_logo');
            list($fileNameImg, $size) = $image->fileUpload(Input::file('user_logo_image'), $path, '', '');
            $user->user_logo = 'uploads/users_logo/' . $fileNameImg;
        }
        
        $user->save();
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', __('message.profile').' '.__('message.updated').' '.__('message.successfully'));
        return redirect()->route('get_admin_profile');
    }

    public function logout(Request $request) {
        $user = Auth::user();
        Session::flush();
        Auth::logout();
        return redirect()->route('admin');
    }

//END :: Logout
}
