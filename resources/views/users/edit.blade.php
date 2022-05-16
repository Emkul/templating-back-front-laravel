@extends('layouts.backend.app', ['activePage' => 'user', 'titlePage' => __('edit user')])

@section('content')

<div class="content">
    <div class="card ">
        <div class="card-header card-header-primary">
            <h4 class="card-title">User</h4>
            <p class="card-category">{{$submit}} User</p>
        </div>
        <div class="card-body ">

            <form action="/user/{{$user->id}}" method="post">
                @method('put')
                @csrf

                @include('users._form')
            </form>
        </div>

    </div>
</div>
@endsection
