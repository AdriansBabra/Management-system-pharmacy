<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from users WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $msg = "Dati veiksmīgi izdzēsti";
    }

    if (isset($_REQUEST['unconfirm'])) {
        $aeid = intval($_GET['unconfirm']);
        $memstatus = 1;
        $sql = "UPDATE users SET status=:status WHERE  id=:aeid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $memstatus, PDO::PARAM_STR);
        $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Izmaiņas veiksmīgas";
    }

    if (isset($_REQUEST['confirm'])) {
        $aeid = intval($_GET['confirm']);
        $memstatus = 0;
        $sql = "UPDATE users SET status=:status WHERE  id=:aeid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status', $memstatus, PDO::PARAM_STR);
        $query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
        $query->execute();
        $msg = "Izmaiņas veiksmīgas";
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Rediģēt atsauksmes</title>

    </head>

    <body>
    <?php include('includes/header.php'); ?>
    <h2>Rediģēt atsauksmes</h2>
    <div>Parādīt lietotājus</div>
    <table id="zctb" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Lietotāja e-pasts</th>
            <th>Tēma</th>
            <th>Atsauksme</th>
            <th>Darbības</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $reciver = 'Admin';
        $sql = "SELECT * from  feedback where reciver = (:reciver)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':reciver', $reciver, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>
                <tr>
                    <td><?php echo htmlentities($cnt); ?></td>
                    <td><?php echo htmlentities($result->sender); ?></td>
                    <td><?php echo htmlentities($result->title); ?></td>
                    <td><?php echo htmlentities($result->feedbackdata); ?></td>

                    <td>
                        <a href="sendreply.php?reply=<?php echo $result->sender; ?>">Atbildēt</a>&nbsp;&nbsp;
                    </td>
                </tr>
                <?php $cnt = $cnt + 1;
            }
        } ?>

        </tbody>
    </table>
    </body>
    </html>
<?php } ?>
