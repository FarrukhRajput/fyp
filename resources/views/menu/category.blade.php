@extends('layouts.app')


@section('content')

    <h4 class="page-title">Menu Catagories</h4>

<div class="row">
    <div class="col-4">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>

        @elseif(session()->has('alert'))
            <div class="p-2 mb-2 alert alert-danger "> 
                {{ session()->get('alert') }}
                <a class="force-btn" href="{{route('menuCatagory.forceDelete', ['id' => session()->get('id') ])}}">Force Delete</a>
            </div>



        @elseif(session()->has('errors'))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> <?= $error ?></li>
                    @endforeach 
                </ul>
            </div>
        @endif

        <div class="card">
            
            <div class="card-body">

                <div class="card-title d-flex justify-content-between"> 
                    <h5 class="d-inline-block h5">Create Category</h5>
                    @if(@$category->id)
                        <a href="{{route('menuCatagory.index')}}" class="btn btn-theme btn-sm d-inline-block">Create <i class="fas fa-plus"></i> </a>
                    @endif
                </div>

                <form action="{{ route('menuCatagory.store') }}" method="POST">
                   @csrf                        
                    <div class="row">
                        <input type="hidden" value="{{@$category->id}}" name="id" >
                         
                       <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">Title</label>
                                <input name="title" type="text" class="form-control"  placeholder="Title" value="{{@$category->title}}">
                            </div>
                       </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mr-3 w-100">{{  @$category->id ?'Update' : 'Save'}}</button>

                        @if(@$category->id )
                            <a onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$category->title}} &#034; ?')" href="{{route('designation.destroy', [ 'id' => $category ->id ])}}" class="btn btn-danger w-100">
                                Delete
                            </a>

                        @else
                            <button class="btn btn-danger w-100" type="reset">Clear</button>

                        @endif
                        
                    </div>
                </form>

            </div>
        </div>
    </div>

    

    <div class="offset-3 col-5">

        <div class="card">
            <div class="card-body ">
                <div class="card-title py-1"> 
                    <h5>Manage Menu Catagories</h5>
                </div>
                    
                <div class="table-card">
                    <table id="menuCategoryTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Title</th> 
                               
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            @foreach ($categories as $item)    
                                <tr>
                                    
                                    <td class="text-center">{{ucwords($item->title) }}</td>
                                   
                                    <td class="d-flex justify-content-center" >
                                        <a class="btn btn-primary mr-3"
                                            href="{{route('menuCatagory.edit', [ 'id' => $item->id ])}}">
                                            <i class="fas fa-edit"></i>
                                        </a>

 
                                        <a  class="btn btn-danger" href="{{route('menuCatagory.destroy', [ 'id' => $item ->id ])}}"
                                            onclick="return confirm('Are Your Sure You Want To Delete &#034; {{ucwords($item->title)}} &#034; ?')" > 
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
        $('#menuCategoryTable').DataTable();
    </script>
@endsection




@endsection