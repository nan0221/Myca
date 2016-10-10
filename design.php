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
                    <div class="half right">
                        <input class="share textWhite" type="submit" name="signup" value="Sign up" />
                        <input class="save textGrey" type="submit" name="login" value="Log in" />
                    </div>
                    <div class="half left">
                    </div>
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


        <div class="block" id="result">
            <h1>Preview</h1>
            <h5>Swipe to switch between <span class="important"><strong>front</strong></span> and <span class="important">back</span> sides</h5>
            <!-- Slider main container -->
            <div class="swiper-container" id="preview">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <img id="stamp" src="img/stamp.jpg" alt="The Scream" width="0" height="0">
                    <img id="front" src="img/front.jpg" alt="Front" width="0" height="0">
                    <img id="bg1" src="img/bg1.jpg" alt="bg1" width="0" height="0">
                    <img id="bg2" src="img/bg2.jpg" alt="bg2" width="0" height="0">
                    <img id="water-mark" src="img/stamp (2).jpg" alt="water-mark" width="0" height="0">
                    <div class="swiper-slide">
                        <canvas class=".imgSize280" id="myCanvas1" width="224" height="150" style="border:1px solid #000000;"></canvas>
                    </div>
                    <div class="swiper-slide">
                        <canvas class=".imgSize280" id="myCanvas2" width="224" height="150" style="border:1px solid #000000;"></canvas>
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>
        </div>

        <div class="notification" id="notification">
            <p>Your postcard is in the landscape layout.</p>
        </div>
        <div class="block dropdown" id="taskList">
            <div class="list">
                <span class="listItem left">1. Choose landscape or portrait layout</span>
                <span class="goto right"><img class="center imgSize11" src="img/checked_2x.png" alt="checked"></span></div>
            <div class="list">
                <span class="listItem left">2. Confirm your location</span>
                <span class="goto right"><img class="center imgSize11" src="img/goto_2x.png" alt="go to"></span></div>
            <div class="list">
                <span class="listItem left">3. Choose a picture for the front side of the postcard</span>
                <span class="goto right"><img class="center imgSize11" src="img/goto_2x.png" alt="go to"></span></div>
            <div class="list">
                <span class="listItem left">4. Choose a picture for the postage stamp</span>
                <span class="goto right"><img class="center imgSize11" src="img/goto_2x.png" alt="go to"></span></div>
            <div class="list">
                <span class="listItem left">5. Choose a short piece of history for the text on the back</span>
                <span class="goto right"><img class="center imgSize11" src="img/goto_2x.png" alt="go to"></span></div>
            <div class="list">
                <span class="listItem left">6. Type in your greeting</span>
                <span class="goto right"><img class="center imgSize11" src="img/goto_2x.png" alt="go to"></span></div>
            <div class="blank"></div>
        </div>

        <div class="step" id="step1Instruction">
            <span class="left"><h4>Please choose the layout</h4></span>
            <span class="right arrowdown"><img class="leftImg imgSize12" src="img/arrowdown_2x.png" /></span>
            <span class="right arrowup"><img class="imgSize12" src="img/arrowup_2x.png" /></span>
        </div>

        <div class="block grey" id="step1Content">
            <div class="chooseLayout">
                <div class="layoutLeft">
                    <img class="selected" src="img/landscape.png" alt="landscape layout" />
                    <p>Landscape</p>
                </div>
                <div class="layoutRight">
                    <img src="img/portrait.png" alt="portrait layout" />
                    <p>Portrait</p>
                </div>
                <div class="blank"></div>
                <div class="button textWhite">Okay</div>
            </div>
        </div>

        <!-- Google map -->
        <!-- Get users current location -->
        <div class="step" id="step2Instruction">
            <span class="left"><h4>Please confirm your current location</h4></span>
            <span class="right arrowdown"><img class="leftImg imgSize12" src="img/arrowdown_2x.png" /></span>
            <span class="right arrowup"><img class="imgSize12" src="img/arrowup_2x.png" /></span>
        </div>
        <div class="block grey " id="step2Content">
            <!--        TO CHANGE: Information shown on screen when geolocation is n/a-->
            <h1 id="map1" class="MapPosition"></h1>
            <h5>Geography service is provided by Google Maps</h5>
            <br>
            <!--        <div id="map1" class="MapPosition"></div>-->
            <div class="blank"></div>
            <div class="button textWhite">Yes, I am here!</div>
            <a href="#">
                <p class="alternativeOption">I am not here</p>
            </a>
        </div>
        <!-- If user clicked 'I am not here', provide them with opportunity to select their location on the map -->
        <div class="block grey " id="step2Branch">
            <h1>Please choose your location</h1>
            <h5>Map service is provided by Google Maps</h5>
            <div id="map2" class="preview" style="width:280px;height:300px;"></div>
            <!-- Google maps API -->
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJzPG-L5GstSeXxXAOgeU-_bROjO9MQFc&callback=myMap" type="text/javascript"></script>
            <div class="blank"></div>
            <div class="button textWhite">Yes, I am here!</div>
        </div>

        <div class=" step" id="step3Instruction">
            <span class="left"><h4>Please choose a picture for the front side of the postcard</h4></span>
            <span class="right arrowdown"><img class="leftImg imgSize12" src="img/arrowdown_2x.png" /></span>
            <span class="right arrowup"><img class="imgSize12" src="img/arrowup_2x.png" /></span>

        </div>

        <div class="block grey " id="step3Content">
            <h1>Tap to choose, swipe for more</h1>
            <h5>powered by Trove</h5>
            <!-- Slider main container -->
            <div class="swiper-container">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper" id="mainPicture">
                    <!-- Slides -->
                    <!--
                <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
                <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
                <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
                -->
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>

            <div class="blank"></div>
            <div class="button textWhite">Okay</div>
        </div>

        <div class=" step" id="step4Instruction">
            <span class="left"><h4>Please choose a picture for postage stamp</h4></span>
            <span class="right arrowdown"><img class="leftImg imgSize12" src="img/arrowdown_2x.png" /></span>
            <span class="right arrowup"><img class="imgSize12" src="img/arrowup_2x.png" /></span>
        </div>

        <div class="block grey " id="step4Content">
            <h1>Tap to choose, swipe for more</h1>
            <h5>powered by Trove</h5>
            <!-- Slider main container -->
            <div class="swiper-container small-group">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper" id="stamps">
                    <!-- Slides -->
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>
            <div class="blank"></div>
            <div class="button textWhite">Okay</div>

        </div>

        <div class=" step" id="step5Instruction">
            <span class="left"><h4>Please choose an article for the back side</h4></span>
            <span class="right arrowdown"><img class="leftImg imgSize12" src="img/arrowdown_2x.png" /></span>
            <span class="right arrowup"><img class="imgSize12" src="img/arrowup_2x.png" /></span>

        </div>

        <div class="block grey " id="step5Content">
            <h1>Tap to choose, swipe for more</h1>
            <h5>At most <span class="important">140 characters</span> related to your location will be shown on the back side</h5>
            <!-- Slider main container -->
            <div class="swiper-container">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <p>Walter, James. "Defining Australia." In Images of Australia. Eds. Gillian Whitlock and David Carter. <strong class="important">St Lucia</strong>: U of Queensland P, 1992, 7-22.</p>
                    </div>
                    <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
                    <div class="swiper-slide"><img src="img/placeholder.png" alt="The current picture" /></div>
                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>
            <div class="blank"></div>
            <div class="button textWhite">Okay</div>
            <a href="">
                <p class="alternativeOption">Automatically generate for me</p>
            </a>
        </div>
        <div class=" step" id="step6Instruction">
            <span class="left"><h4>Please type in your greeting</h4></span>
            <span class="right arrowdown"><img class="leftImg imgSize12" src="img/arrowdown_2x.png" /></span>
            <span class="right arrowup"><img class="imgSize12" src="img/arrowup_2x.png" /></span>
        </div>

        <div class="block grey " id="step6Content">
            <form id="greetings">
                <textarea id="greeting"></textarea>
            </form>
            <div class="blank"></div>
            <div class="button textWhite">Done</div>
        </div>

        <div class="progress">
            <div class="inProgress"></div>
        </div>
    </div>
    <script src="js/pushy.js"></script>
    <script src="js/remodal.js"></script>
    <script>
        $(document).ready(function () {
            $("#greeting").charCount();
        });
        //        $(".swiper-container").each(function (index, element) {
        //            var $this = $(this);
        //            var swiper = new Swiper(this, {
        //                pagination: $this.find(".swiper-pagination")[0],
        //                slidesPerView: 'auto',
        //                centeredSlides: true,
        //                paginationClickable: true,
        //                spaceBetween: 30,
        //                loop: false,
        //                // Navigation arrows
        //                // nextButton: '.swiper-button-next', // prevButton: '.swiper-button-prev',
        //                nextButton: $this.find(".swiper-button-next")[0],
        //                prevButton: $this.find(".swiper-button-prev")[0]
        //            });
        //        });

        var swiper_preview = new Swiper('#preview', {
            pagination: $('#preview').find(".swiper-pagination")[0],
            slidesPerView: 'auto',
            centeredSlides: true,
            paginationClickable: true,
            spaceBetween: 30,
            loop: false,
            // Navigation arrows
            // nextButton: '.swiper-button-next', // prevButton: '.swiper-button-prev',
            nextButton: $('#preview').find(".swiper-button-next")[0],
            prevButton: $('#preview').find(".swiper-button-prev")[0]
        })
    </script>

</body>

</html>