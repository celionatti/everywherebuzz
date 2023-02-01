<?php


/** @var $this \app\core\View */

$this->title = "EverywhereBuzz | Login";

?>

<form action="create.html" method="post" class="admin-form auth-form sm-form">
            <h1 class="center form-title">Login</h1>

            <div class="input-group">
                <label for="username">Username or E-Mail</label>
                <input type="text" name="username" id="username" class="input-control">
                <!-- <div class="invalid-feedback">Your Message</div> -->
            </div>
            <div class="input-group">
                <div class="forgot-password-wrapper">
                    <label for="password">Password</label>
                    <small>
                        <a href="/forgot-password" class="link">Forgot Password?</a>
                    </small>
                </div>
                <input type="password" name="password" id="password" class="input-control">
            </div>
            <div class="input-group">
                <label for="remember">
                    <input type="checkbox" name="remember" id="remember">
                    Remember Me
                </label>
            </div>

            <div class="input-group">
                <button type="submit" class="btn long-btn primary-btn big-btn">Login</button>
            </div>
            <p class="center">
                <small>Don't yet have an account? you can <a href="/register">Sign Up</a></small>
            </p>
        </form>