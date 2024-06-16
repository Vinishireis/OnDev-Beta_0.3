document.addEventListener('DOMContentLoaded', (event) => {
    const openModalButton = document.querySelector("#open-modal");
    const closeModalButton = document.querySelector("#close-modal");
    const modal = document.querySelector("#modal");
    const fade = document.querySelector("#fade");

    const toggleModal = () => {
        [modal, fade].forEach((el) => el.classList.toggle("hide"));
    };

    openModalButton.addEventListener('click', function() {
        const serviceId = this.getAttribute('data-service-id');
        const userId = this.getAttribute('data-user-id');

        document.getElementById('service_id').value = serviceId;
        document.getElementById('user_id').value = userId;

        fetch(`get_dev_id.php?service_id=${serviceId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('dev_id').value = data.dev_id;
                    toggleModal();
                } else {
                    alert('Erro ao obter o ID do desenvolvedor.');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao obter o ID do desenvolvedor.');
            });
    });

    closeModalButton.addEventListener('click', function() {
        toggleModal();
    });

    fade.addEventListener('click', function() {
        toggleModal();
    });

    document.getElementById('save-service-btn').addEventListener('click', function() {
        alert('Serviço salvo!'); // Adicione lógica de salvamento aqui
    });

    document.getElementById('favorite-developer-btn').addEventListener('click', function() {
        alert('Desenvolvedor favoritado!'); // Adicione lógica de favoritamento aqui
    });
});
let profileDropdownList = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".profile-dropdown-btn");

let classList = profileDropdownList.classList;

const toggle = () => classList.toggle("active");

window.addEventListener("click", function (e) {
  if (!btn.contains(e.target)) classList.remove("active");
});
