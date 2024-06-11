function toggleMobileDropdown() {
    const dropdown = document.querySelector('.profile-dropdown-list.mmm-list');
    dropdown.classList.toggle('active');
}

function toggleDesktopDropdown() {
    const dropdown = document.querySelector('.profile-dropdown-list');
    dropdown.classList.toggle('active');
}

document.addEventListener('click', function(event) {
    const profileDropdown = document.querySelector('.profile-dropdown');
    const dropdown = document.querySelector('.profile-dropdown-list');
    if (!profileDropdown.contains(event.target)) {
        dropdown.classList.remove('active');
    }
});

// Função para abrir o modal
function openModal(event) {
    event.preventDefault();
    document.getElementById('qrCodeModal').style.display = 'flex';
}

// Função para fechar o modal
function closeModal() {
    document.getElementById('qrCodeModal').style.display = 'none';
}

// Função para fechar o modal ao clicar fora dele
window.onclick = function(event) {
    if (event.target == document.getElementById('qrCodeModal')) {
        closeModal();
    }
}

// Impedir que o modal abra automaticamente ao recarregar a página
window.onload = function() {
    document.getElementById('qrCodeModal').style.display = 'none';
}
