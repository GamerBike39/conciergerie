<?php
include_once 'includes/connect.php';
include_once 'includes/header.php';
var_dump($_SESSION['login_user']); 
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-12 row">
                <form action="./includes/connect.php" method="post" class="col-12">
                    <h1>Login</h1>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                            required>
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                            required>
                    </div>
                    <section>
                        <!-- <?php login() ?> -->
                        <button type="submit" name="action" value="login">Login</button>
                        <a href="register.php">Register</a>
                    </section>
                </form>
</main>


<?php
include_once 'includes/footer.php'
?>