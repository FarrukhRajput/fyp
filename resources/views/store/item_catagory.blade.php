
@extends('layouts.app')

@section('addStyle')
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.css')}}"> 
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.min.css')}}"> 
@endsection

@section('content')

<h4 class="page-title">Item Catagory</h4>




<div class="row">
    <div class="col-4">
        @if (session()->has('errors'))
            <div class=" alert alert-danger  p-2 mb-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>  
            
        @elseif (session()->has('success')) 
            <div class=" alert alert-success  p-2 mb-2">
               
                <li>{{ session()->get('success') }}</li>
               
            </div>     

        @endif


        <div class="card">
            
            <div class="card-body">

                <div class="card-titl d-flex justify-content-between"> 
                    <h5 class="d-inline-block">New Catagory</h5>
                    @if(@$catagory->id)
                        <a href="{{route('catagory.index')}}" class="btn btn-theme d-inline-block">Create <i class="fas fa-plus"></i> </a>
                    @endif
                </div>

                <form action="{{route('catagory.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="catagory_id" value="{{@$catagory->id}}">

                    <div class="form-group">
                        <label for="" class="form-label">Catagory Title</label>
                        <input name="title" type="text" class="form-control" value="{{@$catagory->title}}" placeholder="Catagory..">
                    </div>

                    <div class="form-group">
                        <label for="parentCatagory">Choose Parent Catagory</label>
                        <select name="parent_id" class="form-control" id="parentCatagory">
                       
                            @foreach($items as $item)
                                <option value="{{$item->id}}" {{@$catagory->parent->id==$item->id?'selected':''}}>{{ucwords($item->title)}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-3">{{@$catagory->id ?  'Update': 'Create' }}</button>
                        @if(@$catagory->id)
                            <a onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$catagory->title}} &#034; ?')" href="{{route('catagory.delete' ,['vendor' => $catagory->id] )}}" class="btn btn-danger">Delete</a>
                        @else
                          <button type="reset" class="btn btn-danger">Clear</button>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    </div>

     <div class="offset-1 col-7">
        <div class="card">
            <div class="card-body ">
                <div class="card-title "> 
                    <h5>All Catagories</h5>
                </div>
                    
                
                    <table id="table" class="table table-stripped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center"># </th>
                                <th class="text-center">Catagory Name</th>
                                <th class="text-center">Parent Catagory</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            @foreach ($items as $catagory)    
                            <tr>
                                <th class="text-center">{{ $catagory ->id }}</th>
                                <td class="text-center">{{ ucwords($catagory ->title) }}</td>
                                <td class="text-center">
                                    @if(!$catagory->parent)
                                      -
                                    @else
                                        {{ ucwords($catagory->parent->title) }}
                                    @endif    
                                </td>
                                @if ($catagory->id != 1 )
                                    <td class="d-flex justify-content-center" >
                                        <a href="{{route('catagory.edit', [ 'catagory' => $catagory ->id ])}}" class="btn btn-primary mr-3">
                                        <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('Are Your Sure You Want To Delete &#034; {{ ucwords($catagory->title)}} &#034; ?')" href="{{route('catagory.delete', [ 'catagory' => $catagory -> id ])}}" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                
                                @else
                                    <td class="d-flex justify-content-center" >
                                        <a onclick="return confirm('Cannot Edit &#034; {{ ucwords($catagory->title)}} &#034; ?')" href="#" class="btn btn-primary mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a onclick="return confirm('Cannot Delete &#034; {{ ucwords($catagory->title)}} &#034; ?')" href="#" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                @endif
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