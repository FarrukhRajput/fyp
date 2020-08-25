
@extends('layouts.app')

@section('content')

<h4 class="page-title">Purchase</h4>
<a href="{{route('purchase.index')}}" class="btn btn-theme mb-3"> <i class="fas fa-arrow-left"></i>  All Purchase</a>

<div class="row">   
    <div class="col-md-10">
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

                <div class="row mt-3 mb-3">
                    <div class="col-lg-4 col-md-5 col-sm-12">
                        <div class="form-group">
                            <label for="">Vendor</label>
                            <select class="form-control" name="vendor_id" id="vendor">
                                <option >Select </option>

                                @foreach ($vendors as $vendor)  
                                   <option value="{{$vendor->id}}">{{ucwords( $vendor->f_name.' '.$vendor->l_name )  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4  offset-lg-4 offset-md-2 col-md-5 col-sm-12">
                        <div class="form-group">
                           
                            <label for="">Date</label>
                            <input type="date" name="" class="form-control" value="" id="date_picker">
                        </div>
                    </div>
                </div>

                <h5 class="text-center border-bottom pb-3">Add Purchase items</h5>
                {{-- <hr> --}}
                <div class="row mt-3">

                    <div class="col-12 " id="error-div">
                        
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Search</label>
                           <!-- Dropdown --> 
                            <select class="form-control" id='productList' >
                                <option  disabled selected>Select  </option>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-6">

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
                                    <input class="form-control text-center" type="number" id="price_field" min="1" >
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
                    <table class="table table-responsive table-bordered puchase-table table-striped" id="purchase_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="w-50">Title</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th></th>  
                            </tr>
                        </thead>

                       

                        <tbody>


                        </tbody>


                    </table>
                   </div>
                </div>




                <div class="row px-3 text-center">
                    <div class="offset-8 ">

                    </div>

                    <div class="col-2 border p-2 h6">
                        Total
                    </div>

                    <div class="col-2 border p-2 h6" id="total">
                        
                    </div>
                    
                   
                </div>


                <div class="row px-3 text-center">
                    <div class="offset-8">

                    </div>

                    <div class="col-2 border p-2">
                        Paid
                    </div>

                    <div class="col-2 border p-2 h" >
                       <input id="paid" type="number" class="form-control" min="0">
                    </div>
                    
                   
                </div>




                <div class="row mt-3">
                    <div class="col-12 d-flex justify-content-end">
                       
                        <button class="btn btn-primary w-25"  id="savePurchase">Save</button>
                           
                    </div>
                </div>

            </div>

        </div>    
    </div>
</div>



@section('addJavaScript')
    
<script>

    var productList = [];
    var purchaseList = [];
    var grandTotal = 0;
    var paidAmount;
    token  = $('input[name=_token]').val();
    
    // select input for search node
    var searchPanel = $('#productList');

    //  field nodes
    var qtyField = $('#qty_field')
    var priceField = $('#price_field');
    var totalField = $('#total_field');
    var table = $('#purchase_table tbody');

    $(document).click(

        function(e) {

            if(e.target.classList.contains('fa-times-circle')){
                // console.log(purchaseList);
                // e.target.parentElement.parentElement.remove();  
                console.log(purchaseList);
            }
           
        }

    );


    $(document).ready(


        () => {


            var now = new Date();

            var day = ("0" + now.getDate()).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);

            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

            $('#date_picker').val(today);



            $("#vendor").change(
                () => {
                    var $id = $("#vendor option:selected").val();
                   
                    $.ajax(
                        {   
                            type: 'GET',
                            url:'/vendor/'+$id+'/allProducts',
                            dataType: 'json',
                            success: function(products){
                              
                            productList = [];
                            purchaseList = [];
                            grandTotal = 0;
                            productList = products;
                            table.empty();
                            // console.log(productList)
                            // console.log(grandTotal);
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


            $('#paid').keyup(
                () => {
                    paidAmount = $('#paid').val() ;    
                }
            )

            $('#add-btn').click(
                () => {
                    title = $('#productList option:selected').html();
                    itemId =  $('#productList').val();
                    itemQty = $('#qty_field').val();
                    price = $('#price_field').val();

                    if( itemQty == '' || price == '' || searchPanel.val() == null ){
                       
                        let error ;
                        $('#error-div').empty();
                         
                         if(itemQty < 0 || price < 0 ) {

                            error = `
                                <div class="alert alert-danger fade show" role="alert">
                                   Invalid values placed
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `;

                           
                         }else{

                            error = `
                                <div class="alert alert-danger fade show" role="alert">
                                    Either item not selected or price or qty is not provide
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `;
                         }                        

                        $('#error-div').append(error);

                    }else{

                        // removing the error messages if all the validation is passed
                    $('#error-div').remove();
                    
                    total = parseInt(itemQty) * parseInt(price);
                    grandTotal += total;
                    item = {"id": parseInt(itemId), "title" : title ,"qty":  parseInt(itemQty) , "price": parseInt(price)};
                    
                    purchaseList.push(item);    

                    var element = ` 
                         <tr>
                            <td>${itemId}</td>
                            <td >${title}</td>
                            <td class="text-center">${itemQty}</td>
                            <td class="text-center">${price}</td>
                            <td class="text-center">${total}</td>
                            <td id="helo" class="remove_purchase text-center text-danger"><i id="" class="fas fa-times-circle"></i></td>
                        </tr> 
                     `;

                     table.append(element);

                     $("#total").html(grandTotal);
                    resetFields();
                    }                    
                    // purchaseList.add();                   
                }
            );


           

            $('#savePurchase').click(
                () =>{

                    let error ;
                    $('#error-div').empty();

                    if(purchaseList.length == 0){
                        error = `
                                <div class="alert alert-danger fade show" role="alert">
                                   No Item to store in purchase.Please add the items to for storing the purchase.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `;
                       
                        $('#error-div').append(error);
                    }
                    
                    else if( paidAmount < 0 ) {
        
                        error = `
                                <div class="alert alert-danger fade show" role="alert">
                                  Inappropriate Paid price
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            `;
                    
                       
                        $('#error-div').append(error);
                    }
                    
                    
                    else{

                        $('#error-div').empty();
                        let data = {
                        "_token": "{{ csrf_token() }}",
                        "purchase" : purchaseList,
                        'total' : grandTotal,
                        "purchase_date" :  $('#date_picker').val(),
                        "amount_paid" : paidAmount,
                        "vendor_id": $("#vendor option:selected").val()

                    }
                   
                    $.ajax(
                        {
                            type: 'POST',
                            url:'/store/purchase/create',
                            dataType: 'json',
                            data: data,
                            success: function(products){
                                     
                            }
                        }
                    );

                    }

                  
                }
            );



            function resetFields() {
                $("input[type=number]").val("");
               
            } 


           

            $('#productList').change(
                () => {
                    selectedId = $('#productList').val();

                    productList.forEach(element => {

                        if(selectedId == element['id']  ){
                            priceField.val(element['price']);
                        
                        }
                       
                    });
                  
                }
            );

        
        }
    );


   
</script>

@endsection

@endsection

