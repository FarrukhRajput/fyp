@extends('layouts.app')


@section('content')

    <h4 class="page-title">Products</h4>
    <a class="btn btn-theme mb-3 " href="{{ route('products.all') }}" > <i class="fas fa-arrow-left"></i> All Products</a>

<div class="row">
    <div class="col-4">
        @if(session()->has('errors'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> <?= $error ?></li>
                @endforeach 
            </ul>
        </div>

        @elseif(session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        @endif

        <div class="card">
            
            <div class="card-body">

                <div class="card-title d-flex justify-content-between"> 
                    <h5 class="d-inline-block h5">Menu Product</h5>
                </div>

                <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{@$product->id}}">
                          
                    <div class="row">

                        <div class="col-12 mb-5 justify-content-center d-flex">
                            <div class="avatar-upload">
                                <div class="avatar-edit">
                                    <input name="image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                    <label class="fa" for="imageUpload"></label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview" style="background-image: url({{ @$product->image ? asset(@$product->image) :  asset('images/product-image.jpg')}});">
                                    </div>
                                </div>
                            </div>

                        </div>

                    
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">Title</label>
                                <input name="title" type="text" class="form-control" required placeholder="Title" value="{{@$product->title}}">
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-contol-label">Menu Catagory</label>
                                <select name="menu_category_id" class="form-control" required>
                                    <option  disabled selected>None</option>
                                    
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}"  {{@$product->menu_category_id == $item->id ? 'selected': ''  }} >{{ucwords($item->title) }}</option>
                                    @endforeach
                                        
                                </select>
                            </div>
                        </div>

                       <div class="col-9">
                            <div class="form-group">
                                <label for="" class="form-control-label">Price</label>
                                <input name="price" type="number" class="form-control" min="1" required placeholder="Price" value="{{@$product->price}}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
          
                                <label for="" class="form-control-label  d-block">IsActive</label>
                                    <label class="switch" for="status">
                                        <input name="is_active" id="status" type="checkbox" {{@$product->is_active === 1 ? 'checked' :''}}> 
                                        <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                        
                    </div>

                    <div class="d-flex justify-content-center">
                        
                        <button type="submit" class="btn btn-primary mr-3 w-100">{{ @$product->id ?'Update' : 'Create'}}</button>
                        
                        
                        @if(@$product->id )
                            <a onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$product->title}} &#034; ?')" href="{{route('products.destroy', [ 'id' => $product ->id ])}}" class="btn btn-danger w-100">
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
    


@section('addJavaScript')
    
<script>

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    $(document).ready(
        
        () => {
            $("#group").change(
                () => {
                    var $id = $("#group option:selected").val();
                    var $designation = $("#designation");
                    $designation.removeAttr('disabled');
                   
                    $.ajax(
                        {
                            type: 'GET',
                            url:'/staff-group/getDesignation/'+$id,
                            dataType: 'json',
                            success: function(designations){

                                $designation.empty(); 
                                $.each(designations , function ( i , designation){
                                    $designation.append("<option value="+designation.id+">"+designation.title+"</option>");
                                });
                            }
                        }
                    )
                }
            );

            $("#imageUpload").change(function() {
                readURL(this);
            });

        }
    )

</script>

@endsection


    @endsection