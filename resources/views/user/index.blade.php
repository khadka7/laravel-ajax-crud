@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Users
                        <a onclick="userForm()" class="btn btn-primary">Add User</a>
                    </div>
                    <div class="card-body" id="list-users">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            fetchUsers();
        });

        function fetchUsers() {
            var url = "{{route('users.fetch')}}";
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    $("#list-users").html(data.template);
                }
            })
        }

        function userForm() {
            url = "{{route('user.form')}}";
            let modal = $("#myModal");
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    modal.find(".modal-title").html("Add User")
                    modal.find(".modal-body").html(data.template);
                    modal.modal("toggle");
                }
            })
        }

        function createUser(e, obj) {
            e.preventDefault();
            var url = "{{route('user.create')}}";
            var formData = new FormData(obj);
            let modal = $("#myModal");
            $.ajax({
                url: url,
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    modal.modal("hide");
                    fetchUsers();
                },
            })
        }

        function editUser(id) {
            url = "{{route('user.edit','ID')}}";
            url = url.replace('ID', id);
            let modal = $("#myModal");
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    modal.find(".modal-title").html("Edit User")
                    modal.find(".modal-body").html(data.template);
                    modal.modal("toggle");
                }
            })
        }

        function updateUser(e, obj, id) {
            e.preventDefault();
            var url = "{{route('user.update','ID')}}";
            url = url.replace('ID', id)
            var formData = new FormData(obj);
            let modal = $("#myModal");
            $.ajax({
                url: url,
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    modal.modal("hide");
                    fetchUsers();

                },
            })
        }

        function deleteUser(id) {
            var url = "{{route('user.delete','ID')}}";
            url = url.replace('ID', id);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (data) {
                    fetchUsers();
                }
            })
        }
    </script>
@endsection
