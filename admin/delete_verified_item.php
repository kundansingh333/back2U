
<?php
include '../includes/db_connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (is_numeric($id)) {
        $conn->begin_transaction();

        try {
            // STEP 1: Get the report_id from verified_item BEFORE deleting
            $getReportId = "SELECT report_id FROM verified_item WHERE id = ?";
            $stmt = $conn->prepare($getReportId);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $report_id = null;

            if ($result && $row = $result->fetch_assoc()) {
                $report_id = $row['report_id'];
            }
            $stmt->close();

            if ($report_id !== null) {
                // STEP 2: Delete from reports (will cascade delete from verified_item if FK is set)
                $deleteReport = "DELETE FROM reports WHERE report_id = ?";
                $stmt2 = $conn->prepare($deleteReport);
                $stmt2->bind_param("i", $report_id);
                $stmt2->execute();
                $stmt2->close();

                $conn->commit();
                header("Location: index.php?page=dashboard&status=success");
                exit;
            } else {
                // No report found
                $conn->rollback();
                header("Location: index.php?page=dashboard&status=notfound");
                exit;
            }

        } catch (Exception $e) {
            $conn->rollback();
            header("Location: index.php?page=dashboard&status=error");
            exit;
        }

    } else {
        header("Location: index.php?page=dashboard&status=invalid");
        exit;
    }

} else {
    header("Location: index.php?page=dashboard&status=missing");
    exit;
}
?>
