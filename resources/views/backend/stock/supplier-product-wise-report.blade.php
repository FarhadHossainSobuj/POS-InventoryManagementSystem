@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Supplier/Product Wise Stock</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
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
                                <h3>
                                    Select Criteria
                                    <!--<a href="{{ route('stocks.report.pdf') }}" target="_blank" class="btn btn-success btn-sm float-right"> <i
                                            class="fa fa-download"></i> Download PDF</a>-->
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <strong>
                                            Supplier wise report
                                        </strong>
                                        <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value"> &nbsp;&nbsp;
                                        <strong>
                                            Product wise report
                                        </strong>
                                        <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value"> &nbsp;&nbsp;
                                    </div>
                                </div>
                                <div class="show_supplier">
                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-8">
                                                <label>Supplier Name</label>
                                                <select name="supplier_id" class="form-control select2">
                                                    <option value="">Select Supplier</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

