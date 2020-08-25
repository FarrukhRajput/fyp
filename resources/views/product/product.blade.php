@extends('layouts.app')


@section('content')

    <h4 class="page-title">Products</h4>

    @if(session()->has('success'))
        <div class="alert alert-success">
        {{ session()->get('success')}}
        </div>

    @endif

    <a href="{{route('products.create')}}" class="btn btn-theme"> <i class="fas fa-plus mr-2"></i>Create Product</a>


    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body ">
                    <div class="card-title py-2"> 
                        <h4>Manage Products</h4>
                    </div>
                        
                
                        <table id="productTable" class="display table table-bordered">
                            <thead>
                                <tr>
                                    
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">MainCategory</th>
                                    {{-- <th class="text-center">Sub Category</th> --}}
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Status</th>
                                   
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                
                                @foreach ($products as $product)
                                    <tr>
                                       
                                        <td class="text-center">
                                            {{ucwords($product->title)}}
                                        </td>
                                        <td class="text-center">
                                            <img src="{{asset($product->image)}}" class="avatar-circle">
                                        </td>
                                        <td class="text-center">
                                            {{ ucwords($product->parentCategory->title)}}
                                        </td>

                                        <td class="text-center">
                                            {{$product->price}}
                                        </td>

                                        <td class="text-center">
                                            {{  ucwords($product->is_active == 1 ? "active" : "de_active")}}
                                        </td>
                                        

                                       
                                        <td class="d-flex justify-content-center text-white " >
                                            <a
                                                href="{{route('products.edit', ['id' => $product->id])}}"
                                                class="edit-btn btn btn-primary mr-3">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a
                                                href="{{route('products.destroy', [ 'id' => $product->id ])}}" 
                                                onclick="return confirm('Are you sure you want to delete &#034;{{ $product->title }}&#034; ?')"  
                                                class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
        
                                        </td>
                                    </tr>   
                                @endforeach
                                
                            
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

        $('#productTable').DataTable();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }





        // $(document).ready(

        //     () => {
        //         $("#group").change(
        //             () => {
        //                 var $id = $("#group option:selected").val();
        //                 var $designation = $("#designation");
        //                 $designation.removeAttr('disabled');

        //                 $.ajax({
        //                     type: 'GET',
        //                     url: '/staff-group/getDesignation/' + $id,
        //                     dataType: 'json',
        //                     success: function (designations) {

        //                         $designation.empty();
        //                         $.each(designations, function (i, designation) {
        //                             $designation.append("<option value=" + designation.id +
        //                                 ">" + designation.title + "</option>");
        //                         });
        //                     }
        //                 })
        //             }
        //         );

        //         $("#imageUpload").change(function () {
        //             readURL(this);
        //         });

        //     }
        // )

    </script>

    @endsection


    @endsection
