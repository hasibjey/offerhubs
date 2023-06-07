@extends('admin.layouts.muster')
@section('title', 'Customers Infromation')

@section('content')
    <div class="f-main-container">
        <div class="row m-0">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header f-card-header">
                        <div class="f-title">Customers information</div>
                    </div>
                    <div class="card-body f-card-body">
                        <form action="{{ route('admin.customer') }}" method="get">
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
                            <table class="table table-sm table-striped table-bordered" id="customer-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>phone</th>
                                        <th>email</th>
                                        <th>action</th>
                                    </tr>
                                </thead>
                                @foreach ($items as $key => $customer)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td> {{ $customer->name }} </td>
                                        <td">{{ $customer->phone }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <button class="f-btn-t btn btn-sm btn-outline-info delete"
                                                data-target="{{ $category->id }}">
                                                <i class="fa-solid fa-eye"></i>
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
