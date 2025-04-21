<?php
session_start();

// Check if the current page is in the admin panel
$is_admin_panel = strpos($_SERVER['REQUEST_URI'], '/admin/') !== false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back2U</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">  
    <link rel="stylesheet" href="../public/css/style.css">  

    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <!-- <style>
        .navbar {
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
    </style> -->
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100 ">

<!-- Navbar -->
<?php include 'navbar.php'?>


<!-- <script src="../public/script.js"></script> -->
<script>
// document.addEventListener("DOMContentLoaded", function () {
    const htmlElement = document.documentElement;
    const themeToggle = document.getElementById("theme-toggle");

    // Apply saved theme on load
    if (localStorage.getItem("theme") === "dark" || 
        (!localStorage.getItem("theme") && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
        htmlElement.classList.add("dark");
    } else {
        htmlElement.classList.remove("dark");
    }

    // Toggle dark/light mode
    if (themeToggle) {
        themeToggle.addEventListener("click", function () {
            htmlElement.classList.toggle("dark");
            console.log("button clicked");
            localStorage.setItem("theme", htmlElement.classList.contains("dark") ? "dark" : "light");
        });
    }

    // Dropdown Toggle
    const userMenuButton = document.getElementById('user-menu');
    const dropdownMenu = document.getElementById('dropdown');

    if (userMenuButton && dropdownMenu) {
        userMenuButton.addEventListener('click', function (event) {
            console.log("Dropdown button clicked");
            event.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

       
    }
    
// });
</script>

















<!-- Dropdown Toggle & Dark Mode Script -->










<!-- <script>
document.addEventListener("DOMContentLoaded", function () {
    console.log("Dropdown & Theme script loaded!");

    const userMenuButton = document.getElementById('user-menu');
    const dropdownMenu = document.getElementById('dropdown');

    if (userMenuButton && dropdownMenu) {
        userMenuButton.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevent body click event
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function (event) {
            if (!userMenuButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    } else {
        console.warn("Dropdown elements not found!");
    }

    // Dark Mode Toggle
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        // Check stored preference
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add('dark');
        }

        themeToggle.addEventListener('click', function () {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem("theme", document.documentElement.classList.contains('dark') ? "dark" : "light");
        });
    }
});



const themeToggle = document.getElementById('theme-toggle');
  const htmlElement = document.documentElement;

  // Apply saved theme on page load
  if (localStorage.getItem('theme') === 'dark' || 
     (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    htmlElement.classList.add('dark');
  } else {
    htmlElement.classList.remove('dark');
  }

  // Toggle theme on click
  themeToggle.addEventListener('click', () => {
    htmlElement.classList.toggle('dark');
    if (htmlElement.classList.contains('dark')) {
      localStorage.setItem('theme', 'dark');
    } else {
      localStorage.setItem('theme', 'light');
    }
  });
</script> -->

