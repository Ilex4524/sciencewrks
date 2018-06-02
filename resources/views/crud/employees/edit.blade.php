@extends('main')

@section('title', 'Employee | Edit')

@section('content')
       <div class="row">
            {!! Form::model($employee, ['route' => ['employees.update', $employee->id], 'method' => 'PUT']) !!}
            <div class="col-md-8">  
                {{ Form::label('firstname', 'First Name:') }}          
                {{ Form::text('firstname', null, ['class' => 'form-control']) }}

                {{ Form::label('lastname', 'Last Name:') }}
                {{ Form::text('lastname', null, ['class' => 'form-control']) }}

                {{ Form::label('birth_date', 'Birth Date:') }}
                {{ Form::text('birth_date', null, ['class' => 'form-control']) }}

                {{ Form::label('inn', 'Inn:') }}
                {{ Form::text('inn', null, ['class' => 'form-control']) }}                                                            
            </div>
            <div class="col-md-4">
                <div class="well">
                    <dl class="dl-horizontal">
                        <dt>Created At:</dt>
                        <dd>{{ date('M j Y H:i' , strtotime($employee->created_at)) }}</dd>
                    </dl>

                    <dl class="dl-horizontal">
                        <dt>Last Updated:</dt>
                        <dd>{{ date('M j Y H:i', strtotime($employee->updated_at)) }}</dd>
                    </dl>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Html::linkRoute('employees.show', 'Cancel', array($employee->id), array('class' => 'btn btn-danger btn-block')) !!}                       
                        </div>
                        <div class="col-sm-6">
                            {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}                            
                        </div>
                    </div>
                </div>
            </div>  
            {!! Form::close() !!}     
        </div>
@stop
