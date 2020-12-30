@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Invoice</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
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
                                    Pending Invoices
                                    {{--<a href="{{ route('invoice.add') }}" class="btn btn-success btn-sm float-right">
                                        <i
                                            class="fa fa-list"></i> Add Invoice</a>--}}
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Customer Name</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($invoices as $key => $invoice)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    {{$invoice->payment->customer->name}} -
                                                    {{$invoice->payment->customer->phone}} -
                                                    {{$invoice->payment->customer->address}}

                                                </td>
                                                <td>Invoice No #{{ $invoice->invoice_no }}</td>
                                                <td>{{ date('d-m-Y', strtotime($invoice->date)) }}</td>
                                                <td>{{$invoice->description}}</td>
                                                <td>{{$invoice['payment']['total_amount']}}</td>
                                                <td>
                                                    @if($invoice->status==0)
                                                        <span style="background: #fc4246; padding: 5px;" class="btn btn-sm btn-danger">Pending</span>
                                                    @else
                                                        <span style="background: #fc4246; padding: 5px;" class="btn btn-sm btn-success">Approved</span>
                                                @endif
                                                <td>
                                                    @if($invoice->status==0)
                                                        <a title="Approve"
                                                           href="{{ route('invoice.approve', $invoice->id) }}"
                                                           class="btn btn-sm btn-success"><i class="fa fa-check-circle"></i></a>
                                                        <a title="Delete" id="delete"
                                                           href="{{ route('invoice.delete', $invoice->id) }}"
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
