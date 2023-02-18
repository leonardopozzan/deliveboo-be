import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

const deleteSubmitButtons = document.querySelectorAll('.delete-button');

deleteSubmitButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        event.preventDefault();

        const dataTitle = button.getAttribute('data-item-title');

        const modal = document.getElementById('deleteModal');

        const bootstrapModal = new bootstrap.Modal(modal);
        bootstrapModal.show();

        const modalItemTitle = modal.querySelector('#modal-item-title');
        modalItemTitle.textContent = dataTitle;

        const buttonDelete = modal.querySelector('button.btn-danger');

        buttonDelete.addEventListener('click', () => {
            button.parentElement.submit();
        })
    })
});

const previewImage = document.getElementById('create_cover_image');
if (previewImage) {
    previewImage.addEventListener('change', (event) => {
        var oFReader = new FileReader();
        // var image  =  previewImage.files[0];
        // console.log(image);
        oFReader.readAsDataURL(previewImage.files[0]);

        oFReader.onload = function (oFREvent) {
            //console.log(oFREvent);
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };

        let button = document.getElementById('reset')

        if (button) {
            button.addEventListener('click', function () {
                document.getElementById("uploadPreview").src = 'https://via.placeholder.com/300x200';
            })
        }


        let buttonEditDish = document.getElementById('resetEdit')
        if (buttonEditDish) {
            buttonEditDish.addEventListener('click', function () {
                document.getElementById("uploadPreview").src = document.getElementById("backupImage").src;
            })
        }

    });

}



const sideButton = document.getElementById('menu');
const closeButton = document.getElementById('close');
const main = document.getElementById('main-container');
const overlay = document.getElementById('overlay');


sideButton.addEventListener('click', (event) => {
    let sideBar = document.getElementById('sidebar');
    sideBar.classList.add('side-open');
    main.classList.add('main-overlay');
    overlay.classList.add('side-overlay-active');
});

closeButton.addEventListener('click', (event) => {
    let sideBar = document.getElementById('sidebar');
    sideBar.classList.remove('side-open');
    main.classList.remove('main-overlay');
    overlay.classList.remove('side-overlay-active');
});

