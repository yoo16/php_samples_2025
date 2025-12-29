function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const base64Data = e.target.result;
            // プレビューの背景を更新
            document.querySelector('.card').style.backgroundImage = `url('${base64Data}')`;
            // PDF生成用の隠しフィールドにセット
            document.getElementById('bg_base64').value = base64Data;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function update() {
    document.querySelector('.name').innerText = document.getElementById('in_name').value;
    document.querySelector('.title').innerText = document.getElementById('in_title').value;
    const info = document.querySelector('.info');
    info.innerHTML = `Email: ${document.getElementById('in_email').value}<br>` +
        `Web: ${document.getElementById('in_web').value}<br>` +
        `Tel: ${document.getElementById('in_tel').value}`;
}