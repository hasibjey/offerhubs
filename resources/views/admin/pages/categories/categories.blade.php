@extends('admin.layouts.muster')
@section('title', 'Categories Infromation')

@section('content')
    <div class="f-main-container">
        <div class="row m-0">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header f-card-header">
                        <div class="f-title">Categories information</div>
                    </div>
                    <div class="card-body f-card-body">
                        <form action="{{ route('admin.category') }}" method="get">
                            <div class="f-card-tooles">
                                <div class="row m-0">
                                    <div class="col-md-4">
                                        {{ Custom::PAGINATION_COUNTER($items, $pagination) }}
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-end">
                                        <input type="text" class="f-search" name="search"
                                            @isset($search) value="{{ $search }}" @endisset
                                            placeholder="Search item..." />
                                    </div>
                                </div>
                            </div>

                        </form>

                        @if (count($items))
                            <table class="table table-sm table-striped table-bordered" id="category-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>icon</th>
                                        <th>Category</th>
                                        <th>Navigation</th>
                                        <th>status</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                @foreach ($items as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <img src="{{ asset($category->image) }}" alt="{{ $category->category_en }}"
                                                class="table-img">
                                        </td>
                                        <td title="{{ $category->slug }}">{{ $category->category_bn }}</td>
                                        <td>{{ $category->nav_bn }}</td>
                                        <td>
                                            <small
                                                class="btn btn-sm w-100 py-0 {{ $category->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $category->status == 1 ? 'Active' : 'Dactive' }}</small>
                                        </td>
                                        <td>
                                            <button class="f-btn-t btn btn-sm btn-outline-danger delete"
                                                data-target="{{ $category->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <button class="f-btn-t btn btn-sm btn-outline-success edit"
                                                data-target="{{ $category->id }}">
                                                <i class="fa-solid fa-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="f-error text-center">Data no found!</p>
                        @endif

                        {{ $items->links('admin.layouts.pagination') }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header f-card-header">
                        <h2 class="f-title"><span id="form-title">Insert</span> Information</h2>
                    </div>
                    <div class="card-body f-card-body">
                        <form action="{{ Route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" hidden>
                            <div class="f-form-group">
                                <label>Navigation</label>
                                <select class="form-select form-select-sm" name="navigation">
                                    <option disabled selected>Select Navigation</option>
                                    @foreach ($navigation as $nav)
                                        <option value="{{ $nav->id }}">{{ $nav->nav_bn }}</option>
                                    @endforeach
                                </select>
                                @error('navigation')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>Category Name (Bangla)</label>
                                <input type="text" class="form-control form-control-sm" name="category_bn" />
                                @error('category_bn')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>Category Name (english)</label>
                                <input type="text" class="form-control form-control-sm" name="category_en"
                                    id="name" />
                                @error('category_en')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>slug</label>
                                <input type="text" class="form-control form-control-sm" name="slug" id="slug" />
                                @error('slug')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
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
                                <label>image</label>
                                <input type="file" class="form-control form-control-sm" name="image" />
                                @error('image')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                                <div class="row m-0 mt-2">
                                    <div class="col-md-6 p-1 img-thumbnail">
                                        {{-- <div class="row m-0">
                                            <div class="col-md-12 p-0">
                                                <button class="btn bnt-sm btn-outline-danger w-100 p-1" style="font-size:12px"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div> --}}
                                        <img src="{{ asset('assets/images/image-upload-demo.png') }}" alt=""
                                            class="img-thumbnail f-form-img">
                                    </div>
                                </div>
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
