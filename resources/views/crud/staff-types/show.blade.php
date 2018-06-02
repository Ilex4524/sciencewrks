@extends('main')

@section('title', 'Staff Type | View')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h3>Name: {{ $type->name }} </h3>           
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd>{{ date('M j Y H:i' , strtotime($type->created_at)) }}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd>{{ date('M j Y H:i', strtotime($type->updated_at)) }}</dd>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('staff-types.edit', 'Edit', array($type->id), array('class' => 'btn btn-primary btn-block')) !!}                       
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['staff-types.destroy', $type->id], 'method' => 'DELETE']) !!}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {!! Html::linkRoute('staff-types.index', '<< See All Staff Types', [], 
                            ['class' => 'btn btn-h1-spacing btn-default btn-block']) !!}
                    </div>
                </div>
            </div>
        </div>       
    </div>

@stop