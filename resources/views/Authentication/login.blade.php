@extends("../extension/extend")

@section("content")
    <div class="container">
        <div class="row d-flex justify-content-center min-vh-100 align-items-center text-center">
            <div class="col-6">
                <div class="d-flex justify-content-center">
                    <img src="{{ asset("images/logo.jpg") }}" class="w-25">
                </div>
                <p class="my-2">Stay connected with Connectify!</p>
                <form action="{{ route('login') }}" class="text-start" method="POST">
                    @csrf
                    {{-- for email  --}}
                    <Label for="email" class="form-label ms-1 mt-3">Email</Label>
                    <input type="email" name="email" placeholder="Enter your email" class="form-control shadow-sm @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    {{-- for password  --}}
                    <Label for="password" class="form-label ms-1 mt-3">Password</Label>
                    <input type="password" name="password" placeholder="Enter your password" class="form-control shadow-sm @error('password') is-invalid @enderror" value="{{ old('password') }}">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    {{-- sign up button  --}}
                    <input type="submit" value="Sign up" class="btn text-white mt-3 px-4" style="background-color:#F57901">
                </form>
                <div class="text-muted my-2 text-start">Have an account? <a href="{{ route("Auth-SignupPage") }}" style="color:#F57901">Signup</a></div>
            </div>
        </div>
    </div>
@endsection
