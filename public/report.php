<?php
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Fetch user details from session
$username = $_SESSION["username"];
$email = $_SESSION["email"];
?>
<?php include '../includes/header.php'; ?>
<div class="bg-gray-100 flex justify-center items-center h-screen dark:bg-gray-900 ">

    <div class="bg-white text-gray-700 p-8 rounded-lg shadow-md w-full max-w-3xl rounded-lg shadow-md dark:bg-gray-800 dark:border dark:border-white/10 dark:shadow-blue-500/10 dark:text-white">
        <h2 class="text-2xl font-bold text-center text-blue-600">Report Item</h2>

        <form action="report_process.php" method="POST" enctype="multipart/form-data" class="mt-6 ">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 dark:text-white" for="item-name">Item Name</label>
                    <input type="text" name="item_name" id="item-name" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-white" for="category">Category</label>
                    <select name="category" id="category" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="Electronics">Electronics</option>
                        <option value="Documents">Documents</option>
                        <option value="Accessories">Accessories</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 dark:text-white" for="description">Description</label>
                    <textarea name="description" id="description" rows="3" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Give the description of the product Found/Lost....."></textarea>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-white" for="datetime">Date & Time</label>
                    <input type="datetime-local" name="datetime" id="datetime" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500 ">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-white" for="location">Location (Where Lost/Found)</label>
                    <input type="text" name="location" id="location" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-white" for="status">Status</label>
                    <select name="status" id="status" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Select Status --</option>
                        <option value="Lost">Lost</option>
                        <option value="Found">Found</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-white" for="contact-info">Contact Information</label>
                    <input type="text" name="contact_info" id="contact-info" required class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-700 dark:text-white" for="image">Upload Image (if available)</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded focus:outline-none">
                </div>
            </div>
            <button
                type="submit"
                id="report-btn"
                class="w-full text-white py-2 mt-4 rounded
                        bg-blue-500 hover:bg-blue-600
                        dark:bg-blue-600 dark:hover:bg-blue-400
                        hover:opacity-90
                        transform hover:scale-105 transition duration-300 ease-in-out
                        hover:shadow-[0_4px_10px_rgba(0,0,0,0.5)] dark:hover:shadow-[0_4px_12px_#3b82f6]"
                >
                Report Item
            </button>


        </form>

        <!-- <p class="mt-4 text-center">
            Found an item? 
        </p> -->
    </div>

</div>
<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        let isValid = true;
        let errorMessage = "";

        // Get form fields
        let itemName = document.getElementById("item-name").value.trim();
        let category = document.getElementById("category").value;
        let description = document.getElementById("description").value.trim();
        let datetime = document.getElementById("datetime").value;
        let location = document.getElementById("location").value.trim();
        let status = document.getElementById("status").value;
        let contactInfo = document.getElementById("contact-info").value.trim();

        // Validation logic
        if (itemName === "") {
            isValid = false;
            errorMessage += "Item Name is required.\n";
        }
        if (category === "") {
            isValid = false;
            errorMessage += "Category is required.\n";
        }
        if (description === "") {
            isValid = false;
            errorMessage += "Description is required.\n";
        }
        if (datetime === "") {
            isValid = false;
            errorMessage += "Date & Time is required.\n";
        }
        if (location === "") {
            isValid = false;
            errorMessage += "Location is required.\n";
        }
        if (status === "") {
            isValid = false;
            errorMessage += "Status must be selected.\n";
        }
        if (contactInfo === "") {
            isValid = false;
            errorMessage += "Contact Information is required.\n";
        }

        // If validation fails, prevent form submission and show alert
        if (!isValid) {
            alert(errorMessage);
            event.preventDefault(); // Stop form submission
        }
    });

    // Button color change logic
    document.getElementById("status").addEventListener("change", function() {
        let status = this.value;
        let button = document.getElementById("report-btn");

        if (status === "Lost") {
            button.className = "w-full text-white py-2 rounded hover:opacity-80 bg-red-500";
        } else if (status === "Found") {
            button.className = "w-full text-white py-2 rounded hover:opacity-80 bg-green-500";
        } else {
            button.className = "w-full text-white py-2 rounded hover:opacity-80 bg-blue-500";
        }
    });
</script>
