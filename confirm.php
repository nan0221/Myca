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

    <div class="remodal-bg">
        <header>
            <div class="left language menu-btn">
                <img class="imgSize20" src="img/australia_2x.png" alt="change language" />
            </div>
            <!-- TODO: change!-->
            <a href="index.php" class="center"><img class="logo center" src="img/logo_2x.png" alt="Myca Logo" /></a>
            <!--        <a href="#" class="right user"><img class="imgSize20" src="img/user.png" alt="user log in" /></a>-->
            <?php
            header("Access-Control-Allow-Origin: *");
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

        <div class="block" id="prerenderbeforeconfirm">
            <?php
            session_start();
            ?>
                <h1 class="lang" key="laststep">One last step!</h1>
                <h5 class="lang" key="renderconfirm">Render it and <span class="important">confirm at the bottom</span></h5>
                <form action="save.php" method="post" name="confirm">
                    <div class="blank"></div>
                    <button class="button center textWhite" id="prerender" class="lang" key="render">Render</button>
                    <div class="blank"></div>
                    <h5 class="lang" key="front">Front</h5>
                    <!--                        <img class="showSize center" id="frontShow" src="<?php echo $img ?>" />-->
                    <canvas id="canvas1" class="center"></canvas>
                    <div class="blank"></div>
                    <h5 class="lang" key="Back">Back</h5>
                    <!--                        <img class="showSize center" id="backShow" src="<?php echo $imgb ?>" />-->
                    <canvas id="canvas2" class="center"></canvas>
                    <div class="blank"></div>
                    <img id="bg1" src="img/bg1.jpg" alt="bg1" width="0" height="0" />
                    <img id="bg2" src="img/bg2(free).jpg" alt="bg2" width="0" height="0" />
                    <input type="text" id="towhom_check" name="towhom_check" value='<?php echo "{$_SESSION["to"]}"; ?>' />
                    <input type="text" id="fromwhom_check" name="fromwhom_check" value='<?php echo "{$_SESSION["from"]}"; ?>' />
                    <textarea id="greeting_check" name="greeting_check">
                        <?php echo "{$_SESSION["Greeting"]}"; ?>
                    </textarea>
                    <input name="address" type="text" value='<?php echo "{$_SESSION["post_add"]}"; ?>' />
                    <input name="firstimg" type="text" value='<?php echo "{$_SESSION["img_URL"]}"; ?>' />
                    <input name="secondimg" type="text" value='<?php echo "{$_SESSION["stamp_URL"]}"; ?>' />
                    <textarea name="frontimgdata" type="text"></textarea>
                    <textarea name="backimgdata" type="text"></textarea>

                    <button class="button center textWhite" id="finishrender" class="lang" key="want">That's what I want</button>
                    <button class="button center textWhite" name="confirm" type="submit" class="lang" key="save">Save</button>
                </form>
        </div>
        <div class="blank"></div>
    </div>


    <script src="js/pushy.js"></script>
    <script src="js/remodal.js"></script>
    <script type="text/javascript">
    </script>
    <!--mutilanguage-->
    <script type="text/javascript">
        var arrLang = {
            'en': {
                'laststep': 'One last step',
                'renderconfirm': 'Render it and confirm at the bottom',
                'render': 'Render',
                'front': 'Front',
                'back': 'Back',
                'want': "That's what I want",
                'save': 'Save'
            },
            'cn': {
                'laststep': '离成功只着一步！',
                'renderconfirm': '执行并在底部确认',
                'render': '执行',
                'front': '正面',
                'back': '反面',
                'want': '这就是我想要的！',
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