@extends('admin.layouts.muster')
@section('title', 'Company Infromation')

@section('content')
    <div class="f-main-container">
        <div class="row m-0">
            <div class="col-md-6 offset-3">
                <div class="card my-2">
                    <div class="card-header f-card-header">
                        <h2 class="f-title"><span id="form-title">Company Information</h2>
                    </div>
                    <div class="card-body f-card-body">
                        <form action="{{ route('admin.company.collection') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" value="{{ isset($items->id)? $items->id : null}}" hidden>
                            <div class="f-form-group">
                                <label>company logo</label>
                                <input type="file" class="form-control form-control-sm" name="image" />
                                @error('image')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                                <div class="row m-0 mt-2">
                                    <div class="col-md-6 p-1 img-thumbnail">
                                        <img src="{{ isset($items->image)? asset($items->image) : asset('assets/images/image-upload-demo.png') }}" alt=""
                                            class="img-thumbnail f-form-img">
                                    </div>
                                </div>
                            </div>
                            <div class="f-form-group">
                                <label>Company name</label>
                                <input type="text" class="form-control form-control-sm" name="name" value="{{ isset($items->name)? $items->name : null}}" />
                                @error('name')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>Company email address</label>
                                <input type="email" class="form-control form-control-sm" name="email" value="{{ isset($items->email)? $items->email : null}}" />
                                @error('email')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>Company phone number</label>
                                <input type="text" class="form-control form-control-sm" name="phone" value="{{ isset($items->phone)? $items->phone : null}}" />
                                @error('phone')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>Company address</label>
                                <textarea rows="4" class="form-control form-control-sm" name="address">{{ isset($items->address)? $items->address : null}}</textarea>
                                @error('address')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>Company Tax</label>
                                <input type="text" class="form-control form-control-sm" name="tax" value="{{ isset($items->tax)? $items->tax : null}}" />
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
    </div>
@endsection

@push('js')
    <script>
        // make slug
        $('#name').keyup(function() {
            let name = $(this).val().trim().toLowerCase();
            name = name.replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#slug').val(name);
        })

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

        // get single information base on sepacific id
        $('.edit').on('click', function() {
            let id = $(this).attr('data-target');
            axios.get('/admin/categories/show/' + id)
                .catch(errors => console.log(error))
                .then(res => {
                    $('#form-title').text("Update");
                    $('form').attr('action', '{{ Route('admin.category.update') }}');
                    $('input[name="id"]').val(res.data.id);
                    $('select[name="navigation"]').val(res.data.nav_id);
                    $('input[name="category_bn"]').val(res.data.category_bn);
                    $('input[name="category_en"]').val(res.data.category_en);
                    $('input[name="slug"]').val(res.data.slug);
                    $('select[name="status"]').val(res.data.status);
                    $('.f-form-img').attr('src', $(location).attr('protocol') + "//" + $(location).attr(
                        'host') + "/" + res.data.image);
                    $('button[type="submit"]').text("Update");
                })
        });

        // clear form field
        $("#form-clear").on('click', function() {
            $('#form-title').text("Insert");
            $('form').attr('action', '{{ Route('admin.admins.store') }}');
            $('.f-form-img').attr('src', $(location).attr('protocol') + "//" + $(location).attr(
                'host') + "/" + 'assets/images/image-upload-demo.png');
            $('button[type="submit"]').text("Save");
        })

        // delete data in database base on espacific id
        $('.delete').on('click', function() {
            let id = $(this).attr('data-target');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace("/admin/categories/trash/" + id);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
@endpush
