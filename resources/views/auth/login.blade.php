@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <div class="my-3 form-check">
                                    <input type="checkbox" onclick="showPassword()" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Show Password</label>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class=" row buttons justify-content-center align-items-center p-5">
                            <div class="row justify-content-center">
                                <div class="col-md-3 btn-primary button btn me-2 mb-3 lh-lg py-4">1</div>
                                <div class="col-md-3 btn-primary button btn me-2 mb-3 lh-lg py-4">2</div>
                                <div class="col-md-3 btn-primary button btn me-2 mb-3 lh-lg py-4">3</div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-3 btn-primary button btn me-2 mb-3 lh-lg py-4">4</div>
                                <div class="col-md-3 btn-primary button btn me-2 mb-3 lh-lg py-4">5</div>
                                <div class="col-md-3 btn-primary button btn me-2 mb-3 lh-lg py-4">6</div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-3 btn-primary button btn me-2 mb-3 lh-lg py-4">7</div>
                                <div class="col-md-3 btn-primary button btn me-2 mb-3 lh-lg py-4">8</div>
                                <div class="col-md-3 btn-primary button btn me-2 mb-3 lh-lg py-4">9</div>
                            </div>
                            <div class="row col-md-3 py-4"><button type="submit" class="btn btn-success py-3">Login</button></div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    let display = document.getElementById("password");
    let buttons = Array.from(document.getElementsByClassName('button'));
    buttons.map(button => {
        button.addEventListener('click', (e) => {

            display.value += e.target.innerHTML;
            console.log(display.innerText);

        });
    });

    function showPassword() {

        if (display.type === "password") {
            display.type = "text";
        } else {
            display.type = "password";
        }
    }
</script>
@endsection