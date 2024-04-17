



<!DOCTYPE html>
<html>
  <head>
    <title>File Upload Form</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
      }

      form {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 2px solid #ccc;
        padding: 20px;
        border-radius: 10px;
      }

      input[type="file"] {
        margin-bottom: 10px;
      }

      input[type="submit"] {
        padding: 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
  <?php
  session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include('service.php');
  $service = new Service();
    $image = pathinfo($_FILES["filename"]["name"]);
    // $Text=$_POST['Text'];
    // $PageId='1';
    /*var_dump($Title1);
    var_dump($Title2);
    var_dump($image);
    var_dump($Text);
    var_dump($PageId);*/
  
    $myval = time();

     $ftp_host = '213.171.193.5';
      $ftp_user_name = 'sci-genetics.com';
      $ftp_user_pass = 'SC!@12345';
      
      $connect_it = ftp_connect( $ftp_host );
      
      $login_result = ftp_login($connect_it, $ftp_user_name, $ftp_user_pass);
      $test = $image['filename'].'_'.$myval.'.'.$image['extension'];
      $remote_file = 'inv/'.$image['filename'].'_'.$myval.'.'.$image['extension'];
      $image = $_FILES['filename']['tmp_name'];
      $database_image_name = pathinfo($_FILES["filename"]["name"]);
      $database_image_name = $database_image_name['filename'].'_'.$myval.'.'.$database_image_name['extension'];
      ftp_pasv($connect_it, true);
      $bool1_response=ftp_put( $connect_it, $remote_file, $image, FTP_BINARY );
      if($bool1_response){
        $insert = $service->insertfile($test);
        echo '<script>alert("File Uploaded Successfully");</script>';
        echo '<script>document.location.href="index.php";</script>';
      }else{
        echo '<script>alert("File Upload failed, try again");</script>';
        echo '<script>document.location.href="index.php";</script>';
      }
}

if(isset($_SESSION['id'])){
?>
    <form action="" method="post" enctype="multipart/form-data">
      <h2>File Upload Form</h2>
      <input type="file" name="filename" id="filename">
      <input type="submit" value="Upload">
    </form>
  <?php }else{
    header("Location:login.php");
  } ?>  
  </body>
</html>
