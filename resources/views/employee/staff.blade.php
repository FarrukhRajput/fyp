
@extends('layouts.app')

@section('content')

    <h4 class="page-title">Staff Groups</h4>

<div class="row">
    <div class="col-4">


        @if(session()->has('success'))
            <div class="p-2 mb-2 alert alert-success "> 
                {{ session()->get('success') }}
            </div>


        @elseif(session()->has('alert'))
            <div class="p-2 mb-2 alert alert-danger "> 
                {{ session()->get('alert') }}
                <a class="force-btn" href="{{route('staff.forceDelete', ['id' => session()->get('id') ])}}">Force Delete</a>
            </div>


        @elseif(session()->has('errors'))
            <ul>
                @foreach ($errors as $error)
                    <li>{{session()->get('error')}}</li>     
                @endforeach
            </ul>
        @endif

       

        <div class="card">
            
            <div class="card-body">

                <div class="card-title d-flex justify-content-between"> 
                    <h5 class="d-inline-block">{{@$group->id ? 'Edit ' : 'New '}}Staff Group</h5>

                    @if(@$group->id)

                        @if(session()->has('alert'))
                            <div>
                                <a href="{{route('staff.index')}}" class="btn btn-sm btn-theme d-inline-block">Create <i class="fas fa-plus"></i> </a>
                                <a href="{{route('staff.forceDelete', ['group' => $group->id ] )}}" class="btn btn-sm btn-info d-inline-block text-white ">Force Delete</a>
                            </div>
                            @else
                            <a href="{{route('staff.index')}}" class="btn btn-theme d-inline-block">Create <i class="fas fa-plus"></i> </a>
                        @endif
                    @endif
                </div>

                <form action="{{route('staff.store')}}" method="post">
                    @csrf
                    <input name="id" type="hidden" value="{{@$group->id}}">

                    <div class="row">
                        <div class="col-12">
                            <label for="" class="form-contol-label">Title</label>
                            <input name="title" value="{{ucwords(@$group->title)}}" type="text" class="form-control" placeholder="Staff Group" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                
                        <button class="btn btn-primary mr-3 w-100" type="submit">{{@$group->id? 'Update' : 'Save    '}}</button>
                                
                        @if(@$group->id)
                            <a href="{{route('staff.destroy' , [ 'group' => $group->id])}}"  onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$group->title}} &#034; ?')"  class="btn btn-danger w-100">
                                Delete
                            </a>
                            @else 
                            <button type="reset" class="btn btn-danger w-100">Clear</button>
                        @endif
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

     <div class="offset-3 col-5">
        <div class="card">
            <div class="card-body ">
                <div class="card-title "> 
                    <h5>Manage Staff Groups</h5>
                </div>
                    
                <div class="table-card">
                    <table class="table table-bordered" id="staff_group_table">
                        <thead>
                            <tr>
                                <th class="text-center"># </th>
                                <th class="text-center">Title</th> 
                                <th class="text-center">Action</th> 
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($groups as $item)
                                <tr>
                                    <td class="text-center">{{$item->id}}</td>
                                    <td class="text-center">{{ ucwords($item->title)}}</td>
                                    <td class="d-flex justify-content-center" >


                                        @if ($item->id == 1)
                                             
                                            <button class="btn btn-primary mr-3" onclick="return confirm('cannot Edit &#034; {{$item->title}} &#034; ?')" >
                                                <i class="fas fa-edit"></i>
                                            </a>
    
                                            <button onclick="return confirm('cannot Delete &#034; {{$item->title}} &#034; ?')"  class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                       
                                            @else
                                            <a href="{{route('staff.edit' , ['group' => $item->id])}}" class="btn btn-primary mr-3">
                                                <i class="fas fa-edit"></i>
                                             </a>
     
                                             <a href="{{route('staff.destroy' , [ 'group' => $item->id])}}" onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$item->title}} &#034; ?')"  class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                             </a>
                                       
                                        @endif

                                        
                                      


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
<script src="{{asset('js/dataTable/dataTable.min.js')}}"></script>
    
<script>

    $('#staff_group_table').DataTable({
        paging:true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });

</script>
@endsection
@endsection

