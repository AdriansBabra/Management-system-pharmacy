<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:login.php');
}
else{
	
if(isset($_POST['submit']))
  {	
	$name=$_POST['name'];
	$email=$_POST['email'];

	$sql="UPDATE admin SET username=(:name), email=(:email)";
	$query = $dbh->prepare($sql);
	$query-> bindParam(':name', $name, PDO::PARAM_STR);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query->execute();
	$msg="Informācija veiksmīgi atjaunināta";
}    
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
	<?php include('includes/header.php');?>
						<h3>Paziņojumi</h3>
									<div>Paziņojumi</div>
<?php 
$reciver = 'Admin';
$sql = "SELECT * from  notification where notireciver = (:reciver) order by time DESC";
$query = $dbh -> prepare($sql);
$query-> bindParam(':reciver', $reciver, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
        <h5><b><?php echo htmlentities($result->time);?></b> ----<?php echo htmlentities($result->notiuser);?> -----> <?php echo htmlentities($result->notitype);?></h5>
                       <?php $cnt=$cnt+1; }} ?>

</body>
</html>
<?php } ?>