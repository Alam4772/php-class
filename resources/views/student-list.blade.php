@extends('layout')
@section('stylesheet')
<style>
    input[type='search'] {

        outline: none;
        padding: 10px;
    }

    .table {
        margin-top: 30px;
    }

    .profile-img {

        width: 50%;
    }
</style>
@endsection
@section('main-content')
<div style="padding: 30px 50px">
    <div style="text-align: right;">
        <a href="{{ url('/student/create') }}" class="btn btn-primary">Add Student</a>
    </div>
    <br>
    <div style="text-align: right;">
        <input onkeyup="getStudentList()" type="search" name="" id="searchText" placeholder="Search Record...">
    </div>
    <table class="table" id="student-table">
        <thead>
            <th>Sr. No.</th>
            <th>Profile Photo</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Created At</th>
            <th>Action</th>
        </thead>
        <tbody>
            {{-- AJAX records will be here --}}
        </tbody>
    </table>
</div>
@endsection
@section('javascript')
<script>
    var BASE_URL = "{{ url('/') }}";

    console.log(BASE_URL);

    $(document).ready(function() {

        getStudentList();
    });

    function getStudentList()
    {
        $.ajax({
            url: '{{ url("api/student/list") }}',
            type: 'GET',
            data: {

                searchText: $('#searchText').val()
            },
            success: function(response) {

                var rows = '';

                if(response.length > 0) {

                    var index = 0;

                    response.forEach(student => {

                        rows += "<tr>";
                        rows += "<td>" + (++index) + "</td>";
                        rows += "<td><img class='profile-img' src='" + BASE_URL + '/public/assets/images/' + student.image + "' /></td>";
                        rows += "<td>" + student.first_name + "</td>";
                        rows += "<td>" + student.last_name + "</td>";
                        rows += "<td>" + student.email + "</td>";
                        rows += "<td>" + student.mobile_number + "</td>";
                        rows += "<td>" + student.created_at + "</td>";
                        rows += "<td><a href='{{ url('/student/edit') }}/"+student.id+"' class='btn btn-warning'>Edit</a>&nbsp;<button class='btn btn-danger' onClick='deleteRecord("+student.id+")'>Delete</button></td>";
                        rows += "</tr>";
                    });
                }else {

                    rows += "<tr>";
                    rows += "<td colspan='6'><h2 style='text-align: center'>No Record Found.</h2></td>";
                    rows += "</tr>";
                }

                $('#student-table tbody').html(rows);
            },
            error: function (error) {
                console.error(error);
            }
        });
    }

    function deleteRecord(id)
    {
        if(confirm('Are you sure to delete this record?')) {

            $.ajax({
                url: '{{ url("student/delete") }}/' + id,
                type: 'GET',
                success: function(response) {

                    getStudentList();
                    alert(response.message);
                }
            });
        }
    }
</script>
@endsection
