



<!-- Main Content -->
<div class="flex-1 p-6 ">



    <h1 class="text-3xl font-bold text-gray-800 dark:text-white text-center">Manage Users</h1>
    
    <!-- text-gray-100 drop-shadow-sm border border-white/10 shadow-lg shadow-blue-500/10 bg-gray-800 p-4 rounded-xl -->
    <!-- Users Table -->
    <div class="text-gray-800 bg-white mt-6 p-6 rounded-lg shadow-md dark:bg-gray-800 border-gray-300  dark:text-white border dark:border-white/10 shadow-lg dark:shadow-blue-500/10">
        <h2 class="text-2xl font-semibold mb-4 text-center text-shadow-lg dark:text-shadow-lg">Registered Users</h2>
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b bg-blue-500 text-white">
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Email</th>
                    <th class="py-2 px-4">Role</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../includes/db_connect.php';
                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr class='border-b'>";
                    echo "<td class='py-2 px-4'>".$row['id']."</td>";
                    echo "<td class='py-2 px-4'>".$row['username']."</td>";
                    echo "<td class='py-2 px-4'>".$row['email']."</td>";
                    echo "<td class='py-2 px-4'>".($row['role'] == 'admin' ? "<span class='text-red-500 font-bold'>Admin</span>" : "User")."</td>";
                    echo "<td class='py-2 px-4'>
                            <a href='edit_user.php?id=".$row['id']."' class='text-blue-500'><i class='fas fa-edit fa-lg'></i></a> |
                            <a href='delete_user.php?id=".$row['id']."' class='text-red-500' onclick='return confirm(\"Are you sure you want to delete this user?\")'><i class='fa-solid fa-trash fa-lg'></i></a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


