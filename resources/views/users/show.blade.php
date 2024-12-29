@extends('layout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left-column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit User</h3>
                        </div>
                        <!-- /.card-header -->
                        <form class="form-valide" method="post" action="{{ route('users.update', $dt['id']) }}">
                            @csrf
                            @method('PATCH')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">Nama <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="inputError" value="{{ $dt['name'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="inputError" value="{{ $dt['email'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputAddress">Alamat <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="inputError" value="{{ $dt['address'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPhoneNumber">No. Hp. <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="inputError" value="{{ $dt['phone_number'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCity">Kota <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="inputError" value="{{ $dt['city'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputRoles">Roles <span class="text-danger">*</span> </label>
                                    <select class="custom-select" name="roles" required>
                                        <option value=""> Pilih </option>
                                        <option value="1" {{ $dt['roles'] == 1 ? 'selected' : '' }}> Admin </option>
                                        <option value="2" {{ $dt['roles'] == 2 ? 'selected' : '' }}> User </option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection