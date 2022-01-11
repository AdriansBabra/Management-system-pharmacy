<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {

    if (isset($_GET['edit'])) {
        $editid = $_GET['edit'];
    }


    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $mobileno = $_POST['mobileno'];
        $idedit = $_POST['editid'];

        $sql = "UPDATE users SET name=(:name), email=(:email), gender=(:gender), mobile=(:mobileno) WHERE id=(:idedit)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':idedit', $idedit, PDO::PARAM_STR);
        $query->execute();
        $msg = "Informācija veiksmīgi atjaunināta";
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
        <meta name="theme-color" content="#3e454c">

        <title>Rediģēt lietotāju</title>

    </head>

    <body>
    <?php
    $sql = "SELECT * from users where id = :editid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':editid', $editid, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $cnt = 1;
    ?>
    <?php include('includes/header.php'); ?>
    <h3>Rediģēt lietotāju : <?php echo htmlentities($result->name); ?></h3>

    <div>Rediģēt informāciju</div>

    <form method="post" enctype="multipart/form-data">
        <label>Vārds<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="text" name="name" required value="<?php echo htmlentities($result->name); ?>">
        </div>
        <label>E-pasts<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="email" name="email" required value="<?php echo htmlentities($result->email); ?>">
        </div>

        <label>Dzimums<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <select name="gender" required>
                <option value="">Izvēlēties</option>
                <option value="Male">Vīrietis</option>
                <option value="Female">Sieviete</option>
            </select>
        </div>
        <label>Tel.Nr.<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="number" name="mobileno" required value="<?php echo htmlentities($result->mobile); ?>">
        </div>
        <input type="hidden" name="editid" required
               value="<?php echo htmlentities($result->id); ?>">
        <button name="submit" type="submit">Saglabāt izmaiņas</button>
    </form>

    </body>
    </html>
<?php } ?>