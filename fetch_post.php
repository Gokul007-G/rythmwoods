<?php
// db.php
$host = 'localhost';
$db = 'rythm';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// fetch_posts.php
include 'db.php';
$result = $conn->query("SELECT * FROM posters ORDER BY created_on DESC");
$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}
echo json_encode($posts);

// edit_post.php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$content = $data['posters_caption'];
$stmt = $conn->prepare("UPDATE posters SET posters_caption = ? WHERE id = ?");
$stmt->bind_param("si", $content, $id);
$stmt->execute();
echo json_encode(['status' => 'success']);
?>