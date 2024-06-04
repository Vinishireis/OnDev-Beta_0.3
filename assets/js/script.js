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