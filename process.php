<?php
session_start();    
include("config.php");

// if(isset($_POST["loginButton"])){

//     $email = $_POST['email'];
//     $password = $_POST['password'];

//     $login_query = "SELECT `id`, `email`, `password`, `fname`, `mname`, `lname` FROM `users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1 ";
//     $login_result = mysqli_query($con, $login_query);

//     if(mysqli_num_rows($login_result) == 1){
//         $_SESSION['status'] = "Welcome!";
//         $_SESSION['status_code'] = "success";
//         header("Location: index.php");
//         exit();
//     }else{
//         $_SESSION['status'] = "Invalid Username/Password";
//         $_SESSION['status_code'] = "error";
//         header("Location: login.php");
//         exit();
//     }
// }





if(isset($_POST["registerButton"])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $fname = $_POST['fname'];
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '' ;
    $lname = $_POST['lname'];

    $check_email_query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $email_result = mysqli_query($con,$check_email_query);
    $email_count = mysqli_fetch_array($email_result)[0];

    if($email_count > 0){
        $_SESSION['status'] = "Email address already taken";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }

    if ($password !== $repassword){
        $_SESSION['status'] = "Password does not match";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }


    $query = "INSERT INTO `users`(`email`, `password`, `fname`, `mname`, `lname`) VALUES ('$email','$password','$fname','$mname','$lname')";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Registration Sucess!";
        $_SESSION['status_code'] = "success";
        header("Location: login.php");
        exit();
    }
}


if(isset($_POST["loginButton"])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT `id`, `email`, `password`, `fname`, `mname`, `lname` FROM `users` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1 ";
    $login_result = mysqli_query($con, $login_query);

    if($login_result){
        if (mysqli_num_rows($login_result) > 0){    
            $data = mysqli_fetch_assoc($login_result);

            $user_id = $data['id'];
            $full_name = $data['fname'] . '' . $data['mname'] . '' . $data['lname'];
            $user_mail = $data['email'];

            $_SESSION['auth'] = true;
            $_SESSION['auth_user'] = [
                'user_id' => $user_id,
                'user_name' => $full_name,
                'user_email' => $user_email,
            ];

            $_SESSION['status'] = "Welcome $full_name!";
            $_SESSION['status_code'] = "success";
            header("Location: index.php");
            exit();
    }else{
        $_SESSION['status'] = "Invalid Username/Password";
        $_SESSION['status_code'] = "error";
        header("Location: login.php");
        exit();
    }
}else{
            $_SESSION['status'] = "Error executing the login query" . mysqli_error( $con );
            $_SESSION['status_code'] = "success";
            header("Location: login.php");
            exit();
}
}

if(isset($_POST["addStudent"])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $year = $_POST['year'];
    $section = $_POST['section'];

    echo $student_id;
    echo $fname;
    echo $lname;
    echo $year;
    echo $section;



    $query = "INSERT INTO `students`(`fname`, `lname`, `year`, `section`) VALUES ('$fname','$lname','$year','$section')";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Student Successfully Added!";
        $_SESSION['status_code'] = "success";
        header("Location: index.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['student_id']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['year']) && isset($_POST['section'])) {
        $student_id = $_POST['student_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $year = $_POST['year'];
        $section = $_POST['section'];

        // Prepare the SQL query with a WHERE clause to update the record with a specific student ID
        $query = "UPDATE students SET fname = '$fname', lname = '$lname', year = '$year', section = '$section' WHERE student_id = '$student_id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $_SESSION['status'] = "Student Successfully Updated!";
            $_SESSION['status_code'] = "success";
            header("Location: index.php"); // Redirect to index page after successful update
            exit();
        } else {
            $_SESSION['status'] = "Error updating student record";
            $_SESSION['status_code'] = "error";
            header("Location: updateStudent.php"); // Redirect back to the update page with an error message
            exit();
        }
    } else {
        $_SESSION['status'] = "One or more required fields are not set";
        $_SESSION['status_code'] = "error";
        header("Location: updateStudent.php"); // Redirect back to the update page with an error message
        exit();
    }
} else {
    $_SESSION['status'] = "Invalid request method";
    $_SESSION['status_code'] = "error";
    header("Location: updateStudent.php"); // Redirect back to the update page with an error message
    exit();
}

if (isset($_POST['student_id'])) {
    $student_id = $_POST['student_id'];

    // Prepare and execute the SQL query to delete the student
    $query = "DELETE FROM students WHERE student_id = '$student_id'";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Set success message in session variable
        $_SESSION['status'] = "Student successfully deleted!";
        $_SESSION['status_code'] = "success";
    } else {
        // Set error message in session variable
        $_SESSION['status'] = "Error deleting student.";
        $_SESSION['status_code'] = "error";
    }
} else {
    // Set error message in session variable if student_id is not set
    $_SESSION['status'] = "Student ID not provided.";
    $_SESSION['status_code'] = "error";
}


if (isset($_POST['delete'])) {
    $student_id = $con->real_escape_string($_POST['student_id']); // Escape the value to prevent SQL injection

    $sql = "DELETE FROM `students` WHERE student_id = '$student_id'"; // Ensure student_id is enclosed in single quotes
    if ($con->query($sql) === TRUE) {
        $_SESSION['status'] = "Student with ID $student_id has been deleted.";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Failed to delete student with ID $student_id: " . $con->error;
        $_SESSION['status_code'] = "error";
    }
    header("Location: index.php"); // Redirect back to the index page
    exit();
} else {
    $_SESSION['status'] = "Delete operation not initiated.";
    $_SESSION['status_code'] = "error";
    header("Location: index.php"); // Redirect back to the index page with an error message
    exit();
}


?>