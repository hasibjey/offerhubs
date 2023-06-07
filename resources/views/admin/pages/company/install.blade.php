<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flickrdesign.css') }}">
</head>

<body>

    <div class="row m-0">
        <div class="col-md-6 offset-3">
            <div class="card my-2">
                <div class="card-header f-card-header">
                    <h2 class="f-title"><span id="form-title">Company Information</h2>
                </div>
                <div class="card-body f-card-body">
                    <form action="{{ route('admin.company.collection') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="id" hidden>
                        <div class="f-form-group">
                            <label>company logo</label>
                            <input type="file" class="form-control form-control-sm" name="image" />
                            @error('image')
                                <samp class="f-error">{{ $message }}</samp>
                            @enderror
                            <div class="row m-0 mt-2">
                                <div class="col-md-6 p-1 img-thumbnail">
                                    <img src="{{ isset($items->image) ? asset($items->image) : asset('assets/images/image-upload-demo.png') }}"
                                        alt="" class="img-thumbnail f-form-img">
                                </div>
                            </div>
                        </div>
                        <div class="f-form-group">
                            <label>Company name</label>
                            <input type="text" class="form-control form-control-sm" name="name" />
                            @error('name')
                                <samp class="f-error">{{ $message }}</samp>
                            @enderror
                        </div>
                        <div class="f-form-group">
                            <label>Company email address</label>
                            <input type="email" class="form-control form-control-sm" name="email" />
                            @error('email')
                                <samp class="f-error">{{ $message }}</samp>
                            @enderror
                        </div>
                        <div class="f-form-group">
                            <label>Company phone number</label>
                            <input type="text" class="form-control form-control-sm" name="phone" />
                            @error('phone')
                                <samp class="f-error">{{ $message }}</samp>
                            @enderror
                        </div>
                        <div class="f-form-group">
                            <label>Company address</label>
                            <textarea rows="4" class="form-control form-control-sm" name="address"> </textarea>
                            @error('address')
                                <samp class="f-error">{{ $message }}</samp>
                            @enderror
                        </div>
                        <div class="f-form-group">
                            <label>Company Tax</label>
                            <input type="text" class="form-control form-control-sm" name="tax" />
                            @error('tax')
                                <samp class="f-error">{{ $message }}</samp>
                            @enderror
                        </div>
                        <div class="f-form-group mt-3 text-center">
                            <button class="btn btn-sm btn-danger px-5" type="reset">Clear</button>
                            <button class="btn btn-sm btn-success px-5" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script>
        // image pre view
        $("input[name='image']").change(function(e) {
            var file = e.target.files[0];
            console.log(file);
            var reader = new FileReader();
            reader.onloadend = function() {
                $(".f-form-img").attr('src', reader.result)
            }
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>
