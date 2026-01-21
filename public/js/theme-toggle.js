(function() {
    const themeToggleBtn = document.createElement('button');
    themeToggleBtn.classList.add('btn', 'btn-link', 'text-body', 'p-0', 'ms-3');
    themeToggleBtn.setAttribute('aria-label', 'Toggle theme');

    const sunIcon = '<i class="bi bi-sun-fill fs-5"></i>';
    const moonIcon = '<i class="bi bi-moon-fill fs-5"></i>';

    function setIcon(theme) {
        themeToggleBtn.innerHTML = theme === 'dark' ? sunIcon : moonIcon;
    }

    function getPreferredTheme() {
        if (localStorage.getItem('bs-theme')) {
            return localStorage.getItem('bs-theme');
        }
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    function setTheme(theme) {
        document.documentElement.setAttribute('data-bs-theme', theme);
        localStorage.setItem('bs-theme', theme);
        setIcon(theme);
    }

    // Set initial theme
    const initialTheme = getPreferredTheme();
    setTheme(initialTheme);

    themeToggleBtn.addEventListener('click', () => {
        const currentTheme = document.documentElement.getAttribute('data-bs-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    });

    function appendToggleTo(targetElement) {
        if (targetElement) {
            const clonedBtn = themeToggleBtn.cloneNode(true);
            targetElement.appendChild(clonedBtn);
            clonedBtn.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                setTheme(newTheme);
            });
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Mobile Navbar (left side)
        const mobileTogglePlaceholder = document.getElementById('mobile-theme-toggle-placeholder');
        appendToggleTo(mobileTogglePlaceholder);

        // Desktop Main Content (right of title)
        const desktopMainTogglePlaceholder = document.getElementById('desktop-main-theme-toggle-placeholder');
        appendToggleTo(desktopMainTogglePlaceholder);

        // Login/Register pages (top-right absolute)
        const loginRegisterTogglePlaceholder = document.getElementById('login-register-theme-toggle-placeholder');
        appendToggleTo(loginRegisterTogglePlaceholder);
    });

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
        if (!localStorage.getItem('bs-theme')) { // Only update if user hasn't manually set a theme
            setTheme(event.matches ? 'dark' : 'light');
        }
    });

})();
