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
        temp.src = base64;
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
    // upload(blob);
});
