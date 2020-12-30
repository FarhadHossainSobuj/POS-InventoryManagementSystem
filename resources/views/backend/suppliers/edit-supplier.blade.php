@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Supplier</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Supplier</li>
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
                                <h3>Add Supplier
                                    <a href="{{ route('suppliers.index') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-list"></i> User List</a>
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <form method="post" action="{{ route('suppliers.update', $supplier->id) }}" id="myForm">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col-4">
                                            <label for="name">Name</label>
                                            <input class="form-control" type="text" name="name" value="{{ $supplier->name }}">
                                            <font style="color:red">{{ ($errors->has('name'))?($errors->first('name')):'' }}</font>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="phone">Phone</label>
                                            <input class="form-control" type="text" name="phone" value="{{ $supplier->phone }}">
                                            <font style="color:red">{{ ($errors->has('phone'))?($errors->first('phone')):'' }}</font>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="email" name="email"  value="{{ $supplier->email }}">
                                            <font style="color:red">{{ ($errors->has('email'))?($errors->first('email')):'' }}</font>
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" name="address" rows="3">{{ $supplier->address }}</textarea>
                                            <font style="color:red">{{ ($errors->has('address'))?($errors->first('address')):'' }}</font>
                                        </div>
                                        <input type="hidden" id="created_by" name="created_by" value="{{ Auth::user()->id }}">
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
