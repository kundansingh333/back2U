<?php include '../includes/header.php'; ?>

<div class="container mx-auto mt-20">
    <h2 class="text-3xl font-bold text-center text-blue-600">My Reports</h2>

    <form method="GET" action="search_my_reports.php" class="mt-6 flex gap-4 justify-center">
        <input type="text" name="search" placeholder="Search by item name" class="border px-4 py-2 rounded-lg">
        <select name="category" class="border px-4 py-2 rounded-lg">
            <option value="">All Categories</option>
            <option value="Electronics">Electronics</option>
            <option value="Clothing">Clothing</option>
        </select>
        <select name="status" class="border px-4 py-2 rounded-lg">
            <option value="">All Status</option>
            <option value="Lost">Lost</option>
            <option value="Found">Found</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
    </form>

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="px-4 py-2">Item Name</th>
                    <th class="px-4 py-2">Category</th>
                    <th class="px-4 py-2">Description</th>
                    <th class="px-4 py-2">Date & Time</th>
                    <th class="px-4 py-2">Location</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Contact Info</th>
                    <th class="px-4 py-2">Image</th>
                </tr>
            </thead>
            <tbody id="resultsTable">
                <!-- Search results will be injected here -->
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector("input[name='search']");
    const categorySelect = document.querySelector("select[name='category']");
    const statusSelect = document.querySelector("select[name='status']");
    const resultsTable = document.querySelector("#resultsTable");

    function fetchResults() {
        const search = searchInput.value;
        const category = categorySelect.value;
        const status = statusSelect.value;

        fetch(`search_my_reports_ajax.php?search=${encodeURIComponent(search)}&category=${encodeURIComponent(category)}&status=${encodeURIComponent(status)}`)
            .then(response => response.json())
            .then(data => {
                resultsTable.innerHTML = data.length > 0 ? data.map(report => `
                    <tr class="border-t">
                        <td class="px-4 py-2">${report.item_name}</td>
                        <td class="px-4 py-2">${report.category}</td>
                        <td class="px-4 py-2">${report.description}</td>
                        <td class="px-4 py-2">${report.datetime}</td>
                        <td class="px-4 py-2">${report.location}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-white rounded ${report.status === 'Lost' ? 'bg-red-500' : 'bg-green-500'}">
                                ${report.status}
                            </span>
                        </td>
                        <td class="px-4 py-2">${report.contact_info}</td>
                        <td class="px-4 py-2">
                            ${report.image ? `<a href="/Project/public/${report.image}" target="_blank">
                                <img src="/Project/public/${report.image}" alt="Item Image" style="max-width: 100px; height: auto;">
                            </a>` : '<span class="text-gray-500">No Image</span>'}
                        </td>
                    </tr>
                `).join("") : '<tr><td colspan="8" class="text-center text-gray-500 py-4">No reports found.</td></tr>';
            });
    }

    searchInput.addEventListener("keyup", fetchResults);
    categorySelect.addEventListener("change", fetchResults);
    statusSelect.addEventListener("change", fetchResults);

    // Fetch results initially to populate table
    fetchResults();
});
</script>

<?php include '../includes/footer.php'; ?>
