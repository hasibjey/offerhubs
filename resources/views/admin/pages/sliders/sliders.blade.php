@extends('admin.layouts.muster')
@section('title', 'Sliders Infromation')

@section('content')
    <div class="f-main-container">
        <div class="row m-0">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header f-card-header">
                        <div class="f-title">Sliders information</div>
                    </div>
                    <div class="card-body f-card-body">
                        @if (count($items))
                            <div class="f-card-tooles">
                                <div class="row m-0">
                                    <div class="col-md-4">
                                        <select class="f-select" id="maxData">
                                            @for ($i = 10; $i <= 100; $i += 10)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                            <option value="{{ count($items) }}">All</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-end">
                                        <input type="text" class="f-search" placeholder="Search item..." />
                                    </div>
                                </div>
                            </div>

                            <div class="f-table" id="sliders-table">
                                <div class="f-row f-row-head">
                                    <div class="f-col">#</div>
                                    <div class="f-col">image</div>
                                    <div class="f-col">status</div>
                                    <div class="f-col">position</div>
                                    <div class="f-col">action</div>
                                </div>
                                @foreach ($items as $key => $slider)
                                    <div class="f-row" id="row">
                                        <div class="f-col">{{ $key + 1 }}</div>
                                        <div class="f-col">
                                            <a href="{{ $slider->url }}">
                                                <img src="{{ asset($slider->image) }}" class="f-table-img">
                                            </a>
                                        </div>
                                        <div class="f-col">
                                            <small
                                                class="btn btn-sm px-4 py-0 {{ $slider->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $slider->status == 1 ? 'Active' : 'Dactive' }}</small>
                                        </div>
                                        <div class="f-col">{{ $slider->position }}</div>
                                        <div class="f-col">
                                            <button class="f-btn-t btn btn-sm btn-outline-danger delete"
                                                data-target="{{ $slider->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <button class="f-btn-t btn btn-sm btn-outline-success edit"
                                                data-target="{{ $slider->id }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <ul class="f-pagination"></ul>
                        @else
                            <p class="f-error text-center">Data no found!</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header f-card-header">
                        <h2 class="f-title"><span id="form-title">Insert</span> Information</h2>
                    </div>
                    <div class="card-body f-card-body">
                        <form action="{{ Route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" hidden>
                            <div class="f-form-group">
                                <label>image <small>(1920*420)</small></label>
                                <input type="file" class="form-control form-control-sm" name="image" />
                                @error('image')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                                <div class="row m-0 mt-2">
                                    <div class="col-md-6 p-1 img-thumbnail">
                                        <img src="{{ asset('assets/images/image-upload-demo.png') }}" alt=""
                                            class="img-thumbnail f-form-img">
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="f-form-group">
                                <label>image for mobile <small>(375*420)</small></label>
                                <input type="file" class="form-control form-control-sm" name="image_mobile" />
                                @error('image')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                                <div class="row m-0 mt-2">
                                    <div class="col-md-6 p-1 img-thumbnail">
                                        <img src="{{ asset('assets/images/image-upload-demo.png') }}" alt=""
                                            class="img-thumbnail f-form-img_mobile">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="f-form-group">
                                <label>status</label>
                                <select class="form-select form-select-sm" name="status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Dactive</option>
                                </select>
                                @error('status')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>position</label>
                                <input type="text" class="form-control form-control-sm" name="position" />
                                @error('position')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>URL</label>
                                <input type="text" class="form-control form-control-sm" name="url" />
                                @error('url')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group mt-3 text-center">
                                <button class="btn btn-sm btn-outline-danger px-5" type="reset"
                                    id="form-clear">Clear</button>
                                <button class="btn btn-sm btn-outline-success px-5" type="submit"
                                    id="form-submit">Save</button>
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
        $("input[name='image']").change(function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                $(".f-form-img").attr('src', reader.result)
            }
            reader.readAsDataURL(file);
        });
        $("input[name='image_mobile']").change(function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                $(".f-form-img_mobile").attr('src', reader.result)
            }
            reader.readAsDataURL(file);
        });

        // get single information base on sepacific id
        $('.edit').on('click', function() {
            let id = $(this).attr('data-target');
            axios.get('/admin/sliders/show/' + id)
                .catch(errors => console.log(error))
                .then(res => {
                    $('#form-title').text("Update");
                    $('form').attr('action', '{{ Route('admin.slider.update') }}');
                    $('input[name="id"]').val(res.data.id);
                    $('.f-form-img').attr('src', $(location).attr('protocol') + "//" + $(location).attr(
                        'host') + "/" + res.data.image);
                    $('input[name="status"]').val(res.data.status);
                    $('input[name="url"]').val(res.data.url);
                    $('option').removeAttr('selected')
                    if (res.data.status == 1) {
                        $('option[value="1"]').attr('selected', 'selected')
                    } else {
                        $('option[value="0"]').attr('selected', 'selected')
                    }
                    $('input[name="position"]').val(res.data.position);
                    $('button[type="submit"]').text("Update");
                })
        });

        // clear form field
        $("#form-clear").on('click', function() {
            $('#form-title').text("Insert");
            $('form').attr('action', '{{ Route('admin.slider.store') }}');
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
                    window.location.replace("/admin/sliders/trash/" + id);
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
