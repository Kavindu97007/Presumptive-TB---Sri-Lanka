<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate QR Code</title>

</head>
<body>
    <!-- Display the generated QR code here -->


<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<div class="form">
  <h1>QR Code using qrcodejs</h1>
  <form>
    <input type="url" id="website" name="website" value="http://localhost/tb/patient.php?ptId= <?php echo $_GET['ptId']; ?>" />

  <div id="qrcode-container" >
    <div id="qrcode" class="qrcode"></div>
  </div>

  <script type="text/javascript">
    function generateQRCode() {
      let website = document.getElementById("website").value;
      if (website) {
        let qrcodeContainer = document.getElementById("qrcode");
        qrcodeContainer.innerHTML = "";
        new QRCode(qrcodeContainer, website);
        document.getElementById("qrcode-container").style.display = "block";
      } 
    }
      generateQRCode()
  </script>

</div>

<style type="text/css">
    .form {
  font-family: Helvetica, sans-serif;
  max-width: 400px;
  margin: 0 auto;
  padding: 16px;
  background: #f7f7f7;
}
.form h1 {
  background: #5868bf;
  padding: 20px 0;
  font-weight: 300;
  text-align: center;
  color: #fff;
  margin: -16px -16px 16px -16px;
  font-size:  25px;
}
.form input[type="text"],
.form input[type="url"] {
  box-sizing: border-box;
  width: 100%;
  background: #fff;
  margin-bottom: 4%;
  border: 1px solid #ccc;
  padding: 3%;
  color: #555;
}
.form input[type="text"]:focus,
.form input[type="url"]:focus {
  box-shadow: 0 0 5px #5868bf;
  padding: 3%;
  border: 1px solid #5868bf;
}

.form button {
  box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  width: 150px;
  margin: 0 auto;
  padding: 3%;
  background: #5868bf;
  border-bottom: 2px solid #5868bf;
  border-top-style: none;
  border-right-style: none;
  border-left-style: none;
  color: #fff;
  cursor: pointer;
}
.form button:hover {
  background: rgba(88,104,191, 0.5);
}
#qrcode-container{
    display:none;
}

.qrcode{
  padding: 16px;
}
.qrcode img{
  margin: 0 auto;
}
</style>
</body>
</html>
