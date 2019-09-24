<?php

namespace App\Exports;

use App\FeedbackSurvey;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use DB;
use Carbon\Carbon;

class ResponseExport implements FromView
{
    public function __construct($request){
        $this->request = $request;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $response = FeedbackSurvey::select('*')->where('feedback_id',$this->request->get('feedback_id'));

            if($this->request->get('user_id') != null){
                $response->where('user_id', $this->request->get('user_id'));
            }
            if($this->request->get('location') != null){
                $response->where('user_city', $this->request->get('location'));   
            }

            if ($this->request->get('time_period') != null) {

            $time_period = $this->request->get('time_period') ;
            $created_from ='';
            $created_to = '';
            if ($this->request->get('created_from') != null) {
                $created_from = $this->request->get('created_from');
                
            }
            if ($this->request->get('created_to') != null) {
                $created_to = $this->request->get('created_to');
            }    
            //dd($time_period);
            if ($time_period == 'specific_date') {
                if (($created_from != null && $created_to != null) && ($created_from != '0' && $created_to != '0')) {
                    $created_from = date('Y/m/d', strtotime($created_from));
                    $created_to = date('Y/m/d', strtotime($created_to));

                    $response = $response->whereRaw(" Date(created_at) between '$created_from' and '$created_to'");
                }
            } elseif ($time_period == 'today') {
                $response = $response->whereDate('created_at', Carbon::now()->format('Y/m/d'));
            }  elseif ($time_period == 'yesterday') {
                $response = $response->whereDate('created_at', '=', Carbon::yesterday()->format('Y-m-d'));
            } elseif ($time_period == 'last_14_day') {
                $response = $response->whereDate('created_at', '>=', Carbon::now()->subDays(14)->toDateTimeString());
                
            } elseif ($time_period == 'this_week') {
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                $response = $response->whereRaw(" Date(created_at) between '$start' and '$end'");

            } elseif ($time_period == 'last_week') {
                $start = Carbon::now()->startOfWeek()->subDays(7);
                $end = Carbon::now()->startOfWeek();
                $response = $response->whereRaw(" Date(created_at) between '$start' and '$end'");

            } elseif ($time_period == 'this_month') {
                $response = $response->whereDate('created_at', '>=', Carbon::now()->startOfMonth()->toDateTimeString());

            } elseif ($time_period == 'last_month') {
                $start = Carbon::now()->startOfMonth()->subMonth()->toDateString();
                $end = Carbon::now()->startofMonth()->subMonth()->endOfMonth()->toDateString();
                $response = $response->whereRaw(" Date(created_at) between '$start' and '$end'");

            } elseif ($time_period == 'this_year') {
                $response = $response->whereYear('created_at', '>=', date('Y'));
            } elseif ($time_period == 'last_year') {
                $start = Carbon::now()->startOfYear()->subDays(365)->toDateString();
                $end = Carbon::now()->startOfYear()->toDateString();
                $response = $response->whereRaw(" Date(created_at) between '$start' and '$end'");
            }

        }

                $response = $response->select(DB::raw('DATE_FORMAT(created_at,"%d/%m") as date'), DB::raw('DATE(created_at) as full_date'), DB::raw('count(*) as responses'))
                            ->groupBy('full_date')
                            ->orderBy('full_date', 'desc');
        return view('exports.all_feedback_responses', ['responses' => $response->get()]);
    }
}
