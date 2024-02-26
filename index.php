<?php session_start(); ?>
<?php include("./assets/header.php");
require_once('config.php');

$query = "select * from students";
$result = mysqli_query($con, $query);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="vh-100">
    <h1 class="text-center">Student Information</h1>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Student ID</th>
            <th scope="col">First name</th>
            <th scope="col">Last name</th>
            <th scope="col">Year</th>
            <th scope="col">Section</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['student_id'] ?></td>
                <td><?php echo $row['fname'] ?></td>
                <td><?php echo $row['lname'] ?></td>
                <td><?php echo $row['year'] ?></td>
                <td><?php echo $row['section'] ?></td>
                <td>
                    <div class="">
                        <a href="updateStudent.php" class="btn btn-success btn-sm">Update</a>
                        <form action="process.php" method="POST">
                        <input type="hidden"  value="<?php echo $row['student_id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm" name="delete" >Delete</button>
                    </form>

                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
        <a href="addStudent.php" class="btn btn-primary btn-lg">Add Student</a>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this student?");
    }
</script>

<?php
if (isset($_SESSION['status']) && $_SESSION['status_code'] != '') {
    ?>
    <script>
        swal({
            title: "<?php echo $_SESSION['status']; ?>",
            icon: "<?php echo $_SESSION['status_code']; ?>",
        });
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['status_code']);
}
?>
<?php include("./assets/footer.php") ?>
</body>
</html>
