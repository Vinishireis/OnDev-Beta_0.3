$(document).ready(function() {
    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
});

function applyTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
}

function detectTheme() {
    const darkModeQuery = window.matchMedia('(prefers-color-scheme: dark)');
    if (darkModeQuery.matches) {
        applyTheme('dark');
    } else {
        applyTheme('light');
    }
}

window.addEventListener('load', detectTheme);

window.matchMedia('(prefers-color-scheme: dark)').addListener((e) => {
    const theme = e.matches ? 'dark' : 'light';
    applyTheme(theme);
});