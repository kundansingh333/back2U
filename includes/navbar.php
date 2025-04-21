<?php
$current_page = basename($_SERVER["REQUEST_URI"]);

?>

<nav id="navbar" class="navbar fixed top-0 left-0 w-full z-50 bg-gray-50 dark:bg-gray-900 shadow-md dark:border-white/10 dark:shadow-blue-500/10 dark:text-white">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
         <div class="flex items-center space-x-2">
         <span> <img class=' w-10  text-blue-600' src="../public/images/logo.png" alt=""></span>
         <a href="index.php" class="text-3xl font-bold text-center text-white text-shadow-lg dark:[--shadow-color:green] dark:text-gray-200"
         style="--shadow-color: #0955F6; text-shadow: 2px 2px 4px var(--shadow-color);">Back2U</a>
         </div>
         
        
        <!-- Navbar Links -->
        <ul class="flex space-x-4">
            <?php if (!$is_admin_panel) { ?>
                <li class="relative">
                    <a href="../public/index.php" 
                       class="relative block px-4 py-2 rounded-md shadow-md transition-all duration-300
                              <?= ($current_page == 'index.php') 
                                  ? 'bg-blue-600 text-white' 
                                  : 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700' ?>">
                        Home
                    </a>
                </li>
                <li class="relative">
                    <a href="../public/report.php" 
                       class="relative block px-4 py-2 rounded-md shadow-md transition-all duration-300
                              <?= ($current_page == 'report.php') 
                                  ? 'bg-blue-600 text-white' 
                                  : 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700' ?>">
                        Report Item
                    </a>
                </li>
                <li class="relative">
                    <a href="view_listings.php" 
                       class="relative block px-4 py-2 rounded-md shadow-md transition-all duration-300
                              <?= ($current_page == 'view_listings.php') 
                                  ? 'bg-blue-600 text-white' 
                                  : 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700' ?>">
                        View Listings
                    </a>
                </li>
            <?php } ?>
        </ul>

        <!-- Right Section: Dark Mode & Auth -->
        <div class="flex items-center space-x-4">
            <!-- Dark Mode Toggle -->
            <!-- <button id="theme-toggle" class="p-2 rounded bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100 transition-all">
            🌙
            </button> -->

            <!-- <label for="" class="lebel">lebel</label> -->
            <input id='theme-toggle' type="checkbox" class="theme-checkbox">


            <?php if (isset($_SESSION["user_id"])): ?>
                <!-- User Dropdown -->
                <div class="relative">
                    <button id="user-menu" class="px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded">
                    <i class='fa-solid fa-circle-user mr-2 fa-xl'></i><?php echo htmlspecialchars($_SESSION["username"]); ?>
                    </button>
                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 shadow-lg rounded-md">
                        <a href="../public/index.php" class="block px-4 py-2 text-gray-700 dark:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-700 hover:rounded-md">User Dashboard</a>
                        <?php if ($_SESSION["role"] === "admin"): ?>
                            <a href="../admin/index.php" class="block px-4 py-2 text-gray-700 dark:text-gray-100 hover:rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Admin Panel</a>
                        <?php endif; ?>
                        <a href="../public/logout.php" class="block px-4 py-2 text-red-500 hover:bg-gray-100 hover:rounded-md dark:hover:bg-gray-700"><i class='fa-solid fa-right-from-bracket mr-3'></i>Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Login</a>
                <a href="signup.php" class="px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">Signup</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
