@extends('admin.layouts.muster')
@section('title', 'Navigation Infromation')

@section('content')
    <div class="f-main-container">
        <div class="row m-0">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header f-card-header">
                        <div class="f-title">Navigation information</div>
                    </div>
                    <div class="card-body f-card-body">
                        
                        <form action="{{ route('admin.navigation') }}" method="get">
                            <div class="f-card-tooles">
                                <div class="row m-0">
                                    <div class="col-md-4">
                                        {{ Custom::PAGINATION_COUNTER($items, $pagination) }}
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4 text-end">
                                        <input type="text" class="f-search" name="search" @isset($search) value="{{ $search }}" @endisset placeholder="Search item..." />
                                    </div>
                                </div>
                            </div>

                        </form>

                        @if (count($items))
                        <table class="table table-sm table-striped table-bordered" id="navigation-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>bangla</th>
                                    <th>position</th>
                                    <th>status</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            @foreach ($items as $key => $nav)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td title="{{ $nav->slug }}">{{ $nav->nav_bn }}</td>
                                    <td>{{ $nav->position }}</td>
                                    <td>
                                        <small
                                            class="btn btn-sm w-100 py-0 {{ $nav->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $nav->status == 1 ? 'Active' : 'Dactive' }}</small>
                                    </td>
                                    <td>
                                        <button class="f-btn-t btn btn-sm btn-outline-danger delete"
                                            data-target="{{ $nav->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                        <button class="f-btn-t btn btn-sm btn-outline-success edit"
                                            data-target="{{ $nav->id }}">
                                            <i class="fa-solid fa-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <p class="f-error text-center">Data no found!</p>
                        @endif

                        {{$items->links('admin.layouts.pagination')}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header f-card-header">
                        <h2 class="f-title"><span id="form-title">Insert</span> Information</h2>
                    </div>
                    <div class="card-body f-card-body">
                        <form action="{{ Route('admin.navigation.store') }}" method="POST">
                            @csrf
                            <input type="text" name="id" hidden>
                            <div class="f-form-group">
                                <label>Navigation Name (Bangla)</label>
                                <input type="text" class="form-control form-control-sm" name="nav_bn" />
                                @error('nav_bn')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>navigation Name (english)</label>
                                <input type="text" class="form-control form-control-sm" name="nav_en" />
                                @error('nav_en')
                                    <samp class="f-error">{{ $message }}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>Slug</label>
                                <input type="text" class="form-control form-control-sm" name="slug" />
                                @error('slug')
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
                                <label>status</label>
                                <select class="form-select form-select-sm" name="status">
                                    <option value="1" selected>Active</option>
                                    <option value="0">Dactive</option>
                                </select>
                                @error('status')
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
        // make slug
        $('input[name="nav_en"]').keyup(function() {
            let name = $(this).val().trim().toLowerCase();
            name = name.replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('input[name="slug"]').val(name);
        });

        // get single information base on sepacific id
        $('.edit').on('click', function() {
            let id = $(this).attr('data-target');
            axios.get('/admin/navigation/show/' + id)
                .catch(errors => console.log(error))
                .then(res => {
                    $('#form-title').text("Update");
                    $('form').attr('action', '{{ Route('admin.navigation.update') }}');
                    $('input[name="id"]').val(res.data.id);
                    $('input[name="nav_bn"]').val(res.data.nav_bn);
                    $('input[name="nav_en"]').val(res.data.nav_en);
                    $('input[name="slug"]').val(res.data.slug);
                    $('input[name="position"]').val(res.data.position);
                    $('select[name="status"]').val(res.data.status);
                    $('button[type="submit"]').text("Update");
                })
        });

        // clear form field
        $("#form-clear").on('click', function() {
            $('#form-title').text("Insert");
            $('form').attr('action', '{{ Route('admin.navigation.store') }}');
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
                    window.location.replace("/admin/navigation/trash/" + id);
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
