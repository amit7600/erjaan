<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;

use App\City;
use App\User;
use DB;
use Input;
use Auth;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $data = array('menu_type' => 1);
    public function __construct() {
        $this->data['base_path'] = url('/') . '/';
        // $this->data['base_path'] = 'http://ss.erjaan.com/';
    }
    public function index(Request $request)
    {
        DB::statement(DB::raw('set @rownum=0'));
        $city_data = DB::table('city')->select('*', DB::raw('@rownum := @rownum + 1 AS rownum'));
        $base_path = $this->data['base_path'];
        if (!$request->ajax()) {
            return view('admin.city.index', $this->data);
        }
        return Datatables::of($city_data)
            ->addColumn('action', function($row) {
                $edit_url = route('city.edit', $row->id);
                $delete_url = route('city.destroy', $row->id);
                $links = '<a title="Edit" href="' . $edit_url . '" class="text-success mr-2 text-25"><i class="i-Pen-4 nav-icon font-weight-bold" aria-hidden="true"></i></a>&nbsp';
                $links .= '<a title="Delete" data-href="' . $delete_url . '" class="text-danger mr-2 text-25 delete_data" style="cursor:pointer;"><i class="i-Close-Window nav-icon font-weight-bold" aria-hidden="true"></i></a>';
                return $links;
            })
            ->addColumn('isActive',function($row){
                $check = $row->isActive ? 'checked' : '';
                $links = '<label class="switch switch-primary mr-3">
                            <input type="checkbox" class="isActive" onclick = "fun_change_status('.$row->id.')" '.$check.'>
                            <span class="slider"></span>
                        </label>';
                return $links;
            })
            ->editColumn('created_at', function($row) {

                return date('d M, Y', strtotime($row->created_at));
            })
            ->editColumn('created_at', function($row) {
                return date('d M, Y', strtotime($row->created_at));
            })
            
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d %b, %Y') like ?", ["%$keyword%"]);
            })
            
            ->rawColumns(['question','isActive', 'action'])
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
        return view('admin.city.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'cityName' => 'required',
            
        ]);
        try {
            $question = DB::table('city')->insert([
                'cityName' => $request->get('cityName'),
                'isActive' => '1',
            ]);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', __('message.city').' ' .__('message.created').' ' .__('message.successfully'));
        
        } catch (Exception $e) {
        
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $e->getMessage());
        }
        return redirect()->to('admin/city')->with('success',__('message.city').' ' .__('message.created').' ' .__('message.successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $city =  DB::table('city')->where('id',$id)->first();
        return view('admin.city.edit',$this->data,compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $question = DB::table('city')->where('id',$id)->update([
                'cityName' => $request->get('cityName'),
        ]);
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', __('message.city').' ' .__('message.updated').' ' .__('message.successfully'));
        return redirect()->to('admin/city')->with('success',__('message.city').' ' .__('message.updated').' ' .__('message.successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = DB::table('city')->where('id',$id)->delete();
        
        return response()->json([
            'message' => __('message.city').' ' .__('message.deleted').' ' .__('message.successfully'),
            'status'  => true
        ],200);
    }
    //question status in feedback setting
    public function city_status(Request $request)
    {
        try {
            $id = $request->get('id');
            $cityData =  DB::table('city')->where('id',$id)->first();
            if($cityData->isActive == 0){
                $isActive = 1;
            }else{
                $isActive = 0;
            }
            if($cityData){

                DB::table('city')->where('id',$id)->update([
                    'isActive' => $isActive
                ]);
                // if($isActive == 1){
                //     $request->session()->flash('message.level', 'success');
                // $request->session()->flash('message.content', 'City activated successfully!');
                // }else{
                //     $request->session()->flash('message.level', 'success');
                //     $request->session()->flash('message.content', 'City inavctive successfully!');
                // }
                return response()->json([
                    'message' => __('message.status').' ' .__('message.change').' ' .__('message.successfully'),
                    'success' => true
                ],200);
            }    

        } catch (Exception $e) {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $e->getMessage());
        }
    }
}
