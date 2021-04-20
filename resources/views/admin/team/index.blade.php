@extends('layouts.admin.app')
@section('title','Blog Category')
{{--Page title--}}
@section('main_title','Team')
@section('active_title','Team')
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
                    <h5 >Team List</h5>    <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-category">Add Team</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                            <tr>

                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Facebook Link</th>
                                <th>photo</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $index=>$team)
                                <tr>
                                    <td>{{++$index}}</td>
                                    <td>{{$team->name}}</td>
                                    <td>{{$team->email}}</td>
                                    <td>
                                        <a href="{{$team->facebook}}">Facebook</a>
                                    </td>
                                    <td>
                                        <img src="{{asset($team->photo)}}" style="width:80px" alt="iamge"/>
                                    </td>
                                    <td>
                                    @if($team->status == 'Inactive')
                                        <span class="badge badge-warning ">Inactive</span>
                                    @else
                                        <span class="badge badge-success">Active</span>
                                        @endif
                                        </td>
                                        <td>
                                            <button type="button"
                                                    data-name="{{$team->name}}"
                                                    data-email="{{$team->email}}"
                                                    data-facebook="{{$team->facebook}}"
                                                    data-image="{{$team->photo}}"
                                                    data-id="{{$team->id}}"
                                                    class="btn btn-primary m-3 edit-btn" data-toggle="modal" data-target="#addFees1">
                                                Edit
                                            </button>
                                            <button  data-success_url="{{url('admin/teams')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/team/delete', $team->id) }}" class="btn btn-danger delete_brand"
                                                     data-id="{{ $team->id }}"  title="Delete">Delete</button>

                                            @if($team->status == 'Inactive')
                                                <button  data-success_url="{{url('admin/teams')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/team/active', $team->id) }}" class="btn btn-success active_brand"
                                                         data-id="{{ $team->id }}"  title="Active">Active</button>
                                            @else
                                                <button  data-success_url="{{url('admin/teams')}}" data-token="{{ csrf_token() }}" data-url="{{ url('admin/team/inactive', $team->id) }}" class="btn btn-warning inactive_brand"
                                                         data-id="{{ $team->id }}"  title="InActive">Inactive</button>
                                            @endif
                                        </td>
                                </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Facebook Link</th>
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
                    <input type="hidden" class="success_url" value="{{url('admin/teams')}}">
                    <input type="hidden" class="submit_url" value="{{url('admin/team/store')}}">
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
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Image</label>
                            <div class="col-sm-9">
                                <input type="file" name="image" value="" class="form-control image_modal" id="image">
                                <div id="modal-input-image"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input class="form-control email_modal" type="text" placeholder="Email  Name" name="email" required>
                                <span id="msg"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-email-input" class="col-sm-3 col-form-label">Facebook Link</label>
                            <div class="col-sm-9">
                                <input class="form-control facebook_modal" type="text" placeholder="Facebook  Link" name="facebook" required>
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
                $('#btn-save').html("Add Team Member");
                $('#k').trigger("reset");
                $('#modalTitile').html("Add New Team Member");
                $('#addCategory').modal('show');
            });

            /*  When user click add user button */
            $('.edit-btn').on('click', function (e) {
                e.preventDefault();
                var id        = $(this).data("id");
                var name    = $(this).data("name");
                var email    = $(this).data("email");
                var facebook    = $(this).data("facebook");
                var image  = $(this).data("image");
                $('.name_modal').val(name);
                $('.email_modal').val(email);
                $('.facebook_modal').val(facebook);
                $('.id').val(id);
                var post_image =  "<img src='"+ '{{asset('/')}}'+image+"' height='100' width='100'>";
                if(post_image){
                    $("#modal-input-image").html(post_image);
                }else{
                    $("#modal-input-image").style.display='none';
                }
                $('.k').trigger("reset");
                $('#modalTitile').html("Edit Team Member");
                $('#btn-save').html("Update Team Member");
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
                url:"{{url('admin/team/store')}}",
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
