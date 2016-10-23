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

    <!--mutilanguage-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        var arrLang = {
            'en': {
                'design': 'Design your own postcard',
                'both': 'for both front and back sides',
                'start': 'Start to design',
                'time_line': 'Time line',
                'all': 'All the postcards you have generated will be shown here after you are logged in',
                'memorable': 'Make your journey more memorable',
                'by_designing': 'by designing your own postcard',
                'first': 'Design your first postcard',
                '5_minutes': 'within only 5 minutes!',
                'popular': 'Popular works',
                'vote': 'Click to vote for them',
                'deco7180': '- a uq deco7180 project-',
                'designed-imple': 'designed and implemented by',
                'mytea': 'team mytea',
                'powered-by': 'powered by',
                'trove': 'trove'
            },
            'cn': {
                'design': '设计你的明信片',
                'both': '正面和反面',
                'start': '开始设计',
                'time_line': '时间记忆轴',
                'all': '当你登录后，你可以在这里浏览你所有的明信片',
                'memorable': '让你的旅行更加难忘',
                'by_designing': '设计你自己独一无二的明信片',
                'first': '设计你自己的明信片',
                '5_minutes': '只花5分钟！',
                'popular': '受欢迎的明信片',
                'vote': '点击为你喜欢的明信片投票',
                'deco7180': '- 一个昆士兰大学 deco7180 项目-',
                'designed-imple': '设计并发行由',
                'mytea': 'mytea 团队',
                'powered-by': '技术支持',
                'trove': 'trove'
            }
        };

        $(function () {
            $('.translate').click(function () {
                var lang = $(this).attr('id');

                $('.lang').each(function (index, element) {
                    $(this).text(arrLang[lang][$(this).attr('key')]);
                });
            });
        });
    </script>

</head>

<body>
    <!-- Pushy Menu -->
    <nav class="pushy pushy-left">
        <ul>
            <!-- Submenu -->
            <li class="pushy-link" class="translate" id="en"><a href="#">English</a></li>
            <li class="pushy-link" class="translate" id="cn"><a href="#">中文（简体）</a></li>
        </ul>
    </nav>
    <!-- Site Overlay -->
    <div class="site-overlay"></div>
    <!-- Login Modal-->
    <div class="remodal" data-remodal-id="LogInModal">
        <div>
            <button data-remodal-action="close" class="remodal-close"></button>
        </div>

        <div id="loginForm">
            <form action="login.php" method="post" id="login">
                <h5>You can sign up or log in with the same form</h5>
                <div class="blank"></div>
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
                    <input type="text" name="URL" />
                    <button class="share textWhite" type="submit" name="signup">Sign up</button>
                    <button class="save textGrey" type="submit" name="login">Log in</button>

                </div>
            </form>
        </div>
    </div>
    <!-- Edit Modal-->
    <div class="remodal" data-remodal-id="EditModal">
        <div>
            <button data-remodal-action="close" class="remodal-close"></button>
        </div>

        <div>
            <form action="" method="post" id="edit">
                <div class="buttonHeight">
                    <button class="share textWhite" type="submit" name="Edit">Edit</button>
                    <button class="save textGrey" type="submit" name="View postcard">View postcard</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Vote Modal-->
    <div class="remodal" data-remodal-id="VoteModal">
        <div>
            <button data-remodal-action="close" class="remodal-close"></button>
        </div>
        <h1><span class="important">123</span> users like it!</h1>
        <h5>It seems that you are attracted. Be the next one to like it!</h5>
        <div class="blank"></div>
        <div>
            <form action="" method="post" id="vite">
                <div class="buttonHeight">
                    <button class="share textWhite" type="submit" name="signup">Like!</button>
                    <button class="save textGrey" type="submit" name="login">View postcard</button>
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
                    <script>
                        var inst = $('[data-remodal-id=LogInModal]').remodal();
                        inst.destroy();
                    </script>

                    <ul class="right user">
                        <li>
                            <img class="imgSize20" src="img/user_2x.png" alt="user log in" />
                            <ul>

                                <!--
                                <li>
    <?php
                        echo $_SESSION['Username'];
                        ?>
</li>
-->

                                <!--
                                <form action="logout.php" method="post">
    <a onclick="form.submit()">
        <li>Log out</li>
    </a>
</form>
-->
                                <li>
                                    <form action="logout.php" method="post">
                                        <input type="submit" name="logout" value="Log out" />
                                    </form>
                                </li>

                            </ul>
                        </li>
                    </ul>
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
            <h1 class="lang" key="design">Design your own postcard</h1>
            <h5 class="lang" key="both">for both <span class="important"><strong>front</strong></span> and <span class="important">back</span> sides</h5>
            <!-- Slider main container -->
            <div class="swiper-container" id="preview">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide"><img class="imgSize280" src="img/promo_1_2x.jpg" alt="An example of the front side of the postcard generated" /></div>
                    <div class="swiper-slide"><img class="imgSize280" src="img/promo_2_2x.jpg" alt="An example of the back side of the postcard generated" /></div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination" id="frontandbackshow"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>

            <a href="design.php">
                <div class="button textWhite" class="lang" key="start">Start to design</div>
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
                    <h1 class="lang" key="time_line">Time line</h1>
                    <!--        <h5>Click to turn over the postcard</h5>-->
                    <h5 class="lang" key="all">All the postcards you have generated will be shown here after you are <span class="important">logged in</span></h5>
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
                        <h1 class="lang" key="memorable">Make your journey more memorable</h1>
                        <h5 class="lang" key="by_designing">by designing your own postcard</h5>
                        <!-- Slider main container -->
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide"><img class="imgSize280" src="img/promo1_2x.jpg" alt="Design a marvelous postcard " /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/promo2_2x.jpg" alt="share postcards with family and friends " /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/promo3_2x.jpg" alt="View your timeline to remember your trips" /></div>
                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>
                        <div class="blank"> </div>
                        <a href="design.php">
                            <div class="button textWhite" class="lang" key="start">Start to design</div>
                        </a>
                    </div>

                    <div class="block grey">
                        <h1 class="lang" key="first">Design your first postcard</h1>
                        <h5 class="lang" key="5_minutes">within only 5 minutes!</h5>
                        <!-- Slider main container -->
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide"><img class="imgSize280" src="img/instructions1_2x.jpg" alt="choose and confirm your location" /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/instructions2_2x.jpg" alt="select one picture for the front side" /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/instructions3_2x.jpg" alt="select another picture as a stamp" /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/instructions4_2x.jpg" alt="type in your greetings" /></div>
                                <div class="swiper-slide"><img class="imgSize280" src="img/instructions5_2x.jpg" alt="share to social network or save to album" /></div>
                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>
                        <div class="blank"></div>
                        <a href="design.php">
                            <div class="button textWhite">Start to design</div>
                        </a>
                    </div>

                    <div class="block" id="popular">
                        <h1 class="lang" key="popular">Popular works</h1>
                        <h5><span class="important" class="lang" key="vote">Click to vote</span> for them</h5>
                        <!-- Slider main container -->
                        <div class="swiper-container votable">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper maskEffect view">
                                <!-- Slides -->
                                <div class="swiper-slide">
                                    <img class="imgSize280" src="img/placeholder.png" alt="The current picture" />
                                    <!-- <div class="mask">
                            <a href="#" class="operation"></a>
                        </div> -->
                                </div>
                                <div class="swiper-slide">
                                    <img class="imgSize280" src="img/placeholder.png" alt="The current picture" />
                                    <!-- <div class="mask">
                            <a href="#" class="operation"></a>
                        </div> -->
                                </div>
                                <div class="swiper-slide">
                                    <img class="imgSize280" src="img/placeholder.png" alt="The current picture" />
                                    <!-- <div class="mask">
                            <a href="#" class="operation"></a>
                        </div> -->
                                </div>
                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>


                    </div>

                    <footer>
                        <p class="lang" key="deco7180">- a uq deco7180 project -</p>
                        <p class="lang" key="designed-imple">designed and implemented by</p>
                        <p class="lang" key="mytea">team mytea</p>
                        <p class="lang" key="powered-by">powered by</p>
                        <p class="lang" key="trove">trove</p>
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