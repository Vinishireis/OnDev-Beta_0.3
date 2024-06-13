document.addEventListener('DOMContentLoaded', (event) => {
    // Função para abrir e fechar o dropdown no mobile
    function toggleMobileDropdown() {
        const dropdown = document.querySelector('.profile-dropdown-list.mmm-list');
        dropdown.classList.toggle('active');
    }

    // Função para abrir e fechar o dropdown no desktop
    function toggleDesktopDropdown() {
        const dropdown = document.querySelector('.profile-dropdown-list');
        dropdown.classList.toggle('active');
    }

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
        const modal = document.getElementById('qrCodeModal');
        if (event.target == modal) {
            closeModal();
        }

        // Fechar dropdowns se clicar fora deles
        const profileDropdown = document.querySelector('.profile-dropdown');
        const dropdown = document.querySelector('.profile-dropdown-list');
        if (!profileDropdown.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    }

    // Impedir que o modal abra automaticamente ao recarregar a página
    window.onload = function() {
        document.getElementById('qrCodeModal').style.display = 'none';
    }

    // Adicionar event listeners para os botões de dropdown
    const profileDropdownBtn = document.querySelector('.profile-dropdown-btn');
    if (profileDropdownBtn) {
        profileDropdownBtn.addEventListener('click', function() {
            const dropdown = document.querySelector('.profile-dropdown-list');
            dropdown.classList.toggle('active');
        });
    }
    
    // Adicionar event listeners para abrir e fechar o modal
    const modalOpenLinks = document.querySelectorAll('a[href="generate.php"]');
    modalOpenLinks.forEach(link => {
        link.addEventListener('click', openModal);
    });

    const modalCloseButton = document.querySelector('.modal .close');
    if (modalCloseButton) {
        modalCloseButton.addEventListener('click', closeModal);
    }
});
