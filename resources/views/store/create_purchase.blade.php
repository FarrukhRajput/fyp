
@extends('layouts.app')

@section('content')


<div class="row">   
    <div class="col-6">
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

            <div class="card-header active d-flex justify-content-between">
                <h5 class="text-light mt-2">Add Purchase</h5>
                <a href="{{route('purchase.index')}}" class="btn btn-theme">All Purchase</a>

            </div>

            <div class="card-body">

                <h5 class="text-center border-bottom pb-3">Vendor Details</h5>
                

                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Vendor</label>
                            <select class="form-control" name="vendor_id" id="vendor">
                                <option  disabled selected>Select  </option>

                                @foreach ($vendors as $vendor)  
                                <option value="{{$vendor->id}}">{{ $vendor->f_name.' '.$vendor->l_name   }}</option>
    
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-4 offset-4">
                        <div class="form-group">
                            <label for="">Date</label>
                            <input type="date" name="" id="">
                        </div>
                    </div>
                </div>

                <h5 class="text-center border-bottom pb-3">Add Purchase items</h5>
                {{-- <hr> --}}
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Search</label>
                            <input class="form-control" type="text">
                        </div>
                        <div id="datafetch">Search results will appear here</div>
                    </div>


                    <div class="col-6">

                        <div class="row">
                            <div class="col-3 text-center">
                                <div class="form-group">
                                    <label for=""><b>Qty</b></label>
                                    <input class="form-control" type="number">
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <div class="form-group">
                                    <label for=""><b>Price</b></label>
                                    <input class="form-control" type="number">
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <div class="form-group">
                                    <label for=""><b>Total</b></label>
                                    <input class="form-control" type="number">
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <label for=""><b> &nbsp;</b></label>
                                <div class="btn btn-secondary">Add</div>
                            </div>
                        </div>

                    </div>

                  
                </div>

                

            
            </div>


        </div>    
    </div>
</div>



@section('addJavaScript')
    
<script>

    $(document).ready(

        () => {
            $("#vendor").change(
                () => {
                    var $id = $("#vendor option:selected").val();
                    console.log($id);
                
                    $.ajax(
                        {
                            type: 'GET',
                            url:'/vendor/'+$id+'/allProducts',
                            dataType: 'json',
                            success: function(designations){
                                console.log(designations);

                                // $designation.empty(); 
                                // $.each(designations , function ( i , designation){
                                //     $designation.append("<option value="+designation.id+">"+designation.title+"</option>");
                                // });
                            }
                        }
                    )
                }
            );

        
        }
    )

</script>

@endsection

@endsection

