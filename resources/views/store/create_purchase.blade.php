
@extends('layouts.app')

@section('content')



<a href="{{route('purchase.index')}}" class="btn btn-theme mb-3">All Purchase</a>


<div class="row">   
    <div class="col-5">
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
    <div class="card-body">

        <div class="card-title "> 
            <h5 class="page-title">Add Purchase</h5>
        </div>

       
    </div>


</div>    
    </div>
</div>


@endsection

