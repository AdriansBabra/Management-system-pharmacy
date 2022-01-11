<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
    $status = '1';
    $email = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT email,password FROM users WHERE email=:email and password=:password and status=(:status)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location = 'profile.php'; </script>";
    } else {

        echo "<script>alert('Nav pareizi ievadīta informācija vai profils nav apstirpināts');</script>";

    }

}

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<h1>Ieiet profilā</h1>
        <form method="post">
            <div class="col-sm-5">
                <label>Jūsu ēpasts</label>
                <input type="email" placeholder="E-pasts" name="username" class="form-control" required>
            </div>
            <div class="col-sm-5">
                <label>Jūsu parole</label>
                <input type="password" placeholder="Parole" name="password" class="form-control" required>
            </div>
            <button class="btn btn-primary btn-block" name="login" type="submit">Ieiet profilā</button>
        </form>
        <p>Jums nav profils? <a href="register.php">Reģistrēties</a></p>
        <p>Ieiet kā adminam <a href="admin/login.php">Admina forma</a></p>
        <p>Atgriezties sākuma lapā <a href="/">Sākumlapa</a></p>
    </div>
</div>

</body>

</html>