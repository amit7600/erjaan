<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Participant;
use App\Country;
use App\Category;
use App\Group;
use App\Type;
use DB;

class ParticipantImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
                        $catId = '';
                        $subCatId = '';
                        $groupId = '';
                        $typeId = '';
                        $isExistLocation = \DB::table('countries')->where('dial_code',(int)$row[4])->first();
                        $location = $isExistLocation != null ?  $isExistLocation->id : null;
                        // dd($location, $isExistLocation, $value->dialcode, $value);
                        $categoryData = Category::get();
                        foreach ($categoryData as $keyC => $valueC) {
                            if (str_replace(' ', '', strtolower($valueC->category_name)) == str_replace(' ', '', strtolower($row[13]))) {
                                $catId = $valueC->id;
                            }
                        }
                        $subCategoryData = Category::where('parent_id', '<>', 0)->get();
                        foreach ($subCategoryData as $keyS => $valueS) {
                            if (str_replace(' ', '', strtolower($valueS->category_name)) == str_replace(' ', '', strtolower($row[14]))) {
                                $subCatId = $valueS->id;        
                            }
                        }                    
                        if ($catId == '' && $row[13] != null) {             
                            $catGetId = Category::create([
                                'parent_id' => 0,
                                'category_name' => $row[13],
                                'status'    => 1,
                                'user_id'   => \Auth::user()->id,
                            ]);
                        }
                        if ($subCatId == '' && $row[12] != null) {
                            $subCatGetId = Category::create([
                                'parent_id' => isset($catGetId) ? $catGetId->id : $catId,
                                'category_name' => $row[12],
                                'status'    => 1,
                                'user_id'   => \Auth::user()->id,
                            ]);
                            DB::commit();
                        }

                        $countryData = DB::table('countries')->where('sortname', strtoupper($row[15]))->first();

                        $groupData = DB::table('tbl_groups')->get();
                        foreach ($groupData as $keyG => $valueG) {
                            if (str_replace(' ', '', strtolower($valueG->group_name)) == str_replace(' ', '', strtolower($row[16]))) {
                                $groupId = $valueG->id;        
                            }
                        }

                        if ($groupId == '' && $row[16] != null) {
                            $groupGetId = Group::create([
                                'user_id'   => \Auth::user()->id,
                                'group_name'   => $row[16],
                                'status'    => 1,
                            ]);
                            DB::commit();
                        }


                        $typeData = DB::table('tbl_types')->get();
                        foreach ($typeData as $keyT => $valueT) {
                            if (str_replace(' ', '', strtolower($valueT->type_name)) == str_replace(' ', '', strtolower($row[17]))) {
                                $typeId = $valueT->id;        
                            }
                        }

                        if ($typeId == '' && $row[17] != null) {
                            $typeGetId = Type::create([
                                'user_id'   => \Auth::user()->id,
                                'type_name'   => $row[17],
                                'status'    => 1,
                            ]);
                        }
                        $gender = 1;
                        if ($row[10]) {
                            if (strtolower($row[10]) == 'male') $gender = 1;
                            if (strtolower($row[10]) == 'female') $gender = 2;
                        } 
                        $arrayData = [
                            'user_id'   => \Auth::user()->id,
                            'first_name'    => $row[1],
                            'last_name' => $row[2],
                            'email' => $row[3],
                            'dial_code' => $row[4],
                            'mobile'    => $row[5],
                            'on_behalf_first_name'  => $row[6],
                            'on_behalf_last_name'   => $row[7],
                            'on_behalf_email'   => $row[8],
                            'on_behalf_mobile'  => $row[9],
                            'gender'    => $gender,
                            'dob'   => $row[11],
                            'comment'   => $row[12],
                            'category_id' => isset($catGetId) ? $catGetId->id : $catId,
                            'sub_category_id' => isset($subCatGetId) ? $subCatGetId->id : $subCatId,
                            'location_id'  => $countryData ? $countryData->id : 971,
                            'group_id'    => isset($groupGetId) ? $groupGetId->id : $groupId,
                            'type_id' => isset($typeGetId) ? $typeGetId->id : $typeId,
                            'status'    => $row[18] == null ?  1 : $row[18] ,
                        ];
                        $isExist = Participant::where('email', $row[3])->where('mobile', $row[5])->first();
                        if($isExist) {                        
                            $a = Participant::where('id', $isExist->id)->update($arrayData);
                            DB::commit();
                        } else {
                            Participant::create($arrayData);
                            DB::commit();
                        }
        return new Participant($arrayData);
    }
}
