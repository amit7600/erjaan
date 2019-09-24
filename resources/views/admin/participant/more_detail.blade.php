<script id="details-template" type="text/x-handlebars-template">
    <div class="form-horizontal">
        <div class="form-group  row">
            <label class="col-sm-3 control-label" for="title">{{__('message.first_name')}}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"  value="@{{first_name}}" readonly />
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="description">{{__('message.last_name')}}</label>
            <div class="col-sm-9">
                 <input type="text" class="form-control"  value="@{{last_name}}" readonly />
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="description">{{__('message.Email')}}</label>
            <div class="col-sm-9">
                 <input type="text" class="form-control"  value="@{{email}}" readonly />
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="description">{{__('message.mobile')}} {{__('message.no')}}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="@{{mobile}}" readonly />
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="description">{{__('message.dob')}}</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="@{{dob}}" readonly />
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="description">{{__('message.gender')}}</label>
            <div class="col-sm-9">
                @{{#ifCond gender "1"}}
                   <input type="text" class="form-control" value="{{__('message.male')}}" readonly />
                @{{else}}
                    <input type="text" class="form-control" value="{{__('message.female')}}" readonly />
                @{{/ifCond}}
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="description">{{__('message.location')}}</label>
            <div class="col-sm-9">
                @{{#if location}}
                    <input type="text" class="form-control" value="@{{location.name}}" readonly />
                @{{else}}
                    <input type="text" class="form-control" value="{{__('message.no')}} {{__('message.location')}} {{__('message.was')}} {{__('message.selected')}}" readonly />
                @{{/if}}
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="description">{{__('message.category')}}</label>
            <div class="col-sm-9">
                @{{#if category}}
                    <input type="text" class="form-control" value="@{{category.category_name}}" readonly />
                @{{else}}
                    <input type="text" class="form-control" value="{{__('message.no')}} {{__('message.category')}} {{__('message.was')}} {{__('message.selected')}}" readonly />
                @{{/if}}
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="description">{{__('message.sub_category')}}</label>
            <div class="col-sm-9">
                @{{#if sub_category}}
                    <input type="text" class="form-control" value="@{{sub_category.category_name}}" readonly />
                @{{else}}
                    <input type="text" class="form-control" value="{{__('message.no')}} {{__('message.sub_category')}} {{__('message.was')}} {{__('message.selected')}}" readonly />
                @{{/if}}
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="price">{{__('message.group')}} {{__('message.name')}}</label>
            <div class="col-sm-9">
                @{{#if group}}
                    <input type="text" class="form-control" value="@{{group.group_name}}" readonly />
                @{{else}}
                    <input type="text" class="form-control" value="{{__('message.no')}} {{__('message.group')}} {{__('message.was')}} {{__('message.selected')}}" readonly />
                @{{/if}}
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="price">{{__('message.type')}} {{__('message.name')}} </label>
            <div class="col-sm-9">
                @{{#if type}}
                    <input type="text" class="form-control" value="@{{type.type_name}}" readonly />
                @{{else}}
                    <input type="text" class="form-control" value="{{__('message.no')}} {{__('message.type')}} {{__('message.was')}} {{__('message.selected')}}" readonly />
                @{{/if}}
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label" for="created_at">{{__('message.created_at')}} </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" value="@{{created_at}}" readonly />
            </div>
        </div>
       <div class="form-group  row">
            <label  class="col-sm-3 control-label"  for="updated_at">U{{__('message.updated_at')}}</label>
            <div class="col-sm-9">
                 <input type="text" class="form-control" value="@{{updated_at}}" readonly />
            </div>
        </div>
    </div>
</script>