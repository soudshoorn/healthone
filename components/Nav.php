<?php session_start(); ?>

<nav>
    <div class="container">
        <div class="row">
            <div class="nav__wrapper">
                <div class="nav__wrapper--left">
                    <figure class="nav__title--wrapper">
                        <a href="/healthone/index.php"><h1 class="nav__title">HEALTH<span>ONE</span></h1></a>
                    </figure>
                    <ul class="nav__link--list">
                        <li class="nav__link">
                            <a href="/healthone/index.php" class="
                            nav__link--anchor 
                            link__hover-effect 
                            ">Home</a>
                        </li>
                        <li class="nav__link">
                            <a href="/healthone/products/categories.php" class="
                            nav__link--anchor 
                            link__hover-effect 
                            ">Apparaten</a>
                        </li>
                        <li class="nav__link">
                            <a href="/healthone/contact.php" class="
                            nav__link--anchor 
                            link__hover-effect 
                            ">Contact</a>
                        </li>
                    </ul>
                </div>
                <?php 
                    if(isset($_SESSION['admin'])) {
                        echo "
                        <div class='nav__wrapper--right'>
                            <a href='/healthone/login/logout.php' class='nav__button'><i class='fas fa-sign-out-alt'></i></i>Uitloggen</a>
                            <a href='/healthone/admin/admin.php' class='nav__button'>Admin</a>
                            <a href='/healthone/profile.php?user=".$_SESSION['user']."' class='nav__button'><i class='fas fa-user-circle nav__button--profile'></i></a>
                        </div>";
                    } else if(isset($_SESSION['user'])) { 
                        echo "
                        <div class='nav__wrapper--right'>
                            <a href='/healthone/login/logout.php' class='nav__button'><i class='fas fa-sign-out-alt'></i></i>Uitloggen</a>
                            <a href='/healthone/profile.php?user=".$_SESSION['user']."' class='nav__button'><i class='fas fa-user-circle nav__button--profile'></i></a>
                        </div>";
                    } else {
                        echo "
                        <div class='nav__wrapper--right'>
                            <a href='/healthone/login/login.php' class='nav__button'><i class='far fa-user-circle'></i>Inloggen</a>
                            <a href='/healthone/login/register.php' class='btn'>Registreren</a>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </div>
</nav>