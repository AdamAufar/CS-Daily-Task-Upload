<?php 
session_start();
if(isset($_SESSION['id'])){
    header('Location: petugasMenu.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }

        h3, h4 {
            color: #333;
            margin: 10px 0;
        }

        input[type="button"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin: 20px 0;
            border-radius: 4px;
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        input[type="button"]:hover {
            background-color: #45a049;
        }

        input[type="text"], input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #008CBA;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin: 20px 0;
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        button:hover {
            background-color: #007BB5;
        }

        img {
            width: 150px;
            height: 150px;
        }
        /* Button Styling */
        .back-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        input[type="button"], .back-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin: 20px 0;
            display: block;
            width: fit-content;
            font-size: 15px; 
            margin-left: 0;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="index.php" class="back-button">Back</a>
        <?php if (!isset($_SESSION["id"])) { ?>
            <img src="images/bgalogo.png" alt="Logo">
            <h4>Selamat Datang Di</h4>
            <h3>Aplikasi Cleaning Service</h3>
            <h3>Login</h3>
            <form action="includes/login.php" method="post">
                <input type="text" name="username" id="username" placeholder="Username">
                <input type="password" name="password" id="password" placeholder="Password">
                <button>Login</button>
            </form>
        <?php } ?>
    </div>
</body>

</html>
