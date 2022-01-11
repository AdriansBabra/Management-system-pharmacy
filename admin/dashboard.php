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

        <title>Admin sākumlapa</title>

    </head>

    <body>
    <h1>Admina pārskats</h1>
    <?php include('includes/header.php'); ?>
    <h3>Admina sākumlapa ar iespējām</h3>
    <?php
    $sql = "SELECT id from users";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $bg = $query->rowCount();
    ?>
    <div><?php echo htmlentities($bg); ?> Kopā lietotāji</div>
    <a href="userlist.php">Pilns apraksts</a>

    <?php
    $reciver = 'Admin';
    $sql1 = "SELECT id from feedback where reciver = (:reciver)";
    $query1 = $dbh->prepare($sql1);;
    $query1->bindParam(':reciver', $reciver, PDO::PARAM_STR);
    $query1->execute();
    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
    $regbd = $query1->rowCount();
    ?>
    <div><?php echo htmlentities($regbd); ?> Atsauksmes ziņas</div>
    <a href="feedback.php">Pilns apraksts</a>

    <?php
    $reciver = 'Admin';
    $sql12 = "SELECT id from notification where notireciver = (:reciver)";
    $query12 = $dbh->prepare($sql12);;
    $query12->bindParam(':reciver', $reciver, PDO::PARAM_STR);
    $query12->execute();
    $results12 = $query12->fetchAll(PDO::FETCH_OBJ);
    $regbd2 = $query12->rowCount();
    ?>
    <div><?php echo htmlentities($regbd2); ?> Paziņojumi</div>
    <a href="notification.php">Pilns apraksts</a>

    <?php
    $sql6 = "SELECT id from deleteduser ";
    $query6 = $dbh->prepare($sql6);;
    $query6->execute();
    $results6 = $query6->fetchAll(PDO::FETCH_OBJ);
    $query = $query6->rowCount();
    ?>
    <div><?php echo htmlentities($query); ?> Izdzēsti lietotāji</div>
    <a href="deleteduser.php">Pilns apraksts</a>

    <?php
    $sql9 = "SELECT id from medics ";
    $query9 = $dbh->prepare($sql9);;
    $query9->execute();
    $results9 = $query9->fetchAll(PDO::FETCH_OBJ);
    $query = $query9->rowCount();
    ?>
    <div><?php echo htmlentities($query); ?> Izveidotie medikamenti</div>
    <a href="medic.php">Pilns apraksts</a>
    </body>
    </html>
<?php } ?>