@extends("../extension/extend")

<style>
    body{
        background-color: #f4f1f1 !important;
    }
</style>

@section("content")
<div style="position: absolute;top:10px;left:10px">
    <a href="{{ route("Auth-HomePage") }}" class="text-decoration-none text-black"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>
    <div class="container">
        <div class="row d-flex justify-content-center min-vh-100 align-items-center">
            <div class="col-6">

                {{-- edit or delete if this post is yours --}}
                @if ($post->user_id==Auth::user()->id)
                <div class="d-flex justify-content-end mt-2">
                    {{-- edit  --}}
                    <a href="{{ route("Post-Edit",$post->id) }}" class="btn btn-primary"><i class="fa-solid fa-pencil"></i> Edit</a>
                    {{-- delete  --}}
                    <button class="btn btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#deleteConfirm"><i class="fa-solid fa-trash-can"></i> Delete</button>
                    <div class="modal" id="deleteConfirm"
                        style="backdrop-filter: blur(5px)">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-center">
                                    <div class="text-center h5 fw-bold"
                                        style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                                        Delete your post</div>
                                </div>
                                <div class="modal-body fw-bold">
                                    Are you sure you want to delete this post?
                                </div>
                                <div class="modal-footer border-0 d-flex justify-content-end">
                                    <button class="btn btn-hover" style="color:#F57901"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{ route('Post-Delete', $post->id) }}"
                                        class="btn text-white fw-bold px-4" style="background-color: #F57901">Confirm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- post details --}}
                <div class="card my-3 shadow-sm" style="border:solid 2px #F57901">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold"><i class="fa-regular fa-circle-user" style="color:#F57901"></i> {{ $post->user_name }}</h5>
                            <div class="text-muted fw-bold" style="font-size: 12px">
                                <i class="fa-solid fa-globe" style="color:#F57901"></i>
                                {{ $post->created_at->format('j F h:i a') }}
                            </div>
                        </div>
                        <hr class="p-0 m-2">
                        <div class="fw-bold">
                            {{ $post->title }}
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $post->description }}
                    </div>
                    <div class="card-footer">
                        0 comment here
                    </div>
                </div>

                {{-- comment box --}}
                  <form action="{{ route("Comment-Upload") }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="text" name="comment" class="form-control shadow-sm @error('comment') is-invalid @enderror" placeholder="Write a comment..." aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn text-white" style="background-color: #F57901" type="submit" id="button-addon2"><i class="fa-solid fa-paper-plane"></i></button>
                        @error('comment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                  </form>

                  {{-- all comments  --}}
                  @foreach ($comments as $item)
                  <div class="my-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa-regular fa-circle-user fs-3" style="color:#F57901"></i>
                        </div>
                        <div class="ms-2 rounded-3 p-2 bg-white shadow-sm" style="border:solid 1px #F57901">
                            <h5 class="fw-bold">{{ $item->user_name }}</h5>
                            <span>{{ $item->text }}</span>
                        </div>
                        {{-- comment option  --}}
                        @if ($item->user_id==Auth::user()->id || $post->user_id==Auth::user()->id) {{-- Post owner and comment owner only can see the opiton besde comment --}}
                        <div class="dropup">
                            <button class="btn border-0 ms-2" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                @if ($item->user_id==Auth::user()->id)  {{-- Post owner only can delte the comment but not edit --}}
                                <a href="{{ route("Comment-Edit",$item->id) }}" class="btn w-100 text-start"><i class="fa-solid fa-pen"></i> Edit</a>
                                @endif
                                <a href="{{ route("Comment-Delete",$item->id) }}" class="btn w-100 text-start"><i class="fa-solid fa-trash"></i> Delete</a>
                            </div>
                        </div>
                        @endif

                    </div>
                  </div>
                  @endforeach

            </div>
        </div>
    </div>
@endsection
