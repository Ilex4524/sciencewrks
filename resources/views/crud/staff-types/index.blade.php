@extends('main')

@section('title', 'Staff Types | All')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>All Staff Types</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('staff-types.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">New Staff Type</a>
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
                    <th>Type Name</th>                    
                    <th>Created At</th>
                    <th></th>
                </thead>

                <tbody>

                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>                                                     
                            <td>{{ date('M j, Y', strtotime($type->created_at)) }}</td>
                            <td><a href="{{ route('staff-types.show', $type->id) }}" class="btn btn-default btn-sm">View</a>
                            <a href="{{ route('staff-types.edit', $type->id) }}" class="btn btn-default btn-sm">Edit</a></td>                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@stop