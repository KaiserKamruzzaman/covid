<!DOCTYPE html>  
<html>  
 <head>  
  <title></title>
  <?php include'../assets/header.php' ?>
 </head> 

 <?php include'../assets/navbar.php' ?>
 <body>  
  <h3 align="center">How to Import Data from CSV File to Mysql using PHP</h3><br />

  <form method="post" enctype="multipart/form-data" action="adminApi.php">
   <div align="center">  
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
   </div>
  </form>
  
 </body>  
</html>

