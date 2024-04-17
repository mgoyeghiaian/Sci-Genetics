<?php
session_start();
if(isset($_SESSION['id'])){

    include('service.php');
    $service=new Service();
    $rate = $service->getrate();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCI | Payment Information</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <a href="logout.php">Back</a>
        <div class="all">
            <div class="logo">
                <img src="sci-logo.png" alt="sci-logo">
            </div>
            
            <div class="login">
                <form action="sendmail.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                
                <div class="row">
                        <div class="col-lg-12">
                            <a href="Refunds.php" style="color:blue;">Refunds</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="file">Upload document</label>
                            <input class="form-control" type="file" name="filename" id="file " placeholder="Client Name" value="dsd"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="file">Prefix</label>
                            <select class="form-control" name="prefix" id="prefix">
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Prof.">Prof.</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="file">First Name</label>
                            <input class="form-control" type="text" name="firstname" id="firstname" placeholder="First Name"/>
                        </div>
                        <div class="col-lg-6">
                            <label for="file">Last Name</label>
                            <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Last Name"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="file">Location</label>
                            <select class="form-control" name="inout" id="inout">
                                <option value="inside">Inside UAE</option>
                                <option value="outside">Outside UAE</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="file">Email</label>
                            <input class="form-control" type="email" name="email" id="email" placeholder="YourEmail@gmail.com" pattern=".*@.*.com" size="30" required/>
                           </div>
                        <div class="col-lg-6">
                            <label for="file">Mobile</label>
                            <input class="form-control" type="text" name="mobile" id="mobile"  placeholder="712345" min="7"  required/>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="file">Test Name</label>
                            <input class="form-control" type="text" name="test" id="test" placeholder="Test Name" required/>
                        </div>
                        <div class="col-lg-6">
                            <label for="file">Amount (USD)</label>
                            <input onkeyup="change()" step="0.01" class="form-control" type="number" name="amount" id="amount" placeholder="Amount" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="file">Charges (USD)</label>
                            <input class="form-control" onkeyup="change2(this.value)" type="number" step="0.01" name="chargeamount" id="chargeamount" placeholder="Charges" required/>
                        </div>
                        <div class="col-lg-6">
                            <label for="file">Rate</label>
                            <input type="number" step="0.01" onkeyup="change()" value='<?php echo $rate[1];?>' class="form-control"  name="rate" id="rate" placeholder="rate" required/>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="file">Amount (AED)</label>
                            <input class="form-control" type="number" step="0.01" name="amountaed" id="amountaed" placeholder="Amount" required/>
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                    <div class="col-lg-4">
                            <button type="button" onclick="generateUniquePassword()">Generate Password</button>
                        </div>
                        <div class="col-lg-8">
                            <input value='' class="form-control" type="text" name="gpas" id="gpas" placeholder="Password" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input class="form-control out" type="submit" name="pg" id="pg" value="Submit">   
                        </div>
                    </div>
                </form>
            </div>
        </div>
     

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="index.js"></script>

<script>
function validateForm() {
    var mobileInput = document.getElementById("mobile").value;
    // Remove non-digit characters
    var mobileNumber = mobileInput.replace(/\D/g, '');
    if (mobileNumber.length <6 || isNaN(mobileNumber)) {
        alert("Please enter a valid 6-digit mobile number.");
        return false;
    }
    return true;
}

   
</script>

</body>
</html>
<?php

if(isset($_GET['success']) && $_GET['success'] == 'true'){
    echo '<script>alert("Invoice Sent Successfully");</script>';
}else if(isset($_GET['success']) && $_GET['success'] == 'false'){
    echo '<script>alert("Error! Check the email you have entered");</script>';
}

}else{
    header("Location:login.php");
}
?>
