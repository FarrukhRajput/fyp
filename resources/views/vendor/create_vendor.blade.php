
@extends('layouts.app')

@section('content')



<a href="{{route('vendor.index')}}" class="btn btn-theme mb-3">All Purchase</a>


<div class="row">   
    <div class="col-5">
        @if(session()->has('success'))
            <div class="p-2 mb-2 message "> 
                {{ session()->get('success') }}
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

        <div class="card-title "> 
            <h5 class="page-title">Create Vendor</h5>
        </div>

        <form action="{{route('vendor.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="vendor_id" value="{{@$vendor->id}}">
            
            <div class="form-group">
                <label for="" class="form-label">Company Name</label>
                <input required name="company_name" type="text" class="form-control" placeholder="Company Name" value="{{@$vendor->company_name}}">
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="form-label">First Name</label>
                        <input required name="f_name" type="text" class="form-control" placeholder="First Name" value="{{@$vendor->f_name}}">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="form-label">Last Name</label>
                        <input required name="l_name" type="text" class="form-control" placeholder="Last Name" value="{{@$vendor->l_name}}">
                    </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="form-label">Cnic</label>
                        <input required name="cnic" type="text" class="form-control" placeholder="XXXXX-XXXXXXX-X" value="{{@$vendor->cnic}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="form-label">Phone</label>
                        <input required name="phone" type="text" class="form-control" placeholder="Phone #" value="{{@$vendor->phone}}">
                    </div>
                </div>
            </div>

        
            <div class="form-group d-flex ">
                <button type="submit" class="btn btn-primary mr-3  w-100" >{{@$vendor->id? 'Update' : 'Create'}}</button>
                @if(@$vendor->id)
                    <a  href="{{route('vendor.delete', [ 'vendor' => $vendor->id ])}}" 
                        onclick="return confirm('Are you sure you want to delete &#034;{{$vendor->title}}&#034; ?')"  
                        class="btn btn-danger text-white d-block w-100">
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
</div>


@endsection

