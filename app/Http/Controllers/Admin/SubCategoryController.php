<?php

namespace App\Http\Controllers\Admin;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Country;
use App\User;
use App\Category;
use Yajra\Datatables\Datatables;
use App\Http\Requests\CategoryRequest;
use DB;
use Input;
use Auth;

class SubCategoryController extends Controller {

    var $data = array('menu_type' => 1);

    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index(Request $request, $id) { 

        $login_user = Auth::user();

        $this->data['page_title'] = "Sub Category Management";

        if (!$request->ajax()) {
            return view('admin.category.sub_category_list', $this->data);
        }

        DB::statement(DB::raw('set @rownum=0'));
        $survey_category_data = DB::table('tbl_categories')
            ->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'))
            ->where('is_deleted', 0)
            ->where('parent_id', $id)
            ->orderBy('id', 'desc');
        
        $base_path = $this->data['base_path'];

        return Datatables::of($survey_category_data)
            ->addColumn('action', function($row) {
                $edit_url = route('sub_category.edit', $row->id);
                $delete_url = route('sub_category.destroy', $row->id);
              $links = '';
               $links .= '<a title="'.__('message.edit').'" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="'.__('message.delete').'" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data" style="cursor:pointer;"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
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
            ->rawColumns(['category_name', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->check_user_role();

        $this->data['category'] = Category::Select('id', 'category_name')
            ->where('is_deleted', 0)
            ->where('parent_id', 0)
            ->get();
        $this->data['menu_type'] = 1;
        return view('admin.category.add_sub_category', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request) {
        $login_user = Auth::user();

        $survey_category = new Category;        
        $survey_category->category_name = $request->input('category_name');
        $survey_category->parent_id = $request->input('category_id');
        $survey_category->created_at = date('Y-m-d');
       
        if ($survey_category->save()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.sub_category').' '.__('message.is').' '.__('message.created').' '.__('message.successfully'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.sub_category').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        }
        
        return redirect()->route('sub_category_list',$request->input('category_id'));
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id) { 
        $category_data = Category::where('id',$id);
        $login_user = Auth::user();

        $this->data['category'] = Category::Select('id', 'category_name')
            ->where('is_deleted', 0)
            ->where('parent_id', 0)
            ->get();

        $this->data['repairman_data'] = $category_data->first();
        if (empty($this->data['repairman_data'])) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.sub_category').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('sub_category.index');
        }
        return view('admin.category.add_sub_category', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id) {
        $login_user = Auth::user();

        $survey_category = Category::find($id);
        if(empty($survey_category)){       
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.sub_category').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
            return redirect()->route('sub_category_list',$id);
        }


        $survey_category->category_name = $request->input('category_name');
        $survey_category->parent_id = $request->input('category_id');

        if ($survey_category->save()) {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.sub_category').' '.__('message.is').' '.__('message.updated').' '.__('message.successfully'));
        } else {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', __('message.sub_category').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        }

        return redirect()->route('sub_category_list',$request->input('category_id'));
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

        $category = Category::find($id);
        $response = array('status' => true, 'message' => __('message.sub_category').' '.__('message.is').' '.__('message.remove').' '.__('message.successfully'));
        if (empty($category)) {
            $response = array('status' => false, 'message' => __('message.sub_category').' '.__('message.is').' '.__('message.not').' '.__('message.found'));
        } else {
            $category->is_deleted = 1;
            $category->save();
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

    function getSubCategoryByCategoryId(Request $request)
    {
        $columns = array('category_name','id');
        $data = Category::where('parent_id',$request->input('category_id'))
        ->where('is_deleted',0)
        ->get($columns);
        $response = array('status'=>true,'data'=>$data);
        echo json_encode($response);
    }

}
