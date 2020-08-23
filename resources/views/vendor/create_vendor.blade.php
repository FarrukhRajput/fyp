
@extends('layouts.app')

@section('content')



<h4 class="page-title">Vendors</h4>
<a href="{{route('vendor.index')}}" class="btn btn-theme mb-3"><i class="fas fa-arrow-left"></i> All Purchase</a>


<div class="row">   
    <div class="col-5">
        @if(session()->has('success'))
            <div class="p-2 mb-2 alert alert-success "> 
                {{ session()->get('success') }}
            </div>

        @elseif(session()->has('alert'))
            <div class="p-2 mb-2 alert alert-danger "> 
                {{ session()->get('alert') }}
                <a class="force-btn" href="{{route('vendor.forceDelete', ['id' => session()->get('id') ])}}">Force Delete</a>
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
            <input type="hidden" name="id" value="{{@$vendor->id}}">
            
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
                        <input required name="cnic" type="text" class="form-control" pattern="^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$" placeholder="XXXXX-XXXXXXX-X" value="{{@$vendor->cnic}}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="" class="form-label">Phone</label>
                        <input  name="phone" pattern="^[0-9+]{4}-[0-9+]{7}$"   type="text" class="form-control" placeholder="03xx-xxxxxx" value="{{@$vendor->phone}}" required>
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

