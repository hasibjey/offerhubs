<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify</title>
    </title>

    {{-- style sheet link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <div class="row m-0 mt-5">
        <div class="col-md-4 offset-4">
            <div class="card">
                <div class="card-header font-weight-bolder font-italic">
                    <h4 class="text-center fst-italic">A new verification OTP code has been sent to the phone number you provided during registration.</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('verifyOTP') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">OTP</label>
                            <input type="text" class="form-control"  name="otp" required autofocus>
                            @error('otp')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- javascript link --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
