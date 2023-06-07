@extends('admin.layouts.muster')
@section('title', 'Admins Infromation')

@section('content')
    <div class="f-main-container">
        <div class="row m-0">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header f-card-header">
                        <div class="f-title">admins information</div>
                        <div class="f-button">
                            <button class="f-btn btn btn-sm btn-outline-success px-3">
                                <i class="fa-solid fa-plus"></i>
                                Add admin
                            </button>
                        </div>
                    </div>
                    <div class="card-body f-card-body">
                        <div class="f-card-tooles">
                            <div class="row m-0">
                                <div class="col-md-4">
                                    <select class="f-select" id="maxData">
                                        @for($i = 10; $i <= 100; $i += 10)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                        <option value="{{count($items)}}">All</option>
                                    </select>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4 text-end">
                                    <input type="text" class="f-search" placeholder="Search item..." />
                                </div>
                            </div>
                        </div>

                        <div class="f-table" id="admins-table">
                            <div class="f-row f-row-head">
                                <div class="f-col">#</div>
                                <div class="f-col">name</div>
                                <div class="f-col">email</div>
                                <div class="f-col">type</div>
                                <div class="f-col">action</div>
                            </div>
                            @foreach ($items as $key=>$admin)
                            <div class="f-row" id="row">
                                <div class="f-col">{{$key+1}}</div>
                                <div class="f-col">{{$admin->name}}</div>
                                <div class="f-col">{{$admin->email}}</div>
                                <div class="f-col">
                                    @if ($admin->type == 1)
                                    Viewer
                                    @elseif ($admin->type == 2)
                                    Editor
                                    @else
                                    Admin
                                    @endif
                                </div>
                                <div class="f-col">
                                    <button class="f-btn-t btn btn-sm btn-outline-danger delete" data-target="{{$admin->id}}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    <button class="f-btn-t btn btn-sm btn-outline-success edit" data-target="{{$admin->id}}">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <ul class="f-pagination">
                            <li class="f-page-item f-page-active">1</li>
                            <li class="f-page-item">2</li>
                            <li class="f-page-item">3</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header f-card-header">
                        <h2 class="f-title"><span id="form-title">Insert</span> Information</h2>
                    </div>
                    <div class="card-body f-card-body">
                        <form action="{{ Route('admin.admins.store')}}" method="POST">
                            @csrf
                            <input type="text" name="id" hidden>
                            <div class="f-form-group">
                                <label>Name</label>
                                <input type="text" class="form-control form-control-sm" name="name" />
                                @error('name')
                                    <samp class="f-error">{{$message}}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>Email</label>
                                <input type="email" class="form-control form-control-sm" name="email" />
                                @error('email')
                                    <samp class="f-error">{{$message}}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group">
                                <label>Type</label>
                                <select class="form-select form-select-sm" name="type">
                                    <option value="null" disabled selected>Select Admin Type</option>
                                    <option value="1">Viwer</option>
                                    <option value="2">Editor</option>
                                    <option value="3">Admin</option>
                                </select>
                                @error('type')
                                    <samp class="f-error">{{$message}}</samp>
                                @enderror
                            </div>
                            <div class="f-form-group mt-3 text-center">
                                <button class="btn btn-sm btn-outline-danger px-5" type="reset" id="form-clear">Clear</button>
                                <button class="btn btn-sm btn-outline-success px-5" type="submit" id="form-submit">Save</button>
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
      $(document).ready(function () {
        /**
         * max data show will data
         * pagination data
         */
        var maxData = parseInt($("#maxData").val());
        var totalRows = $(".f-table > #row").length;
        //this section for pagination
        pagination(maxData, totalRows);

        //this section work after change the show field value
        $("#maxData").on("change", function () {
          var maxData = parseInt($(this).val());
          var totalRows = $(".f-table > #row").length;
          //this section for pagination
          pagination(maxData, totalRows);
        });

        /**
         * search data in table
         * pagination search data
         */
        searching();
      });

      // get single information base on sepacific id
      $('.edit').on('click', function(){
        let id = $(this).attr('data-target');
        axios.get('/admin/show/'+id)
        .catch(errors => console.log(error))
        .then(res => {
            $('#form-title').text("Update");
            $('form').attr('action', '{{ Route('admin.admins.update')}}');
            $('input[name="id"]').val(res.data.id);
            $('input[name="name"]').val(res.data.name);
            $('input[name="email"]').val(res.data.email);
            $('select[name="type"]').val(res.data.type);
            $('button[type="submit"]').text("Update");
        })
      });

      // clear form field
      $("#form-clear").on('click', function(){
        $('#form-title').text("Insert");
        $('form').attr('action', '{{ Route('admin.admins.store')}}');
        $('button[type="submit"]').text("Save");
      })

      // delete data in database base on espacific id
      $('.delete').on('click', function(){
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
                window.location.replace("/admin/trash/"+id);
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
