@extends('admin.layouts.muster')
@section('title', $auth->name);

@push('css')
    <style>
        #old-password-error {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="f-main-container">
        <div class="row m-0 py-3 f-shadow rounded">
            <div class="col-md-6 border-end">
                Change your name & profile image.
            </div>
            <div class="col-md-6">
                <form action="{{ Route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="f-profile-img"><img src="{{ $auth->image == null? "https://ui-avatars.com/api/?name=".$auth->name : asset($auth->image) }}" class="img-thumbnail" alt="{{ $auth->name }}"></div>
                    <input type="file" class="f-profile-field" name="image" hidden>
    
                    <div class="mt-3">
                        <div class="f-form-group">
                            <label>name</label>
                            <input type="name" class="form-control form-control-sm w-75" value="{{ $auth->name }}" disabled>
                        </div>
                        <div class="f-form-group">
                            <label>email</label>
                            <input type="email" class="form-control form-control-sm w-75" value="{{ $auth->email }}" disabled>
                        </div>
                        <div class="f-form-group p-0 pt-3 text-end">
                            <button class="f-btn btn btn-sm btn-outline-dark px-5">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row m-0 py-3 mt-4 f-shadow rounded">
            <div class="col-md-6 border-end">
                Change your password
            </div>
            <div class="col-md-6">
                <div class="f-form-group">
                    <label>old password</label>
                    <input type="password" class="form-control form-control-sm w-75" id="old-password">
                    <p class="f-error" id="old-password-error">password are not matching.</p>
                </div>
                <form action="{{ Route('admin.password.update') }}" method="post">
                    @csrf
                    <div class="f-form-group">
                        <label>password</label>
                        <input type="password" class="form-control form-control-sm w-75" id="password" name="password" disabled>
                    </div>
                    <div class="f-form-group">
                        <label>confirm password</label>
                        <input type="password" class="form-control form-control-sm w-75" id="confirm-password" disabled>
                        <p class="f-error" id="password-error">password are not matching.</p>
                    </div>
                    <div class="f-form-group p-0 pt-3 text-end">
                        <button class="f-btn btn btn-sm btn-outline-dark px-5" id="password-submit" disabled>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $(".f-profile-img").on('click', function(){
                $(".f-profile-field").click();
                $('.f-profile-field').change(function(e){
                    var file = e.target.files[0];  
                    var reader = new FileReader();  
                    reader.onloadend = function() {  
                        $(".f-profile-img").children('img').attr('src', reader.result)
                    }  
                    reader.readAsDataURL(file);
                });
            });

            // old password check
            $("#old-password").keyup(function(){
                let password = $(this).val();
                if(password != ""){
                    axios.get('/admin/password/check/'+password)
                    .catch(errors => console.log(error))
                    .then(res => {
                        if(res.data == 1) {
                            $('#old-password-error').hide();
                            $("#password").removeAttr("disabled");
                            $("#confirm-password").removeAttr("disabled");
                        }
                        else {
                            $('#old-password-error').show();
                            $("#password").attr("disabled", "disabled");
                            $("#confirm-password").attr("disabled", "disabled");   
                        }
                    })
                }
                else {
                    $('#old-password-error').hide();
                }
            })
        });
    </script>
@endpush
