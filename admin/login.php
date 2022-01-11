<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
    $email = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {

        echo "<script>alert('Nepareizi ievadīta informācija');</script>";

    }

}

?>
<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

</head>
<body>
<h1>Ieiet Admina profilā</h1>
<form method="post">
    <div class="col-sm-5">
    <label>Jūsu lietotājvārds :  </label>
    <input type="text" placeholder="Lietotājvārds" name="username" required>
    </div>
    <div class="col-sm-5">
    <label>Jūsu parole : </label>
    <input type="password" placeholder="Parole" name="password" required>
    </div>
    <button name="login" type="submit">Ieiet profilā</button>
</form>
<p>Ieiet kā parastam lietotājam <a href="../login.php">Parasts lietotājs</a></p>
</body>
</html>