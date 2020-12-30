@extends('backend.layouts.master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manage Logo</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Logo</li>
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
                                <h3>Logo List
                                    @if($countLogo < 1)
                                        <a href="{{ route('logos.add') }}" class="btn btn-success btn-sm float-right"><i
                                                class="fa fa-plus-circle"></i> Add Logo</a>
                                    @endif
                                </h3>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($allData as $key => $logo)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img
                                                    src="{{ !empty($logo->image)? url('public/upload/logo_images/'.$logo->image): url('public/upload/no_image.png') }}"
                                                    width="120px" height="130px"></td>
                                            <td>
                                                <a title="Edit" href="{{ route('logos.edit', $logo->id) }}"
                                                   class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                <a title="Delete" id="delete"
                                                   href="{{ route('logos.delete', $logo->id) }}"
                                                   class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
@endsection
