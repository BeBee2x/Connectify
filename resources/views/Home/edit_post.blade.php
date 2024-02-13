@extends("../extension/extend")

<style>
    body{
        background-color: #f4f1f1 !important;
    }
</style>

@section("content")
<div style="position: absolute;top:10px;left:10px">
    <a href="{{ route("Post-Details",$post->id) }}" class="text-decoration-none text-black"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>
    <div class="container">
        <div class="row d-flex justify-content-center min-vh-100 align-items-center">
            <div class="col-6">

                <form action="{{ route("Post-Update") }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="card my-4 shadow" style="border:solid 2px #F57901">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h5 class="fw-bold"><i class="fa-regular fa-circle-user" style="color:#F57901"></i> {{ $post->user_name }}</h5>
                                <div class="text-muted fw-bold" style="font-size: 12px">
                                    <i class="fa-solid fa-globe" style="color:#F57901"></i>
                                    {{ $post->created_at->format('j F h:i a') }}
                                </div>
                            </div>
                            <hr class="p-0 m-2">
                            <div class="">
                                <input type="text" class="form-control shadow-sm @error('title') is-invalid @enderror" name="title" value="{{ old("title",$post->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <textarea name="description" cols="30" rows="10" class="form-control shadow-sm @error('description') is-invalid @enderror">{{ old("description",$post->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn text-white float-end" style="background-color: #F57901"><i class="fa-solid fa-check"></i> Update</button>
                </form>

            </div>
        </div>
    </div>
@endsection
