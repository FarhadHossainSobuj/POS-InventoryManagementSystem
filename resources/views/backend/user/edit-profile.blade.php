@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-12">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3>Edit Profile
                                    <a href="{{ route('profiles.view') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-list"></i> Your Profile</a>
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{ route('profiles.update', $editUser->id) }}" id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label for="name">Name</label>
                                            <input class="form-control" type="text" value="{{ $editUser->name }}" name="name">
                                            <font style="color:red">{{ ($errors->has('name'))?($errors->first('name')):'' }}</font>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="email" value="{{ $editUser->email }}" name="email">
                                            <font style="color:red">{{ ($errors->has('email'))?($errors->first('email')):'' }}</font>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="mobile">Mobile No</label>
                                            <input class="form-control" type="text" value="{{ $editUser->mobile }}" name="mobile">
                                            <font style="color:red">{{ ($errors->has('mobile'))?($errors->first('mobile')):'' }}</font>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="address">Address</label>
                                            <input class="form-control" type="text" value="{{ $editUser->address }}" name="address">
                                            <font style="color:red">{{ ($errors->has('address'))?($errors->first('address')):'' }}</font>
                                        </div>

                                        <div class="form-group col-4">
                                            <label for="gender">Gender</label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="">Select Gender</option>
                                                <option value="Male" {{ ($editUser->gender == "Male"? 'selected': '') }}>Male</option>
                                                <option value="Female" {{ ($editUser->gender == "Female"? 'selected': '') }}>Female</option>
                                            </select>
                                            <font style="color:red">{{ ($errors->has('gender'))?($errors->first('gender')):'' }}</font>
                                        </div>

                                        <div class="form-group col-4">
                                            <label for="image">Image</label>
                                            <input type="file" name="image" class="form-control" id="image">
                                            <font style="color:red">{{ ($errors->has('image'))?($errors->first('image')):'' }}</font>
                                        </div>
                                        <div class="form-group col-2">
                                            <img id="showImage" src="{{ !empty($editUser->image)? url('public/upload/user_images/'.$editUser->image): url('public/upload/no_image.png') }}" style="width: 150px;height: 160px; border: 1px solid #000;">
                                        </div>

                                        <div class="form-group col-12">
                                            <input class="btn btn-primary" type="submit" value="Update">
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#myForm').validate({
                rules: {
                    usertype: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    name: {
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password2: {
                        required: true,
                        equalTo: '#password'
                    },
                },
                messages: {
                    usertype: {
                        required: "Please enter a role",
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    name: {
                        required: "Please provide a name",
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    password2: {
                        required: "Please provide confirm password",
                        equalTo: "Confirm password does not match"
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
