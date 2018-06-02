@extends('main')

@section('title', 'Employee | View')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h3>First Name: {{ $employee->firstname }} </h3>
            <h3>Last Name: {{ $employee->lastname }} </h3>
            <h3>Birth Date: {{ date('d.m.Y', strtotime($employee->birth_date)) }} </h3>
            <h3>Inn: {{ $employee->inn }} </h3>
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
                        {!! Html::linkRoute('employees.edit', 'Edit', array($employee->id), array('class' => 'btn btn-primary btn-block')) !!}                       
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'DELETE']) !!}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Html::linkRoute('employees.index', '<< See All Employees', [], 
                            ['class' => 'btn btn-h1-spacing btn-default btn-block']) !!}
                    </div>
                </div>
            </div>
        </div>       
    </div>

@stop