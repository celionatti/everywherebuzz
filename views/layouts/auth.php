<?php

/** @var $this \app\core\View */

use app\core\Application;

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" href="/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/css/admin-style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/public.css">
    <title>
        <?= $this->title ?>
    </title>
</head>

<body class="bg-pattern">
    <div class="default-page-container">
        <?php if (Application::$app->session->getFlash('success')): ?>
            <div class="message success" role="alert" style="z-index: 5000;">
                <ion-icon name="checkmark-circle" class="message-icon"></ion-icon>
                <span><?= Application::$app->session->getFlash('success'); ?></span>
            </div>
        <?php elseif(Application::$app->session->getFlash('error')): ?>
            <div class="message error" role="alert" style="z-index: 5000;">
                <ion-icon name="close-circle-outline" class="message-icon"></ion-icon>
                <span><?= Application::$app->session->getFlash('error'); ?></span>
            </div>
        <?php endif; ?>
        {{content}}
    </div>

    <!-- Jquery 3.6.3 -->
    <script src="/assets/js/jquery-3.6.3.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>