<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col"> 擁有者 </th>
                <th scope="col"> 原始網址 </th>
                <th scope="col"> 短網址 </th>
            </tr>
        </thead>
        <tbody>
            @foreach (data_get($data, 'short_urls', []) as $short_url)
                <tr>
                    <th scope="row">{{ $short_url->user->name }}</th>
                    <td>{{ $short_url->destination }}</td>
                    <td>{{ $short_url->short_url }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
