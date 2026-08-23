<?php

if (isset($_COOKIE["student_name"])) {
    echo "Student Name: " . $_COOKIE["student_name"];
} else {
    echo "Cookie does not exist.";
}

?>