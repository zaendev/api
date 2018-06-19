@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Token</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <label><b>Name</b></label>
                        <p>{{ $name }}</p><br>

                        <label><b>Access Token</b></label>
                        <p>{{ $access_token }}</p><br>

                        <label><b>Token Type</b></label>
                        <p>{{ $token_type }}</p><br>

                        <label><b>Expires At</b></label>
                        <p>{{ $expires_at }}</p><br>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

    </section>

@endsection
