@extends('../extension/extend')

@section('content')
<div style="position: absolute;top:10px;left:10px">
    <a href="{{ route("Post-Details",$comment->post_id) }}" class="text-decoration-none text-black"><i class="fa-solid fa-arrow-left"></i> Back</a>
</div>
<div class="container">
    <div class="row d-flex justify-content-center min-vh-100 align-items-center">
        <div class="col-4 d-flex justify-content-center">
            <form action="{{ route("Comment-Update") }}" method="POST">
                @csrf
                <div class="my-3">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa-regular fa-circle-user fs-3" style="color:#F57901"></i>
                        </div>
                        <div class="ms-2 rounded-3 p-2 bg-white shadow-sm" style="border:solid 1px #F57901">
                            <h5 class="fw-bold">{{ $comment->user_name }}</h5>
                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                            <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
                            <input type="text" class="form-control shadow-sm @error('comment') is-invalid @enderror" name="comment" value="{{ old("comment",$comment->text) }}">
                            @error('comment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="float-end">
                        <button class="btn float-end mt-2 text-white" style="background-color: #F57901"><i class="fa-solid fa-check"></i> Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
