<!DOCTYPE html>
<html>
<head><title>Registration Successful</title></head>
<body>

<h2>Registration Successful</h2>

<p><strong>Student ID:</strong> <?= htmlspecialchars($_SESSION['student']['student_id']) ?></p>
<p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['student']['name']) ?></p>
<p><strong>Uploaded File:</strong> <?= htmlspecialchars($_SESSION['student']['document']) ?></p>
<p><strong>Cookie (last_student_id):</strong> <?= htmlspecialchars($_COOKIE['last_student_id'] ?? '') ?></p>

<a href="index.php">Register Another Student</a>

</body>
</html>
