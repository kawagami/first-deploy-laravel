const btn = document.getElementById('thumbor-submit');
const loading = document.getElementById('loading');
const resize_checkbox = document.getElementById('resize-checkbox');
const resize_width = document.getElementById('resize-width');
const resize_height = document.getElementById('resize-height');
const filter_checkbox = document.getElementById('filter-checkbox');
const watermark_checkbox = document.getElementById('watermark-checkbox');
const csrf = document.querySelector('meta[name="csrf-token"]').content;
const thumbor_img_section = document.getElementById('thumbor-img-section');
const target_image = document.getElementById('target-image');
const error_massage = document.getElementById('error-massage');
const filter_style = document.getElementById('filter-style');

if (btn != null) {
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        // 隱藏錯誤訊息
        if (!hasClass(error_massage, 'd-none')) {
            addClass(error_massage, 'd-none');
        }

        // 顯示讀取中
        removeClass(loading, 'd-none');
        addClass(btn, 'd-none');

        const formData = new FormData();
        formData.append('_token', csrf);
        formData.append('resize-checkbox', resize_checkbox.checked);
        if (resize_checkbox.checked) {
            formData.append('resize-width', resize_width.value);
            formData.append('resize-height', resize_height.value);
        }

        if (filter_checkbox.checked) {
            formData.append('filter-checkbox', filter_checkbox.checked);
            formData.append('filter-style', filter_style.value);
        }
        formData.append('watermark-checkbox', watermark_checkbox.checked);
        formData.append('target-image', target_image.value);

        thumbor(formData);
    })
}

function thumbor(data) {
    const options = {
        method: 'POST',
        body: data,
    };

    fetch('api/thumbor', options)
        .then(async response => {
            const isJson = response.headers.get('content-type')?.includes('application/json');
            const data = isJson ? await response.json() : null;

            // check for error response
            if (!response.ok) {
                // get error message from body or default to response status
                const error = (data && data.message) || response.status;
                return Promise.reject(error);
            }

            thumbor_img_section.src = 'data:image/png;base64,' + data.data;
        })
        .catch(error => {
            // 顯示錯誤訊息
            removeClass(error_massage, 'd-none');
        }).finally(() => {
            // 關閉讀取中
            removeClass(btn, 'd-none');
            addClass(loading, 'd-none');
        });
}

function hasClass(el, className) {
    if (el.classList)
        return el.classList.contains(className);
    else
        return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
}

function addClass(el, className) {
    if (el.classList)
        el.classList.add(className);
    else if (!hasClass(el, className)) {
        el.className += " " + className;
    }
}

function removeClass(el, className) {
    if (el.classList)
        el.classList.remove(className);
    else if (hasClass(el, className)) {
        var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
        el.className = el.className.replace(reg, ' ');
    }
}
