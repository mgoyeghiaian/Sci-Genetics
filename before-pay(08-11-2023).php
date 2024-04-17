<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once './payment/service.php';
    $service = new Service();
    $check = $service->check($_POST['username'],$_POST['password']);
    if($check){
    ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice</title>
    <style type="text/css">
      body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Adjust to desired height */
        margin: 0;
      }
      * {
        margin: 0;
        padding: 0;
        text-indent: 0;
      }
      .s1 {
        color: black;
        font-family: "Trebuchet MS", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 14.2px;
font-weight: 1000 !important;
      }
      p {
        color: black;
        font-family: "Trebuchet MS", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9pt;
        margin: 0pt;
      }
      .a {
        color: black;
        font-family: "Trebuchet MS", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9pt;
      }

      .a:hover {
      font-weight: bolder;
      color:#316eb8
      }
      .s2 {
        color: black;
        font-family: "Trebuchet MS", sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 9pt;
      }
      h1 {
        color: #dd2133;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 54pt;
      }
      #btnn{
        padding: 5px;
        margin-top: 20px;
        color: #316eb8;
        border: 1px solid #316eb8;
        background: white;
        cursor: pointer;
        font-size: 14px;
      }
      table,
      tbody {
        vertical-align: top;
        overflow: visible;
      }
      .invoice{
        color: 	#8b8d8d;
        font-size: 13.5px;
        font-weight: bolder;
      }
  
    </style>
  </head>
  <body>
    <form action="pay.php" method="post" style="text-align:-webkit-center;text-align:-moz-center;">
    <input type="hidden" name="username" value="<?php echo $_POST['username']?>" />
    <input type="hidden" name="password" value="<?php echo $_POST['password']?>" />
    <div style="width: 100%; text-align: center">
      <p style="text-indent: 0pt; line-height: 17pt; text-align: left">
        <span
          style="
            color: black;
            font-family: 'Trebuchet MS', sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12.5pt;
          "
          > 
          
        Tax Invoice:
        <span class="invoice">
        <?php
    echo '00' . $check['id'];
?>
        </span>
        </span
        >
      </p>


      <p style="padding-left: 0pt; text-indent: 0pt; text-align: left">
        <span
          ><table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
                <img
                  width="120"
                  height="120"
                  src="data:image/jpg;base64,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TbUnrvq9Q9nB2TS0OOsPhT4a02MpFppcm6hvTJPcSzSNLEcxMXdix29gTj2qG7+DvhS9gt4X0po44FlRfs91NCSsjl3RijgspZidrZHPSu3oNV9YrXvzu/qxeyp7cq+4xL/wppmpaHFo89kjabF5Wy2XKKvlsrRgYxgAqvHtVdvAmiyWy27aehhW/wD7UCb24ud+/wAzr13EnHT2ro6KzVSa2kynCL3RxM/wg8LTxSRnS2TddPehorqaN45nzvaNlcGPdk5CkA+laWkeAdE0KWyew06O2azgktoSrMdscjBnByeSzKCScnI610lFW61WSs5u3qJU4J3UUc0vw90CPS9M05dNjNlppZrSFmYrGWRkbqecq7jnPWs3Sfg94U0WeKa10o+bFC9tG811NKUhcYaNd7nCYH3RwOwrt6KPb1ldKb183/XUXsqe/KvuOKtvhD4UttMn09dIDWc1vHavHLPI58qNmaNQzMSNrMxBByO1T6b8MPDukxolvpvK3SXvmzTySytMgwjtI7FmwOBkkV11FN16zveb182Hsqa2ijkNU+FvhzWZp57nTT9omu/trTwXEsMgm8sR7w6MGX5QBgEA4qTRPhr4e8OT28um6YlpJbySyxMrsdryACRuSeWCjOfrXV0UnWquPK5u3a7H7OCfNyq4UUUViaBRRRQAUUUUAFFFFABR0oooAKO9HaigAooFFABRRRQAUUUUAFFFFABRRR1oAKKKKACg0UHpQAUUUUAFFHaigAoo6UUAHeiiigAoooxQB//Z"
                />
              </td>
            </tr></table
        ></span>
      <p
        class="s1"
        style="
          padding-left: 0pt;
          text-indent: 0pt;
          text-align: left;
          padding-bottom: 5px

        "
      >
        To
      </p>
      <p
        style="
          padding-left: 0pt;
          text-indent: 0pt;
          line-height: 141%;
          text-align: left;
        "
      >
        <?php 
        echo $check['client'];
        ?>
      </p>
      <p
        class="s1"
        style="
          padding-top: 12pt;
          padding-left: 0pt;
          text-indent: 0pt;
          text-align: left;
          padding-bottom: 5px
        "
      >
        From
      </p>
      <p
        style="
          padding-left: 0pt;
          text-indent: 0pt;
          line-height: 139%;
          text-align: left;
        "
      >
      <span style="font-size: 12px; font-weight:900 ;">
      Smart Cells International fze
      </span>
      <br/>
      <span style="font-weight:bolder; color:#3274B9">
      W|
      </span>
        <a href="http://www.sci-genetics.com/" class="a" target="_blank"
          >
          www.sci-genetics.com</a
          
        >
        <br/>
        <span style="font-weight:bolder; color:#3274B9">
E |
        </span>
        <a href="mailto:info@sci-genetics.com" class="a" target="_blank"
          >

           info@sci-genetics.com</a
        >
        <br/>
       
    <span style="font-weight:bolder; color:#3274B9">P |</span> <a href="tel:+971509671132" class="a" target="_blank"> +971 50 967 11 32</a>
      </p>
      <p
        style="
          padding-left: 0pt;
          text-indent: 0pt;
          padding-top: 4pt;
          line-height: 10pt;
          text-align: left;
          font-size: 12px;


        "
      >
        VAT 103000675878
      </p>
      <p
        style="
          padding-top: 4pt;
          padding-left: 0pt;
          text-indent: 0pt;
          text-align: left;
          font-size: 12px;

        "
      >
        TRN 104054650700003
      </p>
      <p
        style="
          padding-top: 3pt;
          padding-left: 0pt;
          text-indent: 0pt;
          font-size: 12px;
          text-align: left;
        "
      >
        License 27343
      </p>
      <p style="text-indent: 0pt; text-align: left" />
      <p style="text-indent: 0pt; text-align: left" />
      <p style="text-indent: 0pt; text-align: left" />
      <p style="text-indent: 0pt; text-align: left" />
      <p
        style="
          padding-top: 4pt;
          padding-left: 0pt;
          text-indent: 0pt;
          line-height: 135%;
          text-align: left;
        "
      >
        Ajman Free Zone, Ajman United Arab Emirates
      </p>
      <p
        class="s1"
        style="
          padding-top: 10pt;
          padding-left: 0pt;
          text-indent: 0pt;
          text-align: left;
          padding-bottom: 8px

        "
      >
        Details
      </p>
      
      <table
        style="border-collapse: collapse; margin-left: 5.22418pt; width: 100%"
        cellspacing="0"
      >
        <tr style="height: 27pt">
          <td
            style="
              width: 46pt;
              border-bottom-style: solid;
              border-bottom-width: 1pt;
            "
          >
            <p
              class="s2"
              style="
                padding-top: 2pt;
                padding-left: 9pt;
                text-indent: 0pt;
                text-align: left;
              "
            >
              Test
            </p>
          </td>
          
          
          
          <td
            style="
              width: 111pt;
              border-bottom-style: solid;
              border-bottom-width: 1pt;
            "
          >
            <p
              class="s2"
              style="
                padding-top: 2pt;
                padding-right: 8pt;
                text-indent: 0pt;
                text-align: right;
              "
            >
              Total
            </p>
          </td>
        </tr>
        
        <tr style="height: 28pt">
          <td
            style="
              width: 46pt;
              border-top-style: solid;
              border-top-width: 1pt;
              border-bottom-style: solid;
              border-bottom-width: 1pt;
            "
          >
            <p
              class="s2"
              style="
                padding-top: 8pt;
                padding-left: 9pt;
                text-indent: 0pt;
                text-align: left;
              "
            >
              <?php
              echo $check['test'];
              ?>
            </p>
          </td>
          
          
          
          <td
            style="
              width: 111pt;
              border-top-style: solid;
              border-top-width: 1pt;
              border-bottom-style: solid;
              border-bottom-width: 1pt;
            "
          >
            <p
              class="s2"
              style="
                padding-top: 8pt;
                padding-right: 9pt;
                text-indent: 0pt;
                text-align: right;
              "
            >
            <?php
              echo $check['amountaed'].' AED';
              ?>
            </p>
          </td>
        </tr>
      </table>
      <p style="text-indent: 0pt; text-align: left "><br /></p>
      <p style="padding-top: 6pt; text-indent: 0pt; text-align: right; padding-right: 5.5px; ; padding-bottom: 20px;
">
      Total: <?php echo $check['amountaed'];?> AED
      </p>
    
    
      <p style="text-indent: 0pt; text-align: left">
        <span
          ><table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
                <img
                  width="77"
                  height="9"
                  src="data:image/png;base64,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"
                />
              </td>
            </tr></table
        ></span>
      </p>
      <!-- <h1 style="text-indent: 0pt; line-height: 54pt; text-align: left">
        PAID
      </h1> -->
      <p style="text-indent: 0pt; text-align: left" />
  
     
      <p style="text-indent: 0pt; text-align: left"><br /></p>
          
      <p style="padding-left: 0pt; text-indent: 0pt; text-align: left;margin-bottom:20px;">
        Bank charges should be paid by the Client.
      </p>
      <p style="text-indent: 0pt; text-align: left"><br /></p>
      <p style="padding-left: 0pt; text-indent: 0pt; text-align: left">
        SMART CELLS INTERNATIONAL fze BANK DETAILS:
      </p>
      <p style="padding-left: 0pt; text-indent: 0pt; text-align: left">
        Bank Name: Mashreq Bank, Burjuman Branch, Dubai, UAE Account Number
        (AED): 019100444612
      </p>
      <p style="padding-left: 0pt; text-indent: 0pt; text-align: left">
        IBAN: AE78 0330 0000 1910 0444 612
      </p>
      <p style="padding-left: 0pt; text-indent: 0pt; text-align: left">
        Routing Code: 203320101
      </p>
    </div>
      <input id="btnn" type="submit" name="pay" value="Confirm" />
    </form>
  </body>
</html>
<?php
    }else{
      header("Location:index.php");
    }
?>
