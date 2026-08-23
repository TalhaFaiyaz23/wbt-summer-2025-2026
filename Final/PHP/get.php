<!DOCTYPE html>
<html>

<head>
    <title>GET Request Example</title>
</head>

<body>

<h2>Search Student</h2>

<form method="GET" action="get.php">

    <label>Student ID:</label>

    <input type="text" name="student_id">

    <button type="submit">Search</button>

</form>

<?php

if (isset($_GET["student_id"])) {

    $student_id = $_GET["student_id"];

    echo "<h3>Search Result</h3>";

    echo "Student ID: " . $student_id;
}

?>

</body>

</html>