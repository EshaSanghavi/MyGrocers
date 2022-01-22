<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;1,300&display=swap" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <style type="text/css">
        .center1 {
            margin: auto;
            width: 40%;
            margin-top: 20px;
            margin-bottom: 40px;
            padding: 20px 40px;
            color: #5c5c5c; 
            border: 3px solid lightgrey;
            border-radius: 20px;
        }
    </style>
</head>
<body>
<?php include('config.php'); 
// REGISTER USER
if (isset($_POST['addP'])) {
    // receive all input values from the form
    $pname = mysqli_real_escape_string($conn, $_POST['pName']);
    $ptype = mysqli_real_escape_string($conn, $_POST['pType']);
    $pqty = mysqli_real_escape_string($conn, $_POST['pQty']);
    $pmea = mysqli_real_escape_string($conn, $_POST['pMeasure']);
    $pcost = mysqli_real_escape_string($conn, $_POST['pCost']);
    $pimg = mysqli_real_escape_string($conn, $_POST['pImg']);
  
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($pname)) { array_push($errors, "Product name is required"); }
    if (empty($ptype)) { array_push($errors, "Product type is required"); }
    if (empty($pqty)) { array_push($errors, "Product quantity is required"); }
    if (empty($pmea)) { array_push($errors, "Product measure is required"); }
    if (empty($pcost)) { array_push($errors, "Product cost is required"); }
    if (empty($pimg)) { array_push($errors, "Product image path is required"); }
    
    // first check the database to make sure 
    // a user does not already exist with the same name and/or img path
    $user_check_query = "SELECT * FROM products WHERE name='$pname' OR img='$pimg' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row) { // if user exists
      if ($row['name'] === $pname) {
        array_push($errors, "Product name already exists");
      }
      if ($row['img'] === $pimg) {
        array_push($errors, "Product image path already exists");
      }
    }
  
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $query = "INSERT INTO products (name, type, qty, measure, cost, img) 
                  VALUES('$pname', '$ptype', '$pqty','$pmea', '$pcost', '$pimg')";
        mysqli_query($conn, $query);
        header('location: addProduct.php');
    }
  }
?>

<div class="row">
</div><br><br>
<div class="sub-title" style="font-size: 15px;"><p><a href="index.php">Home</a> <a style="color:#5c5c5c;"> > Add Product</a></p>
<hr></div>

  <form class="center1" method="post" action="addProduct.php">
  	<?php include('errors.php'); ?>
      <h2>Add Product</h2>
  	<div class="input-group">
  	  <label>Name:</label>
  	  <input type="text" name="pName">
  	</div>
  	<div class="input-group">
  	  <label>Type:</label>
      <input type="text" name="pType" list="pTypes">
      <datalist id="pTypes">
        <option value="Dairy">
        <option value="Beverages">
        <option value="Fresh Fruits">
        <option value="Fresh Vegetables">
        <option value="Pulses">
        <option value="Cereals">
      </datalist>
  	</div>
    <div class="input-group">
  	  <label>Quantity:</label>
  	  <input type="text" name="pQty">
  	</div>
    <div class="input-group">
      <label>Measure:</label>
      <input type="text" name="pMeasure" list="pMeasure">
      <datalist id="pMeasure">
        <option value="pcs">
        <option value="gm">
        <option value="kg">
        <option value="l">
        <option value="ml">
      </datalist>
    </div>
    <div class="input-group">
      <label>Cost:</label>
      <input type="text" name="pCost">
    </div>
    <div class="input-group">
      <label>Product Image:</label>
      <input type="text" name="pImg" id="pImg" placeholder="imgs/pId.png">
    </div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="addP">Add Product</button>
  	</div>
  </form>

<?php include('footer.php');?>
</body>
</html>