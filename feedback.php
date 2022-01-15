<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {

    if (isset($_POST['submit'])) {

        $title = $_POST['title'];
        $description = $_POST['description'];
        $user = $_SESSION['alogin'];
        $reciver = 'Admin';
        $notitype = 'Send Feedback';

        $notireciver = 'Admin';
        $sqlnoti = "insert into notification (notiuser,notireciver,notitype) values (:notiuser,:notireciver,:notitype)";
        $querynoti = $dbh->prepare($sqlnoti);
        $querynoti->bindParam(':notiuser', $user, PDO::PARAM_STR);
        $querynoti->bindParam(':notireciver', $notireciver, PDO::PARAM_STR);
        $querynoti->bindParam(':notitype', $notitype, PDO::PARAM_STR);
        $querynoti->execute();

        $sql = "insert into feedback (sender, reciver, title, feedbackdata) values (:user,:reciver,:title,:description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':user', $user, PDO::PARAM_STR);
        $query->bindParam(':reciver', $reciver, PDO::PARAM_STR);
        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
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

        <title>Atsauksme</title>
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
    <h1>Atsauksme</h1>
    <?php
    $email = $_SESSION['alogin'];
    $sql = "SELECT * from users where email = (:email);";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    ?>
    <?php include('includes/header.php'); ?>
    <h2>Sniedziet atsauksmi par mūsu aptiekas mājaslapu!</h2>
    <?php if ($error) { ?>
        <div class="errorWrap"><strong>Kļūda</strong>:<?php echo htmlentities($error); ?>
        </div><?php } else if ($msg) { ?>
        <div class="succWrap"><strong>Veiksmīgi</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
    <form method="post" enctype="multipart/form-data">

        <label>E-pasts</label>
        <div class="col-sm-5">
            <input type="email" name="email" value="<?php echo htmlentities($result->email); ?>">
            <div class="col-sm-5">
                <label>Nosaukums<span style="color:red">*</span></label>
                <div class="col-sm-5">
                    <input type="text" name="title" required>
                </div>
            </div>

            <div class="form-group">
                <label>Apraksts<span style="color:red">*</span></label>
                <div class="col-sm-5">
                    <textarea rows="5" name="description"></textarea>
                </div>
            </div>
            <button name="submit" type="submit">Nosūtīt</button>
    </form>
    </body>
    </html>
<?php } ?>