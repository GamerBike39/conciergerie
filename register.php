<?php 
include_once 'includes/header.php';
require_once 'includes/connect.php';
?>

<main>
    <form action="index.php" method="post">
        <h1>Register</h1>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <section>
            <button type="submit" name="action" value="register">Register</button>
            <a href="index.php">Login</a>
        </section>
    </form>
</main>

<?php include_once 'includes/footer.php' ?>