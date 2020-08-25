
@extends('layouts.app')


@section('content')


<h4 class="page-title">Employees</h4>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success')}}
            </div>

        @endif

    <a href="{{route('employee.create')}}" class="btn btn-theme"><i class="fas fa-plus mr-2"></i>Create Employee</a>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body ">
                    <div class="card-title py-1"> 
                        <h5>Manage Employees</h5>
                    </div>
                        
                
                        <table id="employeeTable" class="display table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">ID </th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Employee Name</th>
                                    <th class="text-center">Cnic</th>
                                    <th class="text-center">Staff Group</th>
                                    <th class="text-center">Designation</th>
                                    <th class="text-center">Salary</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td class="text-center">
                                            {{$employee->id}}
                                        </td>

                                        <td class="text-center">
                                            <img src="{{$employee->image}}" class="avatar-circle">
                                        </td>

                                        <td class="text-center">
                                            {{ ucwords($employee->f_name.' '.$employee->l_name)}}
                                        </td>
                                        <td class="text-center">
                                            {{$employee->cnic}}
                                        </td>
                                        <td class="text-center">
                                            {{$employee->group->title}}
                                        </td>
                                        <td class="text-center">
                                            {{$employee->designation->title}}
                                        </td>
                                        <td class="text-center">
                                            {{$employee->salary}}
                                        </td>
                                        <td class="d-flex justify-content-center text-white " >
                                            <a
                                                href="{{route('employee.edit', ['id' => $employee->id])}}"
                                                class="edit-btn btn btn-primary mr-3">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a
                                                href="{{route('employee.destroy', [ 'id' => $employee->id ])}}" 
                                                onclick="return confirm('Are you sure you want to delete &#034;{{ $employee->f_name.' '. $employee->l_name }}&#034; ?')"  
                                                class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
        
                                        </td>
                                    </tr>   
                                @endforeach
                                
                            
                            </tbody>
                        </table>
                    </div>
                    
        
                </div>
            </div>
        </div>
    </div>

</div>

@section('addJavaScript')
    
<script>

    $('#employeeTable').DataTable();

</script>
@endsection

@endsection