<?php


/** @var $this \app\core\View */

$this->title = "EverywhereBuzz | Topics";

?>

<?= $this->partials('header'); ?>

<!-- Page Banner -->
<section class="page-banner">
    <div class="banner-container">
        <div class="left-box">
            <div class="breadcrumbs" role="navigation">
                <small>
                    <a href="index.html">Home</a> >
                    <span>Life Lessons</span>
                </small>
            </div>
            <h1 class="banner-title">Life Lessons</h1>
            <div class="primary-font">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo, totam aliquid eveniet, architecto
                dolores aperiam libero reprehenderit repellendus quas dignissimos sequi deserunt doloremque! Nostrum
                aliquam laudantium omnis, obcaecati officia reprehenderit.
            </div>
        </div>
    </div>
</section>
<!-- Page Container -->
<div class="default-page-container page-container single-page">
    <!-- Main Content -->
    <div class="main-content">
        <article class="post-card flat-card">
            <div class="image-wrapper bg-image" style="background-image: url(/assets/images/featured_images/1.jpg);">
            </div>
            <div class="post-info">

                <div class="topic-wrapper">
                    <span class="gray-1">5 min</span>
                </div>

                <div>
                    <h3 class="post-title">
                        <a href="#" class="td-none">
                            One Day We Will Be Happy And Free
                        </a>
                    </h3>
                </div>
                <div class="post-preview">
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus magnam voluptatem quod aut.
                    </p>
                </div>
                <div class="author-info">
                    <div class="author">
                        <img src="/assets/images/avatar/avatar.jpg" alt="" class="avatar">
                        <a href="#" class="gray-1 link">Celio Natti</a>
                    </div>
                    <a href="#" class="link">Read More
                        <ion-icon name="arrow-forward-outline" class="read-more-icon"></ion-icon>
                    </a>
                </div>
            </div>
        </article>
        <article class="post-card flat-card">
            <div class="image-wrapper bg-image" style="background-image: url(/assets/images/featured_images/1.jpg);">
            </div>
            <div class="post-info">

                <div class="topic-wrapper">
                    <span class="gray-1">5 min</span>
                </div>

                <div>
                    <h3 class="post-title">
                        <a href="#" class="td-none">
                            One Day We Will Be Happy And Free
                        </a>
                    </h3>
                </div>
                <div class="post-preview">
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus magnam voluptatem quod aut.
                    </p>
                </div>
                <div class="author-info">
                    <div class="author">
                        <img src="/assets/images/avatar/avatar.jpg" alt="" class="avatar">
                        <a href="#" class="gray-1 link">Celio Natti</a>
                    </div>
                    <a href="#" class="link">Read More
                        <ion-icon name="arrow-forward-outline" class="read-more-icon"></ion-icon>
                    </a>
                </div>
            </div>
        </article>
        <article class="post-card flat-card">
            <div class="image-wrapper bg-image" style="background-image: url(/assets/images/featured_images/1.jpg);">
            </div>
            <div class="post-info">

                <div class="topic-wrapper">
                    <span class="gray-1">5 min</span>
                </div>

                <div>
                    <h3 class="post-title">
                        <a href="#" class="td-none">
                            One Day We Will Be Happy And Free
                        </a>
                    </h3>
                </div>
                <div class="post-preview">
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Delectus magnam voluptatem quod aut.
                    </p>
                </div>
                <div class="author-info">
                    <div class="author">
                        <img src="/assets/images/avatar/avatar.jpg" alt="" class="avatar">
                        <a href="#" class="gray-1 link">Celio Natti</a>
                    </div>
                    <a href="#" class="link">Read More
                        <ion-icon name="arrow-forward-outline" class="read-more-icon"></ion-icon>
                    </a>
                </div>
            </div>
        </article>

        <button class="btn long-btn">Load More</button>
    </div>
    <!-- / Main Content -->
    <!-- SideBar -->
    <div class="sidebar">
        <div class="sidebar-section topics-section">
            <h2 class="title">topics</h2>
            <div class="topic-lists">
                <a href="#">Journals</a>
                <a href="#">Journals</a>
                <a href="#">Journals</a>
                <a href="#">Journals</a>
                <a href="#">Journals</a>
                <a href="#">Journals</a>
                <a href="#">Journals</a>
                <a href="#">Journals</a>
            </div>
        </div>
        <div class="sidebar-section">
            <img src="/assets/images/featured_images/8.jpg" alt="" class="tall-image">
        </div>
    </div>
    <!-- / SideBar -->
</div>
<!-- End of Page Container -->

<?= $this->partials('footer'); ?>