const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');
const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');
const switchMode = document.getElementById('switch-mode');

// Função para verificar se é um dispositivo móvel
function isMobileDevice() {
    return window.innerWidth < 768;
}

// Função para esconder ou mostrar a barra lateral dependendo do dispositivo
function toggleSidebar() {
    if (isMobileDevice()) {
        sidebar.classList.add('hide');
    } else {
        sidebar.classList.remove('hide');
    }
}

// Executar a função ao carregar a página
toggleSidebar();

// Evento de clique no ícone do menu
menuBar.addEventListener('click', function () {
    sidebar.classList.toggle('hide');
});

// Evento de clique no botão de pesquisa
searchButton.addEventListener('click', function (e) {
    if (isMobileDevice()) {
        e.preventDefault();
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchButtonIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

// Evento de mudança no modo (escuro/claro)
switchMode.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});

// Evento de redimensionamento da janela
window.addEventListener('resize', function () {
    toggleSidebar();
});

// Evento de carregamento do DOM
document.addEventListener('DOMContentLoaded', () => {
    // Se você tiver outras funcionalidades específicas do DOM aqui, adicione-as
});

// Evento de input no campo de busca
$(document).ready(function () {
    $("#search-bar").on("input", function () {
        // Se você tiver alguma funcionalidade de busca aqui, adicione-a
    });
});
