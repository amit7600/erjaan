<?php

namespace App\Http\Controllers\Admin;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Country;
use App\User;
use App\Type;
use Yajra\Datatables\Datatables;
use App\Http\Requests\TypeRequest;
use DB;
use Input;
use Auth;

class TypeController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request) { 

        $login_user = Auth::user();

        $this->data['page_title'] = "Type Management";

        if (!$request->ajax()) {
            return view('admin.type.list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
        $survey_option_data = DB::table('tbl_types')
            ->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
            ->where('is_deleted', 0)
            ->orderBy('id', 'desc');
        
        $base_path = $this->data['base_path'];

        return Datatables::of($survey_option_data)
            ->addColumn('action', function($row) {
                $edit_url = route('type.edit', $row->id);
                $delete_url = route('type.destroy', $row->id);

                $links = '<a title="'.__('message.edit').'" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="'.__('message.delete').'" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                //$links .= '<a title="Active" data-href="' . $active_url . '" class="btn btn-warning active_inactive_data"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>';
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
            ->rawColumns(['type_name', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->check_user_role();
        $this->data['menu_type'] = 1;
        return view('admin.type.index', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeRequest $request) {
        $login_user = Auth::user();

        $survey_type = new Type;        
        $survey_type->type_name = $request->input('type_name');
        $survey_type->user_id = $login_user->id;
        $survey_type->created_at = date('Y-m-d');
       
        if ($survey_type->save()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content',  __('message.survey').' '.__('message.type').' '.__('message.is').' '.__('message.created').' '.__('message.successfully'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.survey').' '.__('message.type').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        }

        return redirect()->route('type.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id) { 
        $survey_type_data = Type::where('id',$id);
        $login_user = Auth::user();
        
        $this->data['repairman_data'] = $survey_type_data->first();
        if (empty($this->data['repairman_data'])) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.survey').' '.__('message.type').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('type.index');
        }
        return view('admin.type.index', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TypeRequest $request, $id) {
        $login_user = Auth::user();
        $survey_type = Type::find($id);
        if(empty($survey_type)){
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.survey').' '.__('message.type').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('type.index');
        }


        $survey_type->type_name = $request->input('type_name');
        $survey_type->user_id = $login_user->id;

        if ($survey_type->save()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.survey').' '.__('message.type').' '.__('message.is').' '.__('message.updated').' '.__('message.successfully'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.survey').' '.__('message.type').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        }

        return redirect()->route('type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {

        if (!$request->ajax()) {
            echo "Access Denied";
            die;
        }

        $type = Type::find($id);
        $response = array('status' => true, 'message' => __('message.survey').' '.__('message.type').' '.__('message.is').' '.__('message.remove').' '.__('message.successfully'));
        if (empty($type)) {
            $response = array('status' => false, 'message' => __('message.survey').' '.__('message.type').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        } else {
            $type->is_deleted = 1;
            $type->save();
        }
        echo json_encode($response);
        die();
    }


    function check_user_role()
    {
        if(Auth::user()->user_role==2){
            echo "Access Denied";
            die;
        }
    }

}
