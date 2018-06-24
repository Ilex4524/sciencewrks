@extends('main')

@section('title', 'Research | View')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h5> Name: {{ $research->name }} </h5>
            <h5> Authors: </h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Department</th>                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $author->firstname }}</td>
                            <td>{{ $author->lastname }}</td>   
                            <td>{{ $author->department }}</td>                                       
                        </tr>
                    @endforeach                  
                </tbody>
            </table>  
            <h5> Published At: {{ date('M j Y H:i' , strtotime($research->published_at)) }} </h5>
            <h5> Size: {{ $research->size }} pages </h5>
            <div class="row">
                <div class="col-md-12">
                    {!! Html::linkRoute('researches.download', '<< Download .docx >>', array($research->id), 
                        ['class' => 'btn btn-h1-spacing btn-default btn-block']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                    <dt>Created At:</dt>
                    <dd>{{ date('M j Y H:i' , strtotime($research->created_at)) }}</dd>
                </dl>

                <dl class="dl-horizontal">
                    <dt>Last Updated:</dt>
                    <dd>{{ date('M j Y H:i', strtotime($research->updated_at)) }}</dd>
                </dl>
                <hr>
                {{-- <div class="row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('departments.edit', 'Edit', array($department->id), array('class' => 'btn btn-primary btn-block')) !!}                       
                    </div>
                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['departments.destroy', $department->id], 'method' => 'DELETE']) !!}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}
                        {!! Form::close() !!}
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-12">
                        {!! Html::linkRoute('researches.index', '<< See All Researches', [], 
                            ['class' => 'btn btn-h1-spacing btn-default btn-block']) !!}
                    </div>
                </div>
            </div>
        </div>       
    </div>

@stop