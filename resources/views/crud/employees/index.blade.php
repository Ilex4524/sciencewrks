@extends('main')

@section('title', 'Employees | All')

@section('content')

    <div class="row">
        <div class="col-md-10">
            <h1>All Employees</h1>
        </div>

        <div class="col-md-2">
            <a href="{{ route('employees.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing">New Employee</a>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Birth Date</th>
                    <th>Inn</th>
                    <th>Created At</th>
                    <th></th>
                </thead>

                <tbody>

                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->firstname }}</td>
                            <td>{{ $employee->lastname }}</td>
                            <td>{{ $employee->birth_date }}</td>
                            <td>{{ $employee->inn }}</td>                           
                            <td>{{ date('M j, Y', strtotime($employee->created_at)) }}</td>
                            <td><a href="{{ route('employees.show', $employee->id) }}" class="btn btn-default btn-sm">View</a>
                            <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-default btn-sm">Edit</a></td>                            
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@stop