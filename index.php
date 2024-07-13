<?php 
session_start();
include 'includes/db.php';

//Tables aanmaken
include 'includes/userTable.php';
include 'includes/transactionTable.php';

//Controleer of post is geset
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gebruikersnaam en wachtwoord uit post halen
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Match placeholders met columns username en password
    // User input word niet meer direct in de query geinsert
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->execute(['username' => $username]);
    // Fetch result
    $user = $stmt->fetch();
    
    // password_verify om hashed password te verifieren
    if ($user && password_verify($password, $user['password'])) {
        // Gebruiker is ingelogd
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['user'] = $user;
    
        header("location: dashboard.php");
    } else {
        // Gebruiker is niet ingelogd
        $error = "Gebruikersnaam of wachtwoord is onjuist";
    }

}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALFA Bank</title>
    <!-- Voeg Tailwind CSS toe via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <?php include 'includes/header.php'; ?>

    <div class="container mx-auto mt-20 p-6 bg-white max-w-sm shadow-md rounded-md">
        <div class="flex justify-center">
            <img src="img/ALFA1.png" alt="ALFA Bank Logo" class="mb-6 w-1/2"> <!-- Aanpassen van de breedte naar 1/2 van de container -->
        </div>
        <h2 class="text-lg text-center font-bold mb-6">Inloggen bij ALFA Bank</h2>
        <form action="<? echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>" method="post">
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Wachtwoord:</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <input type="submit" value="Inloggen" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
        </form>
        <a href="register.php" class="block text-center text-sm text-blue-600 hover:underline mt-4">Nog geen account? Registreer hier</a>
    </div>

    <div class="mt-4 p-2 border border-gray-300 rounded">
        <label class="block text-sm font-medium text-gray-700">Uitgevoerde SQL-query:</label>
        <textarea readonly class="mt-1 block w-full border rounded-md py-2 px-3 resize-none" rows="4"><? //als $sql bestaat geef $sql, anders geef aan dat deze nog niet is ingevuld
        if(isset($sql)) {
            echo $sql;
        } else {
            echo "Log in om je SQL query te zien";
        }
        ?></textarea>
    </div>

    
</body>
</html>

<!--
Lijn 15, SQL injection op login pagina opgelost en verifieer hashed pass



Aan gewerkt:

Transacties.php
Register.php
Index.php
Dashboard.php 

TO DO :

Session management secure maken
Cookies
  -->
