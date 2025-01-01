<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $to = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL); // Validate email

    if ($to) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = '220170116004@vgecg.ac.in'; // Your email address
            $mail->Password = 'cruecbkasqqupioq'; // Use App Password instead of your actual password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
            $mail->Port = 587; // TLS port

            // Recipients
            $mail->setFrom('220170116004@vgecg.ac.in', 'Hostel Admin');
            $mail->addAddress($to); // Recipient's email address

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Pending Fees Reminder';
            $mail->Body = "Dear Student,<br><br>This is a reminder to kindly pay your pending fees as soon as possible.<br><br>Thank you!";
            $mail->AltBody = "Dear Student,\n\nThis is a reminder to kindly pay your pending fees as soon as possible.\n\nThank you!";

            $mail->send();
            echo "<script>
                alert('Reminder email sent successfully to $to'); 
                window.location.href='../frontend/admin/pages/pendingfees.php';
            </script>";
        } catch (Exception $e) {
            echo "<script>
                alert('Failed to send email. Mailer Error: {$mail->ErrorInfo}'); 
                window.location.href='../frontend/admin/pages/pendingfees.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Invalid email address.'); 
            window.location.href='../frontend/admin/pages/pendingfees.php';
        </script>";
    }
} else {
    header('Location: ../frontend/admin/pages/pendingfees.php');
    exit();
}
?>
