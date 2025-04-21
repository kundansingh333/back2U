
    <!-- Sidebar -->
    <?php
// Get the current page from the URL
$current_page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<div class="w-64  bg-white shadow-md h-screen p-6 fixed left-0 top-0 mt-18 dark:bg-gray-800 transition-colors duration-300 dark:bg-gray-900 shadow-lg dark:border-white/10 dark:shadow-blue-500/10 dark:text-white">
    <h2 class="text-2xl font-bold text-blue-600 ">Admin Panel</h2>
    <ul class="mt-6">
        <li class="py-2 dark:text-white">
            <a href="?page=dashboard" 
               class="block px-4 py-2 rounded-md transition duration-300 
                      <?php echo ($current_page == 'dashboard') ? 'bg-blue-100  text-blue-600 font-bold' : 'text-gray-700 hover:text-blue-500 hover:bg-gray-100 dark:text-white hover:dark:text-blue-500 hover:dark:bg-gray-100'; ?>">
                Dashboard
            </a>
        </li>
        <li class="py-2">
            <a href="?page=users" 
               class="block px-4 py-2 rounded-md transition duration-300 
                      <?php echo ($current_page == 'users') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700 hover:text-blue-500 hover:bg-gray-100 dark:text-white hover:dark:text-blue-500 hover:dark:bg-gray-100'; ?>">
                Manage Users
            </a>
        </li>
        <li class="py-2">
            <a href="?page=listings" 
               class="block px-4 py-2 rounded-md transition duration-300 
                      <?php echo ($current_page == 'listings') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700 hover:text-blue-500 hover:bg-gray-100 hover:dark:text-blue-500 hover:dark:bg-gray-100 dark:text-white'; ?>">
                Manage Listings
            </a>
        </li>
        <li class="py-2">
            <a href="?page=settings" 
               class="block px-4 py-2 rounded-md transition duration-300 
                      <?php echo ($current_page == 'settings') ? 'bg-blue-100 text-blue-600 font-bold' : 'text-gray-700 hover:text-blue-500 hover:bg-gray-100 hover:dark:text-blue-500 hover:dark:bg-gray-100 dark:text-white'; ?>">
                Settings
            </a>
        </li>
    </ul>
</div>
