<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h1>Thumbor</h1>
        </div>
        <div class="col-12 text-center">
            <h3>使用 rust 建構的圖片處理服務</h3>
        </div>
    </div>
    <form action="{{ route('api.thumbor') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="target-image" class="form-label">原始圖片網址</label>
            <input type="text" class="form-control" id="target-image" name="target-image"
                aria-describedby="target-image-help" placeholder="在這貼上要修改的圖片網址" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="resize-checkbox" name="resize-checkbox">
            <label class="form-check-label" for="resize-checkbox">要修改圖片尺寸</label>
        </div>
        <div class="mb-3">
            <label for="resize-width" class="form-label">width : 寬度</label>
            <input type="number" class="form-control" id="resize-width" name="resize-width"
                aria-describedby="resize-width-help" placeholder="需要的圖片寬度">
        </div>
        <div class="mb-3">
            <label for="resize-height" class="form-label">height : 高度</label>
            <input type="number" class="form-control" id="resize-height" name="resize-height"
                aria-describedby="resize-height-help" placeholder="需要的圖片高度">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="filter-checkbox" name="filter-checkbox">
            <label class="form-check-label" for="filter-checkbox">要加濾鏡</label>
        </div>
        <div class="mb-3 form-check">
            <select name="filter-style" id="filter-style">
                @foreach ($filter_style_array as $key => $filter_style)
                    <option value="{{ $key }}">{{ $filter_style }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="watermark-checkbox" name="watermark-checkbox">
            <label class="form-check-label" for="watermark-checkbox">要加水印</label>
        </div>
        <button id="thumbor-submit" type="submit" class="btn btn-primary">
            <div>GET IMAGE</div>
        </button>
        {{-- <div class="form-text">登入才能產生圖片</div> --}}

        <div id="loading" class="spinner-border d-none" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </form>

    <br />
    <div id="error-massage" class="d-none">
        <span class="text-danger">資料格式有誤</span>
        <br />
    </div>
    <img id="thumbor-img-section" src="" alt="" srcset="">
</div>
