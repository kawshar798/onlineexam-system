@extends('layouts.admin.app')
@section('title','Blog Category')
{{--Page title--}}
@section('main_title','Blog')
@section('active_title','Category')
@push('css')

@endpush
@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 >Category List</h5>    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-category">Add Category</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                            <tr>

                                <th>No</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $index=>$category)
                                <tr>
                                    <td>{{++$index}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                    @if($category->status == 'Inactive')
                                        <span class="badge badge-warning ">Inactive</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                                        @endif
                                        </td>
                                        <td>
                                            <button type="button" data-name="{{$category->name}}"  data-id="{{$category->id}}" class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#addFees1">
                                                Edit
                                            </button>
                                            <button  data-success_url="{{url('admin/category')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/category/delete', $category->id) }}" class="btn btn-danger delete_brand"
                                                     data-id="{{ $category->id }}"  title="Delete">Delete</button>

                                            @if($category->status == 'Inactive')
                                                <button  data-success_url="{{url('admin/category')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/category/active', $category->id) }}" class="btn btn-success active_brand"
                                                         data-id="{{ $category->id }}"  title="Active">Active</button>
                                            @else
                                                <button  data-success_url="{{url('admin/category')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/category/inactive', $category->id) }}" class="btn btn-warning inactive_brand"
                                                         data-id="{{ $category->id }}"  title="InActive">Inactive</button>
                                            @endif
                                        </td>
                                </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic table  -->
        <!-- ============================================================== -->
    </div>


    <!-- The Modal for Create -->
    <div class="modal" id="addCategory">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitile"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form class="ajax-form-submit"   id="k"  method="POST">
                    <input type="hidden" class="success_url" value="{{url('admin/categories')}}">
                    <input type="hidden" class="submit_url" value="{{url('admin/category/store')}}">
                    <input type="hidden" class="method" value="POST">
                    <input type="hidden" class="id" name="id" value="">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Name</label>
                            <div class="col-sm-9">
                                <input class="form-control name_modal" type="text" placeholder="Category  Name" name="name" required>
                                <span id="msg"></span>
                            </div>
                        </div>

                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="btn-save"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    @parent
    <script>
        $(document).ready(function () {
            /*  When user click add user button */
            $('#create-new-category').click(function () {
                $('#btn-save').html("Add Category");
                $('#k').trigger("reset");
                $('#modalTitile').html("Add New Category");
                $('#addCategory').modal('show');
            });

            /*  When user click add user button */
            $('.edit-btn').on('click', function (e) {
                e.preventDefault();
                var id        = $(this).data("id");
                var name    = $(this).data("name");
                $('.name_modal').val(name);
                $('.id').val(id);
                $('.k').trigger("reset");
                $('#modalTitile').html("Edit Category");
                $('#btn-save').html("Update Category");
                $('#addCategory').modal('show');
            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

            });
        });

        //Store Category
        $(document).on('submit', '.ajax-form-submit', function(e) {
            e.preventDefault();
            var submit_url = $(this).attr("submit_url");
            var success_url = $(this).attr("success_url");
            var fd = new FormData(document.getElementById("k"));
            $.ajax({
                method: 'POST',
                url:"{{url('admin/category/store')}}",
                data:fd,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.success == true) {
                        $('#addCategory').modal('hide');
                        toastr.success(result.messege);
                        location.reload(success_url);

                    } else {
                        console.log(result.messege)
                        toastr.error(result.messege);
                    }
                },
            });
        });

        // Category Active
        $(document).on('click', '.active_brand', function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            var success_url = $(this).data("success_url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title:"Are You Sure Active this?",
                // text: " ",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax(
                        {
                            url: url,
                            success_url:success_url,
                            type: 'PUT',
                            data: {
                                _token: token,
                                id: id
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.messege);
                                    // setTimeout(function(){
                                    location.reload(success_url);
                                    // },  2000);
                                } else {
                                    toastr.error(result.messege);
                                }
                            },
                        });
                }
            });
        });

        // Category Inactive
        $(document).on('click', '.inactive_brand', function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            var success_url = $(this).data("success_url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title:"Are You Sure Inactive this?",
                // text: " ",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax(
                        {
                            url: url,
                            success_url:success_url,
                            type: 'PUT',
                            data: {
                                _token: token,
                                id: id
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.messege);
                                    // setTimeout(function(){
                                    location.reload(success_url);
                                    // },  2000);
                                } else {
                                    toastr.error(result.messege);
                                }
                            },
                        });
                }
            });
        });



        // Category Delete
        $(document).on('click', '.delete_brand', function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            var success_url = $(this).data("success_url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title:"Are You Sure Delete this?",
                // text: " ",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax(
                        {
                            url: url,
                            success_url:success_url,
                            type: 'DELETE',
                            data: {
                                _token: token,
                                id: id
                            },
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.messege);
                                    // setTimeout(function(){
                                    location.reload(success_url);
                                    // },  2000);
                                } else {
                                    toastr.error(result.messege);
                                }
                            },
                        });
                }
            });
        });

    </script>
@stop
