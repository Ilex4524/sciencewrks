@extends('main')

@section('title', 'Research | Create')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Add New Research</h1>
            <hr>
            {!! Form::open(['route' => 'researches.store', 'data-parsley-validate' => '', 'files' => true]) !!}

            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name', null, ['class' => 'form-control'] ) }}            

            {!! Form::label('authors', 'Authors') !!}
            {{ Form::select('authors[]', $authors, null, ['multiple' => true, 'class' => 'form-control']) }}  

            {{ Form::label('size', 'Size:') }}
            {{ Form::number('size', null, ['class' => 'form-control'] ) }}

            {{ Form::label('published_at', 'Published At:') }}
            {{ Form::date('published_at', null, ['class' => 'form-control'] ) }}

            <div class = 'checkbx'>
                {{ Form::label('is_scopus', 'Is Scopus:') }}
                {{ Form::checkbox('is_scopus', true) }}
            </div>

            <div class = 'checkbx'>
                {{ Form::label('is_vak', 'Is Vak:') }}
                {{ Form::checkbox('is_vak', true) }}
            </div>

            <div class = 'checkbx'>
                {{ Form::label('is_abroad', 'Is Abroad:') }}
                {{ Form::checkbox('is_abroad', true) }}
            </div>

            {{ Form::label('file', 'Upload research:') }}
            {{ Form::file('file') }}
           
            {{ Form::submit('Save Research', ['class' => 'btn btn-success btn-lg btn-block', 
                                            'style' => 'margin-top: 20px;']) }}
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('scripts')
    {!! Html::script('css/parsley.min.js') !!}
@stop