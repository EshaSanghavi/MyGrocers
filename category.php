<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <style type="text/css">
    .center1 {
      margin: auto;
      width: 60%;
      margin-top: 80px;
      margin-bottom: 40px;
      padding: 60px 80px;
      color:#5c5c5c; 
      border: 3px solid lightgrey;
    }
    .center1 h1{
      padding: 0;
      margin: 0;
    }
    .center1 h2{
      font-weight: normal;
      padding: 0;
      margin: 0;
      margin-top: 5px;
    }
    .center1 h3{
      font-weight: normal;
      padding: 0;
      margin: 0;
      margin-top: 5px;
    }
  </style>
</head>
<body>
<?php include('config.php'); ?>
<!--#42dcff --> 
<div class="row">
</div><br><br>
<?php

  $category = $_GET['category'];
  echo "<div class='sub-title' style='font-size: 15px;'><p><a href='index.php'>Home</a> 
        <a style='color:#5c5c5c;'>> $category</a></p>
        <hr></div> <div class='row'>";
    $sql = "SELECT * FROM products WHERE type = '$category'";
    $result = $conn->query($sql);
    $resultset = array();
    // output data of each row into resultset
    while($row = $result->fetch_assoc()) 
    {
        $resultset[] = $row;
    }
    foreach ($resultset as $p)
  	{		
      	echo "<div class='columns'>
        <div class='card'>
            <div class='product-imgs'>
              <img src='$p[img]'>
              <button class='heart' id='$p[pid]' onclick='addWish(this)'>❤</button> 
            </div>
            <h3>$p[name]</h3> 
            <div class='desc'>$p[qty] $p[measure]</div>
            <button class='addCart' id='$p[pid]' onclick='addQty(this)'><img src='icons/addcart.png' class='card-icons-small' id='addcart'>ADD</button>  
            <div class='cost'>₹$p[cost]</div>
          </div>
        </div>";
  	}
?>
</div>
<br>

<?php include('footer.php');?>

<script>

function addQty(x)
{
  var ids = x.id;
  window.location.href = "addCart.php?pid="+ids+"&qty=1";
}

function addWish(x)
{
  var ids = x.id;
  window.location.href = "addWish.php?pid="+ids+"&qty=1";
}
</script>

</body>
</html>
