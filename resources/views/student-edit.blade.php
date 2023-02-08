@extends('layout')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form style="margin-top: 50px;" action="{{ url('/student/update') }}/{{ $student->id }}" method="POST">
                    @csrf
                    <h1>Edit Student</h1>
                    <div class="form-group" style="margin-top: 20px;">
                        <input required value="{{ $student->first_name }}" type="text" name="first_name" id="" placeholder="Enter First Name..." class="form-control">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <input required value="{{ $student->last_name }}" type="text" name="last_name" id="" placeholder="Enter Last Name..." class="form-control">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <input required value="{{ $student->email }}" type="email" name="email" id="" placeholder="Enter Email..." class="form-control">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <input type="text" value="{{ $student->mobile_number }}" name="mobile_number" id="" placeholder="Enter Mobile Number..." class="form-control">
                    </div>
                    <div class="form-group" style="margin-top: 20px; text-align: right;">
                        <span>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
@endsection
