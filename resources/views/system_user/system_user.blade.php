@extends('layouts.app')


@section('content')

<h4 class="page-title">System Users</h4>
  
<div class="row">
    <div class="col-4">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif

        <div class="card">
            
            <div class="card-body">

                <div class="card-title d-flex justify-content-between"> 
                    <h5 class="d-inline-block h5">Create Category</h5>
                </div>

                <form action="{{ route('system_users.store') }}" method="POST">
                    
                   @csrf                        
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-contol-label">Employees</label>
                                <select name="employee_id" class="form-control" required>
                                    <option value="0" disabled selected >None</option>
                                        @foreach ($users as $user)   
                                            <option value="{{$user->id}}" >{{ ucwords($user->f_name.' '.$user->l_name)}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-contol-label">Account Role</label>
                                <select name="role_id" class="form-control" required>
                                    <option value="0" disabled selected >None</option>
                                        @foreach ($roles as $role)  
                                            @if ($role->id != 1)
                                                <option value="{{$role->id}}" >{{ ucwords($role->title)}}</option>
                                            @endif 
                                           
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-contol-label">Allow Access</label>
                                <select name="allow_access" class="form-control" required>
                                    <option  disabled selected >None</option>
                                   
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                       
                                </select>
                            </div>
                        </div>
                         
                       <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">Password</label>
                                <input name="password" type="password" class="form-control" required placeholder="password">
                            </div>
                       </div>

                       <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">Re-Password</label>
                                <input name="password_confirmation" type="password" class="form-control" required placeholder="re-password">
                            </div>
                       </div>

                       
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mr-3 w-100">Create</button>
                        <button class="btn btn-danger w-100">Clear</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="offset-2 col-6">
        <div class="card">
            <div class="card-body ">
                <div class="card-title py-2"> 
                    <h5>Manage System Users</h5>
                </div>
                    
                <div class="table-card">
                    <table id="designationTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center"># </th>
                                <th class="text-center">Employee</th> 
                                <th class="text-center">Roll</th> 
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            {{-- @foreach ($designations as $item)    
                            <tr>
                                <th class="text-center">{{ $item->id }}</th>
                                <td class="text-center">{{ ucwords( $item->title) }}</td>
                                <td class="text-center">
                                        {{ ucwords($item->group->title) }}
                                </td>
                                <td class="d-flex justify-content-center" >
                                    <a href="{{route('designation.show', [ 'id' => $item ->id ])}}" class="btn btn-primary mr-3">
                                       <i class="fas fa-edit"></i>
                                    </a>
                                    <a 
                                        onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$item->title}} &#034; ?')" 
                                        href="{{route('designation.destroy', [ 'id' => $item ->id ])}}" 
                                        class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
                </div>
    
            </div>
        </div>
    </div>


    @endsection