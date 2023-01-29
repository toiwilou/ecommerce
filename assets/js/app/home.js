import '../../bootstrap';
import '../../styles/app/home.css';

const productContent = document.querySelector('#home-app .main .product-content');
const cartPrice = document.querySelector('.cart-price');
const lengthProducts = productContent.dataset.lengthProducts;

for (let i = 0; i < lengthProducts; i++) {
    const btnAdd = document.querySelector('#btn-add-' + i);
    const price = parseFloat(btnAdd.dataset.price);
    const productItem = document.querySelector('.product-item-' + i);
    btnAdd.addEventListener('click', () => {
        console.log(productItem.dataset.id);
        const cartNummberElement = document.querySelector('.cart-number');
        let cartNummber = parseInt(cartNummberElement.innerHTML);
        cartNummber++;
        cartNummberElement.innerHTML = cartNummber;

        if (cartNummber > 0) {
            cartNummberElement.removeAttribute('hidden');
        }
        const initPrice = parseFloat(cartPrice.innerHTML);
        let finalPrice = price + initPrice;
        cartPrice.innerHTML = String(finalPrice).replace('.', ',');
    });
}