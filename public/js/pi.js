// 參考 https://juejin.cn/post/6966156683571626021
let temp = document.querySelector("#temp");

document.addEventListener('paste', function (e) {
    const dataTransferItemList = e.clipboardData.items;
    // 過濾非圖片類型
    const items = [].slice.call(dataTransferItemList).filter(function (item) {
        return item.type.indexOf('image') !== -1;
    });
    if (items.length === 0) {
        return;
    }
    const dataTransferItem = items[0];
    const blob = dataTransferItem.getAsFile();
    // 獲取base64
    const fileReader = new FileReader();
    fileReader.addEventListener('load', function (e) {
        let base64 = e.target.result;
    });
    fileReader.readAsDataURL(blob);
    // // 將圖片加在特定的位置下
    // const blobUrl = URL.createObjectURL(blob);
    // const object = document.createElement("object");
    // object.setAttribute("data", blobUrl);
    // object.setAttribute("type", "text/plain");
    // temp.appendChild(object);
    // document.body.appendChild(temp);

    // 如果覺得 base64 太長，也可以生成本地臨時連結
    let url = URL.createObjectURL(blob);
    // 上傳圖片至後台
    upload(blob);
});

function upload(file) {
    // formData
    const formData = new FormData();
    formData.append('image', file);
    // // 發送
    // const xhr = new XMLHttpRequest();
    // xhr.open('POST', 'api/upload-image', true);
    // xhr.addEventListener('load', function () {
    //     if (xhr.status === 200) {
    //         const res = xhr.responseText;
    //         console.log(res);
    //     }
    // });
    // xhr.send(formData);


    const options = {
        method: 'POST',
        body: formData,
        // If you add this, upload won't work
        // headers: {
        //   'Content-Type': 'multipart/form-data',
        // }
    };

    fetch('api/upload-image', options)
        .then(response => {
            return response.json();
        }).then(result => {
            temp.src = result.image
        });
}
