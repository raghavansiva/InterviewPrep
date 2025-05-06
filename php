<?php
session_start();

// Hardcoded user credentials
$validUser = 'user';
$validPass = 'pass';

$message = '';

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// Handle login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === $validUser && $password === $validPass) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        $message = "Invalid username or password.";
    }
}

// Check if user is logged in
$loggedIn = isset($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Simple PHP Session</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background: #6495ED;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }
  .container {
    background: rgba(0,0,0,0.4);
    padding: 2rem;
    border-radius: 8px;
    width: 280px;
    text-align: center;
  }
  input[type=text], input[type=password] {
    width: 100%;
    padding: 0.5rem;
    margin: 0.6rem 0;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
  }
  button {
    width: 100%;
    padding: 0.6rem;
    background: #ff6347;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    font-weight: bold;
    color: white;
    cursor: pointer;
  }
  button:hover {
    background: #e5533d;
  }
  .message {
    margin-bottom: 1rem;
    color: #ffdddd;
  }
  a.logout-link {
    color: #fff;
    text-decoration: underline;
    cursor: pointer;
    display: inline-block;
    margin-top: 1rem;
  }
</style>
</head>
<body>

<div class="container">
<?php if ($loggedIn): ?>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <a href="index.php?logout=1" class="logout-link">Logout</a>
<?php else: ?>
    <h2>Login</h2>
    <?php if($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required autofocus />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
    </form>
<?php endif; ?>
</div>

</body>
</html>
