<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col"> path </th>
            </tr>
        </thead>
        <tbody>
            @foreach (data_get($data, 'images', []) as $image)
                <tr>
                    <th scope="row">{{ $image->path }}</th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
