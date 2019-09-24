@extends('layouts.app')

@section('content')
    <h2>Test Page</h2>
    <div class="row">
        <div class="col-lg-8">Empleados</div>
        <table class="table-striped">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }} {{ $employee->last_name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            {!! Form::model($employee, ['method' => 'POST', 'action' => ['EmployeeController@destroy', $employee->id],  'files' => true])  !!}
												@method('DELETE')
								<input type="submit" class="btn btn-danger btn-sm" value="Eliminar" onclick="return confirm('Está seguro de eliminar al usuario {{ $employee->name }} {{ $employee->last_name }}? ')">
							{!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection