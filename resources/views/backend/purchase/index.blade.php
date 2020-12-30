@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Purchase</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Purchase</li>
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
                                    All Purchase
                                    <a href="{{ route('purchases.add') }}" class="btn btn-success btn-sm float-right">
                                        <i
                                            class="fa fa-list"></i> Add Purchase</a>
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Purchase no</th>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Category</th>
                                            <th>Product Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Buying Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($purchases as $key => $purchase)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$purchase->purchase_no}}</td>
                                                <td>{{ date('d-m-Y', strtotime($purchase->date)) }}</td>
                                                <td>{{$purchase->supplier->name}}</td>
                                                <td>{{$purchase->category->name}}</td>
                                                <td>{{$purchase->product->name}}</td>
                                                <td>{{$purchase->description}}</td>
                                                <td>{{$purchase->buying_qty}}</td>
                                                <td>{{$purchase->unit_price}}</td>
                                                <td>{{$purchase->buying_price}}</td>
                                                <td>
                                                    @if($purchase->status==0)
                                                        <span class="btn btn-sm btn-danger">Pending</span>
                                                    @else
                                                        <span class="btn btn-sm btn-success">Approved</span>
                                                @endif
                                                <td>
                                                    <a href="{{route('purchases.edit', $purchase->id)}}"
                                                       class="btn btn-sm btn-info"> <i
                                                            class="fas fa-pen"></i>
                                                    </a>
                                                    @if($purchase->status==0)
                                                        <a title="Delete" id="delete"
                                                           href="{{ route('purchases.delete', $purchase->id) }}"
                                                           class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>
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

