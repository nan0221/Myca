<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Myca - Design your own postcard</title>
    <link rel='shortcut icon' href='img/favicon.ico' type='image/x-icon' />
    <!--    use a font called Catamaran from google fonts-->
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
    <!-- Pushy Menu for language switch-->
    <nav class="pushy pushy-left">
        <ul>
            <!-- Submenu -->
            <li class="pushy-link"><a href="#" class="translate" id="en">English</a></li>
            <li class="pushy-link"><a href="#" class="translate" id="cn">中文（简体）</a></li>
        </ul>
    </nav>

    <!-- Site Overlay for modals -->
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
                <?php
                session_start();
                include('Connect.php');
                $imgfront=$_SESSION['imgfront'];
                $findpid = "SELECT post_id FROM Img_info WHERE post_URL='$imgfront'";
                $findpidres=mysql_query($findpid);
                $ids = mysql_fetch_assoc($findpidres);
                $id = $ids[post_id];
                ?>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=http://deco1800-pg2.uqcloud.net/show.php?id=<?PHP echo $id;?>" target="_blank">
                        <img src="img/facebook.png" class="socialMedia" alt="Share to Facebook " /></a>
            </div>
            <!--Reference: https://developers.facebook.com/docs/plugins/share-button -->
            <!-- <div class="socialMedia"><img src="img/instagram.png" alt="Share to Instagram" /></div> -->
            <div class="socialMedia">
                <a href="https://plus.google.com/share?url=http://deco1800-pg2.uqcloud.net/show.php?id=<?PHP echo $id;?>">
                    <img src="img/googleplus.png" class="socialMedia" alt="Share to Google Plus" /></a>
            </div>
            <!--Reference: https://developers.google.com/+/web/share/ -->
            <div class="socialMedia">
                <a href="https://twitter.com/intent/tweet?text=Come to see my customized postcard:) http://deco1800-pg2.uqcloud.net/show.php?id=<?PHP echo $id;?>">
                    <img src="img/twitter.png" class="socialMedia" alt="Share to Twitter" /></a>
            </div>
            <!--Reference: https://dev.twitter.com/web/tweet-button -->
        </div>
    </div>
    <!-- Save Modal-->
    <div class="remodal" data-remodal-id="SaveModal">
        <div>
            <button data-remodal-action="close" class="remodal-close"></button>
        </div>

        <div>
            <?PHP
                session_start();
                if($_SESSION['auth']){
                ?>
                <div>
                    <h1 id='save_font'> Your postcard has already been saved in your timeline </h1></div>
                <?php
                }
                else{
                ?>
                    <div>
                        <h1 id='save_font'> Sign up or Login to save your postcard in your timeline </h1></div>
                    <?php
                }
                ?>
        </div>
    </div>


    <div class="remodal-bg">

        <header>
            <div class="left language menu-btn">
                <img class="imgSize20" src="img/australia_2x.png" alt="change language" />
            </div>
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

        <!--        show the result to the user-->
        <div class="block" id="results">
            <h1 class="lang" key="congrats">Congrats, 
            <?php
            session_start();
            if($_SESSION['auth']){
                echo $_SESSION['Username'];
            }
            else{
                echo "explorer";
            }
            ?>!</h1>
            <h1 class="lang" key="finished">You've finished a masterpiece!</h1>
            <h5 class="lang" key="nowshare">Now share it with your friends!</h5>
            <!-- Slider main container -->
            <div class="swiper-container" id="preview">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php
                    session_start();
                    include('Connect.php');
                    $imgfront=$_SESSION['imgfront'];
                    $imgback=$_SESSION['imfback'];
                    $uname=$_SESSION['Username'];
                    if($_SESSION['auth']){
                        $update = "UPDATE Img_info SET U_id =(SELECT Uid FROM User_info WHERE UName='$uname') WHERE post_URL='$imgfront'";
                        mysql_query($update);
                    }
                    ?>
                        <div class="swiper-slide">
                            <img class="imgSize280" src="<?php echo $imgfront;?>" />
                        </div>
                        <div class="swiper-slide">
                            <img class="imgSize280" src="<?php echo $imgback; ?>" />
                        </div>
                </div>
                <!-- need pagination -->
                <div class="swiper-pagination"></div>

                <!-- need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>
            <div class="blank"> </div>
            <div class="buttonHeight">
                <!-- Share buttons -->
                <a class="share textWhite" data-remodal-target="ShareModal" class="lang" key="share">Share</a>
                <!-- Save buttons -->
                <a class="save textGrey" data-remodal-target="SaveModal" class="lang" key="save">Save</a>
            </div>
        </div>
    </div>


    <script src="js/pushy.js"></script>
    <script src="js/remodal.js"></script>
    <script>
        //        create swiper instances for images 
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

    <!--Here starts to build muli-language translation -->
    <!-- Add language dictionary with English and Chinese(Simple)-->
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

        //        Function to achieve lanague swith between English and Simple Chinese(Simple)-->
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