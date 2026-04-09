<?php
include "connect.php";
// Assume admin login here — for demo, skip it
$result = $conn->query("
  SELECT vr.id, u.user_name, vr.status 
  FROM verification_requests vr 
  JOIN user_master u ON vr.user_id = u.id 
  WHERE vr.status = 'pending'
");
?>
<h2>Admin - Verification Requests</h2>
<table border="1">
  <tr>
    <th>Username</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['user_name'] ?></td>
      <td><?= $row['status'] ?></td>
      <td>
        <a href="handle_request.php?id=<?= $row['id'] ?>&action=approve">✅ Approve</a> |
        <a href="handle_request.php?id=<?= $row['id'] ?>&action=reject">❌ Reject</a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>