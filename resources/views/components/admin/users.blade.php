<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col"> name </th>
                <th scope="col"> email </th>
            </tr>
        </thead>
        <tbody>
            @foreach (data_get($data, 'users', []) as $user)
                <tr>
                    <th scope="row">{{ $user->name }}</th>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
