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
        $producer = $_POST['producer'];
        $quantity = ($_POST['quantity']);
        $description = $_POST['description'];
        $price = $_POST['price'];
        $idedit = $_POST['editid'];

        $sql = "UPDATE medics SET name=(:name), producer=(:producer), quantity=(:quantity), description=(:description), price=(:price) WHERE id=(:idedit)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':producer', $producer, PDO::PARAM_STR);
        $query->bindParam(':quantity', $quantity, PDO::PARAM_STR);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':idedit', $idedit, PDO::PARAM_STR);
        $query->execute();
        $msg = "Informācija veiksmīgi atjaunināta";
    }
    ?>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="theme-color" content="#3e454c">

        <title>Rediģēt medikamentu</title>

    </head>

    <body>
    <?php
    $sql = "SELECT * from medics where id = :editid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':editid', $editid, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $cnt = 1;
    ?>
    <?php include('includes/header.php'); ?>
    <h3>Rediģēt medikamentu : <?php echo htmlentities($result->name); ?></h3>

    <div>Rediģēt informāciju</div>
    <form method="post" enctype="multipart/form-data" name="medform">
        <label>Nosaukums<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="text" name="name" required value="<?php echo htmlentities($result->name); ?>">
        </div>
        <label>Ražotājs<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="text" name="producer" required value="<?php echo htmlentities($result->producer); ?>">
        </div>
        <label>Pieejamais daudzums<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="number" name="quantity" required value="<?php echo htmlentities($result->quantity); ?>">
        </div>
        <label>Apraksts<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <textarea rows="5" name="description"><?php echo htmlentities($result->description); ?></textarea>
        </div>
        <label>Cena par vienu(eur)<span style="color:red">*</span></label>
        <div class="col-sm-5">
            <input type="number" name="price" required value="<?php echo htmlentities($result->price); ?>">
        </div>
        <input type="hidden" name="editid" required
               value="<?php echo htmlentities($result->id); ?>">
        <br>
        <button name="submit" type="submit">Saglabāt izmaiņas</button>
    </form>
    </body>
    </html>
<?php } ?>