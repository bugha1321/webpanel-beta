document.addEventListener('DOMContentLoaded', function () {
    const themeSwitch = document.getElementById('themeSwitch');

    themeSwitch.addEventListener('change', function () {
        document.body.classList.toggle('dark-theme', themeSwitch.checked);
        localStorage.setItem('theme', themeSwitch.checked ? 'dark' : 'light');
    });

    const savedTheme = localStorage.getItem('theme');
    if (savedTheme) {
        document.body.classList.toggle('dark-theme', savedTheme === 'dark');
        themeSwitch.checked = savedTheme === 'dark';
    }
});

function updateTheme() {
    const themeSwitch = document.getElementById('themeSwitch');
    document.body.classList.toggle('dark-theme', themeSwitch.checked);
}

updateTheme();
