
@extends('layouts.app')



@section('content')@section('addStyle')
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.css')}}"> 
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.min.css')}}"> 
@endsection

<h4 class="page-title">Vendors</h4>

@if(session()->has('success'))
        <div class="p-2 mb-2 message "> 
    {{ session()->get('success') }}

    </div>
@endif

<a href="{{route('vendor.create')}}" class="btn btn-theme mb-3">New Vendor   </a>
<div class="row">

     <div class="col-12">
        <div class="card">
            <div class="card-body ">
                <div class="card-title py-2"> 
                    <h5>Manage Vendors</h5>
                </div>
                    
                <div class="table-card">
                    <table id="vendorTable" class="table table-bordered">
                        <thead>
                            <tr>
                              
                                <th class="text-center">Vendor Name</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Cnic</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($vendors as $vendor)
                            <tr>
                                {{-- <td class="text-center">{{$vendor->id}}</td> --}}
                                <td class="text-center">{{ ucwords($vendor->f_name.' '.$vendor->l_name)}}</td>
                                <td class="text-center">{{$vendor->company_name}}</td>
                                <td class="text-center">{{$vendor->phone}}</td>
                                <td class="text-center">{{$vendor->cnic}}</td>
                                <td class="d-flex justify-content-center text-white " >
                                    <a href="{{route('vendor.edit', ['vendor' =>$vendor->id])}}" class="edit-btn btn btn-primary mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('vendor.delete', [ 'vendor' => $vendor->id ])}}" 
                                        onclick="return confirm('Are you sure you want to delete &#034;{{ ucwords($vendor->f_name.' '.$vendor->l_name)}}&#034; ?')"  
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



@section('addJavaScript')

<script>

    $('#vendorTable').DataTable();

</script>
@endsection
@endsection





