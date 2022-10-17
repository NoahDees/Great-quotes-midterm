<!doctype html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
include "../csv_util.php";

if($_SESSION['logged']=false;){
    die();
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(!empty($_POST["$author1"])){
        $author1 = ($_POST["$author1"]);
    }
    else{
        echo "Please enter your author's first name\n";
        $author1 = '';
    }
    if("null"!=($_POST["author2"])){
        $author = ($_POST["author2"]);
    }
    else{
        echo "Please type an author's last name\n";
        $author2 = '';
    }
    if ($$author1=="" or $author2==""){
        echo "<br>Try again";
    }
    else{
        addcsv("../authors.csv",$arr = array($author1,$author2));
    }
}
?>

<head>
<h1><center>Creation Page!</center></h1>
</head>
<body>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
<div class="mb-3">
  <label for="author1" class="form-label">Enter your author's first name</label>
  <input type="text" name="author1" class="form-control" id="author1" placeholder="Justin">
</div>

<div class="mb-3">
  <label for="author2" class="form-label">Enter your author's last name</label>
  <input type="text" name="author2" class="form-control" id="author2" placeholder="Bieber">
</div>
<button type="submit" class="btn btn-primary">Submit</button>
</form>

</body>
</html>