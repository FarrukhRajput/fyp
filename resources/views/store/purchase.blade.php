
@extends('layouts.app')

@section('addStyle')
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.css')}}"> 
<link rel="stylesheet" href="{{asset('css/dataTable/dataTable.min.css')}}"> 
@endsection

@section('content')

<h4 class="page-title">Purchase</h4>

<a href="{{route('purchase.create')}}" class="btn btn-theme mb-3"> <i class="fas fa-plus mr-2"></i>Add Purchase</a>
<div class="row">

     <div class="col-12">
        <div class="card">

            <div class="card-body ">
                <div class="card-title py-2"> 
                    <h5>Manage Purchases</h5>
                </div>
                    
                <div class="table-card">
                    <table id="purchaseTable" class="table table-bordered">
                        <thead>
                            <tr>
                              
                                <th class="text-center">Vendor Name</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Cnic</th>
                                <th class="text-center">Action</th>
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

@section('addJavaScript')
<script src="{{asset('js/dataTable/dataTable.min.js')}}"></script>
    
<script>

    $('#purchaseTable').DataTable({
        paging:true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });

</script>
@endsection

@endsection