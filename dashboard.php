<?php include 'header.php' ?>

<?php  

error_reporting(E_ALL);


if ($_FILES[csv][size] > 0) { 

    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    do { 
        if (!empty($data[0])) { 

            mysqli_query($db, "INSERT INTO imported-data (purchaserName, itemDescription, itemPrice, purchaseCount, merchantAddress, merchantName) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."', 
                    '".addslashes($data[3])."', 
                    '".addslashes($data[4])."', 
                    '".addslashes($data[5])."' 
                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle)); 
    // 

    //redirect 
    header('Location: dashboard.php?success=1'); die; 

} 

?> 

<div class="container">    

	<h3>Please upload the file below!</h3> 
	<hr>    







<?php if (!empty($_GET[success])) { echo '<div class="alert alert-success"> Your file has been imported.</div>'; }  ?> 

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  <input name="csv" type="file" id="csv" /> <br />
  <input type="submit" name="Submit" value="Submit" /> 
</form> 




</div>

<?php include 'footer.php' ?>