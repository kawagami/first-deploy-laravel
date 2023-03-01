const destination = document.querySelector('#destination');
const destination_button = document.querySelector('#destination_button');
const short = document.querySelector('#short_url');
const csrf = document.querySelector('meta[name="csrf-token"]').content;

// 監聽生產短網址的按鈕
destination_button.addEventListener('click', e => {
    e.preventDefault();
    destination_button.disabled = true

    const formData = new FormData();
    formData.append('destination', destination.value);
    formData.append('_token', csrf);

    const options = {
        method: 'POST',
        body: formData,
        // If you add this, upload won't work
        // headers: {
        //     'X-CSRF-TOKEN': csrf,
        // }
    };
    // 發 request 去後端生成短網址
    fetch('/short-url', options)
        .then(response => {
            return response.json();
        }).then(result => {
            // 顯示短網址在頁面上
            short.value = result.short_url;
            destination_button.disabled = false;
            short_url_success();
        }).catch(err => {
            destination_button.disabled = false;
            short_url_fail();
        });
});

function short_url_success() {
    Swal.fire(
        "縮網址成功",
        '',
        'success'
    )
};
function short_url_fail() {
    Swal.fire(
        "不符合網址",
        '',
        'error'
    )
};
