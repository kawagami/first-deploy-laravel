<div class="container">
    <div class="row">
        <div class="col">
            <form id="blog_create_form">

                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="blog_textarea_1"></textarea>
                    <label for="blog_textarea_1">Content</label>
                </div>

                {{-- 錨點一 --}}
                <div id="anchor" class="form-floating"></div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    {{-- 增加一段文字 這個按鈕按下去後在 錨點一 的位置將抓到的 specificInput 元素複製一次貼在 錨點一 的位置 --}}
                    <button class="btn btn-primary me-md-2" type="button">增加一段文字</button>
                    <button class="btn btn-primary" type="button">新增文章</button>
                </div>
            </form>
        </div>
    </div>
</div>
