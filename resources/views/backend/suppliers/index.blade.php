{{--@extends('backend.layouts.master')

@section('content')

    <div class="container-fluid">
        <h1 class="mt-4"></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="">Home</a></li>
            <li class="breadcrumb-item active">Supplier</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Supplier List
                <a class="btn btn-success btn-sm  float-right " href="{{route('suppliers.create')}}">Create Supplier</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td>{{$supplier->name}}</td>
                                <td>{{$supplier->phone}}</td>
                                <td>{{$supplier->email}}</td>
                                <td>{{$supplier->address}}</td>

                                <td>
                                    <form action="{{route('suppliers.destroy', $supplier->id)}}" method="Post">
                                        <a href="{{route('suppliers.edit', $supplier->id)}}"> <i class="fas fa-pen"></i>
                                            Edit</a>

                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link" type="submit"><i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>


                            </tr>
                        @empty
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection--}}
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
                                    <a href="{{ route('suppliers.create') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add Supplier</a>
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @forelse($suppliers as $supplier)
                                            <tr>
                                                <td>{{$supplier->name}}</td>
                                                <td>{{$supplier->phone}}</td>
                                                <td>{{$supplier->email}}</td>
                                                <td>{{$supplier->address}}</td>

                                                @php
                                                    $count_supplier = \App\Models\Product::where('supplier_id', $supplier->id)->count();
                                                @endphp

                                                <td>
                                                        <a href="{{route('suppliers.edit', $supplier->id)}}" class="btn btn-sm btn-info"> <i class="fas fa-pen"></i>
                                                            </a>
                                                    @if($count_supplier<1)
                                                    <a title="Delete" id="delete" href="{{ route('suppliers.delete', $supplier->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

