
@extends('layouts.app')


@section('addStyle')
    
@endsection

@section('content')

<h4 class="page-title">Designations</h4>

<div class="row">
    <div class="col-4">


        @if (session()->has('errors'))

            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li> <?= $error ?></li>
                    @endforeach 
                </ul>
            </div>

        @elseif(session()->has('message'))
            <div class="alert alert-success">
                <?= session()->get('message') ?>
            </div>
            
        @endif


        <div class="card">
            
            <div class="card-body">

                <div class="card-title py-2 d-flex justify-content-between"> 
                    <h5 class="d-inline-block">New Designation</h5>
                    @if(@$designation->id)
                        <a href="{{route('designation.index')}}" class="btn btn-theme d-inline-block">Create <i class="fas fa-plus"></i> </a>
                    @endif
                </div>

                <form action="{{route('designation.store')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{@$designation->id}}" name="id" >
                    <div class="row">
                    
                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">Title</label>
                                <input name="title" type="text" class="form-control" required  value="{{ucwords(@$designation->title)}}" placeholder="Designation">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="" class="form-contol-label">Staff Group</label>
                                <select name="staff_group_id" class="form-control" >
                                    <option disabled selected>None</option>
                                    @foreach ($group as $item )
                                        <option value="{{$item->id}}"  {{@$designation->group->id === $item->id? 'selected': ''  }} >{{ ucwords($item->title)}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                      
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary mr-3 w-100">{{  @$designation->id ?'Update' : 'Save'}}</button>

                        @if(@$designation->id )
                            <a onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$designation->title}} &#034; ?')" href="{{route('designation.destroy', [ 'id' => $designation ->id ])}}" class="btn btn-danger w-100">
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

     <div class="offset-1 col-7">
        <div class="card">
            <div class="card-body ">
                <div class="card-title py-2"> 
                    <h5>Manage Designations</h5>
                </div>
                    
                <div class="table-card">
                    <table id="designationTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center"># </th>
                                <th class="text-center">Title</th> 
                                <th class="text-center">Staff Group</th> 
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            @foreach ($designations as $item)    
                            <tr>
                                <th class="text-center">{{ $item->id }}</th>
                                <td class="text-center">{{ ucwords( $item->title) }}</td>
                                <td class="text-center">
                                        {{ ucwords($item->group->title) }}
                                </td>
                                <td class="d-flex justify-content-center" >
                                    <a href="{{route('designation.show', [ 'id' => $item ->id ])}}" class="btn btn-primary mr-3">
                                       <i class="fas fa-edit"></i>
                                    </a>
                                    <a 
                                        onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$item->title}} &#034; ?')" 
                                        href="{{route('designation.destroy', [ 'id' => $item ->id ])}}" 
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



<script src="{{asset('js/jquery.js')}}"></script>



<script>

    $(document).ready(
        () => {
            $('form').submit(

                (e) => {
                    if($('option:selected').text() === 'None'){
                        e.preventDefault();
                        alert("Staff Group Cannot be none");
                    }else{

                        $('form').submit();
                    }
                }
            );
            
            $('#designationTable').DataTable();
        }
    );

   

</script>

@endsection