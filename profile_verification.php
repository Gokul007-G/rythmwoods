<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}
.sidebar {
    margin-left: -261px;
    background-color: black;
    color: white;
    height: 100vh;
    width: 250px;
    position: fixed;
    overflow-y: auto; /* Enable vertical scrolling */
}
element.style{
  margin-left: 300px;
    overflow-y: auto;
    max-height: 100vh;
}
.header{
    padding:8px 1px;

}
.container{
    margin-left: 240px;
}
h1 {
    color: #333;
}

form {
    margin-top: 20px;
}

input, textarea, button {
    padding: 10px;
    margin: 5px 0;
    width: 100%;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

a {
    color: #007BFF;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Verification</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h1>Request Profile Verification</h1>

    <form action="submit_verification.php" method="POST" enctype="multipart/form-data">
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="reason">Reason for Verification:</label><br>
        <textarea id="reason" name="reason" rows="4" required></textarea><br><br>

        <label for="id_proof">Upload ID Proof:</label><br>
        <input type="file" id="id_proof" name="id_proof" accept="image/*,application/pdf" required><br><br>

        <button type="submit">Submit Request</button>
    </form>

</body>
</html>
