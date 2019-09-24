<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;

class UserReportController extends Controller
{
    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        // $this->data['base_path'] = 'http://ss.erjaan.com/';
    }
    //report 1
    public function get_user_report_1($time_period = null,$created_from = null,$created_to = null)
    {
        $user = DB::table('users')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($user);
        
        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['user'] = $user;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport.user_report',$this->data);
    }
    public function get_location_report_1($time_period = null,$created_from = null,$created_to = null)
    {
        $city = DB::table('city')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($city);

        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['city'] = $city;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport.location_report',$this->data);
    }
    public function get_user_report_filter_1(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_user_report_1($time_period,$created_from,$created_to);
        

    }
    public function get_location_report_filter_1(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_location_report_1($time_period,$created_from,$created_to);

    }

    //report 2

    public function get_user_report_2($time_period = null,$created_from = null,$created_to = null)
    {
        $user = DB::table('users')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($user);
        
        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['user'] = $user;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport_2.user_report_2',$this->data);
    }
    public function get_location_report_2($time_period = null,$created_from = null,$created_to = null)
    {
        $city = DB::table('city')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($city);

        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['city'] = $city;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport_2.location_report_2',$this->data);
    }
    public function get_user_report_filter_2(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_user_report_2($time_period,$created_from,$created_to);
        

    }
    public function get_location_report_filter_2(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_location_report_2($time_period,$created_from,$created_to);

    }

    //report 3

    public function get_user_report_3($time_period = null,$created_from = null,$created_to = null)
    {
        $user = DB::table('users')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($user);
        
        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['user'] = $user;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport_3.user_report_3',$this->data);
    }
    public function get_location_report_3($time_period = null,$created_from = null,$created_to = null)
    {
        $city = DB::table('city')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($city);

        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['city'] = $city;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport_3.location_report_3',$this->data);
    }
    public function get_user_report_filter_3(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_user_report_3($time_period,$created_from,$created_to);
        

    }
    public function get_location_report_filter_3(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_location_report_3($time_period,$created_from,$created_to);

    }

    //report 4

    public function get_user_report_4($time_period = null,$created_from = null,$created_to = null)
    {
        $user = DB::table('users')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($user);
        
        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['user'] = $user;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport_4.user_report_4',$this->data);
    }
    public function get_location_report_4($time_period = null,$created_from = null,$created_to = null)
    {
        $city = DB::table('city')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($city);

        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['city'] = $city;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport_4.location_report_4',$this->data);
    }
    public function get_user_report_filter_4(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_user_report_4($time_period,$created_from,$created_to);
        

    }
    public function get_location_report_filter_4(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_location_report_4($time_period,$created_from,$created_to);

    }

    //report 5 

    public function get_user_report_5($time_period = null,$created_from = null,$created_to = null)
    {
        $user = DB::table('users')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($user);
        
        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['user'] = $user;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport_5.user_report_5',$this->data);
    }
    public function get_location_report_5($time_period = null,$created_from = null,$created_to = null)
    {
        $city = DB::table('city')->get();
        
        $time_filter = array('today' => __('message.today'), 'yesterday' => __('message.yesterday'), 'last_14_day' => __('message.last_14_day'), 'this_week' => __('message.this_week'), 'last_week' => __('message.last_week'), 'this_month' => __('message.this_month'), 'last_month' => __('message.last_month'), 'this_year' => __('message.this_year'), 'last_year' => __('message.last_year'), 'specific_date' => __('message.specific_date'));
        $tempArray = array($city);

        $this->data['time_period'] = $time_period;
        $this->data['created_from'] = $created_from;
        $this->data['created_to'] = $created_to;
        $this->data['tempArray'] = $tempArray;
        $this->data['city'] = $city;
        $this->data['time_filter'] = $time_filter;

        return view('admin.userReport_5.location_report_5',$this->data);
    }
    public function get_user_report_filter_5(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_user_report_5($time_period,$created_from,$created_to);
        

    }
    public function get_location_report_filter_5(Request $request)
    {
        $time_period = $request->get('time_period');
        $created_from = $request->get('created_from');
        $created_to = $request->get('created_to');

        Session::put('time_period',$time_period);
        Session::put('created_from',$created_from);
        Session::put('created_to',$created_to);
        
        return $this->get_location_report_5($time_period,$created_from,$created_to);

    }
}
