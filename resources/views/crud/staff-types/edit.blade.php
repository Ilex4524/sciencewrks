@extends('main')

@section('title', 'Staff Type | Edit')

@section('content')
       <div class="row">
            {!! Form::model($type, ['route' => ['staff-types.update', $type->id], 'method' => 'PUT']) !!}
            <div class="col-md-8">  
                {{ Form::label('name', 'Name:') }}          
                {{ Form::text('name', null, ['class' => 'form-control']) }}                                                          
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
                            {!! Html::linkRoute('staff-types.show', 'Cancel', array($type->id), array('class' => 'btn btn-danger btn-block')) !!}                       
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
