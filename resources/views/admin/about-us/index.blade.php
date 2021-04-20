@extends('layouts.admin.app')
@section('title','About us')
{{--Page title--}}
@section('main_title','About us')
@section('active_title','About us')

@section('content')
    <div class="row">
        <!-- ============================================================== -->
        <!-- basic table  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>About us </h5>
                </div>

                <div class="card-body">
                    <form method="post" action="{{url('admin/about-us')}}" enctype="multipart/form-data">
                        @csrf
                        <div class=" row">
                            <div class="col-md-6">
                                <label for="example-email-input" class=" col-form-label">Title</label>

                                    <input class="form-control name_modal" type="text" placeholder="Title"
                                           name="title" required="" value="{{isset($about_us->title)?$about_us->title:''}}">
                                    <span id="msg"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="example-email-input" class=" col-form-label">Image</label>

                                        <input class="form-control name_modal" type="file" placeholder="Image"
                                               name="image" required="">

                                    @isset($about_us->image)
                                        <img src="{{asset($about_us->image)}}"  width="150px"/>
                                    @endisset


                                </div>
                            <div class="col-md-12">
                                <label for="example-email-input" class=" col-form-label">Description</label>
                                <textarea class="form-control" name="description">
                                    @isset($about_us->description)
                                        {{$about_us->description}}
                                    @endisset </textarea>
                            </div>
                            <div class="col-md-12 mt-5 d-flex justify-content-center">
                               <button class="btn btn-primary">Submit</button>
                            </div>
                            </div>

                    </form>

                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end basic table  -->
        <!-- ============================================================== -->
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
                var id = $(this).data("id");
                var name = $(this).data("name");
                var email = $(this).data("email");
                var facebook = $(this).data("facebook");
                var image = $(this).data("image");
                $('.name_modal').val(name);
                $('.email_modal').val(email);
                $('.facebook_modal').val(facebook);
                $('.id').val(id);
                var post_image = "<img src='" + '{{asset('/')}}' + image + "' height='100' width='100'>";
                if (post_image) {
                    $("#modal-input-image").html(post_image);
                } else {
                    $("#modal-input-image").style.display = 'none';
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
        $(document).on('submit', '.ajax-form-submit', function (e) {
            e.preventDefault();
            var submit_url = $(this).attr("submit_url");
            var success_url = $(this).attr("success_url");
            var fd = new FormData(document.getElementById("k"));
            $.ajax({
                method: 'POST',
                url: "{{url('admin/team/store')}}",
                data: fd,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function (result) {
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
        $(document).on('click', '.active_brand', function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            var success_url = $(this).data("success_url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "Are You Sure Active this?",
                // text: " ",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax(
                        {
                            url: url,
                            success_url: success_url,
                            type: 'PUT',
                            data: {
                                _token: token,
                                id: id
                            },
                            success: function (result) {
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
        $(document).on('click', '.inactive_brand', function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            var success_url = $(this).data("success_url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "Are You Sure Inactive this?",
                // text: " ",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax(
                        {
                            url: url,
                            success_url: success_url,
                            type: 'PUT',
                            data: {
                                _token: token,
                                id: id
                            },
                            success: function (result) {
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
        $(document).on('click', '.delete_brand', function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            var url = $(this).data("url");
            var success_url = $(this).data("success_url");
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "Are You Sure Delete this?",
                // text: " ",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(willDelete => {
                if (willDelete) {
                    $.ajax(
                        {
                            url: url,
                            success_url: success_url,
                            type: 'DELETE',
                            data: {
                                _token: token,
                                id: id
                            },
                            success: function (result) {
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
