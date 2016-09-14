-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2014 at 04:54 AM
-- Server version: 5.5.33
-- PHP Version: 5.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webappdemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `combos`
--

CREATE TABLE IF NOT EXISTS `combos` (
  `ID` int(3) NOT NULL AUTO_INCREMENT,
  `USER` varchar(25) NOT NULL,
  `FLICKR_IMG` varchar(250) NOT NULL,
  `FLICKR_URL` varchar(250) NOT NULL,
  `TWEET_TEXT` varchar(250) NOT NULL,
  `TWEET_URL` varchar(250) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `combos`
--

INSERT INTO `combos` (`ID`, `USER`, `FLICKR_IMG`, `FLICKR_URL`, `TWEET_TEXT`, `TWEET_URL`) VALUES
(11, 'lorns', 'http://farm4.staticflickr.com/3910/14843528459_1a7649973d_z.jpg', 'https://www.flickr.com/photos/122828675@N06/14843528459/', '#Special #Offer Boost your business on twitter, we can give you 5000 twitter followers for $29, More info : http://t.co/LLWZG44XH3', 'https://twitter.com/qylyvekezedy'),
(12, 'lorns', 'http://farm6.staticflickr.com/5551/15014983286_13681d680b_z.jpg', 'https://www.flickr.com/photos/47188130@N00/15014983286/', 'blue x BeyoncÃ© >', 'https://twitter.com/ayeetrujillo'),
(13, 'lorns', 'http://farm4.staticflickr.com/3903/15037698232_d134f9b358_z.jpg', 'https://www.flickr.com/photos/44502866@N03/15037698232/', 'RT @AdorableWords: Girls, don''t let a guy treat you like a yellow starburst. You are a pink starburst.', 'https://twitter.com/ErikaJohnson_02'),
(14, 'lorns', 'http://farm6.staticflickr.com/5501/14654812675_2420d514c0_z.jpg', 'https://www.flickr.com/photos/alesprimozic/14654812675/', 'RT @weknowwhatsbest: Effective immediately--\nThe official "White House Schedule" will be renamed "Tee Times"', 'https://twitter.com/Landlvr'),
(15, 'lorns', 'http://farm6.staticflickr.com/5576/14851266109_2c0281497f_z.jpg', 'https://www.flickr.com/photos/compacflt/14851266109/', '@heRobust wouldn''t she not age if she''s in the time machine?', 'https://twitter.com/openmike503'),
(16, 'lorns', 'http://farm6.staticflickr.com/5583/14851813837_0e131d2cb3_z.jpg', 'https://www.flickr.com/photos/maximlabel/14851813837/', 'Damn ðŸ˜‚ RT @WTFUMeanNoRiRi: Blue Ivy will buy all of Vietnam and have ur whole fam working for House of Dereon @karruecheâ€', 'https://twitter.com/thecoach1908'),
(17, 'lorns', 'http://farm4.staticflickr.com/3859/15038499205_3e0c6b49c7_z.jpg', 'https://www.flickr.com/photos/rtha/15038499205/', 'RT @djchrisjamaica: Silver Cat - My Money - Single - https://t.co/BEENabIL1X #iTunes via @MobysJamaica #JSO #Entrepreneur #TeamDancehall #Râ€¦', 'https://twitter.com/JAShoutOut'),
(18, 'lorns', 'http://farm4.staticflickr.com/3908/15041212822_5b0995454a_z.jpg', 'https://www.flickr.com/photos/craftygal/15041212822/', 'RT @HealthHabits: Labelling soft drinks with "28 cubes of sugar" instead of "70 grams of sugar" reduces consumption - http://t.co/enzCfxUtRâ€¦', 'https://twitter.com/chiamakait'),
(19, 'lorns', 'http://farm6.staticflickr.com/5589/14855332268_347f25aaf4_z.jpg', 'https://www.flickr.com/photos/igoal-kwphoto/14855332268/', '#Photography #Camera #95 http://t.co/uyApJu64h6\n\nTripod Monopod Metal BALL HEAD Quick Release Plate By Fanciers... http://t.co/Jz03ipGkdy', 'https://twitter.com/Sinaibouca'),
(20, 'lorns', 'http://farm6.staticflickr.com/5579/14855330877_7ca199d94f_z.jpg', 'https://www.flickr.com/photos/nopayne/14855330877/', 'RT @emilyrschilling: If I get a little prettier can I be your baby ?', 'https://twitter.com/Stegr_andiose53'),
(21, 'lorns', 'http://farm4.staticflickr.com/3842/14855338547_4b429f3640_z.jpg', 'https://www.flickr.com/photos/125025155@N05/14855338547/', 'RT @AssumingMo: SANA PWEDE RIN I-DOWNLOAD ANG PAGKAIN\n\nðŸ• Pizza\nðŸ” Burger\nðŸŸ Fries\nðŸ§ Ice Cream\nðŸ° Cake\nðŸ« Chocolate', 'https://twitter.com/celinneftw'),
(22, 'lorns', 'http://farm6.staticflickr.com/5581/15041530292_4c1e8af9b6_z.jpg', 'https://www.flickr.com/photos/110793816@N06/15041530292/', 'RT @drmartens: Dr. Martens Kenton Boot\nUS & Int: http://t.co/VRPbKTuVcP \nUK & EU: http://t.co/1c6mUrKxSs http://t.co/hlH6CzxukB', 'https://twitter.com/priginasuit'),
(23, 'lorns', 'http://farm4.staticflickr.com/3853/15046324556_d4952b7468_z.jpg', 'https://www.flickr.com/photos/124381879@N02/15046324556/', 'Red hat, black chucks, black 501s on ????????', 'https://twitter.com/AustinFrieberg'),
(24, 'lorns', 'http://farm6.staticflickr.com/5594/14882495789_4a5a335116_z.jpg', 'https://www.flickr.com/photos/123648498@N05/14882495789/', 'RT @FoodPornsx: Sour Peach Rings http://t.co/3co18sbIMB', 'https://twitter.com/delaboobz'),
(25, 'lorns', 'http://farm6.staticflickr.com/5576/15068713982_b999073ff8_z.jpg', 'https://www.flickr.com/photos/109541435@N04/15068713982/', 'RT @Harry_Styles: @Real_Liam_Payne It''s your Birthday!!!! You''re 18..you can do things that you couldn''t before, like buy flumps..or look a…', 'https://twitter.com/niamoustache'),
(26, 'lorns', 'http://farm6.staticflickr.com/5556/14882759837_1f6ddae4e9_z.jpg', 'https://www.flickr.com/photos/116928977@N06/14882759837/', 'Best Women Watches- Omega Constellation Diamond Mother of Pearl Dial Yellow Gold and Stainless Steel Ladies... - http://t.co/E2Q60nMmyF', 'https://twitter.com/ThelmaWamsley'),
(27, 'lorns', 'http://farm4.staticflickr.com/3848/15069225782_20c001325d_z.jpg', 'https://www.flickr.com/photos/36520792@N04/15069225782/', 'RT @veerafornia: the way @trinidadmiles talks to his dog KILLS me.', 'https://twitter.com/trinidadmiles');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
