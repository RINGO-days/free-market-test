const input = document.querySelector('#image__input');
const previewImg = document.querySelector('#preview-img');
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

const postCode = document.querySelector('#input-post_code');
const button = document.querySelector('#button');
const address = document.querySelector('#address');

button.addEventListener('click', async () => {
    const zipCode = postCode.value;
    const newZipCode = zipCode.replace('-', '');

    const response = await fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${newZipCode}`);
    const data = await response.json();
    address.value = data.results[0].address1 + data.results[0].address2 + data.results[0].address3;
})