@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Password</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">password</li>
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
                                <h3>Edit Password
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{ route('profiles.password.update') }}" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label for="old_password">Old Password</label>
                                            <input class="form-control" type="password" name="old_password" id="old_password">
                                            <font style="color:red">{{ ($errors->has('password'))?($errors->first('password')):'' }}</font>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="password">New Password</label>
                                            <input class="form-control" type="password" name="new_password" id="new_password">
                                            <font style="color:red">{{ ($errors->has('new_password'))?($errors->first('new_password')):'' }}</font>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="password">Confirm Password</label>
                                            <input class="form-control" type="password" name="password2">
                                            <font style="color:red">{{ ($errors->has('password2'))?($errors->first('password2')):'' }}</font>
                                        </div>
                                        <div class="form-group col-6">
                                            <input class="btn btn-primary" type="submit" value="Submit">
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
                    old_password: {
                        required: true,
                        minlength: 6
                    },
                    new_password: {
                        required: true,
                        minlength: 6
                    },
                    password2: {
                        required: true,
                        equalTo: '#new_password'
                    },
                },
                messages: {
                    old_password: {
                        required: "Please provide old password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    new_password: {
                        required: "Please provide new password",
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
