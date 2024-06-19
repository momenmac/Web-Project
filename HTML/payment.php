<?php session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../CSS/index.css" type="text/css">
    <title>Computers World</title>
    <link href="../IMG/Logo-icon.png" rel="icon">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <script src="../Scripts/product.js"></script>
    <script src="../Scripts/index.js"></script>
    <script src="../Scripts/global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js"></script>
    <script src="https://kit.fontawesome.com/64a3783f0c.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/cart.css">
    <script src="https://kit.fontawesome.com/64a3783f0c.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
include ('../Server/connection.php');
include ('header.php');

$userDetails = [];
if (isset($_SESSION['username_id'])) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['username_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $userDetails = $result->fetch_assoc();
    $stmt->close();
}
?>
<div class="container mt-5">
    <h3 class="mb-4">Shipping Address</h3>
    <form action="processpayment.php" method="post" id="paymentForm">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required value="<?php echo $userDetails['first_name'] ?? ''; ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required value="<?php echo $userDetails['last_name'] ?? ''; ?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" required value="<?php echo $userDetails['street'] ?? ''; ?>">
        </div>
        <div class="mb-3">
            <label for="address2">Apartment/Suite/Building (Optional)</label>
            <input type="text" class="form-control" id="address2" name="address2">
        </div>
        <div class="row">
            <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="form-control" id="country" name="country" required>
                    <option value="">Choose...</option>
                    <option value="Jerusalem">Jerusalem</option>
                    <option value="Tel Aviv-Yafo">Tel Aviv-Yafo</option>
                    <option value="Haifa">Haifa</option>
                    <option value="Rishon LeZion">Rishon LeZion</option>
                    <option value="Petah Tikva">Petah Tikva</option>
                    <option value="Ashdod">Ashdod</option>
                    <option value="Netanya">Netanya</option>
                    <option value="Beer Sheva">Beer Sheva</option>
                    <option value="Holon">Holon</option>
                    <option value="Bnei Brak">Bnei Brak</option>
                    <option value="Ramla">Ramla</option>
                    <option value="Bat Yam">Bat Yam</option>
                    <option value="Kfar Saba">Kfar Saba</option>
                    <option value="Modi'in-Maccabim-Re'ut">Modi'in-Maccabim-Re'ut</option>
                    <option value="Herzliya">Herzliya</option>
                    <option value="Nazareth">Nazareth</option>
                    <option value="Tiberias">Tiberias</option>
                    <option value="Hadera">Hadera</option>
                    <option value="Acre">Acre</option>
                    <option value="Lod">Lod</option>
                    <option value="Eilat">Eilat</option>
                    <option value="Ashkelon">Ashkelon</option>
                    <option value="Safed">Safed</option>
                    <option value="Nahariya">Nahariya</option>
                    <option value="Ramat Gan">Ramat Gan</option>
                    <option value="Giv'atayim">Giv'atayim</option>
                    <option value="Kiryat Motzkin">Kiryat Motzkin</option>
                    <option value="Ramot">Ramot</option>
                    <option value="Ra'anana">Ra'anana</option>
                    <option value="Beersheba">Beersheba</option>
                    <option value="Hadera">Hadera</option>
                    <option value="Hod HaSharon">Hod HaSharon</option>
                    <option value="Bet Shemesh">Bet Shemesh</option>
                    <option value="Sderot">Sderot</option>
                    <option value="Yavne">Yavne</option>
                    <option value="Rehovot">Rehovot</option>
                    <option value="Rosh HaAyin">Rosh HaAyin</option>
                    <option value="Dimona">Dimona</option>
                    <option value="Kiryat Gat">Kiryat Gat</option>
                    <option value="Migdal HaEmek">Migdal HaEmek</option>
                    <option value="Yehud">Yehud</option>
                    <option value="Kiryat Bialik">Kiryat Bialik</option>
                    <option value="Qiryat Ata">Qiryat Ata</option>
                    <option value="Kiryat Yam">Kiryat Yam</option>
                    <option value="Netivot">Netivot</option>
                    <option value="Qiryat Malakhi">Qiryat Malakhi</option>
                    <option value="Beit Shemesh">Beit Shemesh</option>
                    <option value="Tamra">Tamra</option>
                    <option value="Afula">Afula</option>
                    <option value="Qalansawe">Qalansawe</option>
                    <option value="Nazerat Illit">Nazerat Illit</option>
                    <option value="Kfar Yona">Kfar Yona</option>
                    <option value="Giv'at Shmuel">Giv'at Shmuel</option>
                    <option value="Ra'anana">Ra'anana</option>
                    <option value="Eilabun">Eilabun</option>
                    <option value="Ma'alot-Tarshiha">Ma'alot-Tarshiha</option>
                    <option value="Tirat Carmel">Tirat Carmel</option>
                    <option value="Hura">Hura</option>
                    <option value="Jisr az-Zarqa">Jisr az-Zarqa</option>
                    <option value="Ma'alot-Tarshiha">Ma'alot-Tarshiha</option>
                    <option value="Kiryat Shmona">Kiryat Shmona</option>
                    <option value="Or Yehuda">Or Yehuda</option>
                    <option value="Zefat">Zefat</option>
                    <option value="Nesher">Nesher</option>
                    <option value="Nahf">Nahf</option>
                    <option value="Tiberias">Tiberias</option>
                    <option value="Givatayim">Givatayim</option>
                    <option value="Kiryat Ekron">Kiryat Ekron</option>
                    <option value="Rahat">Rahat</option>
                    <option value="Metula">Metula</option>
                    <option value="Bnei Brak">Bnei Brak</option>
                    <option value="Efrat">Efrat</option>
                    <option value="Kfar Sava">Kfar Sava</option>
                    <option value="Jaffa">Jaffa</option>
                    <option value="Jaffa">Jaffa</option>
                    <option value="Mitzpe Ramon">Mitzpe Ramon</option>
                    <option value="Gush Etzion">Gush Etzion</option>
                    <option value="Qalqilyah">Qalqilyah</option>
                    <option value="Jenin">Jenin</option>
                    <option value="Nablus">Nablus</option>
                    <option value="Bethlehem">Bethlehem</option>
                    <option value="Jericho">Jericho</option>
                    <option value="Ramallah">Ramallah</option>
                    <option value="Hebron">Hebron</option>
                    <option value="Gaza">Gaza</option>
                    <option value="Khan Yunis">Khan Yunis</option>
                    <option value="Rafah">Rafah</option>
                    <option value="Tulkarem">Tulkarem</option>
                    <option value="Qalqilya">Qalqilya</option>
                    <option value="Ariel">Ariel</option>
                    <option value="Beit Jala">Beit Jala</option>
                    <option value="Beit Sahour">Beit Sahour</option>
                    <option value="Bethlehem">Bethlehem</option>
                    <option value="Birzeit">Birzeit</option>
                    <option value="Dura">Dura</option>
                    <option value="Gaza">Gaza</option>
                    <option value="Hamas">Hamas</option>
                    <option value="Hebron">Hebron</option>
                    <option value="Janin">Janin</option>
                    <option value="Jenin">Jenin</option>
                    <option value="Jericho">Jericho</option>
                    <option value="Khan Yunis">Khan Yunis</option>
                    <option value="Nablus">Nablus</option>
                    <option value="Nazareth">Nazareth</option>
                    <option value="Qalqilya">Qalqilya</option>
                    <option value="Qalqilyah">Qalqilyah</option>
                    <option value="Ramallah">Ramallah</option>
                    <option value="Salfit">Salfit</option>
                    <option value="Tulkarm">Tulkarm</option>
                    <option value="Tulkarm">Tulkarm</option>
                    <option value="Yatta">Yatta</option>
                    <option value="Zababdeh">Zababdeh</option>

                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="state">State/Province</label>
                <input type="text" class="form-control" id="state" name="state" required value="<?php echo $userDetails['region'] ?? ''; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="zip">Postal Code</label>
                <input type="text" class="form-control" id="zip" name="zip" required value="<?php echo $userDetails['postal_code'] ?? ''; ?>">
            </div>
        </div>
        <div class="mb-3">
            <label for="phone">Phone Number (Optional)</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $userDetails['phone_number'] ?? ''; ?>">
        </div>
        <hr class="mb-4">
        <h4 class="mb-4">Payment</h4>
        <div class="d-block my-3">
            <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                <label class="custom-control-label" for="credit">Credit card</label>
            </div>
            <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                <label class="custom-control-label" for="paypal">PayPal</label>
            </div>
        </div>
        <div id="creditCardInfo" class="row">
            <div class="col-md-6 mb-3">
                <label for="ccName">Name on card</label>
                <input type="text" class="form-control" id="ccName" name="ccName" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="ccNumber">Credit card number</label>
                <input type="text" class="form-control" id="ccNumber" name="ccNumber" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="ccExpiration">Expiration</label>
                <input type="text" class="form-control" id="ccExpiration" name="ccExpiration" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="ccCVV">CVV</label>
                <input type="text" class="form-control" id="ccCVV" name="ccCVV" required>
            </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit" style="margin-bottom: 30px">Continue to checkout</button>
    </form>
</div>
<?php include("footer.html"); ?>
</body>
</html>
