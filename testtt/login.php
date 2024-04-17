<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // die(print_r($_POST));
    include('service.php');
    $service = new Service();
    $login = $service->login($_POST['username'],$_POST['password']);
    // die(print_r($login));
    if($login){
        session_start();
        $_SESSION['id'] = $login['id'];
        if($login['type'] == 2){
            header("Location:table.php");
        }else if($login['type'] == 1){
            header("Location:index.php");
        }
    }else{
        header("Location: login.php");
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<script src="font.js"></script>

  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    .container {
      max-width: 500px;
      margin: auto;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
      box-sizing: border-box;
      font-size: 16px;
    }

    button {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: #3e8e41;
    }
    .logodiv{
      text-align:center;
    }
    .sl{
      display:flex;
      align-items: center;
      gap: 1rem;
      justify-content: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logodiv">
      <img src="../images/logo/logo-dark.png" alt="">
    </div>
    <div class="sl">
        <i class="fa-solid fa-lock" style="font-size:24px;"></i><h1>Secure Login</h1>
    </div>
    
    <form method="post" action="">
      <label for="username">Username:</label>
      <input type="text" name="username" id="username" required>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required>
      <button type="submit" name="submit">Login</button>
    </form>
    
  </div>
</body>
</html>
