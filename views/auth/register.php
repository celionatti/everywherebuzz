<?php


/** @var $this \app\core\View */

use app\core\forms\Form;

$this->title = "EverywhereBuzz | Create an Account";

?>

<form action="" method="post" class="admin-form auth-form">
    <?= Form::csrfField(); ?>
    <h1 class="center form-title">Sign Up</h1>

    <div class="input-group">
        <label for="surname">Surname</label>
        <input type="text" name="surname" id="surname" class="input-control">
    </div>
    <div class="input-group">
        <label for="lastname">LastName</label>
        <input type="text" name="lastname" id="lastname" class="input-control">
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
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" id="confirmPassword" class="input-control">
    </div>

    <div class="input-group">
        <button type="submit" class="btn long-btn primary-btn big-btn">Register</button>
    </div>
    <p class="center">
        <small>Already have an account? you can <a href="/login">Login</a></small>
    </p>
</form>