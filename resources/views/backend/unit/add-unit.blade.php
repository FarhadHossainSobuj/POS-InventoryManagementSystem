@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Unit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Unit</li>
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
                                <h3>Add Unit
                                    <a href="{{ route('units.index') }}" class="btn btn-success btn-sm float-right"><i
                                            class="fa fa-list"></i> Unit List</a>
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{ route('units.store') }}" id="myForm">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label for="name">Unit Name</label>
                                            <input class="form-control" type="text" name="name">
                                            <font
                                                style="color:red">{{ ($errors->has('name'))?($errors->first('name')):'' }}</font>
                                        </div>
                                        <div class="form-group col-12">
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
                    name: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                    address: {
                        required: true,
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
