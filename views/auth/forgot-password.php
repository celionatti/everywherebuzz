<?php


/** @var $this \app\core\View */

$this->title = "EverywhereBuzz | Forgot Password";

?>

<form action="create.html" method="post" class="admin-form auth-form sm-form">
    <h1 class="center form-title">Reset Password</h1>

    <div class="lead-text">
        Enter the email address you used to sign up on this website so we can assist you in resetting your password.
    </div>

    <div class="input-group">
        <input type="email" name="email" id="email" class="input-control" placeholder="E-Mail Address">
    </div>

    <div class="input-group">
        <button type="submit" class="btn long-btn primary-btn big-btn">Send Reset Link</button>
    </div>
    <a href="/login" role="button" class="btn btn-warning long-btn">Back to Login</a>
</form>