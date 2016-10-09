<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Myca - Design your own postcard</title>
    <link rel='shortcut icon' href='img/favicon.ico' type='image/x-icon' />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Catamaran:300,500" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/script.js"></script>

    <link rel="stylesheet" href="css/swiper.css">
    <script src="js/swiper.js"></script>

    <link rel="stylesheet" href="css/pushy.css">
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


    <header>
        <div class="left language menu-btn">
            <img class="imgSize20" src="img/australia_2x.png" alt="change language" />
        </div>
        <!-- TODO: change!-->
        <a href="index.php" class="center"><img class="logo center" src="img/logo_2x.png" alt="Myca Logo" /></a>
        <!--        <a href="#" class="right user"><img class="imgSize20" src="img/user.png" alt="user log in" /></a>-->
        <?php
        session_start();
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
                <button type="button" class="user userLogin right" data-toggle="modal" data-target="#login"></button>
                <?php
        }
        ?>


    </header>

    <div class="modal fade" id="login" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="login.php" method="post">
                        <div class="center">
                            <span><img src="img/username.png" /></span>
                            <input type="text" placeholder="username" name="name" />
                        </div>
                        <div class="center">
                            <span><img src="img/password.png" /></span>
                            <input type="password" placeholder="password" name="password" />
                        </div>
                        <div class="blank"> </div>
                        <input type="submit" name="signup" value="Sign up" />
                        <input type="submit" name="login" value="Log in" />
                    </form>


                </div>
            </div>
        </div>
    </div>

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

    <div class="block grey" id="timeline">
        <h1>Time line</h1>
        <!--        <h5>Click to turn over the postcard</h5>-->
        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <?PHP
            session_start();
            if($_SESSION['auth']){
                include('Connect.php');
                $id = $_SESSION['Username'];
                $postimg = "select post_URL, post_date, post_add from Img_info where U_id = (select Uid from User_info where UName = '$id') ";
                $postreslut=mysql_query($postimg);
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
                }else{
                ?>
                        <!-- Slides -->

                        <div class="swiper-slide">
                            <img class="imgSize280" src="img/timeline_placeholder_2x.jpg" alt="Your time line will be shown here after you are logged in" />
                        </div>
                        <!-- If we need navigation buttons -->


                        <?php
                    }                        
                ?>

            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <div class="blank"> </div>
    </div>


    <div class="block">
        <h1>Promotional content</h1>
        <h5><span class="important">optional</span> content</h5>
        <!-- Slider main container -->
        <div class="swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
                <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
                <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
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
                <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
                <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
                <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
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
                    <img src="img/placeholder.png" alt="The current picture" />
                    <div class="mask">
                        <a href="#" class="operation"></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="img/placeholder.png" alt="The current picture" />
                    <div class="mask">
                        <a href="#" class="operation"></a>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="img/placeholder.png" alt="The current picture" />
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

    <script src="js/pushy.js"></script>
    <script>
        $(document).ready(function () {
            $("#owl-example").owlCarousel({
                items: 3
            });
        });

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