
@extends('layouts.app')

@section('content')

<h4 class="page-title">{{$title}}</h4>

<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="" class="form-label">Catagory Title</label>
                    <input type="text" class="form-control" placeholder="Catagory..">
                </div>

                <div class="form-group">
                    <label for="parentCatagory">Choose Parent Catagory</label>
                    <select class="form-control" id="parentCatagory">
                        <option>Choose</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

                <div class="form-group d-flex justify-content-end">
                    <a href="" class="btn btn-primary mr-3">Save</a>
                    <a href="{{route('item-catagory')}}" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection