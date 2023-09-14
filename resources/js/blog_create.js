// 获取表单和锚点一的元素
const blog_create_form = document.getElementById('blog_create_form');

if (blog_create_form != null) {

    // 要插入新區塊的錨點
    const anchorOne = blog_create_form.querySelector('#anchor');

    // 获取 增加一段文字 按钮
    const addButton = blog_create_form.querySelector('.btn-primary.me-md-2');

    // 添加按钮点击事件监听器
    addButton.addEventListener('click', function () {
        // 创建一个新的输入字段
        const newInput = document.createElement('textarea');
        newInput.className = 'form-control';
        newInput.placeholder = 'Leave a comment here';

        // 创建一个新的<label>元素
        const newLabel = document.createElement('label');
        newLabel.htmlFor = 'blog_textarea_2'; // 替换为实际的ID
        newLabel.textContent = 'Content';

        // 将新输入字段和新<label>元素添加到锚点一的位置
        anchorOne.appendChild(newInput);
        anchorOne.appendChild(newLabel);
    });

}
