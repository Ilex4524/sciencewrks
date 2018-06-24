@extends('main')

@section('title', 'Researches | All')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>All Researches</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('researches.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">New Research</a>
        </div>

        <div class="col-md-12">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Research Name</th>  
                    <th>Research Size</th>                  
                    <th>Published At</th>
                    <th></th>
                </thead>

                <tbody>

                    @foreach ($researches as $research)
                        <tr>
                            <td>{{ $research->id }}</td>
                            <td>{{ $research->name }}</td>   
                            <td>{{ $research->size }}</td>                                                     
                            <td>{{ date('M j, Y', strtotime($research->published_at)) }}</td>
                            <td><a href="{{ route('researches.show', $research->id) }}" class="btn btn-default btn-sm">View</a>
                            <a href="#" class="btn btn-default btn-sm">Edit</a></td>                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@stop