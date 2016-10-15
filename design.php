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

    <link rel="stylesheet" href="css/pace.css" />
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
    <!-- Login Modal -->
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

    <!-- Task list Modal -->
    <div class="remodal" data-remodal-id="TaskListModal" id="taskListModal">
        <div>
            <button data-remodal-action="close" class="remodal-close"></button>
        </div>
        <h1>All tasks you need to do</h1>
        <h1>to design a postcard</h1>
        <div class="blank"></div>
        <ul>
            <li>
                1. Choose your location
            </li>
            <li>
                2. Choose a picture for the front side of the postcard
            </li>
            <li>
                3. Choose a picture for the postage stamp
            </li>
            <li>
                4. Type in your greeting
            </li>
        </ul>
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
                        <canvas id="myCanvas1" width="224" height="150" style="border:1px solid #000000;"></canvas>
                    </div>
                    <div class="swiper-slide">
                        <canvas id="myCanvas2" width="224" height="150" style="border:1px solid #000000;"></canvas>
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>
        </div>

        <div class="navigation" id="navigation">
            <ul>
                <li>
                    1. Locating
                </li>
                <li>
                    2. Design front side
                </li>
                <li>
                    3. Design back side
                </li>
                <li>
                    4. Type in greeting
                </li>
            </ul>
        </div>

        <div class="step" id="step1Instruction">
            <h4>Please choose the layout</h4>
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
            <h4>Please confirm your current location</h4>
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
            <h4>Please choose a picture for the front side of the postcard</h4>

        </div>

        <div class="block grey " id="step3Content">
            <h1>Tap to choose, swipe for more</h1>
            <h5>powered by Trove</h5>
            <!-- Slider main container -->
            <div class="swiper-container large-group">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper" id="mainPicture">

                </div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>

            <div class="blank"></div>
            <div class="button textWhite">Okay</div>
        </div>

        <div class=" step" id="step4Instruction">
            <h4>Please choose a picture for postage stamp</h4>
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
            <h4>Please choose an article for the back side</h4>

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
            <h4>Please type in your greeting</h4>
        </div>

        <div class="block grey " id="step6Content">
            <form id="greetings" method="post">
                <span>Only the first 140 characters will be recorded.
                </span>
                <span class="counter right"></span>
                <textarea id="greeting" name="greeting"></textarea>
                <div class="blank"></div>
                <input name="address" type="text" value="Australia" />
                <input name="firstimg" type="text" />
                <input name="secondimg" type="text" />
                <input class="button center textWhite" type="submit" value="Done" />
                <!--3-->
                <?php
				$greeting = $_POST['greeting'];
				session_start();
				$_SESSION['greeting'] = "$greeting";
				?>
            </form>
        </div>

        <div class="progress">
            <div class="inProgress"></div>
        </div>
    </div>
    <script src="js/pushy.js"></script>
    <script src="js/remodal.js"></script>
    <script src="js/pace.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#greeting").charCount();
        });


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