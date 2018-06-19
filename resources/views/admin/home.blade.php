@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <a href="{{ url('client') }}">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Client</span>
                            <span class="info-box-number">{{ $data['count_client'] }}</span>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </section>

@endsection
