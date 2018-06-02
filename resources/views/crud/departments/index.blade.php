@extends('main')

@section('title', 'Departments | All')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>All Departments</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('departments.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">New Department</a>
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
                    <th>Department Name</th>                    
                    <th>Created At</th>
                    <th></th>
                </thead>

                <tbody>

                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>{{ $department->name }}</td>                                                     
                            <td>{{ date('M j, Y', strtotime($department->created_at)) }}</td>
                            <td><a href="{{ route('departments.show', $department->id) }}" class="btn btn-default btn-sm">View</a>
                            <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-default btn-sm">Edit</a></td>                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@stop