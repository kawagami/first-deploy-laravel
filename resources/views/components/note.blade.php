<div class="container">

    <div class="row row-cols-1 row-cols-md-3 g-4">

        @foreach ($notes as $note)
            <div class="col">
                <div class="card">
                    {{-- <img src="..." class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $note->title }}</h5>
                        <a href="{{ $note->url }}" class="btn btn-primary" target="_blank">Open</a>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- <ul class="list-group">
        <li class="list-group-item">
            <a href="https://hackmd.io/@kawagami/Hk_ZzngGF">Docker</a>
        </li>
    </ul> --}}
    </div>
