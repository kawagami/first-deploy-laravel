<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col"> 類別 </th>
                <th scope="col"> 數量 </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $category => $count)
                <tr>
                    <th scope="row">{{ $category }}</th>
                    <td>{{ $count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
