<?php
// Database connection
include '../includes/db_connect.php';
session_start();

// Fetch user information for session
$admin_name = "Guest"; // Default name if no session is found

if (isset($_SESSION['user_id'])) { 
    $id = $_SESSION['user_id']; 

    // Secure query using prepared statements
    $query = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $admin_name = htmlspecialchars($admin['username']);
    }
    $stmt->close();
}

// Fetch counts dynamically
$totalReportsQuery = "SELECT COUNT(*) AS total FROM reports";
$totalVerifiedQuery = "SELECT COUNT(*) AS verified FROM verified_item";
$totalResolvedQuery = "SELECT COUNT(*) AS resolved FROM verified_item";

// Execute the queries
$totalReports = $conn->query($totalReportsQuery)->fetch_assoc()['total'];
$totalVerified = $conn->query($totalVerifiedQuery)->fetch_assoc()['verified'];
$totalResolved = $conn->query($totalResolvedQuery)->fetch_assoc()['resolved'];

// Calculate the total pending reports
$totalPending = $totalReports - $totalVerified;
?>

<!-- Main Content -->
<div class="flex-1 p-6">
    <h1 class="t_color text-3xl font-bold text-gray-800 text-center dark:text-white ">Welcome <?= ucfirst($admin_name) ?></h1>

    <!-- Dashboard Stats -->
    <div class="grid grid-cols-3 gap-6 mt-6">
        <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-800 transition-all duration-300 transform hover:-translate-y-2 hover:border hover:shadow-lg hover:shadow-black/20 border border-transparent dark:bg-gray-800 dark:border dark:border-white/10 dark:hover:border-blue-500 dark:hover:shadow-blue-500/30 dark:text-white"
        >
            <h3 class="text-xl font-semibold">Total Reports</h3>
            <p class="text-3xl font-bold text-blue-600"><?= $totalReports ?></p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-800 transition-all duration-300 transform hover:-translate-y-2 hover:border hover:shadow-lg hover:shadow-black/20 border border-transparent dark:bg-gray-800 dark:border dark:border-white/10 dark:hover:border-green-500 dark:hover:shadow-green-500/30 dark:text-white"
        >
            <h3 class="text-xl font-semibold">Resolved Cases</h3>
            <p id="resolved-count" class="text-3xl font-bold text-green-600"><?= $totalResolved ?></p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-800 transition-all duration-300 transform hover:-translate-y-2 hover:border hover:shadow-lg hover:shadow-black/20 border border-transparent dark:bg-gray-800 dark:border dark:border-white/10 dark:hover:border-red-500 dark:hover:shadow-red-500/30 dark:text-white"
        >
            <h3 class="text-xl font-semibold">Pending Reports</h3>
            <p id="pending-count" class="text-3xl font-bold text-red-600"><?= $totalPending ?></p>
        </div>
    </div>

    <!-- Recent Listings Table -->
    <div class="bg-white mt-6 p-6 rounded-lg shadow-md text-gray-800 dark:bg-gray-800 dark:border dark:border-white/10 dark:shadow-blue-500/10 dark:text-white">
        <h2 class="text-2xl font-semibold mb-4 text-center">Verified Reports</h2>
        <table class="w-full text-left ">
            <thead>
                <tr class="border-b bg-blue-500 text-white">
                    <th class="py-2 pl-3">ID</th>
                    <th class="py-2">Item</th>
                    <th class="py-2">Status</th>
                    <th class="py-2">User</th>
                    <th class="py-2">Verification Date</th>
                    <th class="py-2">Actions</th>
                    <!-- Added column -->
                    <th class="py-2">Mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to fetch the verified items
                $query = "
                    SELECT vi.id, vi.item_name, vi.status, vi.username, vi.verification_date, vi.actions, r.report_id, u.email AS user_email
                    FROM verified_item vi
                    LEFT JOIN users u ON vi.user_id = u.id
                    LEFT JOIN reports r ON vi.report_id = r.report_id
                    ORDER BY vi.verification_date DESC
                    LIMIT 5";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-b'>";
                        echo "<td class='py-2 pl-3'>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td class='py-2'>" . htmlspecialchars($row['item_name']) . "</td>";
                        echo "<td class='py-2'>
                                <span class='px-2 py-1 text-white " . ($row['status'] == 'found' ? 'bg-green-500 rounded-lg' : 'bg-red-500 rounded-lg') . "'>
                                    " . htmlspecialchars($row['status']) . "
                                </span>
                              </td>";
                        echo "<td class='py-2'>" . htmlspecialchars($row['username'] ?? 'Unknown') . "</td>";
                        echo "<td class='py-2'>" . htmlspecialchars($row['verification_date']) . "</td>";
                        echo "<td class='py-2'>
                                
                                <a href='delete_verified_item.php?id=" . htmlspecialchars($row['id']) . "' class='text-red-500' onclick='return confirm(\"Are you sure?\")'><i class='fa-solid fa-trash fa-lg'></i></a>
                              </td>";
                        // Added mail button
                        echo "<td class='py-2'>
                                <button 
                                    onclick=\"openEmailForm('" . htmlspecialchars($row['user_email']) . "', '" . htmlspecialchars($admin_name) . "')\" 
                                    class='text-blue-500 px-3 py-1 rounded'>
                                    <i class='fa-solid fa-paper-plane fa-lg'></i>
                                </button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center py-4 text-gray-500'>No verified reports found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Added code starts here -->
<!-- Email Form Modal -->
<div id="emailModal" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden items-center justify-center z-50 hover:dark:bg-opacity-70">
    <div class="bg-white text-gray-800 p-6 rounded shadow-lg w-full max-w-md  shadow-gray-800  dark:bg-gray-800 dark:text-white dark:border dark:border-white/10 dark:shadow-blue-500 transition-transform duration-300 hover:scale-105 ">
        <h2 class="head_text text-xl  font-semibold mb-4 text-center ">Send Email</h2>
        <form action="send_mail.php" method="POST">
            <input type="hidden" id="sender_name" name="sender_name">
            <div class="mb-4">
                <label for="receiver_email" class="block text-sm font-medium">To</label>
                <input type="email" id="receiver_email" name="receiver_email" class="w-full border px-3 py-2 rounded" readonly>
            </div>
            <div class="mb-4">
                <label for="subject" class="block text-sm font-medium">Subject</label>
                <input type="text" name="subject" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium">Message</label>
                <textarea name="message" class="w-full border px-3 py-2 rounded" rows="4" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEmailForm()" class="bg-gray-400 text-white px-4 py-2 mr-2 rounded">Cancel</button>
                <button type="submit" name="submit" class="bg-green-500 text-white px-4 py-2 rounded">Send</button>
            </div>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
function openEmailForm(email, senderName) {
    document.getElementById("receiver_email").value = email;
    document.getElementById("sender_name").value = senderName;
    document.getElementById("emailModal").classList.remove("hidden");
    document.getElementById("emailModal").classList.add("flex");
}

function closeEmailForm() {
    document.getElementById("emailModal").classList.remove("flex");
    document.getElementById("emailModal").classList.add("hidden");
}

</script>
<!-- Added code ends here -->
