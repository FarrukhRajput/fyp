
@extends('layouts.app')

@section('addStyle')
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.css')}}"> 
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.min.css')}}"> 
@endsection

@section('content')
<h4 class="page-title">Store Items</h4>

<a href="{{route('rawItem.index')}}" class="btn btn-theme mb-3">Create Store Item</a>

<div class="row">
     <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <div class="card-title py-2"> 
                    <h5> Manage Store Items</h5>
                </div>
                    
                <div class="table-card">
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th >Title</th>
                                <th class="text-center">Catagory</th>
                                <th class="text-center">Reorder Level</th>
                                <th class="text-center">Reorder Qty</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($rawItems as $item)
                                <tr>
                                    <td >{{ ucwords($item->title)}}</td>
                                    <td class="text-center">{{ ucwords($item->catagory->title)}}</td>
                                    <td class="text-center">{{$item->reorder_level}}</td>
                                    <td class="text-center">{{$item->reorder_qty}}</td>
                                    <td class="d-flex justify-content-center text-white" >
                                        <a href="{{route('rawItem.edit',$item->id)}}"class="btn btn-primary  mr-3">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a  href="{{route('rawItem.destroy',['rawitem' => $item->id])}}"
                                            onclick="return confirm('Are you sure you want to delete &#034;{{ ucwords($item->title) }}&#034; ?')"  
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
<script src="{{asset('js/dataTable/dataTable.min.js')}}"></script>

<script>

$('#table').DataTable();

</script>
@endsection

@endsection