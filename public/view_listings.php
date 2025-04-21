<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include '../includes/db_connect.php'; // Database connection

$user_id = $_SESSION["user_id"]; // Get logged-in user ID
$search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%%';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Base SQL query
$sql = "SELECT * FROM reports WHERE user_id = ? AND item_name LIKE ?";
$params = [$user_id, $search];
$types = "is";

// Add category filter if selected
if (!empty($category)) {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

// Add status filter if selected
if (!empty($status)) {
    $sql .= " AND status = ?";
    $params[] = $status;
    $types .= "s";
}

$sql .= " ORDER BY datetime DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include '../includes/header.php'; ?>

<div class="container mx-auto mt-35">
    <h2 class="text-3xl font-bold text-center text-blue-600">My Reports</h2>

    <form method="GET" action="search_my_reports.php" class="mt-6 flex gap-4 justify-center">
        <input type="text" name="search" placeholder="Search by item name" class="border px-4 py-2 rounded-lg" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        <select name="category" class="border px-4 py-2 rounded-lg">
            <option value="">All Categories</option>
            <option value="Electronics" <?php if ($category == 'Electronics') echo 'selected'; ?>>Electronics</option>
            <option value="Clothing" <?php if ($category == 'Clothing') echo 'selected'; ?>>Clothing</option>
        </select>
        <select name="status" class="border px-4 py-2 rounded-lg">
            <option value="">All Status</option>
            <option value="Lost" <?php if ($status == 'Lost') echo 'selected'; ?>>Lost</option>
            <option value="Found" <?php if ($status == 'Found') echo 'selected'; ?>>Found</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
    </form>

    <div class="overflow-x-auto mt-6 rounded-lg shadow-lg">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead>
                <tr class="bg-blue-500 text-white h-12 rounded-lg">
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
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr class="border-t bg-white text-gray-800 dark:bg-gray-800 dark:text-white">
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row["item_name"]); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row["category"]); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row["description"]); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row["datetime"]); ?></td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row["location"]); ?></td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-white rounded <?php echo $row['status'] === 'Lost' ? 'bg-red-500' : 'bg-green-500'; ?>">
                                <?php echo htmlspecialchars($row["status"]); ?>
                            </span>
                        </td>
                        <td class="px-4 py-2"><?php echo htmlspecialchars($row["contact_info"]); ?></td>
                        <td class="px-4 py-2">
                            <?php if (!empty($row["image"])) { ?>
                                <a href="/Project/public/<?php echo htmlspecialchars($row["image"]); ?>" target="_blank">
                                    <img src="/Project/public/<?php echo htmlspecialchars($row["image"]); ?>" alt="Item Image" style="max-width: 100px; height: auto;">
                                </a>
                            <?php } else { ?>
                                <span class="text-gray-500">No Image</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$stmt->close();
$conn->close();
// include '../includes/footer.php';
// ?>