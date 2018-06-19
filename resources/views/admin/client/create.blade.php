@extends('layouts.app')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Add New Client</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">

        <form method="post" action="{{ url('client') }}">
            @method('POST')
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group {{ !empty($errors->first('name')) ? 'has-error':'' }}">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                                       value="{{ old('name') }}" required>
                                <div class="error">{{ $errors->first('name') }}</div>
                            </div>
                            <div class="form-group {{ !empty($errors->first('email')) ? 'has-error':'' }}">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                                       value="{{ old('email') }}" required>
                                <div class="error">{{ $errors->first('email') }}</div>
                            </div>
                            <div class="form-group {{ !empty($errors->first('password')) ? 'has-error':'' }}">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                       name="password" value="{{ old('password') }}" required>
                                <div class="error">{{ $errors->first('password') }}</div>
                            </div>
                            <div class="form-group {{ !empty($errors->first('password-confirm')) ? 'has-error':'' }}">
                                <label for="password">Password Confirm</label>
                                <input type="password" class="form-control" id="password-confirm" placeholder="Password Confirm"
                                       name="password_confirmation" value="{{ old('password-confirm') }}" required>
                                <div class="error">{{ $errors->first('password-confirm') }}</div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </section>

@endsection
