<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>$_POST-Appelé</title>
</head>
<body>
<h1>Page appelée par un formulaire</h1>
<h2>Des paramètres sont passées un formulaire dans le tableau $_POST
    !</h2>
<p> Bonjour <?php echo $_POST['name']. $_POST['street']. $_POST['city']. $_POST['postal_code']. $_POST['state']. $_POST['country'].
        $_POST['price'].$_POST['status'].$_POST['propertyTypeId'].$_POST['sellerId'] ; ?>
</p>
</body>
</html>
