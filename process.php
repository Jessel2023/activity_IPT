<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


include("config.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_query = "SELECT username, password, role FROM user WHERE username = ? ";

    $stmt = $con->prepare($login_query);

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $role = $row['role'];

        if ($role == 1) {
            header("Location: admin.php");
            exit(); 
        } elseif ($role == 2) {
            header("Location: student.php");
            exit();
        }
    } else {
        echo "Login failed. User does not exist.";
    }

    $stmt->close();
}

if (isset($_POST["register"])) {
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Print out the received values for debugging
    echo "First Name: $first_name<br>";
    echo "Middle Name: $middle_name<br>";
    echo "Last Name: $last_name<br>";
    echo "Username: $username<br>";
    echo "Password: $password<br>";


    // Prepare and execute the SQL query
    $query = "INSERT INTO user (first_name, middle_name, last_name, username, password) VALUES ('$first_name', '$middle_name', '$last_name', '$username', '$password')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo "Registration Successful";
    } else {
        echo "Registration Failed";
    }

}



?>