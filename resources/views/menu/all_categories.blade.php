
@extends('layouts.app')


@section('content')

    <h4 class="page-title">Menu Catagories</h4>

    <a href="{{ route('menuCatagory.create') }}" class="btn btn-theme mb-3"> Create Category</a>

<div class="row">
     <div class="col-6">


        @if (session()->has('delete'))
            <div class="card bg-danger text-white p-2 mb-2">
                {{ session()->get('delete') }}    
            </div>            
        @endif

        

        <div class="card">
            <div class="card-body ">
                <div class="card-title py-1"> 
                    <h5>Manage Catagories</h5>
                </div>
                    
                <div class="table-card">
                    <table id="menuCategoryTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Title</th> 
                                <th class="text-center">Parent Category</th> 
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            @foreach ($categories as $item)    
                                <tr>
                                    
                                    <td class="text-center">{{ $item->title }}</td>
                                    <td class="text-center">
                                            {{ $item->parent_category_id == 0 ? 'Parent' : $item->parent->title }}
                                    </td>
                                    <td class="d-flex justify-content-center" >
                                        <a class="btn btn-primary mr-3"
                                            href="{{route('menuCatagory.edit', [ 'id' => $item->id ])}}">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form method="POST" action="{{route('menuCatagory.destroy', [ 'id' => $item ->id ])}}">
                                            {{ method_field('DELETE')}}
                                            {{ csrf_field()}}
                                            <button  class="btn btn-danger" type="submit"
                                                onclick="return confirm('Are Your Sure You Want To Delete &#034; {{$item->title}} &#034; ?')" > 
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>                         

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
        $('#menuCategoryTable').DataTable();
    </script>
@endsection



@endsection