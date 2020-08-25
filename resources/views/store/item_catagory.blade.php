
@extends('layouts.app')

@section('addStyle')
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.css')}}"> 
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.min.css')}}"> 
@endsection

@section('content')

<h4 class="page-title">Item Catagory</h4>

<div class="row">
    <div class="col-4">
       
        @if (session()->has('success')) 
            <div class=" alert alert-success  p-2 mb-2">
                <li>{{ session()->get('success') }}</li>
            </div>

        @elseif(session()->has('alert'))
            <div class="p-2 mb-2 alert alert-danger "> 
                {{ session()->get('alert') }}
                <a class="force-btn" href="{{route('category.forceDelete', ['id' => session()->get('id') ])}}">Force Delete</a>
            </div>     

        @elseif (session()->has('errors'))
            <div class=" alert alert-danger p-2 mb-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>  
        @endif


        <div class="card">
            
            <div class="card-body">

                <div class="card-titl d-flex justify-content-between"> 
                    <h5 class="d-inline-block">New Catagory</h5>
                    @if(@$category->id)
                        <a href="{{route('category.index')}}" class="btn btn-theme d-inline-block">Create <i class="fas fa-plus"></i> </a>
                    @endif
                </div>

                <form action="{{route('category.store')}}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{@$category->id}}">

                    <div class="form-group">
                        <label for="" class="form-label">Catagory Title</label>
                        <input name="title" type="text" class="form-control" value="{{ucwords(@$category->title)}}" placeholder="Catagory..">
                    </div>


                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-3">{{@$category->id ?  'Update': 'Save' }}</button>
                        @if(@$category->id)
                            <a onclick="return confirm('Are you sure you Delete &#034; {{ ucwords($category->title)}} &#034; category ?')" 
                                href="{{route('category.delete' ,['vendor' => $category->id] )}}" class="btn btn-danger">Delete</a>
                        
                        @else
                          <button type="reset" class="btn btn-danger">Clear</button>
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
                    <h5>Manage Catagories</h5>
                </div>
                    
                
                    <table id="table" class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center"># </th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            @foreach ($categories as $category)    
                            <tr>
                                <th class="text-center">{{ $category->id }}</th>
                                <td class="text-center">{{ ucwords($category ->title) }}</td>
                             
                            
                                    <td class="d-flex justify-content-center" >
                                        
                                        <a href="{{ route('category.edit' , ['id' => $category->id])}}" class="btn btn-primary mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you Delete &#034; {{ ucwords($category->title)}} &#034; category ?')" 
                                            href="{{route('category.delete' ,['vendor' => $category->id] )}}" class="btn btn-danger">
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


@section('addJavaScript')
<script src="{{asset('js/dataTable/dataTable.min.js')}}"></script>
    
<script>

    $('#table').DataTable({
        paging:true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });

</script>
@endsection

@endsection