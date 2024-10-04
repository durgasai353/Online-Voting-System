<?php
include("connect.php");

$name = $_POST['fname'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm'];
$Address = $_POST['Address'];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$role = $_POST['role'];

// Define the regular expression patterns
$password_pattern = "/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?\":{}|<>])(?=.*\d.*\d).{8,}$/";
$phone_pattern = "/^\d{10}$/";

if ($password == $confirm_password) {
    if (preg_match($password_pattern, $password)) {
        if (preg_match($phone_pattern, $phone)) {
            move_uploaded_file($tmp_name, "../uploads/$image");
            $insert = mysqli_query($connect, "INSERT INTO voter_lists (name, Mobile, password, Address, image, role, status, votes) VALUES ('$name', '$phone', '$password', '$Address', '$image','$role', 0, 0)");
            if ($insert) {
                echo '
                <script>
                    alert("Registration Successful");
                    window.location="../";
                </script>
                ';
            } else {
                echo '
                <script>
                    alert("Some error occurred");
                    window.location="../page_transformation/register.html";
                </script>
                ';
            }
        } else {
            echo '
            <script>
                alert("Phone number must be exactly 10 digits.");
                window.location="../page_transformation/register.html";
            </script>
            ';
        }
    } else {
        echo '
        <script>
            alert("Password must be at least 8 characters long, contain one capital letter, one special character, and at least two numbers.");
            window.location="../page_transformation/register.html";
        </script>
        ';
    }
} else {
    echo '
    <script>
        alert("Passwords do not match");
        window.location="../page_transformation/register.html";
    </script>
    ';
}
?>
    