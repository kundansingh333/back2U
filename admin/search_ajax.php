<?php
// include '../includes/db_connect.php'; // Database connection

// $search = isset($_GET['search']) ? trim($_GET['search']) : '';
// $filter_status = isset($_GET['status']) ? $_GET['status'] : '';

// $sql = "SELECT r.*, u.username, u.email 
//         FROM reports r
//         JOIN users u ON r.user_id = u.id 
//         WHERE 1=1 ";

// $params = [];
// $types = "";

// // Add search filter
// if (!empty($search)) {
//     $sql .= " AND (r.item_name LIKE ? OR r.category LIKE ? OR r.location LIKE ? OR r.status LIKE ?) ";
//     $search_param = "%$search%";
//     array_push($params, $search_param, $search_param, $search_param, $search_param);
//     $types .= "ssss";
// }

// // Add status filter
// if (!empty($filter_status)) {
//     $sql .= " AND r.status = ? ";
//     array_push($params, $filter_status);
//     $types .= "s";
// }

// $sql .= " ORDER BY r.datetime DESC";

// $stmt = $conn->prepare($sql);
// if (!empty($types)) {
//     $stmt->bind_param($types, ...$params);
// }
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         echo "<tr class='border-t'>";
        
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["username"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["email"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["item_name"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["category"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["description"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["datetime"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["location"]) . "</td>";

//         echo "<td class='px-4 py-2'>";
//         echo "<span class='px-2 py-1 text-white rounded " . 
//              ($row['status'] === 'Lost' ? 'bg-red-500' : ($row['status'] === 'Found' ? 'bg-green-500' : 'bg-yellow-500')) . "'>";
//         echo htmlspecialchars($row["status"]) . "</span>";
//         echo "</td>";

//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["contact_info"]) . "</td>";

//         echo "<td class='px-4 py-2'>";
//         if (!empty($row["image"])) {
//             echo "<a href='/Project/public/" . htmlspecialchars($row["image"]) . "' target='_blank'>";
//             echo "<img src='/Project/public/" . htmlspecialchars($row["image"]) . "' alt='Item Image' style='max-width: 100px; height: auto;'>";
//             echo "</a>";
//         } else {
//             echo "<span class='text-gray-500'>No Image</span>";
//         }
//         echo "</td>";

//         // ✅ Actions: Delete + Checkbox
//         echo "<td class='px-4 py-2'>";
//         echo "<button class='delete-btn bg-red-500 text-white px-2 py-1 rounded' data-report_id='" . htmlspecialchars($row["report_id"]) . "'>Delete</button>";
//         echo "<input type='checkbox' class='verify-checkbox ml-2' value='" . htmlspecialchars($row["report_id"]) . "'>";
//         echo "</td>";

//         echo "</tr>";
//     }
// } else {
//     echo "<tr><td colspan='11' class='text-center text-gray-500 py-4'>No listings found.</td></tr>";
// }

// $stmt->close();
// $conn->close();
?>



<?php
// include '../includes/db_connect.php'; // Database connection

// $search = isset($_GET['search']) ? trim($_GET['search']) : '';
// $filter_status = isset($_GET['status']) ? $_GET['status'] : '';

// $sql = "SELECT r.*, u.username, u.email 
//         FROM reports r
//         JOIN users u ON r.user_id = u.id 
//         WHERE 1=1 ";

// $params = [];
// $types = "";

// // Add search filter
// if (!empty($search)) {
//     $sql .= " AND (r.item_name LIKE ? OR r.category LIKE ? OR r.location LIKE ? OR r.status LIKE ?) ";
//     $search_param = "%$search%";
//     array_push($params, $search_param, $search_param, $search_param, $search_param);
//     $types .= "ssss";
// }

// // Add status filter
// if (!empty($filter_status)) {
//     $sql .= " AND r.status = ? ";
//     array_push($params, $filter_status);
//     $types .= "s";
// }

// $sql .= " ORDER BY r.datetime DESC";

// $stmt = $conn->prepare($sql);
// if (!empty($types)) {
//     $stmt->bind_param($types, ...$params);
// }
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         echo "<tr class='border-t'>";
        
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["username"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["email"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["item_name"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["category"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["description"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["datetime"]) . "</td>";
//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["location"]) . "</td>";

//         // ✅ Force status column to only show "Lost" or "Found"
//         $status = strtolower($row["status"]) === "verified" ? "Found" : $row["status"];
//         $status_color = $status === 'Lost' ? 'bg-red-500' : 'bg-green-500';

//         echo "<td class='px-4 py-2'>";
//         echo "<span class='px-2 py-1 text-white rounded $status_color'>";
//         echo htmlspecialchars($status) . "</span>";
//         echo "</td>";

//         echo "<td class='px-4 py-2'>" . htmlspecialchars($row["contact_info"]) . "</td>";

//         echo "<td class='px-4 py-2'>";
//         if (!empty($row["image"])) {
//             echo "<a href='/Project/public/" . htmlspecialchars($row["image"]) . "' target='_blank'>";
//             echo "<img src='/Project/public/" . htmlspecialchars($row["image"]) . "' alt='Item Image' style='max-width: 100px; height: auto;'>";
//             echo "</a>";
//         } else {
//             echo "<span class='text-gray-500'>No Image</span>";
//         }
//         echo "</td>";

//         // ✅ Actions: Delete + Verified Label or Checkbox
//         echo "<td class='px-4 py-2'>";
//         echo "<button class='delete-btn bg-red-500 text-white px-2 py-1 rounded' data-report_id='" . htmlspecialchars($row["report_id"]) . "'>Delete</button>";

//         if (strtolower($row["status"]) !== 'verified') {
//             echo "<input type='checkbox' class='verify-checkbox ml-2' value='" . htmlspecialchars($row["report_id"]) . "'>";
//         } else {
//             echo "<div class='text-green-600 mt-1 font-semibold'>✔ Verified</div>";
//         }

//         echo "</td>";

//         echo "</tr>";
//     }
// } else {
//     echo "<tr><td colspan='11' class='text-center text-gray-500 py-4'>No listings found.</td></tr>";
// }

// $stmt->close();
// $conn->close();
?>






<?php
// Include database connection
include '../includes/db_connect.php'; 

// Get the search and status filter parameters
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$filter_status = isset($_GET['status']) ? $_GET['status'] : '';

// Debugging output for received parameters
// echo "Search: " . $search . "<br>";
// echo "Status: " . $filter_status . "<br>";

$sql = "SELECT r.*, u.username, u.email 
        FROM reports r
        JOIN users u ON r.user_id = u.id 
        WHERE 1=1 ";

$params = [];
$types = "";

// Add search filter if search term is not empty
if (!empty($search)) {
    $sql .= " AND (r.item_name LIKE ? OR r.category LIKE ? OR r.location LIKE ? OR r.status LIKE ?) ";
    $search_param = "%$search%";
    array_push($params, $search_param, $search_param, $search_param, $search_param);
    $types .= "ssss";
}

// Add status filter if status is provided
if (!empty($filter_status)) {
    $sql .= " AND r.status = ? ";
    array_push($params, $filter_status);
    $types .= "s";
}

// Add ordering
$sql .= " ORDER BY r.datetime DESC";

// Debugging output for SQL query
// echo "SQL Query: " . $sql . "<br>";

$stmt = $conn->prepare($sql);
if (!empty($types)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Check if any results are returned
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='border-t'>";
        
        echo "<td class='px-4 py-2'>" . htmlspecialchars($row["username"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($row["item_name"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($row["category"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($row["description"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($row["datetime"]) . "</td>";
        echo "<td class='px-4 py-2'>" . htmlspecialchars($row["location"]) . "</td>";

        // Force status column to show "Lost" or "Found"
        $status = strtolower($row["status"]) === "verified" ? "Found" : $row["status"];
        $status_color = $status === 'Lost' ? 'bg-red-500' : 'bg-green-500';

        echo "<td class='px-4 py-2'>";
        echo "<span class='px-2 py-1 text-white rounded $status_color'>";
        echo htmlspecialchars($status) . "</span>";
        echo "</td>";

        echo "<td class='px-4 py-2'>" . htmlspecialchars($row["contact_info"]) . "</td>";

        echo "<td class='px-4 py-2'>";
        if (!empty($row["image"])) {
            echo "<a href='/Project/public/" . htmlspecialchars($row["image"]) . "' target='_blank'>";
            echo "<img src='/Project/public/" . htmlspecialchars($row["image"]) . "' alt='Item Image' style='max-width: 100px; height: auto;'>";
            echo "</a>";
        } else {
            echo "<span class='text-gray-500'>No Image</span>";
        }
        echo "</td>";

        // Actions: Delete + Verified Label or Checkbox
        echo "<td class='px-4 py-2'>";
        echo "<button class='delete-btn text-red-500  px-2 py-1 rounded' data-report_id='" . htmlspecialchars($row["report_id"]) . "'><i class='fa-solid fa-trash fa-xl'></i></button>";

        if (strtolower($row["status"]) !== 'verified') {
            echo "<input type='checkbox' class='verify-checkbox ml-2' value='" . htmlspecialchars($row["report_id"]) . "'>";
        } else {
            echo "<div class='text-green-600 mt-1 font-semibold'>✔ Verified</div>";
        }

        echo "</td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='11' class='text-center text-gray-500 py-4'>No listings found.</td></tr>";
}

$stmt->close();
$conn->close();
?>

