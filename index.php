<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Myca - Design your own postcard</title>
    <link rel='shortcut icon' href='img/favicon.ico' type='image/x-icon' />

    <link href="https://fonts.googleapis.com/css?family=Catamaran:300,500" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/script.js"></script>

    <link rel="stylesheet" href="css/swiper.css" />
    <script src="js/swiper.js"></script>

    <link rel="stylesheet" href="css/pushy.css" />

    <link rel="stylesheet" href="css/remodal.css" />
    <link rel="stylesheet" href="css/remodal-default-theme.css" />
</head>

<body>
    <!-- Pushy Menu -->
    <nav class="pushy pushy-left">
        <ul>
            <!-- Submenu -->
            <li class="pushy-link"><a href="#">English</a></li>
            <li class="pushy-link"><a href="#">中文（简体）</a></li>
        </ul>
    </nav>
    <!-- Site Overlay -->
    <div class="site-overlay"></div>
    <!-- Login Modal-->
    <div class="remodal" data-remodal-id="LogInModal" id="logInModal">
        <div>
            <button data-remodal-action="close" class="remodal-close"></button>
        </div>

        <div id="loginForm">
            <form action="login.php" method="post" id="login">
                <div class="center">
                    <label for="username"><img class="imgSize24" src="img/username_2x.png" /></label>
                    <input id="username" type="text" placeholder=" username" name="name" />
                </div>
                <div class="center">
                    <label for="password"><img class="imgSize24" src="img/password_2x.png" /></label>
                    <input id="password" type="password" placeholder=" password" name="password" />
                </div>
                <div class="blank"> </div>
                <div class="buttonHeight">
                    <input class="share textWhite" type="submit" name="signup" value="Sign up" />
                    <input class="save textGrey" type="submit" name="login" value="Log in" />
                </div>
            </form>
        </div>

    </div>

    <div class="remodal-bg">

        <header>
            <div class="left language menu-btn">
                <img class="imgSize20" src="img/australia_2x.png" alt="change language" />
            </div>
            <!-- TODO: change!-->
            <a href="index.php" class="center"><img class="logo center" src="img/logo_2x.png" alt="Myca Logo" /></a>
            <!--        <a href="#" class="right user"><img class="imgSize20" src="img/user.png" alt="user log in" /></a>-->
            <?php
                session_start();
            ?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <script src="js/remodal.js"></script>
                <?php
                if($_SESSION['auth']){
                ?>
                    <div>
                        <!--修改这个div改变欢迎词和logout的排版-->
                        <form action="logout.php" method="post">
                            <span>Welcome</span>
                            <?php
                        echo $_SESSION['Username'];
                        ?>
                                <br/>
                                <input type="submit" name="logout" value="Log out" />
                        </form>
                    </div>
                    <?php
                }else{
                ?>

                        <ul class="right user">
                            <li>
                                <img class="imgSize20" src="img/user_2x.png" alt="user log in" />
                                <ul>
                                    <a data-remodal-target="LogInModal">
                                        <li>Log in</li>
                                    </a>
                                </ul>
                            </li>
                        </ul>

                        <?php
        }
        ?>


        </header>

        <div class="block">
            <h1>Design your own postcard</h1>
            <h5>for both <span class="important"><strong>front</strong></span> and <span class="important">back</span> sides</h5>
            <!-- Slider main container -->
            <div class="swiper-container" id="preview">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide"><img class="imgSize280" src="img/promo_1_2x.jpg" alt="An example of the front side of the postcard generated" /></div>
                    <div class="swiper-slide"><img class="imgSize280" src="img/promo_2_2x.jpg" alt="An example of the back side of the postcard generated" /></div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>

            <a href="design.html">
                <div class="button textWhite">Start to design</div>
            </a>
        </div>

        <?PHP
            session_start();
            if($_SESSION['auth']){
                include('Connect.php');
                $id = $_SESSION['Username'];
                $postimg = "select post_URL, post_date, post_add from Img_info where U_id = (select Uid from User_info where UName = '$id') ";
                $postreslut=mysql_query($postimg);
                ?>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="js/swiper.js"></script>
            <link rel="stylesheet" href="css/swiper.css" />
            <div class="block grey" id="timeline">
                <h1>Time line</h1>
                <!--        <h5>Click to turn over the postcard</h5>-->

                <!-- Slider main container -->
                <div class="swiper-container">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">

                        <?PHP
                while($row = mysql_fetch_assoc($postreslut)){
            ?>
                            <!-- Slides -->
                            <div class="swiper-slide" id="timeline-slide">
                                <div class="timeline-line">
                                    <h5><?php echo $row[post_date];?> <span class="important"><?php echo $row[post_add];?></span></h5>
                                </div>
                                <img class="imgSize280" src="<?php echo $row[post_URL];?>" />
                            </div>

                            <?php
                    }
                ?>
                    </div>
                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
                <div class="blank"> </div>
            </div>
            <?php
                }else{
                ?>
                <div class="block grey">
                    <h1>Time line</h1>
                    <!--        <h5>Click to turn over the postcard</h5>-->
                    <h5>All the postcards you have generated will be shown here after you are <span class="important">logged in</span></h5>
                    <!-- Slider main container -->
                    <div class="swiper-container" id="notLoggedIn">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="swiper-slide">
                                <img class="imgSize280" src="img/timeline_placeholder_2x.jpg" alt="Your time line will be shown here after you are logged in" />
                            </div>
                        </div>
                    </div>


                </div>
                <?php
        }
        ?>


                    <div class="block">
                        <h1>Promotional content</h1>
                        <h5><span class="important">optional</span> content</h5>
                        <!-- Slider main container -->
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide"><img class="imgSize280" src="img/placeholder.png" alt="The current picture" /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/placeholder.png" alt="The current picture" /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/placeholder.png" alt="The current picture" /></div>
                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>
                        <div class="blank"> </div>
                        <a href="design.html">
                            <div class="button textWhite">Start to design</div>
                        </a>
                    </div>

                    <div class="block grey">
                        <h1>Promotional content</h1>
                        <h5><span class="important">optional</span> content</h5>
                        <!-- Slider main container -->
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide"><img class="imgSize280" src="img/placeholder.png" alt="The current picture" /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/placeholder.png" alt="The current picture" /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/placeholder.png" alt="The current picture" /></div>
                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>
                        <div class="blank"></div>
                        <a href="design.html">
                            <div class="button textWhite">Start to design</div>
                        </a>
                    </div>

                    <div class="block" id="popular">
                        <h1>Popular works</h1>
                        <h5><span class="important">Click to vote</span> for them</h5>
                        <!-- Slider main container -->
                        <div class="swiper-container votable">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper maskEffect view">
                                <!-- Slides -->
                                <div class="swiper-slide">
                                    <img class="imgSize280" src="img/placeholder.png" alt="The current picture" />
                                    <div class="mask">
                                        <a href="#" class="operation"></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img class="imgSize280" src="img/placeholder.png" alt="The current picture" />
                                    <div class="mask">
                                        <a href="#" class="operation"></a>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <img class="imgSize280" src="img/placeholder.png" alt="The current picture" />
                                    <div class="mask">
                                        <a href="#" class="operation"></a>
                                    </div>
                                </div>
                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>


                    </div>

                    <footer>
                        <p>- a uq deco7180 project -</p>
                        <p>designed and implemented by</p>
                        <p>team mytea</p>
                        <p>powered by</p>
                        <p>trove</p>
                    </footer>
    </div>
    <script src="js/pushy.js"></script>
    <script src="js/remodal.js"></script>
    <script>
        $(".swiper-container").each(function (index, element) {
            var $this = $(this);
            var swiper = new Swiper(this, {
                pagination: $this.find(".swiper-pagination")[0],
                slidesPerView: 'auto',
                centeredSlides: true,
                paginationClickable: true,
                spaceBetween: 30,
                loop: false,
                // Navigation arrows
                // nextButton: '.swiper-button-next', // prevButton: '.swiper-button-prev',
                nextButton: $this.find(".swiper-button-next")[0],
                prevButton: $this.find(".swiper-button-prev")[0]
            });
        });
    </script>

</body>

</html>