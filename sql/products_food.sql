-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-08-15 12:32:44
-- 伺服器版本： 10.4.20-MariaDB
-- PHP 版本： 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `d-food`
--

-- --------------------------------------------------------

--
-- 資料表結構 `products_food`
--

CREATE TABLE `products_food` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `introduction` text DEFAULT NULL,
  `flavor` varchar(255) NOT NULL,
  `cate_sid` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products_food`
--

INSERT INTO `products_food` (`sid`, `name`, `product_id`, `price`, `brand`, `introduction`, `flavor`, `cate_sid`, `img`, `content`) VALUES
(1, '冰烤地瓜', 'PM001', 30, 'Fitme', '直火烘烤，選用台灣契作地瓜，退冰後不用加熱帶皮一起吃香甜可口、冰沁身心，而且冰過的地瓜都是抗性澱粉熱量相對較低喔。', '原味冰烤', 3, '', '熱量 155.0 Kcal\r\n蛋白質 0.8 g\r\n碳水化合物 38.0 g\r\n脂肪0.0 g'),
(2, '鮮凍綠花椰菜', 'PM002', 99, '食安先生', '', '原味', 3, '', '熱量 21.3 Kcal\r\n蛋白質 1.3 g\r\n碳水化合物 4.5 g\r\n脂肪 0.0 g'),
(3, '韓式泡菜豬燉飯', 'PT001', 150, 'Fitme', '以新鮮豬後腿肉加上黃豆芽、海帶芽、青花菜，搭配獨家低糖、低鈉的韓式調味，美味無負擔的享用韓式風味料理，混和多種蔬菜達到低GI的效果。', '韓式泡菜', 1, '', '熱量 575.3 Kcal\r\n蛋白質 31.3 g\r\n碳水化合物 77.6 g\r\n脂肪15.3 g'),
(4, '田園蔬菜燉飯', 'PT002', 80, 'Fitme', '田園蔬菜燉飯包含了白米、高麗菜、洋蔥、番茄，並且用健康的醬油、沙拉油、鹽做些許調味，以一比一的蔬菜跟白飯組合，能夠給予易飽足的低GI料理、充足的碳水化合物讓您在健身時能量滿滿！', '田園蔬菜', 1, '', '熱量 370.0 Kcal\r\n蛋白質 8.0 g\r\n碳水化合物 75.0 g\r\n脂肪4.0 g'),
(5, '花雕醉雞', 'PT003', 50, 'Fitme', '嚴選新鮮雞腿肉以花雕酒醃製12小時，並且使用低溫烹調調理製作，雞肉內保留滿滿的雞汁，一口咬下口中充滿花雕酒的香氣與濕潤雞腿口感。', '花雕雞', 1, '', '熱量 126.3 Kcal\r\n蛋白質 15.0 g\r\n碳水化合物 5.9 g\r\n脂肪1.5 g'),
(6, '法式舒肥雞胸', 'PW001', 80, '食安先生', '以精選喜馬拉雅山玫瑰鹽簡單調味，完整保留食材原始風味，讓人品嘗最純粹的雞肉香甜', '玫瑰鹽原味', 2, ' ', '熱量 203.0 Kcal\r\n蛋白質 39.4 g\r\n碳水化合物 0.0 g\r\n脂肪 1.0 g'),
(7, '香蒜雞胸肉', 'PW002', 40, 'Fitme', '雞胸肉擁有極高的優質蛋白質以及極低的脂肪，對於不管是要增肌或是減重的族群都是非常好的選擇。FitMe健身餐的香蒜雞胸肉採用的烹調方式是採用法國的烹飪概念：舒肥法（Sous-Vide）', '香蒜', 2, ' ', '熱量 79.0 Kcal\r\n蛋白質 17.0 g\r\n碳水化合物 1.9 g\r\n脂肪0.3 g'),
(8, '柴魚健身飯', 'PW003', 50, 'Fitme', ' 鷹嘴豆是素食著相當優質的蛋白質、碳水化合物來源。鷹嘴豆是富含有蛋白質、不飽和脂肪酸、纖維素、鈣、鋅、鉀、維他命B 群等有益人體營養素的健康豆類食物。其中人體必需的八種胺基酸全部具備，而且含量比燕麥還要高出兩倍以上;魚片配上醬油更是連貓都愛的貓飯(但是貓不能吃) ，這款不但美味更是低GI!', '醬油柴魚', 2, ' ', '熱量 382.0 Kcal\r\n蛋白質 11.2 g\r\n碳水化合物 80.0 g\r\n脂肪1.8 g');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `products_food`
--
ALTER TABLE `products_food`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products_food`
--
ALTER TABLE `products_food`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
