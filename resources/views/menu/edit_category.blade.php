@extends('layouts.app')


@section('content')

    <h4 class="page-title">Menu Catagories</h4>

<div class="row">
    <div class="col-4">

        @if(session()->has('error'))
            <div class="card bg-danger text-white p-2 mb-2">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="card-title py-2 d-flex justify-content-between"> 
                    <h5 class="d-inline-block h5">Edit Category</h5>
                        <form method="POST" action="{{route('menuCatagory.destroy', [ 'id' => $category ->id ])}}">
                            {{ method_field('DELETE')}}
                            {{ csrf_field()}}
                       
                            <button  class="btn btn-danger d-inline-block" href="{{ route('menuCatagory.index') }}" >
                                <i class="fas fa-trash-alt"></i> 
                            </button>
                        </form>
                </div>

                <form  method="post" action="{{ route('menuCatagory.update' , [ 'id' => $category->id ]) }}">
                    
                    @csrf

                    <div class="row">
                    
                        <div class="col-3"> 
                            <div class="form-group">
                                <label for="" class="form-contol-label">Desg ID</label>
                                <input type="text" class="form-control" disabled value="{{@$category->id}}">
                             </div> 
                         </div>                         
                         
                         <div class="col-9"> 
                            <div class="form-group">
                                <label for="" class="form-contol-label">Parent Catagory</label>
                                <select name="parent_category_id" class="form-control" required>
                                    <option value="0">None</option>
                                        @foreach ($categories as $item)   
                                            <option value="{{$item->id}}"  {{ $item->id === @$category->parent_category_id ? 'selected': ''  }} >{{$item->title}}</option>
                                        @endforeach 
                                </select>

                            </div> 
                        </div>

                       <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">Title</label>
                                <input  class="form-control" name="title"  value="{{ $category->title }}" type="text"  placeholder="Designation"  required >
                            </div>
                       </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mr-3 w-100">Update</button>
                        <a  href="{{ route('menuCatagory.index') }}" class="btn btn-theme w-100">Cancel</a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>


    @endsection