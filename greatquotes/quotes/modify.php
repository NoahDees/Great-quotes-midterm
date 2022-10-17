<!doctype html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
include "../csv_util.php";

$totrows = count(file('../authors.csv'));
$totrows = $totrows-1;

if(!isset($_GET['quotedata'])){
    $data = rand(0,$totrows);
}
else{
    $data = $_GET['quotedata'];
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!empty($_POST["quote"])){
        $quote = ($_POST["quote"]);
    }
    else{
        echo "Please enter your quote\n";
        $quote = '';
    }
    if("null"!=($_POST["author"])){
        $author = ($_POST["author"]);
    }
    else{
        echo "Please select an author";
        $author = '';
    }
}
?>

<head>
<h1><center>Modify Page!</center></h1>
</head>
<body>
<form action='' method='POST'>
    <div class="form-group">
        <?php 
        $var = readonecsv("../quotes.csv",$data);
        $authors = readonecsv("../authors.csv",$var[1]);
        $full = ''.$var[0].' - '.$authors[0].' '.$authors[1];
        echo '<label for="quote"><h3>'.$full.'</h3></label>';
        if(isset($_POST['button'])) {
            modcsv("../quotes.csv",$data,$arr=array($quote,$author));
            echo "Modified";
            echo "<br><br>";
        }
        ?>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <div class="mb-3">
        <label for="quote" class="form-label">Enter your quote modification</label>
        <input type="text" name="quote" class="form-control" id="quote" placeholder="Just dance, it'll be okay">
        </div>
        <select class="form-select" name="author" aria-label="Default select example">
            <option selected value="null">Select an author</option>
            <?php 
            $arr = readcsv("../authors.csv");
            $count=0;
            foreach ($arr as $author){
                echo '<option value="'.$count.'">'.$author[0]." ".$author[1].'</option>';
                $count++;
            }
            ?>
        </select>
    </div>
    <a class="btn btn-primary" href="detail.php">Details</a>
    <br><br>
    <button id="modbutton" name="button" type="submit" class="btn btn-danger">Submit Modification</button>
</form>
</body>
</html>