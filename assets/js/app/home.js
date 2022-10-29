import '../../bootstrap';
import '../../styles/app/home.css';

for (let i = 0; i < 6; i++) {
    const btnAdd = document.querySelector('#add-' + i);
    btnAdd.addEventListener('click', () => {
        console.log(btnAdd.innerHTML);
    });
}