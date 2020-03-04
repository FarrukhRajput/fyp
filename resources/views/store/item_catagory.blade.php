
@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h4 class="page-title">{{$title}}</h4>
     <a href="{{route('item-catagory-create')}}" class="btn btn-primary mb-4"> Create Catagory</a>

    <div class="card">
        <div class="card-body ">
            <div class="card-title py-3"> 
                <h4>Manage Catagory</h2>
            </div>

        <table class="table table-bordered w-75">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Catagory Name</th>
                        <th>Parent Catagory</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th >1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td class="d-flex justify-content-center" >
                          <a href="" class="btn btn-primary mr-3">
                          <i class="fas fa-edit"></i>
                          </a>
                          <a href="" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i>
                          </a>
                        </td>
                    </tr>
                    <tr>
                        <th >2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                    <th >3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
                </table>

        </div>
    </div>
</div>




<!-- Modal for catagory -->
<div class="modal fade" id="catagoryModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Create Catagory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection