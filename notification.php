<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {
    ?>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Paziņojumi</title>
    </head>

    <body>
    <?php include('includes/header.php'); ?>
    <h3>Paziņojumi</h3>
    <div>Paziņojumi</div>
    <?php
    $reciver = $_SESSION['alogin'];
    $sql = "SELECT * from  notification where notireciver = (:reciver) order by time DESC";
    $query = $dbh->prepare($sql);
    $query->bindParam(':reciver', $reciver, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
        foreach ($results as $result) { ?>
            <h5 style="background:#ededed;padding:20px;">&nbsp;&nbsp;<b
                        class="text-primary"><?php echo htmlentities($result->time); ?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlentities($result->notiuser); ?>
                -----> <?php echo htmlentities($result->notitype); ?></h5>
            <?php $cnt = $cnt + 1;
        }
    } ?>
    </body>
    </html>
<?php } ?>