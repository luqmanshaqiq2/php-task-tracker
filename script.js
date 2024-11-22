document.addEventListener('DOMContentLoaded', function () {
    const hamburger = document.querySelector('.hamburger');
    const sidebar = document.querySelector('.sidebar');
    const closeIcon = document.querySelector('.sidebar .close-icon');
    const darkModeToggle = document.getElementById('darkModeToggle'); 

    // Open sidebar
    hamburger.addEventListener('click', () => {
        sidebar.classList.add('active');
    });

    // Close sidebar when "X" is clicked
    closeIcon.addEventListener('click', () => {
        sidebar.classList.remove('active');
    });

    // Dark mode toggle
    darkModeToggle.addEventListener('click', () => {
        // Toggle the dark-mode class on the body element
        document.body.classList.toggle('dark-mode');
        
        // Save the user's dark mode preference in localStorage
        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('darkMode', 'enabled');
            darkModeToggle.textContent = "Light Mode"; 
        } else {
            localStorage.removeItem('darkMode');
            darkModeToggle.textContent = "Dark Mode"; 
        }
    });

    if (localStorage.getItem('darkMode') === 'enabled') {
        document.body.classList.add('dark-mode');
        darkModeToggle.textContent = "Light Mode"; 
    }
});
