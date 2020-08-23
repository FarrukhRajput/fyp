
@extends('layouts.app')

@section('content')

<h4 class="page-title">Purchase</h4>
<a href="{{route('purchase.index')}}" class="btn btn-theme mb-3"> <i class="fas fa-arrow-left"></i>  All Purchase</a>

<div class="row">   
    <div class="col-10">
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
                                <option value="{{$vendor->id}}">{{ucwords( $vendor->f_name.' '.$vendor->l_name )  }}</option>
    
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
                           <!-- Dropdown --> 
                            <select class="form-control" id='productList' >
                                <option  disabled selected>Select  </option>
                            </select>
                        </div>
                    </div>


                    <div class="col-6">

                        <div class="row">
                            <div class="col-3 text-center">
                                <div class="form-group">
                                    <label for=""><b>Qty</b></label>
                                    <input class="form-control text-center" type="number" id="qty_field" min="1" placeholder="1">
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <div class="form-group">
                                    <label for=""><b>Price</b></label>
                                    <input class="form-control text-center" type="number" id="price_field" >
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <div class="form-group">
                                    <label for=""><b>Total</b></label>
                                    <input class="form-control text-center" type="number" id="total_field" min="1" placeholder="1" disabled>
                                </div>
                            </div>
                            <div class="col-3 text-center">
                                <label for="" style="color: transparent"><b>sdfsdf</b></label>
                                <button id="add-btn" class="btn btn-secondary">Add</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                   <div class="col-12">
                    <table class="table table-bordered puchase-table table-striped" id="purchase_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="w-50">Title</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Price</th>
                                <th></th>  
                            </tr>
                        </thead>

                       

                        <tbody>


                        </tbody>
                    </table>
                   </div>
                </div>

            </div>

        </div>    
    </div>
</div>



@section('addJavaScript')
    
<script>

    productList = [];
    purchaseList = [];
    grandTotal = 0;
    

    // select input for search node
    var searchPanel = $('#productList');

    //  field nodes
    var qtyField = $('#qty_field')
    var priceField = $('#price_field');
    var totalField = $('#total_field');
    var table = $('#purchase_table tbody');



    $(document).ready(

        () => {
            $("#vendor").change(
                () => {
                    var $id = $("#vendor option:selected").val();
                   
                    $.ajax(
                        {
                            type: 'GET',
                            url:'/vendor/'+$id+'/allProducts',
                            dataType: 'json',
                            success: function(products){
                              productList = products;
                              setSearchField(productList);
                              
                            }
                        }
                    )
                }
            );

            function setSearchField(products){
                $.each(products , function ( i , product){
                    searchPanel.append("<option value="+product["id"]+">"+product["title"]+"</option>");
                });
            }   



            $('#add-btn').click(
                () => {
                    title = $('#productList option:selected').html();
                    itemId =  $('#productList').val();
                    itemQty = $('#qty_field').val();
                    price = $('#price_field').val();
                    total = parseInt(itemQty) * parseInt(price);
                    grandTotal += total;
                    item = {"id": parseInt(itemId), "title" : title ,"qty":  parseInt(itemQty) , "price": parseInt(price)};
                    
                    purchaseList.push(item);

                    console.log(grandTotal);

                    var element = ` 
                         <tr>
                            <td></td>
                            <td >${title}</td>
                            <td class="text-center">${itemQty}</td>
                            <td class="text-center">${price}</td>
                            <td class="text-center">${total}</td>
                            <td class="remove_purchase text-center text-danger"><i class="fas fa-times-circle"></i></td>
                        </tr>
                     `;

                     table.append(element);


                    resetFields();
                    // purchaseList.add();                   
                }
            );


            priceField.keyup(
                () => {
                  var qty =  $('#qty_field').val();
                  var price = $('#price_field').val();
                  var total = parseInt(qty) * parseInt(price);
                  totalField.val(total);
                }
            )
            qtyField.keyup(
                () => {
                  var qty =  $('#qty_field').val();
                  var price = $('#price_field').val();
                  var total = parseInt(qty) * parseInt(price);
                  totalField.val(total);
                }
            )

            function resetFields() {
                $("input[type=number]").val("");
                $("#productList").find("option:selected").remove().end();
                $("#productList").show();
            } 

            $('#productList').change(
                () => {
                    selectedId = $('#productList').val();

                    productList.forEach(element => {

                        if(selectedId == element['id']  ){
                            priceField.val(element['price']);
                            console.log(element);
                        }
                       
                    });
                  
                }
            );

        
        }
    )

</script>

@endsection

@endsection

