<table class="table">
    <thead>
    <tr>
        <th>S.N</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <a onclick="editUser('{{$user->id}}')" class="btn btn-info">Edit</a>
                <a onclick="deleteUser('{{$user->id}}')" class="btn btn-danger">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
