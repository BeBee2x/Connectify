@extends("../extension/extend")

<style>
    body{
        background-color: #f4f1f1 !important;
    }
</style>

@section('content')

{{-- All status start --}}
@if (session('create_status'))
    <div class="alert col-3 alert shadow-sm rounded alert-dismissible fade show" role="alert"
        style="background-color:rgb(43, 43, 43);position: fixed;bottom:0px;right:10px;z-index:1">
        <span class="text-white fw-bold">{{ session('create_status') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="z-index:0"></button>
    </div>
@endif
@if (session('update_status'))
    <div class="alert col-3 alert shadow-sm rounded alert-dismissible fade show" role="alert"
        style="background-color:rgb(43, 43, 43);position: fixed;bottom:0px;right:10px;z-index:1">
        <span class="text-white fw-bold">{{ session('update_status') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="z-index:0"></button>
    </div>
@endif
@if (session('delete_status'))
    <div class="alert col-3 alert shadow-sm rounded alert-dismissible fade show" role="alert"
        style="background-color:rgb(43, 43, 43);position: fixed;bottom:0px;right:10px;z-index:1">
        <span class="text-white fw-bold">{{ session('delete_status') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="z-index:0"></button>
    </div>
@endif
{{-- All status end --}}

{{-- nav bar --}}
<nav class="navbar navbar-expand-lg bg-white shadow-sm" style="position: sticky;top:0;z-index:1">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ route("Auth-HomePage") }}">
        <img src="{{ asset("images/logo.jpg") }}" style="width:100px">
    </a>
    <div class="dropdown" style="position: relative;">
        <button class="btn dropdown-toggle text-white" style="background-color:#F57901 " data-bs-toggle="dropdown"><i class="fa-solid fa-circle-user"></i> {{ Auth::user()->name }}</button>
        <ul class="dropdown-menu" style="position: absolute;top:40px;left:-70px">
            <li class="dropdown-item">
                <form action="{{ route('logout') }}" method="post" class="m-0">
                    @csrf
                    <button class="btn">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                    </button>
                </form>
            </li>
        </ul>
    </div>
  </div>
</nav>
{{-- main  --}}
<div class="row mt-2 mx-2" style="position: relative">
    {{-- upload  --}}
    <div class="col-5" style="position: fixed;over-flow:scroll">
        <div class="bg-white shadow-sm rounded-3 p-2" style="min-height:520px">
            <div class="fw-bold fs-5">Post something</div>
            <form action="{{ route("Post-Upload") }}" method="POST" class="my-3">
                @csrf
                {{-- for title  --}}
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control shadow-sm @error('title') is-invalid @enderror" placeholder="Enter title..." value="{{ old('title') }}">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                {{-- for description  --}}
                <label for="description" class="form-label mt-3">Description</label>
                <textarea name="description" class="form-control shadow-sm @error('description') is-invalid @enderror" cols="30" rows="10" placeholder="Enter description...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                {{-- upload button --}}
                <input type="submit" value="Upload" class="btn text-white mt-3 px-4" style="background-color:#F57901">
            </form>
        </div>
    </div>
    {{-- feeds  --}}
    <div class="col-7 bg-white offset-5 p-2 rounded-3" style="min-height: 90vh;z-index:0">
        <div class="fw-bold fs-5">Your feeds</div>

        @if (count($posts)==0)
            <div class="d-flex justify-content-center text-muted align-items-center text-center" style="height:100%">
                <div class="">
                    <img src="{{ asset("images/empty-concept-illustration_114360-1253.avif") }}" class="w-25">
                    <div>
                        There is no posts yet
                    </div>
                </div>
            </div>
        @endif

        @foreach ($posts as $item)
        <a href="{{ route("Post-Details",$item->id) }}" class="text-decoration-none">
            <div class="card my-4 shadow" style="border:solid 2px #F57901">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold"><i class="fa-regular fa-circle-user" style="color:#F57901"></i> {{ $item->user_name }}</h5>
                        <div class="text-muted fw-bold" style="font-size: 12px">
                            <i class="fa-solid fa-globe" style="color:#F57901"></i>
                            {{ $item->created_at->format('j F h:i a') }}
                        </div>
                    </div>
                    <hr class="p-0 m-2">
                    <div class="fw-bold">
                        {{ $item->title }}
                    </div>
                </div>
                <div class="card-body">
                    {{ Str::words($item->description, 25, '...See More') }}
                </div>
                <div class="card-footer">

                    <div class="d-none">
                        {{ $count = 0 }}
                    </div>
                    @foreach ($comments as $cmt)
                        @if($cmt->post_id==$item->id)
                        <div class="d-none">
                            {{ $count++ }}
                        </div>
                        @endif
                    @endforeach

                    @if ($count>1)
                        {{ $count }} comments here
                    @else
                        {{ $count }} comment here
                    @endif

                </div>
            </div>
        </a>
        @endforeach

    </div>
</div>
@endsection
