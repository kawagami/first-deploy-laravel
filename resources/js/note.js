const floatingSelect = document.getElementById('floatingSelect');

if (floatingSelect != null) {
    floatingSelect.addEventListener('change', function (event) {
        let url = window.location.href.split('?')[0] + '?tag=' + event.target.value;
        location.replace(url)
    });
}
