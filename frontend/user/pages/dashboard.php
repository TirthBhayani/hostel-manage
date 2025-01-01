<?php
include '../../../backend/dbconnection.php'; // Database connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDHostel</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">

    <script>
        // Toggle sidebar visibility
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const content = document.querySelector('.content');
            sidebar.classList.toggle('hidden');
            content.classList.toggle('full-width');
        }

        // Toggle dropdown visibility
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown-menu');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }

        // Close dropdown if clicked outside
        window.onclick = function (event) {
            if (!event.target.matches('.profile-pic')) {
                const dropdowns = document.getElementsByClassName("dropdown");
                for (let i = 0; i < dropdowns.length; i++) {
                    dropdowns[i].style.display = "none";
                }
            }
        };
    </script>
</head>

<body>
    <div class="sidebar">
    <ul class="menu">
            <li><a href="hostel-fees.php">Hostel Fees</a></li>
            <li><a href="maintenance-issue.php">Maintenance Issue</a></li>
            <li><a href="gate-pass.php">Gate Pass & Leave</a></li>
            <li><a href="gate-pass-status.php">Status</a></li>
            <li><a href="change-password.php">Change Password</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="top-bar">
            <button class="toggle-btn" onclick="toggleSidebar()">☰</button>
            <h1><a href="dashboard.php">SDHOSTEL</a></h1>
            <div class="user">
                <img src="../photos/Gpay.png" alt="Profile Picture" class="profile-pic" onclick="toggleDropdown()">
                <div id="dropdown-menu" class="dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div class="main-content">
            <!-- Dynamic content will be loaded here -->
            <!-- <?php
            // Load the appropriate content based on the 'page' query parameter
            // if (isset($_GET['page'])) {
            //     $page = $_GET['page'];

            //     // Use include to load the corresponding page
            //     $contentFile = strtolower($page) . '.php';
            //     if (file_exists($contentFile)) {
            //         include($contentFile);
            //     } else {
            //         echo "<p>Page not found.</p>";
            //     }
            // } else {
            //     echo "<p>Welcome to the Admin Dashboard.</p>";
            // }
            // ?> -->
        </div>
    </div>
</body>

</html>
