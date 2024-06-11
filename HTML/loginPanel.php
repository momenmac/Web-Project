<div class="login-panel">
    <b>Sign in</b><br>
    <div class="login-panel-container">
        <form method="post" action="index.php">
            <label>
                Username<br>
                <input type="text" maxlength="50" name="username" placeholder="Enter your username"><br>
            </label>
            <label>
                Password<br>
                <input type="password" name="password" maxlength="50">
            </label>
            <input type="submit" name="signInButton" value="Sign in"><br>
            <button type="button" onclick="document.querySelector('.login-panel-container').style.display = 'none'" style="background-color: var(--secondary); color: white">Sign Up</button>

        </form>
        <br>

    </div>

</div>