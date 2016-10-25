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
    <script type="text/javascript">
        var arrLang = {};

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
            <li class="pushy-link"><a href="#" class="translate" id="en">English</a></li>
            <li class="pushy-link"><a href="#" class="translate" id="cn">中文（简体）</a></li>
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
    <!-- Share Modal-->
    <div class="remodal" data-remodal-id="ShareModal">
        <div>
            <button data-remodal-action="close" class="remodal-close"></button>
        </div>

        <div class="shareModal">
            <!--Share link to facebook, twitter and google plus-->
            <div class="socialMedia">
                <a href="https://www.facebook.com/sharer/sharer.php?u=http://deco1800-pg2.uqcloud.net/design.html" target="_blank">
                    <img src="img/facebook.png" alt="Share to Facebook " /></a>
            </div>
            <!--Reference: https://developers.facebook.com/docs/plugins/share-button -->
            <!-- <div class="socialMedia"><img src="img/instagram.png" alt="Share to Instagram" /></div> -->
            <div class="socialMedia">
                <a href="https://plus.google.com/share?url=http://deco1800-pg2.uqcloud.net/">
                    <img src="img/googleplus.png" alt="Share to Google Plus" /></a>
            </div>
            <!--Reference: https://developers.google.com/+/web/share/ -->
            <div class="socialMedia">
                <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=Come to see my customized postcard:) http://deco1800-pg2.uqcloud.net/design.html">
                    <img src="img/twitter.png" alt="Share to Twitter" /></a>
            </div>
            <!--Reference: https://dev.twitter.com/web/tweet-button -->
        </div>
    </div>
    <!-- Save Modal-->
    <div class="remodal" data-remodal-id="SaveModal">
        <div>
            <button data-remodal-action="close" class="remodal-close"></button>
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
            <form action="vote.php" method="post" id="vote">
                <div class="buttonHeight">
                    <input name="voteimgid" type="text" />
                    <button class="share textWhite" type="submit" name="vote">Like!</button>
                    <button class="save textGrey" type="submit" name="view">View postcard</button>
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
                            <img class="imgSize20" src="img/loginsuccess.png" alt="user log out" />
                            <ul>

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

        <div class="block" id="show">
            <?php
            include('Connect.php');
            $postid=$_GET['id'];
            $getusername = "SELECT UName FROM User_info WHERE Uid = (SELECT U_id FROM Img_info WHERE post_id='$postid')";
            $unameres = mysql_query($getusername);
            $unames = mysql_fetch_assoc($unameres);
            $name = $unames[UName];
            ?>
                <h1 class="lang">Here is a postcard designed by <span class="important"><?PHP echo $name;?></span></h1>
                <!-- Slider main container -->
                <?php
            $getimg = "SELECT post_URL, postb_URL FROM Img_info WHERE post_id='$postid'";
            $getimgres = mysql_query($getimg);
            $imgs = mysql_fetch_assoc($getimgres);
            $img = $imgs[post_URL];
            $imgb =$imgs[postb_URL];
            ?>
                    <div class="blank"></div>
                    <h5>Front</h5>
                    <img class="showSize center" id="frontShow" src="<?php echo $img ?>" />
                    <div class="blank"></div>
                    <h5>Back</h5>
                    <img class="showSize center" id="backShow" src="<?php echo $imgb ?>" />
                    <div class="blank"></div>
                    <div class="buttonHeight">
                        <a class="share textWhite" data-remodal-target="ShareModal" class="lang" key="share">Share</a>
                        <a class="save textGrey" data-remodal-target="SaveModal" class="lang" key="save">Save</a>
                    </div>
        </div>
        <div class="blank"></div>
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

    <!--mutilanguage-->
    <script type="text/javascript">
        var arrLang = {
            'en': {
                'congrats': 'Congrats,',
                'finished': "You've finished a masterpiece!",
                'nowshare': 'Now share it with your friends!',
                'share': 'Share',
                'save': 'Save'
            },
            'cn': {
                'congrats': '恭喜，',
                'finished': "你已经完成一张明信片！",
                'nowshare': '现在和朋友分享你的明信片吧！',
                'share': '分享',
                'save': '保存'
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

</body>

</html>