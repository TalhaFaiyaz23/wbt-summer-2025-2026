<!DOCTYPE html>
<html>
<head><title>Student Registration</title></head>
<body>

<h2>Student Registration Form</h2>

<?php if (!empty($errors)): ?>
    <div style="color:red">
        <?php foreach ($errors as $error): ?>
            <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="index.php" method="POST" enctype="multipart/form-data">

    <label>Student ID:</label>
    <input type="text" name="student_id" value="<?= htmlspecialchars($old['student_id'] ?? '') ?>">
    <br><br>

    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>">
    <br><br>

    <label>Email:</label>
    <input type="text" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
    <br><br>

    <label>Password:</label>
    <input type="password" name="password">
    <br><br>

    <label>Gender:</label>
    <input type="radio" name="gender" value="Male" <?= (($old['gender'] ?? '') === 'Male') ? 'checked' : '' ?>> Male
    <input type="radio" name="gender" value="Female" <?= (($old['gender'] ?? '') === 'Female') ? 'checked' : '' ?>> Female
    <br><br>

    <label>Department:</label>
    <select name="department">
        <option value="">Select Department</option>
        <?php foreach (['CSE', 'EEE', 'BBA', 'English'] as $dept): ?>
            <option value="<?= $dept ?>" <?= (($old['department'] ?? '') === $dept) ? 'selected' : '' ?>><?= $dept ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Address:</label><br>
    <textarea name="address" rows="5" cols="40"><?= htmlspecialchars($old['address'] ?? '') ?></textarea>
    <br><br>

    <label>Upload Student Document:</label>
    <input type="file" name="document">
    <br><br>

    <input type="submit" value="Register">

</form>

</body>
</html>
