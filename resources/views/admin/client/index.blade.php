@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Client</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">

        <div class="row">
            <div class="col-12">

                @if (session('message'))
                    <div class="callout callout-success alert-dismissible">
                        <button type="button" class="close close-alert" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ session('message') }}</p>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('client/create') }}" class="btn btn-default">Add New</a>

                        <div class="card-tools">
                            <form method="GET">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Expires</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            @foreach( $data as $key => $d )
                                <tr>
                                    <td class="no">{{ $key + 1 }}</td>
                                    <td>{{ $d['name'] }}</td>
                                    <td>{{ $d['email'] }}</td>
                                    <td>
                                        @if(!empty($d['expires_at']))
                                            {{ $d['expires_at'] }} |
                                            <form style="display: inline" action="{{ url('client/newex/'.$d['id'])}}"
                                                  method="post">
                                                <input type="hidden" name="_method" value="POST">
                                                {{ csrf_field() }}
                                                <button class="btn-text" type="submit">
                                                    New
                                                </button>
                                            </form>
                                         @endif
                                    </td>
                                    <td>{{ $d['created_at'] }}</td>
                                    <td class="no">
                                        <a href="{{ url('client/'.$d['id'].'/edit') }}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form style="display: inline" action="{{ url('client/'.$d['id'])}}"
                                              method="post">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button class="btn-del" type="submit" style="border: none">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                        <form style="display: inline" action="{{ url('client/token/'.$d['id'])}}"
                                              method="post">
                                            <input type="hidden" name="_method" value="POST">
                                            {{ csrf_field() }}
                                            <button class="btn-text" type="submit">
                                                Create Token
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {{ $data->appends(['search' => !empty($_GET['search']) ? $_GET['search']:''])->links() }}
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>

@endsection
