<!-- start participant list and filter serach-->
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card text-left">
            <div class="card-body">
                <h4 class="card-title mb-3">{{__('message.participants_list')}}
                    <a href="" class="btn btn-primary btn-icon m-1 float-right" id="quick_add_participant">
                        <span class="ul-btn__icon"><i class="i-Refresh "></i></span>
                        <span class="ul-btn__text">{{__('message.clear_filter')}}</span>
                    </a>
                    <button class="btn btn-primary btn-icon m-1 float-right" id="quick_add_participant"
                        data-toggle="modal" data-target="#myModal_search">
                        <span class="ul-btn__icon"><i class="i-Magnifi-Glass1"></i></span>
                        <span class="ul-btn__text">{{__('message.filtering')}}</span>
                    </button>
                </h4>
                <div id="show_filter"></div>
                <div class="table-responsive ">
                    <table id="main_tble" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:5%" scope="col" class="text-center">S.No</th>
                                <th class="text-center" scope="col">{{__('message.first_name')}}</th>
                                <th class="text-center" scope="col">{{__('message.last_name')}}</th>
                                <th class="text-center" scope="col">{{__('message.e-mail')}}</th>
                                <th class="text-center" scope="col">{{__('message.mobile')}}</th>
                                <th class="text-center" scope="col">{{__('message.created_date')}}</th>
                                <th class="text-center" scope="col">{{__('message.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($participant_record) > 0) {?>
                            <?php foreach($participant_record as $key =>$participantRecord) { ?>
                            <tr id="participants_{{ $participantRecord->id }}">
                                <th scope="row" style="width:5%" class="text-center">{{ $key + 1 }}</th>
                                <td class="text-center">{{ $participantRecord->first_name }}</td>
                                <td class="text-center">{{ $participantRecord->last_name }}</td>
                                <td class="text-center">{{ $participantRecord->email }}</td>
                                <td class="text-center">{{ $participantRecord->mobile }}</td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($participantRecord->created_at)->format('d M Y')}}</td>
                                <td class=" text-center">
                                    <a href="" class="text-success mr-2" id="quick_add_participant" data-toggle="modal"
                                        data-target="#mymodel_{{ $participantRecord->id }}">
                                        <i class="nav-icon i-Pen-2 font-weight-bold text-20" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            <div class="modal" role="dialog" id="mymodel_{{ $participantRecord->id }}">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="alert alert-danger" role="alert" style="display:none;">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">{{__('message.edit')}}
                                                {{__('message.participant')}}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" name="frm_edit_participant_{{ $participantRecord->id }}"
                                            id="frm_edit_participant_{{ $participantRecord->id }}">
                                            <div class="modal-body">
                                                {{ csrf_field()}}
                                                <input type="hidden" name="id" id="id_{{ $participantRecord->id }}"
                                                    value="{{!empty($participantRecord->id)?$participantRecord->id:''}}">
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.first_name')}}<span
                                                                class="required">*</span></label>
                                                        <input type="text" id="first_name_{{ $participantRecord->id }}"
                                                            maxlength="30" name="first_name" class="form-control"
                                                            value="{{ $participantRecord->first_name }}"
                                                            placeholder="First Name">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.last_name')}} <span
                                                                class="required">*</span></label>
                                                        <input type="text" id="last_name_{{ $participantRecord->id }}"
                                                            maxlength="30" name="last_name" class="form-control"
                                                            value="{{ $participantRecord->last_name }}"
                                                            placeholder="Last Name">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.email')}} <span
                                                                class="required">*</span></label>
                                                        <input type="text" id="email_{{ $participantRecord->id }}"
                                                            maxlength="70" name="email" class="form-control"
                                                            value="{{ $participantRecord->email }}" placeholder="Email">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.location')}} <span
                                                                class="required">*</span></label>
                                                        <div class="input-right-icon">
                                                            <select class="select2_group form-control"
                                                                id="location_id_{{ $participantRecord->id }}"
                                                                name="location_id">
                                                                <option value="0">{{__('message.select_location')}}
                                                                </option>
                                                                @foreach ($country as $row)
                                                                <?php
                                                                $selected = '';
                                                                if (!empty($participantRecord->location_id)) {
                                                                    if ($participantRecord->location_id == $row->id)
                                                                        $selected = 'selected';
                                                                }
                                                                ?>
                                                                <option <?php echo $selected; ?> value="{{ $row->id }}">
                                                                    {{$row->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="span-right-input-icon">
                                                                <i class="ul-form__icon i-Arrow-Down"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.mobile')}} <span
                                                                class="required">*</span></label>
                                                        <input type="text" id="mobile_{{ $participantRecord->id }}"
                                                            maxlength="15" name="mobile" class="form-control"
                                                            value="{{ $participantRecord->mobile }}"
                                                            placeholder="Mobile">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.date_of_birth')}}
                                                            <span class="required">*</span></label>
                                                        <div class="input-right-icon">
                                                            <input type="text" id="dob_{{ $participantRecord->id }}"
                                                                name="dob" class="form-control dob" readonly="readonly "
                                                                value="{{ $participantRecord->dob }}"
                                                                placeholder="YYYY-mm-dd">
                                                            <span class="span-right-input-icon">
                                                                <i class="ul-form__icon i-Calendar-4"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.gender')}} <span
                                                                class="required">*</span></label>
                                                        <div class="input-right-icon">
                                                            <select class="form-control" name="gender"
                                                                id="gender_{{ $participantRecord->id }}">
                                                                <?php
                                                                $selected1 = '';
                                                                $selected2 = '';
                                                                if (!empty($participantRecord)) {
                                                                    if ($participantRecord->gender == 1){
                                                                        $selected1 = 'selected';
                                                                    }
                                                                }

                                                                if (!empty($participantRecord)) {
                                                                    if ($participantRecord->gender == 2){
                                                                        $selected2 = 'selected';
                                                                    }
                                                                }
                                                                ?>
                                                                <option <?php echo $selected1; ?>value="1">
                                                                    {{__('message.male')}}</option>
                                                                <option <?php echo $selected2; ?> value="2">
                                                                    {{__('message.female')}}
                                                                </option>
                                                            </select>
                                                            <span class="span-right-input-icon">
                                                                <i class="ul-form__icon i-Arrow-Down"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.category')}} <span
                                                                class="required">*</span></label>
                                                        <div class="input-right-icon">
                                                            <select class="select2_group form-control"
                                                                id="category_id_{{ $participantRecord->id }}"
                                                                name="category_id">
                                                                <option value="0"> {{__('message.select_category')}}
                                                                </option>
                                                                @foreach ($category as $row)
                                                                <?php
                                                                $selected = '';
                                                                $selected_category_id = !empty(Input::old('category_id'))?Input::old('category_id'):((!empty($participantRecord->category_id)?$participantRecord->category_id:0));
                                                                
                                                                if ($selected_category_id == $row->id){
                                                                    $selected = 'selected';
                                                                }
                                                                ?>
                                                                <option <?php echo $selected; ?> value="{{ $row->id }}">
                                                                    {{$row->category_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="span-right-input-icon">
                                                                <i class="ul-form__icon i-Arrow-Down"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.sub_category')}}
                                                            <span class="required">*</span></label>
                                                        <div class="input-right-icon">
                                                            <select class="select2_group form-control"
                                                                id="sub_category_id_{{ $participantRecord->id }}"
                                                                name="sub_category_id">
                                                                <option value="0">{{__('message.select_sub_category')}}
                                                                </option>
                                                            </select>
                                                            <span class="span-right-input-icon">
                                                                <i class="ul-form__icon i-Arrow-Down"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="ul-form__label">{{__('message.group')}} <span
                                                                class="required">*</span></label>
                                                        <div class="input-right-icon">
                                                            <select class="select2_group form-control"
                                                                id="group_id_{{ $participantRecord->id }}"
                                                                name="group_id">
                                                                <option value="0">{{__('message.select_group')}}
                                                                </option>
                                                                @foreach ($group as $row)
                                                                <?php
                                                                $selected = '';
                                                                if (!empty($participantRecord)) {
                                                                    if ($participantRecord->group_id == $row->id)
                                                                        $selected = 'selected';
                                                                }
                                                                ?>
                                                                <option <?php echo $selected; ?> value="{{ $row->id }}">
                                                                    {{$row->group_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="span-right-input-icon">
                                                                <i class="ul-form__icon i-Arrow-Down"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label class="ul-form__label">{{__('message.type')}} <span
                                                                class="required">*</span></label>
                                                        <div class="input-right-icon">
                                                            <select class="select2_group form-control"
                                                                id="type_id_{{ $participantRecord->id }}"
                                                                name="type_id">
                                                                <option value="">{{__('message.select_type')}}</option>
                                                                @foreach ($type as $row)
                                                                <?php
                                                                $selected = '';
                                                                if (!empty($participantRecord)) {
                                                                    if ($participantRecord->type_id == $row->id){
                                                                        $selected = 'selected';
                                                                    }
                                                                }
                                                                ?>
                                                                <option <?php echo $selected; ?> value="{{ $row->id }}">
                                                                    {{$row->type_name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <span class="span-right-input-icon">
                                                                <i class="ul-form__icon i-Arrow-Down"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="ul-form__label">{{__('message.comment')}} <span
                                                                class="required">*</span></label>
                                                        <textarea name="comment"
                                                            id="comment_{{ $participantRecord->id }}"
                                                            class="form-control"
                                                            placeholder="Comment"> {{ $participantRecord->comment }}  </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{__('message.close')}}</button>
                                                <button type="button" class="btn btn-success ml-2"
                                                    onclick="fun_edit_participant_{{ $participantRecord->id }}()">{{__('message.update')}}</button>
                                            </div>
                                            <script type="text/javascript">
                                                $(document).ready( function(){
                                                    $('#category_id_{{ $participantRecord->id }}').change(function() {
                                                    //debugger;
                                                    var me = this;
                                                    var url = '{{route("get_sub_category_by_category_id")}}';
                                                    var categoryId = $(this).find(':selected').val();
                                                    $.ajax({
                                                        url  : url,
                                                        type : 'GET',
                                                        data : {category_id:categoryId},
                                                        dataType: 'json',
                                                        success: function(resp){
                                                            if(resp.data.length==0){
                                                                return false;
                                                            }
                                                            //debugger;
                                                            $('#sub_category_id_{{ $participantRecord->id }}').html('');
                                                            selectedSubCategory = '<?php echo !empty(Input::old('sub_category_id'))?Input::old('sub_category_id'):((!empty($participantRecord->sub_category_id)?$participantRecord->sub_category_id:0)) ?>';
                                                            $.each(resp.data, function (index, value) {
                                                                //debugger;
                                                                var obj = { 
                                                                    value: value.id,
                                                                    text : value.category_name,
                                                                };

                                                                if(selectedSubCategory==value.id){
                                                                    obj.selected = 'selected';
                                                                }

                                                                $('#sub_category_id_{{ $participantRecord->id }}').append($('<option/>',obj));
                                                            });  
                                                        },
                                                        error: function(resp){

                                                        }
                                                    });
                                                });
                                                var categoryId = '<?php echo isset($selected_category_id) ? $selected_category_id : '' ?>';
                                                if(categoryId!=0){
                                                    $('#category_id_{{ $participantRecord->id }}').trigger('change');
                                                }        
                                            })
                                                function fun_edit_participant_{{ $participantRecord->id }}(){
                                                    
                                                    var id = $('#id_{{ $participantRecord->id }}').val();
                                                    var first_name = $('#first_name_{{ $participantRecord->id }}').val();
                                                    var last_name = $('#last_name_{{ $participantRecord->id }}').val();
                                                    var email = $('#email_{{ $participantRecord->id }}').val();
                                                    var location_id = $('#location_id_{{ $participantRecord->id }}').val();
                                                    var mobile = $('#mobile_{{ $participantRecord->id }}').val();
                                                    var dob = $('#dob_{{ $participantRecord->id }}').val();
                                                    var gender = $('#gender_{{ $participantRecord->id }}').val();
                                                    var category_id = $('#category_id_{{ $participantRecord->id }}').val();
                                                    var sub_category_id = $('#sub_category_id_{{ $participantRecord->id }}').val();
                                                    var group_id = $('#group_id_{{ $participantRecord->id }}').val();
                                                    var type_id = $('#type_id_{{ $participantRecord->id }}').val();
                                                    var comment = $('#comment_{{ $participantRecord->id }}').val();

                                                    $.ajax({
                                                        url: '{{route("edit_participant")}}',
                                                        type: 'POST',               
                                                        data: {
                                                            "_token": "{{ csrf_token() }}",
                                                            'id' : id,
                                                            'first_name' : first_name,
                                                            'last_name' : last_name,
                                                            'email' : email,
                                                            'location_id' : location_id,
                                                            'mobile' : mobile,
                                                            'dob' : dob,
                                                            'gender' : gender,
                                                            'category_id' : category_id,
                                                            'sub_category_id' : sub_category_id,
                                                            'type_id' : type_id,
                                                            'group_id' : group_id,
                                                            'comment' : comment,
                                                            
                                                        },
                                                        success:function(responce){
                                                            $('#mymodel_{{ $participantRecord->id }} ').modal('hide');
                                                            $('.close').click()
                                                            $("#main_tble").load(document.URL + ' #main_tble');
                                                        },
                                                        error: function(responce){
                                                        
                                                        }
                                                    });    
                                                }
                                            </script>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php } else { ?>
                            <tr>
                                <td colspan="7" style="text-align: center"> {{__('message.no_record_found')}} </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div id="show_data">
                    </div>
                    {{ $participant_record->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end participant list and filter serach-->

<!-- search filter participant model -->
<div class="modal" role="dialog" id="myModal_search">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="alert alert-danger" role="alert" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-header">
                <h5 class="modal-title">{{__('message.search')}} {{__('message.participant')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="ul-form__label">{{__('message.select_category')}}</label>
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="category_id_participant"
                                    name="category_id">
                                    <?php $selected = ''; ?>
                                    <option value="">{{__('message.select_category')}}</option>
                                    @foreach ($category as $row)
                                    <?php
                                        if (!empty($form_data)) {
                                            if ($form_data['category_id'] == $row->id) {
                                                $selected = 'selected';
                                            }
                                        }
                                        ?>
                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->category_name}}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="ul-form__label">{{__('message.select_sub_category')}}</label>
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="sub_category_id" name="sub_category_id">
                                    <option value="">{{__('message.select_sub_category')}}</option>
                                    <?php
                                        if (!empty($form_data)) {
                                            if ($form_data['sub_category_name']) {
                                                ?>
                                    <option selected="selected" value="<?php echo $form_data['sub_category_id']; ?>">
                                        <?php echo $form_data['sub_category_name']; ?></option>;
                                    <?php
                                            }
                                        }
                                        ?>
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="hidden"
                                value="<?php echo!empty($form_data['schedule_id']) ? $form_data['schedule_id'] : ''; ?>"
                                id="schedule_id" name="schedule_id">
                            <label class="ul-form__label">{{__('message.select_type')}}</label>
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="type_id" name="type_id">
                                    <option value="">{{__('message.select_type')}}</option>
                                    <?php $selected = ''; ?>
                                    @foreach ($type as $row)
                                    <?php
                                        if (!empty($form_data)) {
                                            if ($form_data['type_id'] == $row->id) {
                                                $selected = 'selected';
                                            }
                                        }
                                        ?>
                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->type_name}}</option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="ul-form__label">{{__('message.select_group')}}</label>
                            <div class="input-right-icon">
                                <select class="select2_group form-control" id="group_id" name="group_id">
                                    <?php $selected = ''; ?>
                                    <option value="">{{__('message.select_group')}} </option>
                                    @foreach ($group as $row)
                                    <?php
                                        if (!empty($form_data)) {
                                            if ($form_data['group_id'] == $row->id) {
                                                $selected = 'selected';
                                            }
                                        }
                                        ?>
                                    <option <?php echo $selected; ?> value="{{ $row->id }}">{{$row->group_name}}
                                    </option>
                                    @endforeach
                                </select>
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Arrow-Down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="ul-form__label">{{__('message.start_date')}} <span
                                    class="required">*</span></label>
                            <div class="input-right-icon">
                                <input type="text" id="start_date" readonly="readonly" name="start_date"
                                    class="form-control" value="" placeholder="YYYY-mm-dd">
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Calendar-4"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="ul-form__label">{{__('message.end_date')}} <span
                                    class="required">*</span></label>
                            <div class="input-right-icon">
                                <input type="text" id="end_date" readonly="readonly" name="end_date"
                                    class="form-control" value="" placeholder="YYYY-mm-dd">
                                <span class="span-right-input-icon">
                                    <i class="ul-form__icon i-Calendar-4"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{__('message.close')}}</button>
                    <button type="button" class="btn btn-success ml-2"
                        onclick="fun_search()">{{__('message.search')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end search filter participant model -->

@include('admin.participant.more_detail')


<script src="{{asset('admin_css/assets/gentelella/vendors/bootbox/bootbox.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
<link href="{{asset('admin_css/assets/gentelella/build/css/jquery-ui.css')}}" rel="stylesheet">
<script src="{{asset('admin_css/assets/gentelella/build/js/jquery-ui.js')}}"></script>
<script type="text/javascript">
    var dataTable;
    var extraData={};

    var scheduleID = $('#schedule_id').val();
    extraData.schedule_id = scheduleID;
    extraData.segment = '{{Request::segment(2)}}';

    var columns = [
        {data: 'rownum', name: 'rownum'},
        {data: 'first_name', name: 'first_name'},
        {data: 'last_name', name: 'last_name'},
        {data: 'email', name: 'email'},
        {data: 'mobile', name: 'mobile'},
        {data: 'created_at', name: 'created_at'},
        // {data: 'action', name: 'action'},
    ];

    var ajaxUrl = '{!! route('participant_table') !!}'; //Url of ajax datatable where you fetch data


    //It may be empty array
    var columnDefs = [
        {
            "targets": 0,
            "orderable": true,
            "class": "text-center",
        },
        {
            "targets": 1,
            "orderable": true,
            "class": "text-left"
        },
        {
            "targets": 2,
            "orderable": true,
            "class": "text-center"
        },
        {
            "targets": 3,
            "orderable": true,
            "class": "text-center"
        },
        // {
        //     "targets": 4,
        //     "orderable": false,
        //     "class": "text-center"
        // },
                /*{
                 "targets": 5,
                 "orderable": false,
                 "class":"text-center"
                 },*/
    ];
    //var columnDefs = [];
    $('#btn-search').click(function () {
        var category_id = $('#category_id_participant').find('option:selected').val();
        var sub_category_id = $('#sub_category_id').find('option:selected').val();
        var type_id = $('#type_id').find('option:selected').val();
        var location_id = $('#location_id').find('option:selected').val();
        var gender = $('#gender').find('option:selected').val();
        var group_id = $('#group_id').find('option:selected').val();

        extraData = {};
        extraData.category_id = category_id;
        extraData.sub_category_id = sub_category_id;
        extraData.type_id = type_id;
        extraData.location_id = location_id;
        extraData.gender = gender;
        extraData.group_id = group_id;
        extraData.segment = '{{Request::segment(2)}}';
        extraData.search_filter_value = $('#search_filter_value').val();
        dataTable.ajax.reload();
    });
    
    $( "#start_date" ).datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
       
    });
    $( "#end_date" ).datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
       
    });


    

    function fun_search(){
        var category_id = $('#category_id_participant').val();
        var sub_category_id = $('#sub_category_id').val();
        var type_id = $('#type_id').val();
        var group_id = $('#group_id').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        var category_name = category_id != '' ? $('#category_id_participant').find('option:selected')[0].label : '' ;
        var sub_category_name = sub_category_id != '' ? $('#sub_category_id').find('option:selected')[0].label : '';
        var type_name = type_id != '' ? $('#type_id').find('option:selected')[0].label : '' ;
        var group_name = group_id != '' ? $('#group_id').find('option:selected')[0].label : '' ;



        $.ajax({
                url: '{{route("search_participant")}}',
                type: 'POST',               
                data: {
                    'category_id' : category_id,
                    "_token": "{{ csrf_token() }}",
                    'sub_category_id' : sub_category_id,
                    'type_id' : type_id,
                    'group_id' : group_id,
                    'start_date' : start_date,
                    'end_date' : end_date,
                },
                success:function(responce){
                   
                    $("#show_data").html(responce); 
                    $("#main_tble").hide();
                    $('#myModal_search ').modal('hide');
                    $('.close').click()
                },
                error: function(responce){

                }
            });
        $('#show_filter').empty()
        $('#show_filter').append("<ul class='filter_display'><li>"+category_name+"</li><li>"+sub_category_name+"</li><li>"+type_name+"</li><li>"+group_name+"</li><li>"+start_date+"</li><li>"+end_date+"</li></ul>")
    }    
</script>
<script type="text/javascript">
    $('.dob').datepicker({
        dateFormat:'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#category_id_participant').change(function(){
            //debugger;
            var me = this;
            var url = '{{route("get_sub_category_by_category_id")}}';
            var categoryId = $(this).find(':selected').val();
            $.ajax({
                url  : url,
                type : 'GET',
                data : {category_id:categoryId},
                dataType: 'json',
                success: function(resp){
                    if(resp.data.length==0){
                        return false;
                    }
                    //debugger;
                    $('#sub_category_id').html('<option value="0">Select sub category</option>');
                    selectedSubCategory = '<?php echo !empty(Input::old('sub_category_id'))?Input::old('sub_category_id'):((!empty($repairman_data->sub_category_id)?$repairman_data->sub_category_id:0)) ?>';
                    $.each(resp.data, function (index, value) {
                        //debugger;
                        var obj = { 
                            value: value.id,
                            text : value.category_name,
                        };

                        if(selectedSubCategory==value.id){
                            obj.selected = 'selected';
                        }

                        $('#sub_category_id').append($('<option/>',obj));
                    });  
                },
                error: function(resp){

                }
            });
        });
    });
</script>
<style type="text/css">
    .ui-datepicker .ui-datepicker-title select {
        color: #555 !important;
    }

    .filter_display {
        display: inline-block;
        float: left;
        width: 100%;
        padding: 0px;
    }

    .filter_display li {
        display: inline-block;
        float: left;
        padding: 0px 0px;
        width: 16%;
        text-align: center;
        border-right: 2px solid #26b99a;
        margin: 12px 0;
        font-size: 14px;
    }

    .filter_display li:last-child {
        border-right: none;
    }
</style>