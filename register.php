<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
<form action="process.php" method="post">
    <div class="form-group">
        <label for="first_name">First name</label>
        <input name="first_name" type="text" class="form-control" id="first_name" placeholder="Enter first name">
    </div>
    <div class="form-group">
        <label for="middle_name">Middle name</label>
        <input name="middle_name" type="text" class="form-control" id="middle_name" placeholder="Enter middle name">
    </div>
    <div class="form-group">
        <label for="last_name">Last name</label>
        <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Enter last name">
    </div>
    <div class="form-group">
        <label for="username">Email address</label>
        <input name="username" type="email" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Password">
    </div>
    <div class="form-group">
  <label for="role">Choose role:</label>
    <select name="role" id="role">
        <option value="1">Admin</option>
        <option value="2">Student</option>
    </select>
  </div>
    <button type="submit" name="register" class="btn btn-primary">Register</button>
    <a href="index.php" class="btn btn-primary">Login</a>

</form>
</body>
</html>
