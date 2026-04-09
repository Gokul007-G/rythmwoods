<?php
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'];
     // Use prepared statements to prevent SQL injection
    $updateQuery = $con->query("SELECT * from `posters` WHERE `id` = '$postId'");
	//echo "UPDATE `posters` SET `likestatus` = '$likeStatus' WHERE `id` = '$postId'";
	
	$row=$updateQuery->fetch(PDO::FETCH_ASSOC);
    
 if ($row) {
        $postType = $row['post_type']; // Assuming there is a column named 'post_type' to determine if it's an image or video

        $response = array('postType' => $postType);

        if ($postType === 'image') {
            $response['content'] = $row['postimg'];
        } 
		elseif ($postType === 'video') {
            $response['content'] = $row['postvideos'];
        }
		else {
            $response['content'] = 'Invalid post type';
        }

        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'Post not found'));
    }
} else {
    echo json_encode(array('error' => 'Invalid request method'));
}
?>
