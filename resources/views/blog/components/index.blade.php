<div class="container-lg overflow-auto">

    <div class="row row-cols-1 g-4">

        @foreach ($data as $item)
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ data_get($item, 'name') }}</h5>
                        <p class="card-text">{{ data_get($item, 'short_content') }}</p>
                        <a href="{{ route('blog.show', ['id' => data_get($item, 'id')]) }}" class="stretched-link">
                            詳細閱讀
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

</div>
