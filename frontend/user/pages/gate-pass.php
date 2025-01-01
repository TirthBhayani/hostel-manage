
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDHostel - Gate Pass & Leave Request</title>
    <link rel="stylesheet" href="../CSS/gate-pass.css">
    <style>
     
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
            <h1><a href="dashboard.php">SDHOSTEL</a></h1>
            <div class="user">
                <!-- Profile image -->
                <img src="photos/Gpay.png" alt="Profile" onclick="toggleDropdown()">
                <!-- Dropdown menu -->
                <div id="dropdown" class="dropdown">
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="form-container">
                <h2>Gate Pass & Leave Request</h2>
                <form action="../../../backend/user/gate-pass.php" method="POST">
                    <!-- <div class="form-group">
                        <label for="otr_number">OTR Number:</label>
                        <input type="text" id="otr_number" name="otr_number">
                    </div>
                    <div class="form-group">
                        <label for="otr_number">Name:</label>
                        <input type="text" id="Name" name="Name">   
                    </div> -->
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="Gate">Gate Pass</option>
                            <option value="Leave">Leave</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="reason">Reason:</label>
                        <select id="reason" name="reason" required>
                            <option value="">Select Reason</option>
                            <option value="Medical">Medical</option>
                            <option value="Relative Meeting">Relative Meeting</option>
                            <option value="College">College</option>
                            <option value="Home">Home</option>
                            <option value="Salon">Salon</option>
                            <option value="Shopping">Shopping</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="out_time">Approximate Out Time:</label>
                        <input type="time" id="out_time" name="out_time" required>
                    </div>

                    <div class="form-group">
                        <label for="in_time">Approximate In Time:</label>
                        <input type="time" id="in_time" name="in_time" required>
                    </div>

                    <div class="form-group">
                        <label for="date_from">Date From:</label>
                        <input type="date" id="date_from" name="date_from" required>
                    </div>

                    <div class="form-group">
                        <label for="date_to">Date To:</label>
                        <input type="date" id="date_to" name="date_to" required>
                    </div>

                    <div class="form-group">
                        <button type="submit">Submit Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
