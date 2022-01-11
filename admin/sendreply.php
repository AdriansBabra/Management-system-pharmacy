<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {

    if (isset($_GET['reply'])) {
        $replyto = $_GET['reply'];
    }

    if (isset($_POST['submit'])) {
        $reciver = $_POST['email'];
        $message = $_POST['message'];
        $notitype = 'Send Message';
        $sender = 'Admin';

        $sqlnoti = "insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
        $querynoti = $dbh->prepare($sqlnoti);
        $querynoti->bindParam(':notiuser', $sender, PDO::PARAM_STR);
        $querynoti->bindParam(':notireciver', $reciver, PDO::PARAM_STR);
        $querynoti->bindParam(':notitype', $notitype, PDO::PARAM_STR);
        $querynoti->execute();

        $sql = "insert into feedback (sender, reciver, feedbackdata) values (:user,:reciver,:description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':user', $sender, PDO::PARAM_STR);
        $query->bindParam(':reciver', $reciver, PDO::PARAM_STR);
        $query->bindParam(':description', $message, PDO::PARAM_STR);
        $query->execute();
        $msg = "Atsauksme nosūtīta";
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Atsauksmes atbildēšana</title>
    </head>
    <body>
    <?php
    $sql = "SELECT * from users;";
    $query = $dbh->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $cnt = 1;
    ?>
    <?php include('includes/header.php'); ?>
    <h2>Atbildēt uz atsauksmi</h2>
    <div>Rediģēt informāciju</div>
    <form method="post" enctype="multipart/form-data">

        <label>E-pasts<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="text" name="email" class="form-control" readonly required
                   value="<?php echo htmlentities($replyto); ?>">
        </div>
        <label>Ziņa<span style="color:red">*</span></label>
        <div class="col-sm-6">
            <textarea name="message" cols="30" rows="10"></textarea>
        </div>
        <input type="hidden" name="editid" required value="<?php echo htmlentities($result->id); ?>">
        <button class="btn btn-primary" name="submit" type="submit">Sūtīt atbildi</button>
    </form>
    </body>
    </html>
<?php } ?>