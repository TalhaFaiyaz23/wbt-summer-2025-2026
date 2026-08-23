<?php
// Initialize error and success message variables
$nameErr = $idErr = $emailErr = $deptErr = $passErr = "";
$name = $student_id = $email = $department = $password = "";
$message = "";

// Part 5: Delete Cookie Logic
if (isset($_POST['clear_cookie'])) {
    setcookie("student_name", "", time() - 3600, "/");
    setcookie("student_id", "", time() - 3600, "/");
    // Clear superglobal array values for the current request
    unset($_COOKIE['student_name']);
    unset($_COOKIE['student_id']);
    $message = "Cookie deleted successfully.";
}

// Helper function to sanitize user input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Part 2: PHP Validation Logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    // Student Name Validation
    if (empty($_POST["student_name"])) {
        $nameErr = "Student Name is required.";
    } else {
        $name = test_input($_POST["student_name"]);
        if (!preg_match("/^[a-zA-Z\s]*$/", $name)) {
            $nameErr = "Should contain only letters and spaces.";
        }
    }

    // Student ID Validation
    if (empty($_POST["student_id"])) {
        $idErr = "Student ID is required.";
    } else {
        $student_id = test_input($_POST["student_id"]);
        if (strlen($student_id) < 4) {
            $idErr = "Student ID must contain at least 4 characters.";
        }
    }

    // Email Validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required.";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Please enter a valid email address.";
        }
    }

    // Department Validation
    if (empty($_POST["department"])) {
        $deptErr = "Department must be selected.";
    } else {
        $department = test_input($_POST["department"]);
    }

    // Password Validation
    if (empty($_POST["password"])) {
        $passErr = "Password is required.";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 6) {
            $passErr = "Password must contain at least 6 characters.";
        }
    }

    // Part 3: Implement Cookie if all validation passes
    if (empty($nameErr) && empty($idErr) && empty($emailErr) && empty($deptErr) && empty($passErr)) {
        // Store student_name and student_id in cookies for 1 hour (3600 seconds)
        setcookie("student_name", $name, time() + 3600, "/");
        setcookie("student_id", $student_id, time() + 3600, "/");
        
        // Manually assign to $_COOKIE so display updates immediately without needing a refresh
        $_COOKIE['student_name'] = $name;
        $_COOKIE['student_id'] = $student_id;
        
        $message = "Registration successful! Cookie saved.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <style>
        .error { color: #FF0000; }
        .message { color: #008000; font-weight: bold; }
        .info-box { border: 1px solid #ccc; padding: 10px; margin-bottom: 20px; width: 350px; background-color: #f9f9f9; }
        .form-group { margin-bottom: 12px; }
        label { display: inline-block; width: 140px; }
    </style>
</head>
<body>

    <h2>Student Registration Form</h2>

    <?php if (!empty($message)): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <!-- Part 4: Display Cookie Information -->
    <div class="info-box">
        <?php if (isset($_COOKIE['student_name']) && isset($_COOKIE['student_id'])): ?>
            <h3>Welcome Back!</h3>
            <p><strong>Student Name:</strong> <?php echo htmlspecialchars($_COOKIE['student_name']); ?></p>
            <p><strong>Student ID:</strong> <?php echo htmlspecialchars($_COOKIE['student_id']); ?></p>
        <?php else: ?>
            <p>No saved student information found.</p>
        <?php endif; ?>
    </div>

    <!-- Part 1: Form Structure -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        
        <div class="form-group">
            <label>Student Name:</label>
            <input type="text" name="student_name" value="<?php echo $name;?>">
            <span class="error">* <?php echo $nameErr;?></span>
        </div>

        <div class="form-group">
            <label>Student ID:</label>
            <input type="text" name="student_id" value="<?php echo $student_id;?>">
            <span class="error">* <?php echo $idErr;?></span>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo $email;?>">
            <span class="error">* <?php echo $emailErr;?></span>
        </div>

        <div class="form-group">
            <label>Department:</label>
            <select name="department">
                <option value="">--Select Department--</option>
                <option value="CSE" <?php if ($department == "CSE") echo "selected";?>>CSE</option>
                <option value="EEE" <?php if ($department == "EEE") echo "selected";?>>EEE</option>
                <option value="BBA" <?php if ($department == "BBA") echo "selected";?>>BBA</option>
                <option value="English" <?php if ($department == "English") echo "selected";?>>English</option>
            </select>
            <span class="error">* <?php echo $deptErr;?></span>
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password">
            <span class="error">* <?php echo $passErr;?></span>
        </div>

        <div class="form-group">
            <label>Confirm Password:</label>
            <input type="password" name="confirm_password">
        </div>

        <input type="submit" name="submit" value="Submit">
        <!-- Part 5: Clear Cookie Button -->
        <input type="submit" name="clear_cookie" value="Clear Cookie">
    </form>

</body>
</html>