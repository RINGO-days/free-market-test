const input = document.querySelector('#image__input');
const previewImg = document.querySelector('#preview-img');
const previewBox = document.querySelector('.preview-img__inner')
const reader = new FileReader();

input.addEventListener('change', (event) => {
    const image = event.target.files[0];

    if (!image) {
        previewImg.style.opacity = 0;
        return;
    }
    reader.onload = (e) => {
        previewImg.src = e.target.result;
        previewImg.style.opacity = 1;
    }
    reader.readAsDataURL(image);
});