<?php include '../includes/header.php'; ?>
<?php
// session_start();
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
?>

<style>
 
</style>

<!-- Hero Section with Background Image -->
<div class="min-h-screen mt-16 bg-cover bg-center bg-no-repeat relative transition-colors duration-300" style="background-image: url('../public/images/bgimage.png')">
    
    <!-- Transparent Overlay -->
    <div class="absolute inset-0 bg-white/70 dark:bg-gray-900/70 backdrop-blur-sm"></div>

    <div class="relative z-10 flex flex-col justify-start items-center">
        <section class="py-20 text-center">
            <div class="container mx-auto mt-36">
            <div class="overflow-hidden whitespace-nowrap">
                <h1 class=" inline-block text-4xl font-bold text-gradient">
                    Lost &amp; Found Management System
                </h1>
            </div>


                <p class="text-lg text-gray-700 dark:text-gray-300 mt-4">Easily report and retrieve lost items with our system.</p>
                <a href="report.php" 
                    class="report_btn mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-md transition">
                    Report Item
                </a>
            </div>
        </section>

        <!-- Features -->
        <section class="py-12 w-full">
            <div class="container mx-auto grid md:grid-cols-3 gap-8 text-center">
                <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-800 transition-all duration-300 transform hover:-translate-y-2 hover:border hover:shadow-lg hover:shadow-black/20 border border-transparent dark:bg-gray-800 dark:border dark:border-white/10 dark:hover:border-blue-500 dark:hover:shadow-blue-500/30 dark:text-white">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Easy Reporting</h3>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">Quickly submit lost and found reports.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-800 transition-all duration-300 transform hover:-translate-y-2 hover:border hover:shadow-lg hover:shadow-black/20 border border-transparent dark:bg-gray-800 dark:border dark:border-white/10 dark:hover:border-blue-500 dark:hover:shadow-blue-500/30 dark:text-white">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Verified Listings</h3>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">Ensuring accurate and valid reports.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-800 transition-all duration-300 transform hover:-translate-y-2 hover:border hover:shadow-lg hover:shadow-black/20 border border-transparent dark:bg-gray-800 dark:border dark:border-white/10 dark:hover:border-blue-500 dark:hover:shadow-blue-500/30 dark:text-white">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Secure System</h3>
                    <p class="text-gray-700 dark:text-gray-300 mt-2">Your data is safe and protected.</p>
                </div>
            </div>
        </section>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
