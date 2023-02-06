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
</style>
@endsection
@section('main-content')
<div style="padding: 30px 50px">
    <div style="text-align: right;">
        <input onkeyup="getStudentList()" type="search" name="" id="searchText" placeholder="Search Record...">
    </div>
    <table class="table" id="student-table">
        <thead>
            <th>Sr. No.</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Created At</th>
        </thead>
        <tbody>
            {{-- AJAX records will be here --}}
        </tbody>
    </table>
</div>
@endsection
@section('javascript')
<script>
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
                        rows += "<td>" + student.first_name + "</td>";
                        rows += "<td>" + student.last_name + "</td>";
                        rows += "<td>" + student.email + "</td>";
                        rows += "<td>" + student.mobile_number + "</td>";
                        rows += "<td>" + student.created_at + "</td>";
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
</script>
@endsection
