<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ParticipantExport;
use App\Imports\ParticipantImport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Participant;
use App\Country;
use App\Category;
use App\Group;
use App\Type;
use App\Exports\ResponseExport;

class ExcelController extends Controller
{
    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';

    }
    public function export(Request $request)
    {
        try {
            return Excel::download(new ParticipantExport($request), 'All Participant.xlsx');
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.participant').' '.__('message.not').' '.__('message.found'));
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function feedbackResponce(Request $request)
    {
        try {
            return Excel::download(new ResponseExport($request), 'All responses.xlsx');
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.responses').' '.__('message.not').' '.__('message.found'));
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showImport() 
    {
        return view('admin.participant.importExcel', $this->data);
    }

    public function import(Request $request)
    {
        $this->validate($request,[
            'excel_file'  => 'required'
        ]);
        try {
            DB::beginTransaction();
            Excel::import(new ParticipantImport, request()->file('excel_file'));

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.participant').' '.__('message.import').' '.__('message.successffully'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.internal_error'));
            return redirect()->back();
        }
            
    }
}
