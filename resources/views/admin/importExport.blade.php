<style type="text/css">
    .myoption{ 
        border: 1px solid #cccccc;
        height: 24px;
        padding: 3px;
        margin-top: 2%;
    }
</style>

@extends('layout.admin')
{{-- Page title --}}
@section('title')
Message
@parent
@stop
{{-- page level styles --}}
@section('header_styles')
<link href="{{asset('dropzone/dist/dropzone.css')}}" rel="stylesheet"/>
@stop
{{-- Page content --}}
@section('inner_body')


<div class="right_col" role="main" style="min-height: 3214px;">
    <div class="row">
        <div class="container">
            @if($message = Session::get('success'))
            <div class="alert alert-info alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Success!</strong> {{ $message }}
            </div>
            @endif
            {!! Session::forget('success') !!}
            <br />
            <a href="{{ URL::to('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
            <a href="{{ URL::to('downloadExcel/xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
            <a href="{{ URL::to('downloadExcel/csv') }}"><button class="btn btn-success">Download CSV</button></a>
            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="import_file" />
                <button class="btn btn-primary">Import File</button>
            </form>
        </div>
    </div>
</div>    
@stop
{{-- page level scripts --}}
@section('footer_scripts')
@stop