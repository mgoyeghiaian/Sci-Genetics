<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
<script src="font.js"></script>
  <title>Test Results</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
      max-width: 800px;
      margin: 20px auto;
    }

    th, td {
      text-align: left;
      padding: 8px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    a {
      text-decoration: none;
      color: #0066cc;
    }
    h1{
        text-align:center;
    }
    svg{
        padding-right:10px;
    }
  </style>
</head>
<body>
  <h1>Test Results</h1>
    <table>
      <thead>
        <tr>
          <th>File Name</th>
          <th>Download</th>
        </tr>
      </thead>
      <tbody>
        
        <?php
        include('service.php');
        $service = new Service();
        $file_list = $service->getfiles();
        // die(print_r($file_list));
        foreach ($file_list as $file){ ?>
          <tr>
            <td><?php echo $file[1]; ?></td>
            <td><i class="fa-thin fa-file-pdf"></i><a href="https://www.sci-genetics.com/inv/<?php echo $file[1]; ?>" target="_blank">Download</a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
</body>
</html>
