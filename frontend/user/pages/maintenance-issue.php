<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Issue</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../CSS/maintenace-issue.css">

    <style>
        /* Textarea styling */
       
    </style>
    <script>
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.user img')) {
                var dropdowns = document.getElementsByClassName("dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</head>
<body>
    <?php 
    session_start(); // Start the session
    include 'sidebar.php'; 
    ?>
    <div class="content">
        <div class="top-bar">

            <h1>Maintenance Issue</h1>
            <div class="user">
                <!-- Profile image that triggers the dropdown -->
                <img src="photos/Gpay.png" alt="Profile" onclick="toggleDropdown()">
                <!-- Dropdown menu for logout -->
                <div id="dropdown" class="dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="main-content">
            <h2>Describe the maintenance issue:</h2>
            <form action="../../../backend/user/submit_issue.php" method="post">
                <textarea id="issue" name="issue" rows="10" required></textarea>
                <input type="submit" value="Submit Issue">
            </form>
        </div>
    </div>
</body>
</html>
