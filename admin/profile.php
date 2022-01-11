<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "UPDATE admin SET username=(:name), email=(:email)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $msg = "Informācija veiksmīgi atjaunināta";
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Rediģēt Adminu</title>
    </head>

    <body>
    <?php
    $sql = "SELECT * from admin;";
    $query = $dbh->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $cnt = 1;
    ?>
    <?php include('includes/header.php'); ?>
    <h3>Rediģēt admina kontu!</h3>
    <div>Rediģēt informāciju</div>

    <form method="post" enctype="multipart/form-data">
        <label>Lietotājvārds<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="text" name="name" required value="<?php echo htmlentities($result->username); ?>">
        </div>
        <label>E-pasts<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="email" name="email" required value="<?php echo htmlentities($result->email); ?>">
        </div>
        <button name="submit" type="submit">Saglabāt izmaiņas</button>
    </form>
    </body>
    </html>
<?php } ?>