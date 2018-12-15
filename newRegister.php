<?php
    session_start();
    $firstName = $_SESSION["firstName"];
    $lastName = $_SESSION["lastName"];
    $userName = $_SESSION["userName"];
    $password = $_SESSION["password"];
    $email = $_SESSION["email"];


    $mysql = new mysqli("localhost", "root", "noU", "mugBuddy");

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "CREATE TABLE IF NOT EXISTS users (
        id TEXT,
        firstName TEXT,
        lastName TEXT,
        userName TEXT,
        password TEXT,
        email TEXT
        )";

    if ($mysql->query($query))
    {
        $checkForDuplicate = $mysql->prepare("SELECT email FROM users WHERE email=?");
        $checkForDuplicate->bind_params("s", $email);

        if($checkForDuplicate->execute())
        {
            if ($checkForDuplicate->num_rows === 0)
            {
                $id = guidv4(random_bytes(16));

                $createNewAccount = $mysql->prepare("INSERT INTO users (id, firstName, lastName, userName, password, email) VALUES (?,?,?,?,?,?)");
                $createNewAccount->bind_params("ssssss", $id, $firstName, $lastName, $userName, $password, $email);

                if ($createNewAccount->execute()) {
                    header('Location: login.php');
                }
            } else {
                echo "Account already exists.";
            }
        }
    }

    function guidv4($data)
    {
      assert(strlen($data) == 16);

      $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
      $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

      return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
   }
 ?>
