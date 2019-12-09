<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ComplainExport;
use App\Exports\ParticipantExport;
use App\Exports\ResponseExport;
use App\Http\Controllers\Controller;
use App\Imports\ParticipantImport;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public $data = array('menu_type' => 1);

    public function __construct()
    {
        $this->data['base_path'] = url('/') . '/';

    }
    public function export(Request $request)
    {
        try {
            return Excel::download(new ParticipantExport($request), 'All Participant.xlsx');
        } catch (\Exception $e) {
            dd($e);
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.participant') . ' ' . __('message.not') . ' ' . __('message.found'));
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function feedbackResponce(Request $request)
    {
        try {
            return Excel::download(new ResponseExport($request), 'All responses.xlsx');
        } catch (\Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.responses') . ' ' . __('message.not') . ' ' . __('message.found'));
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function showImport()
    {
        return view('admin.participant.importExcel', $this->data);
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'excel_file' => 'required',
        ]);
        try {
            DB::beginTransaction();
            Excel::import(new ParticipantImport, request()->file('excel_file'));

            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.participant') . ' ' . __('message.import') . ' ' . __('message.successffully'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.internal_error'));
            return redirect()->back();
        }

    }
    public function complainExport(Request $request)
    {
        try {
            return Excel::download(new ComplainExport($request), 'Complaints.csv');
        } catch (\Throwable $th) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $th->getMessage());
            return redirect()->back()->with('error', $th->getMessage());

        }
    }
}
