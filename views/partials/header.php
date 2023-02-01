<?php ?>

<header>
        <div class="nav-overlay"></div>
        <span role="button" class="menu-icon">
            <ion-icon name="menu-outline"></ion-icon>
        </span>
        <a href="#" class="logo-wrapper td-none">
            <div><span>E</span>BUZZ</div>
        </a>

        <nav>
            <div class="search-item">
                <span class="search-icon" role="button">
                    <ion-icon name="search-outline"></ion-icon>
                </span>
                <form action="index.html" method="post" class="header-search-form hide">
                    <input type="search" name="search-term" placeholder="Search..."
                        class="input-control input-control-sm search-input">
                </form>
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="#">All Posts</a></li>
                <li class="nav-item"><a href="#">Life Lessons</a></li>
                <li class="nav-item"><a href="#">Journals</a></li>
                <li class="nav-item">
                    <a href="#">Best Articles <ion-icon name="chevron-down-outline" class="nav-icon"></ion-icon></a>
                    <ul class="dropdown">
                        <li><a href="#">Best of 2022</a></li>
                        <li><a href="#">Best of 2021</a></li>
                        <li><a href="#">Best of 2020</a></li>
                        <li><a href="#">Best of 2019</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="#">Register</a></li>
                <li class="nav-item"><a href="#">Login</a></li>
                <!-- <li class="nav-item">
                    <a href="#">
                        <ion-icon name="person-circle-outline" class="nav-icon"></ion-icon>
                         Celio Natti 
                         <ion-icon name="chevron-down-outline" class="nav-icon"></ion-icon>
                        </a>
                    <ul class="dropdown">
                        <li><a href="#">Dashboard</a></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </li> -->
            </ul>
        </nav>
    </header>