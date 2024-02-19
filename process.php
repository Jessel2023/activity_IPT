<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


include("config.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_query = "SELECT username, password, role FROM user WHERE username = ? LIMIT 1 ";

    $login_query_run = $con->prepare($login_query);

    $login_query_run->bind_param("s", $username);
    $login_query_run->execute();

    $result = $login_query_run->get_result();

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
    $role = $_POST["role"];

    // Print out the received values for debugging
    echo "First Name: $first_name<br>";
    echo "Middle Name: $middle_name<br>";
    echo "Last Name: $last_name<br>";
    echo "Username: $username<br>";
    echo "Password: $password<br>";
    
    if ($role == 1) {
        echo "Role: Admin <br>";
    } else {
        echo "Role: Student <br>";
    }
 



    // Prepare and execute the SQL query
    $query = "INSERT INTO user (first_name, middle_name, last_name, username, password, role) VALUES ('$first_name', '$middle_name', '$last_name', '$username', '$password', '$role')";
    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo "Registration Successful";
    } else {
        echo "Registration Failed";
    }

}



?>