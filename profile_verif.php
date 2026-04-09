<?php
include "connect.php";
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM verification_requests WHERE user_id = $user_id AND status = 'pending'");
$alreadyRequested = $result->num_rows > 0;
?>
<!DOCTYPE html>
<html>
<head>
  <title>Request Verification</title>
</head>
<body>
<h2>Request Profile Verification</h2>

<?php if ($alreadyRequested): ?>
  <p>Your request is under review.</p>
<?php else: ?>
  <form method="POST" action="submit_verification.php">
    <p>Submit a request to verify your account. Our team will review it.</p>
    <button type="submit">Request Verification</button>
  </form>
<?php endif; ?>

<a href="profile.php">Back to Profile</a>
</body>
</html>
