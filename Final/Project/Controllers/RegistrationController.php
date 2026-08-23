<?php
require 'models/StudentModel.php';

class RegistrationController {

    public function index() {
        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];
        unset($_SESSION['errors'], $_SESSION['old']);
        require 'views/form.php';
    }

    public function store() {
        $errors = [];

        $student_id = $_POST["student_id"] ?? "";
        $name       = $_POST["name"] ?? "";
        $email      = $_POST["email"] ?? "";
        $password   = $_POST["password"] ?? "";
        $gender     = $_POST["gender"] ?? "";
        $department = $_POST["department"] ?? "";
        $address    = $_POST["address"] ?? "";

        if (empty($student_id)) {
            $errors[] = "Student ID is required.";
        }

        if (empty($name)) {
            $errors[] = "Name is required.";
        }

        if (empty($email)) {
            $errors[] = "Email is required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email address.";
        }

        if (empty($password)) {
            $errors[] = "Password is required.";
        } elseif (strlen($password) < 6) {
            $errors[] = "Password must contain at least 6 characters.";
        }

        if (empty($gender)) {
            $errors[] = "Please select your gender.";
        }

        if (empty($department)) {
            $errors[] = "Please select your department.";
        }

        if (empty($address)) {
            $errors[] = "Address is required.";
        }

        $new_file_name = null;

        if (!isset($_FILES["document"]) || $_FILES["document"]["error"] != 0) {

            $errors[] = "Please upload a document.";

        } else {

            $file_name = $_FILES["document"]["name"];
            $file_size = $_FILES["document"]["size"];
            $file_tmp  = $_FILES["document"]["tmp_name"];
            $file_type = $_FILES["document"]["type"];

            $allowed_types = [
                "application/pdf",
                "image/jpeg",
                "image/png"
            ];

            if (!in_array($file_type, $allowed_types)) {
                $errors[] = "Only PDF, JPG and PNG files are allowed.";
            }

            if ($file_size > 2 * 1024 * 1024) {
                $errors[] = "File size must be less than 2 MB.";
            }

            if (empty($errors)) {
                $new_file_name = time() . "_" . basename($file_name);
                move_uploaded_file($file_tmp, __DIR__ . '/../uploads/' . $new_file_name);
            }
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old'] = [
                'student_id' => $student_id,
                'name'       => $name,
                'email'      => $email,
                'gender'     => $gender,
                'department' => $department,
                'address'    => $address,
            ];
            header('Location: index.php');
            exit;
        }

        // Save to JSON "database"
        $model = new StudentModel();
        $model->save([
            'student_id' => $student_id,
            'name'       => $name,
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_DEFAULT),
            'gender'     => $gender,
            'department' => $department,
            'address'    => $address,
            'document'   => $new_file_name,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // Session: keep registered student info for success page
        $_SESSION['student'] = [
            'student_id' => $student_id,
            'name'       => $name,
            'document'   => $new_file_name,
        ];

        // Cookie: remember last registered student id for 1 hour
        setcookie('last_student_id', $student_id, time() + 3600, "/");

        require 'views/success.php';
    }
}
