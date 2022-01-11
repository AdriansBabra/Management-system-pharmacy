<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {
    if (isset($_GET['del']) && isset($_GET['name'])) {
        $id = $_GET['del'];
        $name = $_GET['name'];

        $sql = "delete from users WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();

        $sql2 = "insert into deleteduser (email) values (:name)";
        $query2 = $dbh->prepare($sql2);
        $query2->bindParam(':name', $name, PDO::PARAM_STR);
        $query2->execute();

        $msg = "Dati ir veiksmīgi izdzēsti";
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

    <!doctype html>
    <html lang="en" class="no-js">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Pieejamie medikamenti</title>
    </head>

    <body>
    <?php include('includes/header.php'); ?>

    <h2>Pieejamie medikamenti</h2>
    <div>Medikamentu saraksts</div>

    <table id="zctb" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Nosaukums</th>
            <th>Ražotājs</th>
            <th>Daudzums</th>
            <th>Apraksts</th>
            <th>Cena par vienu(eur)</th>
        </tr>
        </thead>

        <tbody>

        <?php $sql = "SELECT * from  medics ";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) { ?>
                <tr>
                    <td><?php echo htmlentities($cnt); ?></td>
                    <td><?php echo htmlentities($result->name); ?></td>
                    <td><?php echo htmlentities($result->producer); ?></td>
                    <td><?php echo htmlentities($result->quantity); ?></td>
                    <td><?php echo htmlentities($result->description); ?></td>
                    <td><?php echo htmlentities($result->price); ?></td>
                </tr>
                <?php $cnt = $cnt + 1;
            }
        } ?>
        </tbody>
    </table>

    </body>
    </html>
<?php } ?>
