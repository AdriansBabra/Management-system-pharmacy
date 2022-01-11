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
        $mobileno = $_POST['mobile'];
        $idedit = $_POST['editid'];

        $sql = "UPDATE users SET name=(:name), email=(:email), mobile=(:mobileno) WHERE id=(:idedit)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':idedit', $idedit, PDO::PARAM_STR);
        $query->execute();
        $msg = "Informācija ir veiksmīgi atjaunināta";
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Rediģēt profilu</title>

    </head>

    <body>
    <h1>Rediģēt profilu</h1>
    <?php
    $email = $_SESSION['alogin'];
    $sql = "SELECT * from users where email = (:email);";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $cnt = 1;
    ?>
    <?php include('includes/header.php'); ?>
    <h3>Sveicināti, <?php echo htmlentities($result->name); ?>!</h3>
    <form method="post" enctype="multipart/form-data">
        <label>Name<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="text" name="name" required
                   value="<?php echo htmlentities($result->name); ?>">
        </div>
        <label>Email<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="email" name="email" required
                   value="<?php echo htmlentities($result->email); ?>">
        </div>
        <label>Mobile<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="text" name="mobile" required
                   value="<?php echo htmlentities($result->mobile); ?>">
        </div>
        <input type="hidden" name="editid" required
               value="<?php echo htmlentities($result->id); ?>">
        <button name="submit" type="submit">Saglabāt izmaiņas</button>
    </form>
    </body>
    </html>
<?php } ?>