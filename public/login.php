

<?php include '../includes/header.php'; ?>
<div class="bg-gray-100 flex justify-center items-center h-screen dark:bg-gray-800">

    <!-- Login Form -->

<div class="bg-white text-gray-800 p-6 rounded shadow-lg w-full max-w-md  shadow-gray-800  dark:bg-gray-800 dark:text-white dark:border dark:border-white/10 dark:shadow-blue-500 transition-transform duration-300 hover:scale-105 ">
    <h2 class="text-2xl font-bold text-center text-blue-600">Login</h2>

    <form action="login_process.php" method="POST" class="mt-6">
        <div class="mb-4 ">
            <label class="block text-gray-700 dark:text-white" for="email">Email</label>
            <input type="email" name="email" id="email" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 dark:text-white">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 dark:text-white" for="login-password">Password</label>
            <div class="relative">
                <input type="password" name="password" id="login-password" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700 dark:text-white">
                <span class="absolute right-3 top-3 cursor-pointer text-gray-800 dark:text-gray-200" onclick="togglePassword('login-password', this)">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>

            </div>
        </div>


        <button 
            type="submit" 
            class="w-full text-white py-2 mt-4 rounded
                        bg-blue-500 hover:bg-blue-600
                        dark:bg-blue-600 dark:hover:bg-blue-400
                        hover:opacity-90
                        transform hover:scale-105 transition duration-300 ease-in-out
                        hover:shadow-[0_4px_10px_rgba(0,0,0,0.5)] dark:hover:shadow-[0_4px_12px_#3b82f6]"
            >
            Login
        </button>
    </form>

    <p class="mt-4 text-center text-gray-600">
        Don't have an account? <a href="signup.php" class="text-blue-600 hover:underline">Signup here</a>
    </p>
</div>

</div>

<script>
    function togglePassword(fieldId) {
        let passwordField = document.getElementById(fieldId);
        passwordField.type = passwordField.type === "password" ? "text" : "password";
    }

    function togglePassword(inputId, toggleIcon) {
        const input = document.getElementById(inputId);
        const icon = toggleIcon.querySelector('i');

        if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
        } else {
        input.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
        }
    }
</script>
