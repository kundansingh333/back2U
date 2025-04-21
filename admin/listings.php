<!-- Search & Filter Form -->
<form id="searchForm" class="flex justify-center gap-4 mt-6 mb-4">
    <input type="text" id="searchInput" name="search" placeholder="Search listings..." class="border bg-white px-4 py-2 rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-700">
    
    <select id="statusFilter" name="status" class="border px-4 py-2 bg-white rounded-lg dark:bg-gray-800 dark:text-white dark:border-gray-700">
        <option value="">All</option>
        <option value="Lost">Lost</option>
        <option value="Found">Found</option>
    </select>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg dark:bg-blue-500 dark:text-white">Search</button>
    <!-- ✅ Verify Items Button -->
    <button type="button" id="verifyBtn" class="bg-green-500 text-white px-4 py-2 rounded-lg dark:bg-green-500 dark:text-white">Verify Items</button>
</form>

<!-- Listings Table -->
<div class="overflow-x-auto mt-6 dark:border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-white/10 dark:shadow-blue-500/10">
    <table class="min-w-full bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-700">
        <thead>
            <tr class="bg-blue-500 text-white dark:bg-blue-500 dark:text-white">
                <th class="px-4 py-2">Username</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Item Name</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Date & Time</th>
                <th class="px-4 py-2">Location</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Contact Info</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Actions</th> <!-- ✅ Column for Delete + Checkbox -->
            </tr>
        </thead>
        <tbody id="resultsTable" class="bg-white text-gray-800 dark:bg-gray-800 dark:text-white">
            <!-- Dynamic results will be inserted here (with checkboxes) -->
        </tbody>
    </table>
</div>

<!-- JavaScript for AJAX -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchForm = document.getElementById("searchForm");
        const searchInput = document.getElementById("searchInput");
        const statusFilter = document.getElementById("statusFilter");
        const resultsTable = document.getElementById("resultsTable");

        // Function to fetch search results and render listings
        function fetchResults() {
            const searchValue = searchInput.value;
            const statusValue = statusFilter.value;

            fetch("search_ajax.php?search=" + encodeURIComponent(searchValue) + "&status=" + encodeURIComponent(statusValue))
                .then(response => response.text())
                .then(data => {
                    resultsTable.innerHTML = data;
                    addDeleteEventListeners();  // Reattach delete event listeners after fetching new results
                })
                .catch(error => {
                    alert("Failed to load data.");
                    console.error("Fetch error:", error);
                });
        }

        // Handle delete item functionality
        function addDeleteEventListeners() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const reportId = button.getAttribute('data-report_id');
                    
                    if (confirm("Are you sure you want to delete this item?")) {
                        fetch('delete_item.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + encodeURIComponent(reportId)
                        })
                        .then(response => response.text())
                        .then(data => {
                            alert(data);
                            fetchResults(); // Re-fetch listings after deletion
                        })
                        .catch(error => {
                            alert("Error deleting item.");
                            console.error("Error:", error);
                        });
                    }
                });
            });
        }

        // ✅ Verify selected items
        const verifyBtn = document.getElementById("verifyBtn");

        verifyBtn.addEventListener("click", function () {
            const selected = [];
            document.querySelectorAll(".verify-checkbox:checked").forEach(checkbox => {
                selected.push(parseInt(checkbox.value));
            });

            if (selected.length !== 2) {
                alert("Please select exactly two items to verify.");
                return;
            }

            verifyBtn.disabled = true;
            verifyBtn.textContent = "Verifying...";

            fetch('verify_items.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ ids: selected })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Items verified successfully.");
                    fetchResults(); // Refresh listings
                } else {
                    alert(data.error || "Verification failed.");
                }
                verifyBtn.disabled = false;
                verifyBtn.textContent = "Verify Items";
            })
            .catch(error => {
                alert("Error verifying items.");
                console.error("Error:", error);
                verifyBtn.disabled = false;
                verifyBtn.textContent = "Verify Items";
            });
        });

        // Trigger live search/filter
        searchInput.addEventListener("input", fetchResults);
        statusFilter.addEventListener("change", fetchResults);

        // Handle manual form submission
        searchForm.addEventListener("submit", function (event) {
            event.preventDefault();
            const searchValue = searchInput.value;
            const statusValue = statusFilter.value;

            window.location.href = "index.php?page=listings&search=" + encodeURIComponent(searchValue) + "&status=" + encodeURIComponent(statusValue);
        });

        fetchResults(); // Load listings on page load
    });
</script>
