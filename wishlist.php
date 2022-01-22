<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
  <link href="css/styles.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">
  <style>
    .cart tr{
      font-size: large;
    }
    .cart td{
      font-size: large;
    }
    .qty-input{
      background-color: inherit;
      width:30px; 
      height:30px; 
      text-align:center; 
      vertical-align:middle;
      color: #5c5c5c;
      font-size: 15px;
      font-weight: normal;
      border: 1px solid grey;
      border-radius: 5px;
      outline: none;
    }
    .btn{
      float: right;
      margin: 20px;
      height: 60px;
      width: 250px;
      background: #ff6c0a;
      font-size: large;
      font-weight: bold;
      border: 2px solid white;
      border-radius: 100px;
    }
    .btn:hover{
      float: right;
      margin: 20px;
      height: 60px;
      width: 250px;
      background: white;
      color: #ff6c0a;
      font-size: large;
      font-weight: bold;
      border: 2px solid #ff6c0a;
      border-radius: 100px;
      box-shadow: 0px 0px 25px #ff6c0a;
    }
  </style>
</head>
<body>
<?php include('config.php'); ?>
<!--#42dcff --> 
<div class="row">
</div><br><br>
<div class="sub-title" style="font-size: 15px;"><p><a href="index.php">Home</a> <a style="color:#5c5c5c;"> > Wish List</a></p>
<hr></div>
<div class="row">
<?php
    $uid = $_SESSION['user'];

    $sql = "SELECT * FROM users WHERE username='$uid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $uid  = $row["userid"];

    $sql = "SELECT * FROM wishlist LEFT JOIN products ON wishlist.pid=products.pid WHERE uid='$uid'";
    $result = $conn->query($sql);
    $resultset = array();
    // output data of each row into resultset
    while($row = $result->fetch_assoc()) 
    {
        $resultset[] = $row;
    }

    foreach ($resultset as $r)
    {
      echo "<div class='columns'>
        <div class='card'>
            <div class='product-imgs'>
              <img src='$r[img]'>
              <button class='heart' id='$r[pid]' onclick='remWish(this,\"$r[name]\")'>✕</button> 
            </div>
            <h3>$r[name]</h3>
            <div class='desc'>$r[qty] $r[measure]</div>
            <button class='addCart' id='$r[pid]' onclick='addQty(this)'><img src='icons/addcart.png' class='card-icons-small' id='addcart'>ADD</button>  
            <div class='cost'>₹$r[cost]</div>
        </div>
      </div>";
    }
      echo "</div><br>";
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
function remWish(x, product)
{
  var ids = x.id;
  var r = confirm("Do you wish to remove "+product+" from wishlist?");
  if (r == true)
    window.location.href = "addWish.php?pid="+ids+"&qty=0";
}
</script>

</body>
</html>
