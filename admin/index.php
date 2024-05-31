<?php
session_start();

require_once "./../connections/connections.php";

$err = "";
$username = "";

if (isset($_SESSION['session_username'])) {
    header("location:admin.php");
    exit();
}

if (isset($_POST['tb_admin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == '' or $password == '') {
        $err .= "<p class='text-danger' style='margin: 10px 30px 0px 30px;'>Silakan masukkan username dan juga password</p>";
    } else {
        $sql1 = "select * from tb_admin where username = '$username'";
        $q1   = mysqli_query($conn, $sql1);
        $r1   = mysqli_fetch_array($q1);

        if (empty($r1['username'])) {
            $err .= "<p class='text-danger' style='margin: 10px 30px 0px 30px;'>Username <b>$username</b> tidak tersedia</p>";
        } elseif ($r1['password'] != md5($password)) {
            $err .= "<p class='text-danger' style='margin: 10px 30px 0px 30px;'>Password yang dimasukkan tidak sesuai</p>";
        }

        if (empty($err)) {
            $_SESSION['session_username'] = $username;
            $_SESSION['session_password'] = md5($password);
            header("location:admin.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-4">Login Admin</h2>
                        <?php echo $err; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" name="tb_admin">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
