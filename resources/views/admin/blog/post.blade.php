@extends('layouts.admin.app')
@section('title','Blog Post')
{{--Page title--}}
@section('main_title','Blog')
@section('active_title','Post')
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
                    <h5 >Post List</h5>    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-category">Add Post</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                            <tr>

                                <th>No</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $index=>$post)
                                <tr>
                                    <td>{{++$index}}</td>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        <img src="{{asset($post->image)}}" style="width:80px" alt="iamge"/>
                                    </td>
                                    <td>
                                    @if($post->status == 'Inactive')
                                        <span class="badge badge-warning ">Inactive</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                                        @endif
                                        </td>
                                        <td>
                                            <button type="button"
                                                    data-title="{{$post->title}}"
                                                    data-image="{{$post->image}}"
                                                    data-category_id="{{$post->category_id}}"
                                                    data-description="{{$post->description}}"
                                                    data-id="{{$post->id}}"
                                                    class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#addFees1">
                                                Edit
                                            </button>
                                            <button  data-success_url="{{url('admin/posts')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/post/delete', $post->id) }}" class="btn btn-danger delete_brand"
                                                     data-id="{{ $post->id }}"  title="Delete">Delete</button>

                                            @if($post->status == 'Inactive')
                                                <button  data-success_url="{{url('admin/posts')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/post/active', $post->id) }}" class="btn btn-success active_brand"
                                                         data-id="{{ $post->id }}"  title="Active">Active</button>
                                            @else
                                                <button  data-success_url="{{url('admin/posts')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/post/inactive', $post->id) }}" class="btn btn-warning inactive_brand"
                                                         data-id="{{ $post->id }}"  title="InActive">Inactive</button>
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
        <div class="modal-dialog modal-lg" >
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitile"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form class="ajax-form-submit"   id="k" enctype="multipart/form-data"  method="POST">
                    <input type="hidden" class="success_url" value="{{url('admin/posts')}}">
                    <input type="hidden" class="submit_url" value="{{url('admin/post/store')}}">
                    <input type="hidden" class="method" value="POST">
                    <input type="hidden" class="id" name="id" value="">
                @csrf
                <!-- Modal body -->
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <label for="example-email-input" class=" col-form-label">Title</label>
                                    <input class="form-control title_modal" type="text" placeholder="Title" name="title" required>
                                    <span id="msg"></span>
                            </div>
                            <div class="col-md-4">
                                <label for="example-email-input" class=" col-form-label">Category</label>
                                <select class="form-control category_id_modal" name="category_id">
                                    <option>Select</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" value="" class="form-control image_modal" id="image">
                                <div id="modal-input-image"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control description_modal" placeholder="Description " name="description" required></textarea>
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
                $('#btn-save').html("Add Post");
                $('#k').trigger("reset");
                $('#modalTitile').html("Add New Post");
                $('#addCategory').modal('show');
            });
            /*  When user click add user button */
            $('.edit-btn').on('click', function (e) {
                e.preventDefault();
                var id        = $(this).data("id");
                var title    = $(this).data("title");
                var image  = $(this).data("image");
                var category_id  = $(this).data("category_id");
                var description  = $(this).data("description");

                $('.title_modal').val(title);
                $('.category_id_modal').val(category_id);
                $('.description_modal').val(description);
                $('.id').val(id);
                var post_image =  "<img src='"+ '{{asset('/')}}'+image+"' height='100' width='100'>";
                if(post_image){
                    $("#modal-input-image").html(post_image);
                }else{
                    $("#modal-input-image").style.display='none';
                }
                $('.k').trigger("reset");
                $('#modalTitile').html("Edit Post");
                $('#btn-save').html("Update Post");
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
                url:"{{url('admin/post/store')}}",
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
