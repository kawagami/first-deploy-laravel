<div class="container">

    <div class="form-floating">
        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
            <option selected value="all">選擇分類</option>
            <option value="all">全部</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        <label for="floatingSelect">選擇分類</label>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">

        @foreach ($notes as $note)
            <div class="col">
                <div class="card h-100">
                    <a class="list-group-item list-group-item-action" href="{{ $note->publishLink }}" target="_blank">
                        <div class="card-body">
                            <h5 class="card-title">{{ $note->title }}</h5>
                            <p class="card-text">
                                <small>Last updated at {{ $note->lastChangedAt }}</small>
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">created at {{ $note->createdAt }}</small>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach

    </div>
</div>
