 //for scrolling
 window.addEventListener("scroll", function() {
        const navbar = document.getElementById("navbar");
        if (window.scrollY > 50) {
            navbar.classList.add("bg-white", "shadow-md", "text-black");
            navbar.classList.remove("bg-transparent", "text-white");
        }
         else {
            // navbar.classList.add("bg-transparent", "text-white");
            navbar.classList.remove("bg-white", "shadow-md", "text-black");
        }
    });




    
    document.addEventListener("DOMContentLoaded", function () {
        const themeToggle = document.getElementById("theme-toggle");
        const html = document.documentElement;
    
        // Dropdown Logic
        const userMenuButton = document.getElementById("user-menu");
        const dropdownMenu = document.getElementById("dropdown");
    
        if (userMenuButton && dropdownMenu) {
            userMenuButton.addEventListener("click", function (event) {
                event.stopPropagation();
                dropdownMenu.classList.toggle("hidden");
            });
    
            document.addEventListener("click", function (event) {
                if (!userMenuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        }
    
        // Theme toggle logic using session (AJAX)
        if (themeToggle) {
            themeToggle.addEventListener("click", () => {
                fetch("?toggle_theme=true")
                    .then(res => res.json())
                    .then(data => {
                        if (data.theme === "dark") {
                            html.classList.add("dark");
                        } else {
                            html.classList.remove("dark");
                        }
                    });
            });
        }
    });
    