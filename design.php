<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Myca - Design your own postcard</title>
    <link rel='shortcut icon' href='img/favicon.ico' type='image/x-icon' />
    <!--    use a font called Catamaran from google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Catamaran:300,500" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Neuton" rel="stylesheet">
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
                <h5>It is strongly recommended <span class="important">not</span> to log in or sign up once you start designing. Otherwise, you will lose what you have done!</h5>
                <div class="blank"> </div>
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


        <div class="block" id="result">
            <h1 class="lang" key="preview">Preview</h1>
            <!-- Swiper plugin for the preview feature -->
            <div class="swiper-container" id="preview">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide" id="previewFront">
                        <!-- Front-side postcard background image, placeholder geo-text, placeholder image -->
                        <img class="imgSize280" id="previewFrontBg" src="img/bg1.jpg" />
                        <p id="locationP" class="locationP" class="lang" key="your_location">Your location</p>
                        <img id="img1P" src="img/placeholder.png">
                    </div>
                    <div class="swiper-slide" id="previewBack">
                        <!-- Back-side postcard background image, placeholder stamp -->
                        <img class="imgSize280" id="previewBackBg" src="img/bg2.jpg" />
                        <img id="img2P" src="img/placeholder.png">
                    </div>
                </div>
                <!-- pagination -->
                <div class="swiper-pagination"></div>

                <!-- navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>

        </div>

        <!--        navigation for the whole process of making a postcard-->
        <div class="navigation" id="navigation">
            <ul>
                <li class="lang" key="locating">
                    1. Location
                </li>
                <li class="lang" key="designfront">
                    2. Front side
                </li>
                <li class="lang" key="designback">
                    3. Back side
                </li>
                <li class="lang" key="typegreeting">
                    4. Greetings
                </li>
            </ul>
        </div>


        <!-- Google map -->
        <!-- Get users current location (Auto-geolocating)-->
        <div class="step" id="step2Instruction">
            <h4 class="lang" key="confirmlocation">Please confirm your current location</h4>
        </div>
        <div class="block grey " id="step2Content">
            <h1 id="map1" class="MapPosition"></h1>
            <h5 class="lang" key="googlemap">Geography service is provided by Google Maps</h5>
            <br>
            <!-- <div id="map1" class="MapPosition"></div> -->
            <div class="blank"></div>
            <div class="button textWhite" class="lang" key="iamhere">Yes, I am here!</div>
            <a href="#">
                <p class="alternativeOption" class="lang" key="nothere">Choose manually</p>
                <div class="blank"></div>
            </a>
        </div>
        <!-- When user clicked 'I am not here' or auto-geolocating failed, locating manually-->
        <div class="block grey " id="step2Branch">
            <h1 class="lang" key="chooselocation">Please choose your location</h1>
            <h5 class="lang" key="mapservice">Map service is provided by Google Maps</h5>
            <div id="map2" class="googlemap center"></div>
            <!-- Google maps API -->
            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJzPG-L5GstSeXxXAOgeU-_bROjO9MQFc&callback=myMap" type="text/javascript"></script>
            <div class="blank"></div>
            <div class="button textWhite" class="lang" key="iamhere">Yes, I am here!</div>
            <div class="blank"></div>
        </div>

        <!--        Allow users to select a picture from trove based on their locations as the main picture on the front side-->
        <div class=" step" id="step3Instruction">
            <h4 class="lang" key="choosepicfront">Please choose a picture for the front side</h4>
        </div>
        <div class="block grey " id="step3Content">
            <h1 class="lang" key="tapswipe">Tap to choose, swipe for more</h1>
            <h5 class="lang" key="poweredbyTrove">powered by Trove</h5>
            <!-- Slider main container -->
            <div class="swiper-container large-group">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper" id="mainPicture">
                </div>
                <!-- navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
            <div class="blank"></div>
            <div class="button textWhite" class="lang" key="okay">Okay</div>
            <div class="blank"></div>
        </div>

        <!--        Allow users to choose a picture from Trove as the stamp-->
        <div class=" step" id="step4Instruction">
            <h4 class="lang" key="choosepicstamp">Please choose a picture for postage stamp</h4>
        </div>

        <div class="block grey " id="step4Content">
            <h1 class="lang" key="tapswipe">Tap to choose, swipe for more</h1>
            <h5 class="lang" key="poweredbyTrove">powered by Trove</h5>
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
            <div class="blank"></div>
        </div>

        <!--        Allow users to type in their greetings which will be printed on the back side of the postcard-->
        <div class="block grey " id="step6Content">
            <form action="trans.php" id="greetings" method="post">
                <span>TO</span>
                <input type="text" id="towhom" name="towhom" />
                <!--To-->
                <span>FROM</span>
                <input type="text" id="fromwhom" name="fromwhom" />
                <!--From-->
                <span class="lang" key="140">Only the first 140 characters will be recorded.
                </span>
                <span class="counter right"></span>
                <textarea id="greeting" name="greeting"></textarea>
                <!--greeting-->
                <div class="blank"></div>
                <input name="address" type="text" value="Australia" />
                <!--add-->
                <input name="firstimg" type="text" />
                <!--Trove front URL-->
                <input name="secondimg" type="text" />
                <!--Trove stamp URL-->
                <button class="button center textWhite" name="done" type="submit">Done</button>
            </form>
            <div class="blank"></div>
        </div>

        <!--        show the progess at the bottom of the browswe -->
        <div class="progress">
            <div class="inProgress"></div>
        </div>
    </div>

    <script src="js/pushy.js"></script>
    <script src="js/remodal.js"></script>
    <script src="js/pace.min.js"></script>
    <script>
        //        apply character count function on the greeting form
        $(document).ready(function () {
            $("#greeting").charCount();
        });

        //        apply swpier plugin to the preview feature
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

    <!--Here starts to build muli-language translation -->
    <!-- Add language dictionary with English and Chinese(Simple)-->
    <script type="text/javascript">
        var arrLang = {
            'en': {
                'location': 'Choose your location',
                'front': 'Choose a picture for the front side of the postcard',
                'stamp': 'Choose a picture for the postage stamp',
                'greeting': 'Type in your greeting',
                'preview': 'Preview',
                'your_location': 'Your location',
                'swipe': 'Swipe to switch between front and back sides',
                'locating': 'Locating',
                'designfront': 'Design front side',
                'designback': 'Design back side',
                'typegreeting': 'Type in greeting',
                'layout': 'Please choose the layout',
                'landscape': 'Lanscape',
                'portrait': 'Portrait',
                'okay': 'Okay',
                'confrimlocation': 'Please confirm your current location',
                'googlemap': 'Geography service is provideed by Google Maps',
                'iamhere': 'Yes, I am here!',
                'nothere': 'I am not here',
                'chooselocation': 'Please choose your location',
                'mapservice': 'Map service is provided by Google Maps',
                'choosepicfront': 'Please choose a picture for the front side of the postcard',
                'tapswipe': 'Tap to choose, swipe for more',
                'poweredbyTrove': 'powered by Trove',
                'choosepicstamp': 'Please choose a picture for postage stamp',
                'typeyourgreeting': 'Please type in your greeting',
                '140': 'Only the first 140 characters will be recorded.',
            },
            'cn': {
                'location': '请选择你的位置',
                'front': '请选择一张图片作为明信片的封面',
                'stamp': '请选择一张图片作为明信片的邮票',
                'greeting': '请送上你的祝福',
                'preview': '预览',
                'your_location': '你的位置',
                'swipe': '左右滑动切换正面和反面',
                'locating': '确定你的位置',
                'designfront': '设计明信片封面',
                'designback': '设计明信片反面',
                'typegreeting': '请写祝福语',
                'layout': '请选择明信片布局',
                'landscape': '横向明信片',
                'portrait': '纵向明信片',
                'okay': '确定',
                'confirmlocation': '请确认你现在的位置',
                'googlemap': '定位服务由谷歌地图提供支持',
                'iamhere': '对，我在这儿！',
                'nothere': '我不在这儿',
                'chooselocation': '请选择你的位置',
                'mapservice': '地图服务由谷歌地图提供支持',
                'choosepicfront': '请选择一张图片作为明信片的封面',
                'tapswipe': '轻点选择图片，左右滑动浏览更多',
                'poweredbyTrove': 'Trove技术支持',
                'choosepicstamp': '请选择一张图片作为明信片的邮票',
                'typeyourgreeting': '请送上你的祝福',
                '140': '只有前140个字符会显示在明信片上。',
            }
        };
        //        Function to achieve lanague swith between English and Simple Chinese(Simple)
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