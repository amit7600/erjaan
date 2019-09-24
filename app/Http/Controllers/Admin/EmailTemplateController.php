<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EmailTemplate;
use Yajra\Datatables\Datatables;
use App\Http\Requests\EmailTemplateRequest;
use DB;

class EmailTemplateController extends Controller
{
    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $this->data['page_title'] = __('message.Email').' '.__('message.template').' '.__('message.managenment');

        if (!$request->ajax()) {
            return view('admin.email_template.list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
        $survey_category = EmailTemplate::select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
            ->orderBy('id', 'desc');
        
        $base_path = $this->data['base_path'];

        return Datatables::of($survey_category)
            ->addColumn('action', function($row) {
                $edit_url = route('email-template.edit', $row->id);
                $delete_url = route('email-template.destroy', $row->id);
                
                $links = '';
                $links .= '<a title="'.__('message.edit').'" href="' . $edit_url . '" class=" text-success mr-2 text-25"><i class=" i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="'.__('message.delete').'" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data" style="cursor:pointer"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                
                return $links;
            })
            ->editColumn('created_at', function($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            ->editColumn('updated_at', function($row) {
                return date('d M, Y', strtotime($row->updated_at));
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('updated_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(updated_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $this->data['title'] = "Hello";
        $this->data['parameter_list'] = \DB::table('tbl_survey_form')
                                        ->where('status', 1)
                                        ->where('is_deleted', 0)
                                        ->get();
        return view('admin.email_template.index',$this->data);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailTemplateRequest $request)
    {
        //
        $email_template = new EmailTemplate;        
        $email_template->title = $request->input('title');
        $email_template->content = $request->input('content');
        $email_template->created_at = date('Y-m-d H:i:s');
        $email_template->updated_at = date('Y-m-d H:i:s');

        if ($email_template->save()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.Email').' '.__('message.template').' '.__('message.is').' '.__('message.created').' '.__('message.successfully'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.something_wrong'));
        }

        return redirect()->route('email-template.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //echo "ID->". $request->post('template_id');die;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function emailTemplateList(Request $request)
    {
        $email_template = EmailTemplate::select('*')
            ->orderBy('id', 'desc')
            ->get();

        $html = '';
        if($email_template){
            $html .='<div class="form-group">';
                $html .='<select class="select2_group form-control" id="template_type" name="template_dropdown">';
                $html .= '<option value="0">Select Template</option>';
            foreach ($email_template as $email) { 
                $html .= '<option value="'.$email->id.'">'.$email->title.'</option>';
            }    
                $html .='</select>';
            $html .='</div>';
        }
        
        echo json_encode($html);
        die();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->data['template_data'] = EmailTemplate::find($id);
        $this->data['parameter_list'] = \DB::table('tbl_survey_form')
                                        ->where('status', 1)
                                        ->where('is_deleted', 0)
                                        ->get();
        if (empty($this->data['template_data'])) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.Email').' '.__('message.template').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('email-template.index');
        }
        return view('admin.email_template.index', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailTemplateRequest $request, $id)
    {
        //
        $email_template = EmailTemplate::find($id);
        if (empty($email_template)) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.Email').' '.__('message.template').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('email-template.index');
        }

        $email_template->title = $request->input('title');
        $email_template->content = $request->input('content');
        $email_template->updated_at = date('Y-m-d H:i:s');

        if ($email_template->save()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.Email').' '.__('message.template').' '.__('message.updated').' '.__('message.successfully'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.something_wrong'));
        }

        return redirect()->route('email-template.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        if(!$request->ajax()){
            echo "No direct access allowed.";
            die;
        }

        $obj = EmailTemplate::find($id);
        $response = array('status'=>false,'message'=>'Data not found');
        if($obj->delete()){
            $response = array('status'=>true,'message'=> __('message.Email').' '.__('message.template').' '.__('message.deleted').' '.__('message.successfully'));
        }
        
        echo json_encode($response);
    }
}
