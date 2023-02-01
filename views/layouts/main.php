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
    <link rel="stylesheet" type="text/css" href="/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/admin-style.css">
    <link rel="stylesheet" type="text/css" href="/assets/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/public.css">
    <title><?= $this->title ?></title>
</head>

<body>
    
    {{content}}

    <!-- Jquery 3.6.1 -->
    <script src="/assets/js/jquery-3.6.3.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/slick/slick.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        // Toggle Search input
        const mobileBreakPoint = 754;
        const searchIcon = document.querySelector('.search-icon');
        const headerSearchForm = document.querySelector('.header-search-form');
        const searchInput = document.querySelector('.search-input');
        const logoWrapper = document.querySelector('.logo-wrapper');

        function toggleSearchBar() {
            searchIcon.classList.toggle('hide');
            headerSearchForm.classList.toggle('hide');
            searchInput.focus();
            if (window.innerWidth == mobileBreakPoint) {
                logoWrapper.classList.toggle('hide');
            }
        }
        searchIcon.addEventListener('click', toggleSearchBar);
        searchInput.addEventListener('blur', toggleSearchBar);

        // Navbar Responsiveness
        const menuIcon = document.querySelector('.menu-icon');
        const navOverlay = document.querySelector('.nav-overlay');
        const navMenu = document.querySelector('.nav-menu');
        const dropdowns = document.querySelectorAll('.nav-item .dropdown');

        menuIcon.addEventListener('click', function () {
            navOverlay.classList.toggle('open');
            navMenu.classList.toggle('open');
        });

        navOverlay.addEventListener('click', function () {
            navOverlay.classList.remove('open');
            navMenu.classList.remove('open');
        });

        // Dropdown Section
        dropdowns.forEach(dropdown => {
            const navItem = dropdown.closest('.nav-item');
            navItem.addEventListener('click', function () {
                navItem.classList.toggle('active');
            })
        })

        // Slick Carousel
        $('.post-slider').each(function (index, slider) {
            $(slider).slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: false,
                infinite: false,
                autoplaySpeed: 2000,
                nextArrow: $(slider).siblings('.next-arrow'),
                prevArrow: $(slider).siblings('.prev-arrow'),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 550,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>