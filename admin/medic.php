<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $producer = $_POST['producer'];
    $quantity = ($_POST['quantity']);
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO medics(name, producer, quantity, description, price) VALUES(:name, :producer, :quantity, :description, :price)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':producer', $producer, PDO::PARAM_STR);
    $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
    $query->bindParam(':description', $description, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);

    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script type='text/javascript'>alert('Medikamentu ieraksta izveida ir veiksmīga');</script>";
    } else {
        $error = "Kaut kas nogāja greizi. Lūdzu meģiniet vēlreiz";
    }

}
if (strlen($_SESSION['alogin']) == 0) {
    header('location:login.php');
} else {
    if (isset($_GET['del']) && isset($_GET['name'])) {
        $id = $_GET['del'];
        $name = $_GET['name'];

        $sql = "delete from medics WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
    }

    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Pārvaldīt medikamentus</title>
    </head>

    <body>
    <?php include('includes/header.php'); ?>

    <h2>Pārvaldīt medikamentus</h2>
    <br>
    <h3>Pievienot jaunu medikamentu</h3>
    <form method="post" enctype="multipart/form-data" name="medform">
        <label>Nosaukums<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="text" name="name" required>
        </div>
        <label>Ražotājs<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="text" name="producer" required>
        </div>
        <label>Pieejamais daudzums<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="number" name="quantity" required>
        </div>
        <label>Apraksts<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <textarea rows="5" name="description"></textarea>
        </div>
        <label>Cena par vienu(eur)<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="number" name="price" required>
        </div>

        <br>
        <button name="submit" type="submit">Izveidot</button>
    </form>
    <br>
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
            <th>Darbības</th>
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

                    <td>
                        <a href="edit-medic.php?edit=<?php echo $result->id; ?>"
                           onclick="return confirm('Vai Jūs vēlaties veikt izmaiņas?');">Edit</a>&nbsp;&nbsp;
                        <a style="color:red"
                           href="medic.php?del=<?php echo $result->id; ?>&name=<?php echo htmlentities($result->name); ?>"
                           onclick="return confirm('Vai Jūs vēlaties izdzēst šo meidkamentu?');">Delete</a>&nbsp;&nbsp;
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
