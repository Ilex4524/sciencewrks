@extends('main')

@section('title', 'Employee | Create')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Add New Employee</h1>
            <hr>
            {!! Form::open(['route' => 'employees.store', 'data-parsley-validate' => '']) !!}
                {{ Form::label('firstname', 'First Name:') }}
                {{ Form::text('firstname', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '100'] ) }}

                {{ Form::label('lastname', 'Last Name:') }}
                {{ Form::text('lastname', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '100'] ) }}

                {{ Form::label('birth_date', 'Birth Date:') }}
                {{ Form::date('birth_date', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '10', 'placeholder' => 'DD/MM/YYYY' ] ) }}

                {{ Form::label('inn', 'Inn:') }}
                {{ Form::text('inn', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '10'] ) }}

                {{ Form::submit('Save Employee', ['class' => 'btn btn-success btn-lg btn-block', 
                                                'style' => 'margin-top: 20px;']) }}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
    {!! Html::script('css/parsley.min.js') !!}
@stop