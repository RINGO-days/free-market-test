const postCode = document.querySelector('#input-post_code');
const button = document.querySelector('#button');
const address = document.querySelector('#address');

button.addEventListener('click', async () => {
    const zipCode = postCode.value;
    const newZipCode = zipCode.replace('-', '');
    console.log('aaa');

    const response = await fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${newZipCode}`);
    const data = await response.json();
    if (data.results === null) {
        document.querySelector('#error-message').textContent = "入力された郵便番号の住所はありませんでした。";
        return;
    };
    address.value = data.results[0].address1 + data.results[0].address2 + data.results[0].address3;
})