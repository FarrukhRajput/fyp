@extends('layouts.app')


@section('content')

    <h4 class="page-title">Menu Catagories</h4>
    <a class="btn btn-primary mb-3" href="{{ route('menuCatagory.index') }}"> All Categories</a>

<div class="row">
    <div class="col-4">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{session()->get('message')}}
            </div>
        @endif

        <div class="card">
            
            <div class="card-body">

                <div class="card-title d-flex justify-content-between"> 
                    <h5 class="d-inline-block h5">Create Category</h5>
                </div>

                <form action="{{ route('menuCatagory.store') }}" method="POST">
                    
                   @csrf                        
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-contol-label">Parent Catagory</label>
                                <select name="parent_category_id" class="form-control" required>
                                    <option value="0" disabled selected >None</option>
                                        @foreach ($categories as $item)   
                                            <option value="{{$item->id}}"  {{$item->id === @$category->parent_category_id ? 'selected': ''  }} >{{$item->title}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                         
                       <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">Title</label>
                                <input name="title" type="text" class="form-control" required placeholder="Designation">
                            </div>
                       </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mr-3 w-100">Create</button>
                        <button class="btn btn-danger w-100">Clear</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    @endsection