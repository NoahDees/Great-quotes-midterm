<!doctype html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
include 'C:\xampp\htdocs\greatquotes\csv_util.php';

$totrows = count(file('C:\xampp\htdocs\greatquotes\authors.csv'));
$totrows = $totrows-1;

if(!isset($_GET['quotedata'])){
    $data = rand(0,$totrows);
}
else{
    $data = $_GET['quotedata'];
}

?>

<head>
<h1><center>Author Index Page! All authors are listed here!</center></h1>
</head>
<body>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	<?php 
	$authors = readcsv('C:\xampp\htdocs\greatquotes\authors.csv');
	echo "<br><br>";
	$count=0;
	foreach($authors as $author){
		$var = $author[0].' '.$author[1];
		echo '<a href="detail.php?quotedata='.$count.'"><center>'.$var.'</a></center>';
		$count++;
	}
	echo "<br><br>";
	?>
</form>
</body>
</html>