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
        $title = $_POST['title'];
        $reciver = $_POST['email'];
        $description = $_POST['description'];
        $notitype = 'Send Message';
        $sender = 'Admin';

        $sqlnoti = "insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
        $querynoti = $dbh->prepare($sqlnoti);
        $querynoti->bindParam(':notiuser', $sender, PDO::PARAM_STR);
        $querynoti->bindParam(':notireciver', $reciver, PDO::PARAM_STR);
        $querynoti->bindParam(':notitype', $notitype, PDO::PARAM_STR);
        $querynoti->execute();

        $sql = "insert into feedback (sender, reciver, title, feedbackdata) values (:user,:reciver,:title,:description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':user', $sender, PDO::PARAM_STR);
        $query->bindParam(':reciver', $reciver, PDO::PARAM_STR);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->execute();
        $msg = "Ziņa nosūtīta";
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
        <style>
            .errorWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #dd3d36;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }

            .succWrap {
                padding: 10px;
                margin: 0 0 20px 0;
                background: #5cb85c;
                color: #fff;
                -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
                box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            }
        </style>
    </head>
    <body>
    <?php
    $sql = "SELECT * from users";
    $query = $dbh->prepare($sql);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $cnt = 1;
    ?>
    <?php include('includes/header.php'); ?>
    <h2>Atbildēt uz atsauksmi</h2>
    <div>Rediģēt informāciju</div>
    <?php if ($error) { ?>
        <div class="errorWrap"><strong>Kļūda</strong>:<?php echo htmlentities($error); ?>
        </div><?php } else if ($msg) { ?>
        <div class="succWrap"><strong>Veiksmīgi</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
    <form method="post" enctype="multipart/form-data">

        <label>E-pasts<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="text" name="email" class="form-control" readonly required
                   value="<?php echo htmlentities($replyto); ?>">
        </div>
        <label>Nosaukums<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="text" name="title" required value="<?php echo htmlentities($title); ?>">
        </div>
        <label>Ziņa<span style="color:red">*</span></label>
        <div class="col-sm-6">
            <textarea name="description" cols="30" rows="10"></textarea>
        </div>
        <button name="submit" type="submit">Sūtīt atbildi</button>
    </form>
    </body>
    </html>
<?php } ?>