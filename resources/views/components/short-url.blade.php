<div class="container">
    <div class="input-group mb-3">
        <input id="destination" type="text" class="form-control" placeholder="@lang('main.note.input-placeholder')"
            aria-label="Recipient's username" aria-describedby="destination">
        <button class="btn btn-outline-secondary" type="button" id="destination_button">@lang('main.note.generate-short-url')</button>
    </div>

    <div class="input-group mb-3">
        <button class="btn btn-outline-secondary" type="button" id="copy-url-button">@lang('main.note.copy-url')</button>
        <input id="short_url" class="form-control" type="text" placeholder="@lang('main.note.output-placeholder')"
            aria-label="Disabled input example" disabled readonly>
    </div>
</div>
