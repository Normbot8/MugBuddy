<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title>MugBuddy</title>
	<link href="css/signup.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Sigmar+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Architects+Daughter|Baloo+Bhaina|Orbitron|Permanent+Marker|Poiret+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Concert+One|Karla|Nunito|Open+Sans|Oxygen|Poppins|Source+Sans+Pro|Ubuntu" rel="stylesheet">
</head>

<?php
    // define variables and set to empty values
    $firstName = $lastName = $userName = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST["firstName"]);
        $email = test_input($_POST["lastName"]);
        $website = test_input($_POST["userName"]);
        $comment = test_input($_POST["password"]);
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 ?>

<body>
    <h1>Sign Up Today!</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        First Name:
        <br>
        <input type="text" name="firstName"></input>
        <br>
        Last Name:
        <br>
        <input type="text" name="lastName"></input>
        <br>
        Username:
        <br>
        <input type="text" name="userName"></input>
        <br>
        Password:
        <br>
        <input type="text" name="password"></input>
    </form>
</body>

</html>
