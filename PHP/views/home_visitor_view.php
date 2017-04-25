<div class="jumbotron">

    <form class="form-signin" method="POST" action="../scripts/sign_in.php">
        <h3 class="form-signin-heading">Sign in</h3>
        <input type="text" name="username" class="form-control" placeholder="Username" maxlength="20" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" maxlength="20" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

    <form class="form-signin" method="POST" action="../scripts/sign_up.php">
        <h3 class="form-signin-heading">No account yet? Create one</h3>
        <input type="text" name="username" class="form-control" placeholder="Username" maxlength="20" required autofocus>
        <input type="text" name="first_name" class="form-control" placeholder="First name" maxlength="20" required>
        <input type="text" name="last_name" class="form-control" placeholder="Last name" maxlength="20" required>
        <input type="email" name="email" class="form-control" placeholder="Email address" maxlength="60" required>
        <input type="password" name="password" class="form-control" placeholder="Password" maxlength="20" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    </form>
</div>