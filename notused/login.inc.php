<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'connection.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // error hndlers
        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect Login Info";
        }

        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect Login Info";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username,
                "pwd" => $pwd,
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../index.php");
            die();
        }

        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] =htmlspecialchars($result["username"]);
        $_SESSION["user_id"] = $result["id"];
        $_SESSION["last_regeneration"] = time();

        header("Location: ../index/php?login=success");
        $pdo = null;
        $statement = null;

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ..index/php");
    die();
}



?>

