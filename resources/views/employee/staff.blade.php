
@extends('layouts.app')

@section('content')

    <h4 class="page-title">Staff Group</h4>

<div class="row">
    <div class="col-4">


        @if(session()->has('message'))
            <div class="p-2 mb-2 message "> 
                {{ session()->get('message') }}
            </div>
        @endif



        @if(session()->has('alert'))
            <div class="p-2 mb-2 bg-danger text-white "> 
                <p class="d-inline">{{ session()->get('alert') }}</p> 
            </div>
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
                        {{-- <div class="col-3">
                            <div class="form-group">
                                <label for="" class="form-contol-label">Staff ID</label>
                                <input type="text" class="form-control" value="{{ @$group->id}}" disabled>
                            </div>
                        </div> --}}
                        <div class="col-12">
                            <label for="" class="form-contol-label">Title</label>
                            <input name="title" value="{{@$group->title}}" type="text" class="form-control" placeholder="Staff Group">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                
                        <button class="btn btn-primary mr-3 w-100" type="submit">{{@$group->id? 'Update' : 'Create'}}</button>
                        @if(@$group->id)
                            <a  href="{{route('staff.destroy' , [ 'group' => $group->id])}}"  onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$group->title}} &#034; ?')"  class="btn btn-danger w-100">
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
                    <h5>All Staff Groups</h5>
                </div>
                    
                <div class="table-card">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center"># </th>
                                <th class="text-center">Staff Group Title</th> 
                                <th class="text-center">Action</th> 
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($groups as $item)
                                <tr>
                                    <td class="text-center">{{$item->id}}</td>
                                    <td class="text-center">{{$item->title}}</td>
                                    <td class="d-flex justify-content-center" >

                                        
                                        <a href="{{route('staff.show' , ['group' => $item->id])}}" class="btn btn-primary mr-3">
                                           <i class="fas fa-edit"></i>
                                        </a>


                                        <a href="{{route('staff.destroy' , [ 'group' => $item->id])}}" onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$item->title}} &#034; ?')"  class="btn btn-danger">
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


@endsection

