@extends('main')

@section('title', 'Staff Type | Create')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Add New Staff Type</h1>
            <hr>
            {!! Form::open(['route' => 'staff-types.store', 'data-parsley-validate' => '']) !!}
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '100'] ) }}

                {{ Form::submit('Save Staff Type', ['class' => 'btn btn-success btn-lg btn-block', 
                                                'style' => 'margin-top: 20px;']) }}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
    {!! Html::script('css/parsley.min.js') !!}
@stop