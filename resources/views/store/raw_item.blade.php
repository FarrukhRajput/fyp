
@extends('layouts.app')

@section('content')

<h4 class="page-title">Store Items</h4>

<a href="{{route('rawItem.all')}}" class="btn btn-theme mb-3"> <i class="fas fa-arrow-left"></i> All Raw Items</a>

<div class="row">
   
    <div class="col-5">

    @if(session()->has('errors'))
        <div class="alert alert-danger  p-2 mb-2  "> 
            @foreach ($errors->all() as $error)
              <li> <?= $error ?></li>
            @endforeach 
           
        </div>

        @elseif(session()->has('success'))
        <div class="alert alert-success  p-2 mb-2  "> 
           
            <?= session()->get('success')?>
        </div>


    @endif
        <div class="card">
            
            <div class="card-body">

                <div class="card-title"> 
                    <h5>Create Item</h5>
                </div>

                <form method="post" action="{{route('rawItem.store')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{@$item->id}}">

                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-label">Title</label>
                                <input id="title_field" value="{{@$item->title}}" name="title" type="text" class="form-control" placeholder="Item Title..">
                            </div>
                        </div>
            
                        <div class="col-6">
                            <div class="form-group">
                                <label for="parentCatagory">Catagory</label>
                                <select required name="item_catagory" class="form-control" >
                                    <option disabled selected>Select ...</option>
                                        @foreach($catagory as $catagory)
                                            <option value="{{$catagory->id}}" {{@$item->catagory_id == $catagory->id  ?'selected':''}}>{{$catagory->title}}</option>
                                        @endforeach
                                 </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="parentCatagory">Vendor</label>
                                <select required name="vendor_id" class="form-control" >
                                    <option disabled selected>Select ...</option>
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}"  {{$item->vendor_id == $vendor->id ? 'selected' : ''}} >{{ ucwords($vendor->f_name.' '.$vendor->l_name) }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                 <label for="">Reorder Level</label>
                                 <input value="{{@$item->reorder_level}}" name="reorder_level" min="0" type="number" class="form-control" placeholder="">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                 <label for="">Reorder Quantity</label>
                                 <input value="{{@$item->reorder_qty}}" name="reorder_qty" min="0" type="number" class="form-control" placeholder="">
                            </div>
                        </div>                
                        
                        
                        <div class="col-4">
                            <div class="form-group">
                                <label for="" class="form-label"> Unit</label>
                                <select class="form-control" name="unit" id="">
                                    <option class="text-center" value="kg">kg</option>
                                    <option class="text-center" value="ltr">ltr</option>
                                    <option class="text-center" value="kg">dozen</option>
                                    <option class="text-center" value="pc">pc</option>
                                    <option class="text-center" value="gram">grams</option>
                                    <option class="text-center" value="ml">ml</option>
                                </select>
                            </div>
                        </div>

                                              
                    </div>
                    

                    <div class="form-group d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-3">{{@$item->id ? "Update": "Save"}}</button>

                        @if(@$item->id)
                            <a class="btn-danger btn mr-3"  onclick="return  confirm ('Are you sure you want to delete &#034;{{$item->title}}&#034; ?')" href="{{route('rawItem.destroy',['rawitem' => $item->id])}}">Delete</a>
                            <a href="{{route('rawItem.all')}}" class="btn btn-theme">Cancel</a>
                            @else

                        <button type="reset" class="btn btn-danger">Clear</button>
                        @endif

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


@section('addJavaScript')
    
<script>

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
