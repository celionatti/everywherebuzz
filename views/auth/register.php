<?php


/** @var $this \app\core\View */

$this->title = "EverywhereBuzz | Create an Account";

?>

<form action="create.html" method="post" class="admin-form auth-form">
    <h1 class="center form-title">Sign Up</h1>

    <div class="input-group avatar-input-group center">
        <input type="file" name="avatar" id="avatar-input" class="hide avatar-input">
        <button type="button" class="change-avatar-btn">
            <span>Change</span>
        </button>
        <label for="avatar-input">Profile Image Optional</label>
    </div>

    <div class="input-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="input-control">
    </div>
    <div class="input-group">
        <label for="email">E-Mail</label>
        <input type="email" name="email" id="email" class="input-control">
    </div>
    <div class="input-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="input-control">
    </div>
    <div class="input-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" name="confirm-password" id="confirm-password" class="input-control">
    </div>

    <div class="input-group">
        <button type="submit" class="btn long-btn primary-btn big-btn">Register</button>
    </div>
    <p class="center">
        <small>Already have an account? you can <a href="/login">Login</a></small>
    </p>
</form>