@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header theme-bg">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! {{ ucfirst(substr(Auth::user()->name ,  -strlen(Auth::user()->name) , 1)) }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
