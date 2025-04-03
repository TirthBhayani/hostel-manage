<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../../../backend/adminlatestudent.php';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Late Student Report</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
    $('#example').DataTable();

    // Fetch data when filter button is clicked
    $('#filter-btn').click(function () {
        var startDate = $('#start-date').val();
        var endDate = $('#end-date').val();

        $.ajax({
            url: '../../../backend/adminlatestudent.php',
            type: 'POST',
            data: { start_date: startDate, end_date: endDate },
            success: function (response) {
                $('#report-table').html(response);
            }
        });
    });

    // Download PDF using Form Submission
    $('#download-pdf').click(function () {
        var startDate = $('#start-date').val();
        var endDate = $('#end-date').val();

        if (startDate === '' || endDate === '') {
            alert("Please select start and end dates.");
            return;
        }

        // Create a form dynamically
        var form = $('<form action="../../../backend/adminlatestudent.php" method="post" target="_blank">');
        form.append($('<input type="hidden" name="start_date">').val(startDate));
        form.append($('<input type="hidden" name="end_date">').val(endDate));
        form.append($('<input type="hidden" name="generate_pdf">').val(1));

        $('body').append(form);
        form.submit();
        form.remove(); // Remove form after submission
    });
});

    </script>
</head>

<body>
<?php include 'admin_sidebar.php'; ?>
<div class="content">
    <?php include 'admin_topbar.php'; ?>

    <div class="main-content">
        <h2>Late Student History</h2>

        <!-- Date Filter Section -->
         
        <div class="filter-section">
            <label for="start-date">Start Date:</label>
            <input type="date" id="start-date" name="start_date">
            
            <label for="end-date">End Date:</label>
            <input type="date" id="end-date" name="end_date">

            <button id="filter-btn" class="btn btn-primary">Generate Report</button>
            <button id="download-pdf" class="btn btn-danger">Download PDF</button>
        </div>

        <!-- Data Table -->
        <table id="example" class="table">
            <thead>
                <tr>
                    <th>OTR Number</th>
                    <th>Name</th>
                    <th>Check-out Date</th>
                    <th>Check-out Time</th>
                    <th>Check-in Date</th>
                    <th>Check-in Time</th>
                    <th>Late Entry</th>
                </tr>
            </thead>
            <tbody id="report-table">
                <tr>
                    <td colspan="7" class="text-center">Select a date range to generate a report.</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="../javascript/script.js"></script>
</body>

</html>
