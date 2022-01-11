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

        <title>Ziņas</title>

    </head>

    <body>
    <?php include('includes/header.php'); ?>
    <h2>Ziņas</h2>
    <div>Lietotāju saraksts</div>
    <table id="zctb" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>#</th>
            <th>Lietotājs</th>
            <th>Ziņa</th>
        </tr>
        </thead>

        <tbody>

        <?php
        $reciver = $_SESSION['alogin'];
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
                    <td><?php echo htmlentities($result->feedbackdata); ?></td>
                </tr>
                <?php $cnt = $cnt + 1;
            }
        } ?>

        </tbody>
    </table>
    </body>
    </html>
<?php } ?>
