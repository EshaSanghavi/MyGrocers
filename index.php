<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
<?php include('config.php'); ?>
<!--#42dcff	--> 

<div class="row">
  <div class="upcolumn">

<div class="mySlides fade">
  <img src="imgs/img1.jpg" class="slides-img">
</div>
<div class="mySlides fade">
  <img src="imgs/img2.jpg" class="slides-img">
</div>
<div class="mySlides fade">
  <img src="imgs/img3.jpg" class="slides-img">
</div>
<div class="mySlides fade">
  <img src="imgs/img4.jpg" class="slides-img">
</div>
<div class="mySlides fade">
  <img src="imgs/img5.jpg" class="slides-img">
</div>
<div class="mySlides fade">
  <img src="imgs/img6.jpg" class="slides-img">
</div>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span> 
</div>

</div>
</div>

<?php
    $sql = "SELECT DISTINCT type FROM products";
    $result = $conn->query($sql);
    $resultset = array();
    // output data of each row into resultset
    while($row = $result->fetch_assoc()) 
    {
        $resultset[] = $row;
    }

    foreach ($resultset as $r)
    {
      echo "<div class='sub-title'>$r[type] <a href='category.php?category=$r[type]'>(View All)</a>
            <hr></div>  
            <div class='row'>";
      $sql = "SELECT * FROM products WHERE type = '$r[type]' ORDER BY name ASC LIMIT 5";
      $res = $conn->query($sql);
      $products = array();
      // output data of each row into resultset
      while($row = $res->fetch_assoc()) 
      {
        $products[] = $row;
      }
      foreach ($products as $p)
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
      echo "</div><br>";
    } 
?>


<?php include('footer.php');?>


<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2500); // Change image every 2 seconds
}

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
