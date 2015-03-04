<?php // no direct access 
/**
 * @package                Template for joomla
 * @copyright        Copyright (C) 2012 a4joomla.com
 * @license                GNU General Public License version 2 or later
 */
defined( '_JEXEC' ) or die( 'Restricted access' ); 
$showLeftColumn = (bool) $this->countModules('position-7');
$showRightColumn = (bool) $this->countModules('position-6');
$showRightColumn &= JRequest::getCmd('layout') != 'edit';

$headerType = $this->params->get("headerType","1");
$myimage = $this->params->get("myimage","tillage1.jpg");
$myfolder = $this->params->get("myfolder","sampledata");
$duration = $this->params->get("duration","800");
$delay = $this->params->get("delay","4000");
$imageWidth = $this->params->get("imageWidth","950");
$imageHeight = $this->params->get("imageHeight","350");
$forceresize = $this->params->get("forceresize","0");
$showControl = $this->params->get("showControl", "true");
$display = $this->params->get("display","sequence");
$arrowColor = $this->params->get("arrowColor","white");

$frontpagediv="0";
if ($headerType == "0" || $headerType == "1") {
	$lang =& JFactory::getLanguage();
	$locale = $lang->getTag();
	$menu = JSite::getMenu();
	if ($menu->getActive() == $menu->getDefault($locale)) {
		$frontpagediv="1";
	} 
} elseif ($headerType == "2" || $headerType == "3") {
	$frontpagediv="1";
}

$margin = 30;
$outermargin = 0;
$logoText	= $this->params->get("logoText","Tillage");
$slogan	= $this->params->get("slogan","Template from a4joomla.com");
$pageWidth	= $this->params->get("pageWidth", "980");
$pageWidth	= $pageWidth - $outermargin;
$rightColumnWidth	= $this->params->get("rightColumnWidth", "190");
$leftColumnWidth	= $this->params->get("leftColumnWidth", "190");
$logoWidth	= $this->params->get("logoWidth", "300");
$removeBanner = $this->params->get("removeBanner", "No");
$widthdiff = 30;
if ($forceresize == "1") {
	$imageHeight = round($imageHeight * ($pageWidth + $outermargin - $widthdiff) / $imageWidth);
	$imageWidth = $pageWidth + $outermargin - $widthdiff;
}
$controlPosition = 50 - 2500/$imageHeight;

if($this->countModules('position-0')){
$searchWidth = 170;
} else {
$searchWidth = 0;
}
$searchHeight = 32;
$headerrightWidth = $pageWidth + $outermargin - $logoWidth - 50;

if ($showLeftColumn && $showRightColumn) {
   $contentWidth = $pageWidth - $leftColumnWidth - $rightColumnWidth - 3*$margin;
} elseif (!$showLeftColumn && $showRightColumn) {
   $contentWidth = $pageWidth - $rightColumnWidth - 2*$margin ;
} elseif ($showLeftColumn && !$showRightColumn) {
   $contentWidth = $pageWidth - $leftColumnWidth - 2*$margin ;
} else {
   $contentWidth = $pageWidth - $margin ;
}
JHTML::_('behavior.framework', true);  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >

<head>

<jdoc:include type="head" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/grey.css" type="text/css" />
<!--[if IE 6]>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie6.css" type="text/css" />
<style type="text/css">
img, div, a, input { behavior: url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/iepngfix.htc) }
#search input.inputbox { behavior:none;}
</style>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/iepngfix_tilebg.js" type="text/javascript"></script>
<![endif]-->
<!--[if lte IE 7]>
<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie67.css" type="text/css" />
<![endif]-->
<!--[if lte IE 8]>
<style type="text/css">
#search input.inputbox { behavior: url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/PIE.php) }
</style>
<![endif]-->
<style type="text/css">
 #logo {
    width:<?php echo $logoWidth; ?>px;
 }
 #headerright {
    width:<?php echo $headerrightWidth; ?>px;
	<?php if($this->countModules('banner') || $removeBanner == "Yes") : ?>
       background: none;   
    <?php endif; ?>
 } 
 #search {
   width:<?php echo $searchWidth; ?>px;
   height:<?php echo $searchHeight; ?>px;
 }
 #slideshow-container {
	width:<?php echo $pageWidth + $outermargin - $widthdiff; ?>px;
	//height:<?php echo $imageHeight; ?>px;
	height: 20px;
 }
 #slideshow-container img { 
	width:<?php echo $imageWidth; ?>px; 
	height:<?php echo $imageHeight; ?>px;
 }
 #slcontrol {
	width:<?php echo $imageWidth; ?>px; 
	top:<?php echo $controlPosition; ?>%;
 }
 a#slprev {
    background: url("<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/previous-<?php echo $arrowColor; ?>.png") no-repeat scroll left center transparent;
 }
 a#slnext {
    background: url("<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/next-<?php echo $arrowColor; ?>.png") no-repeat scroll right center transparent;
 }
</style>
<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/verysimpleslideshow.js" type="text/javascript"></script>
<?php if (($headerType == "1" || $headerType == "3") && $frontpagediv == "1") : ?>
<script type="text/javascript">
window.addEvent('domready',function() {
	var slideshow = new VerySimpleSlideshow({
		container: 'slideshow-container',
		elements: '#slideshow-container img',
		showControls: <?php echo $showControl; ?>,
		transDelay: <?php echo $delay; ?>,
		transDuration: <?php echo $duration; ?>
	});
	slideshow.start();  
});
</script>
<?php endif; ?>
<!--
1 ) Reference to the files containing the JavaScript and CSS.
These files must be located on your server.
-->
<script type="text/javascript" src="/photo/highslide/highslide-with-gallery.js"></script>
<link rel="stylesheet" type="text/css" href="/photo/highslide/highslide.css">
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="/photo/highslide/highslide-ie6.css" />
<![endif]-->
<!--
2) Optionally override the settings defined at the top
of the highslide.js file. The parameter hs.graphicsDir is important!
-->
<script type="text/javascript">
hs.graphicsDir = '/photo/highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.fadeInOut = true;
hs.dimmingOpacity = 0.8;
hs.outlineType = 'rounded-white';
hs.captionEval = 'this.thumb.alt';
hs.marginBottom = 105 // make room for the thumbstrip and the controls
hs.numberPosition = 'caption';
// Add the slideshow providing the controlbar and the thumbstrip
hs.addSlideshow({
//slideshowGroup: 'group1',
interval: 5000,
repeat: false,
useControls: true,
overlayOptions: {
className: 'text-controls',
position: 'bottom center',
relativeTo: 'viewport',
offsetY: -60
},
thumbstrip: {
position: 'bottom center',
mode: 'horizontal',
relativeTo: 'viewport'
}
});
</script>	  


<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="/photo/templates/a4joomla-tillage-free/js/cookie.js" type="text/javascript"></script>
<script src="/photo/templates/a4joomla-tillage-free/js/jquery/1.11.1/jquery.min.js" type="text/javascript"></script>

<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

 																									
</head>
<body>

<?php
/*

<body type='button' onload="get_iframe2();">  <script> function get_iframe2() { var data2 = '<iframe id="sparky_maps" frameborder="no" scrolling="no" width="100%" height="120" src="http://galleryua.com/sela/Panoramio/slider-hero/hero.html"></iframe>'; document.getElementById('mydiv2').innerHTML = data2;  <div id='mydiv2'></div></body>

*/
?>

<?php /*

<!--slyder-->
		<link rel="stylesheet" media="all" href="/sela/Panoramio/slider-hero/jquery.heroCarousel-1.3/style-hero.css" type="text/css" />
		<link rel="stylesheet" media="all" href="/sela/Panoramio/slider-hero/jquery.heroCarousel-1.3/layout.css" type="text/css" />
		<link rel="stylesheet" media="all" href="/sela/Panoramio/slider-hero/style.css" type="text/css" />
		<script src="/sela/Panoramio/slider-hero/jquery-2.1.1.min.js"></script>
		<script src="/sela/Panoramio/slider-hero/jquery.heroCarousel-1.3/jquery.easing-1.3.js"></script>
		<script src="/sela/Panoramio/slider-hero/jquery.heroCarousel-1.3/jquery.heroCarousel-1.3.js"></script>
		<script>
		$(function(){
				$('.hero-carousel').heroCarousel({
					easing: 'easeOutExpo'
					//css3pieFix: true
				});
		});
		</script>
	
<div class="hero">
	<div style="position: relative; overflow: hidden; left: 50%; top: 0px; margin-left: -1895px; height: 353px; width: 6315px;" 
	class="hero-carousel hero-carousel-container">

   <article class="carousel-article" 
   style="background-image: url('http://po-ua.com/node-foto/Krym-Ay-Petri-noyabr-2014.files/image003.jpg'); 
   background-size: cover; background-position: center center; width: 1263px;">
   <div class="contents">
        <h2>Поход по Крыму налегке "Осенняя Ай-Петри"</h2>
		<p>Видели ли Вы когда-нибудь настоящую осень? А хотите ли увидеть еще раз? Отправляемся с нами в пеший поход по осеннему Крыму
			<a href="http://po-ua.com/osenniy-pohod-Krym-Ay-Petri-noyabr">подробнее</a>
		</p>            
	</div>
    </article>
	

	<article class="carousel-article current" 
	style="background-image: url('http://po-ua.com/node-foto/Krym-Ay-Petri-noyabr-2014.files/image011.jpg'); 
	background-size: cover; background-position: center center; width: 1263px;">
    <div class="contents">
        <h2>Поход по Крыму налегке "Осенняя Ай-Петри"</h2>
		<p>Видели ли Вы когда-нибудь настоящую подземную пещеру? А хотите ли увидеть еще раз? Отправляемся с нами в пеший поход по осеннему Крыму
			<a style="color:#ddf;" href="http://po-ua.com/osenniy-pohod-Krym-Ay-Petri-noyabr">подробнее</a>
		</p>
		</div>
    </article>
	

	<article class="carousel-article" 
	style="background-image: url('http://po-ua.com/node-foto/pohod-Chernorechye/pohod-010.jpg'); 
	background-size: cover; background-position: center center; width: 1263px;">
    <div class="contents">
        <h2>Поход по Крыму налегке "Осенняя Ай-Петри"</h2>
	<p>Видели ли Вы когда-нибудь настоящую осень? А хотите ли увидеть еще раз? Отправляемся с нами в пеший поход по осеннему Крыму
			<a href="http://po-ua.com/osenniy-pohod-Krym-Ay-Petri-noyabr">подробнее</a>
	</p>
	</div>
    </article>
	
	
	<article class="carousel-article" style="background-image: url('http://po-ua.com/node-foto/osenniy-pohod-noviy-svet/image001.jpg'); background-size: cover; background-position: center center; width: 1263px;">
    <div class="contents">
        <h2>Поход по Крыму налегке "Осенняя Ай-Петри"</h2>
	<p>Видели ли Вы когда-нибудь настоящую осень? А хотите ли увидеть еще раз? Отправляемся с нами в пеший поход по осеннему Крыму
			<a href="http://po-ua.com/osenniy-pohod-Krym-Ay-Petri-noyabr">подробнее</a>
	</p>
	</div>
    </article>
		
		
	<article class="carousel-article" style="background-image: url('http://po-ua.com/node-foto/NG-2014-karpaty-putila/zimniy-pohod-016.jpg'); background-size: cover; background-position: center center; width: 1263px;">
    <div class="contents">
	<h2>Зимний новогодний пешеходный поход по Карпатам</h2>
	<p>Видели ли Вы когда-нибудь настоящую зиму? А хотите ли увидеть еще раз? Отправляемся с нами в пеший новогодний поход по зимним Карпатам
			<a href="http://po-ua.com/pohod-Karpaty-Noviy-God-Zakarpate">подробнее</a>
	</p></div>
    </article>
	
	</div>

</div>
<div style="width:100%; height:1500px;">

		<!--/slyder-->
		*/
?>

<link rel="stylesheet" href="/photo/templates/a4joomla-tillage-free/css/header-dima.css" media="screen">	

<div id="hdr">
      <div id="logo1" class="gainlayout">
         	<h2><a href="http://galleryua.com/photo/" title="Достопримечательности Украины">Достопримечательности Украины</a></h2>
			<h3>Путешествуйте с нами!</h3> 
      </div>
	  <div id="headerright1" class="gainlayout">
                <div class="clr"></div>
      </div>
      <div class="clr"></div>

</div>

<link rel="stylesheet" href="/sela/Panoramio/slider-oleg/css/afwslider.css" media="screen">	
<script src="/sela/Panoramio/slider-oleg/script/jquery-1.10.2.min.js"></script>
<script src="/sela/Panoramio/slider-oleg/script/afwslider.js"></script>

<!-- begin slider -->
	<div id="sld">
		
		<img 
		src="/sela/Panoramio/slider-oleg/img/karpaty1.jpg" 
		alt='ПЕШИЙ ПОХОД ПО КАРПАТАМ «КРАЙ ЗЕМЛИ». КЛУБ АКТИВНОГО ОТДЫХА «ПЕШКОМ ПО УКРАИНЕ»' 
		title='Бывали ли Вы когда-нибудь в самых отдаленных от населенных пунктов и самых живописных уголках Карпат? 
		Тогда Вам с нами'
		data-src='http://po-ua.com/'>
		
		<img 
		src="/sela/Panoramio/slider-oleg/img/yral.jpg"
		alt='ПЕШИЙ ПОХОД ПО УРАЛУ «ВЕРШИНЫ КРАСОТЫ». КЛУБ АКТИВНОГО ОТДЫХА «ПЕШКОМ ПО УКРАИНЕ»'
		title='Видели ли Вы завораживающую природу Уральских гор? А вдыхали ли Вы воздух их вершин? Еще нет, тогда Вам с нами'
		data-src='http://po-ua.com/pohod-Ural-2013'>
		
		<img 
		src="/sela/Panoramio/slider-oleg/img/oreli.jpg"
		alt='СПЛАВ ПО РЕКЕ ОРЕЛИ НА БАЙДАРКАХ. КЛУБ АКТИВНОГО ОТДЫХА «ПЕШКОМ ПО УКРАИНЕ»'
		title='Знакомы ли Вы с одной из самых живописных рек Украины? Вы новичок или эксперт, не имеет значения, Вы с нами'
		data-src='http://po-ua.com/'>
		
		<img src="/sela/Panoramio/slider-oleg/img/karpaty2.jpg"
		alt='ПОХОД КВАСЫ-ОСМОЛОДА. КЛУБ АКТИВНОГО ОТДЫХА «ПЕШКОМ ПО УКРАИНЕ»'
		title='Хотите ли Вы провести майские праздники в окружении украинских Карпат, вдыхать этот свежий запах весны с нами? 
		Добро пожаловать в мир природы'
		data-src='http://po-ua.com/'>
		
		<img src="/sela/Panoramio/slider-oleg/img/karpaty3.jpg"
		alt='ПОХОД ПО КАРПАТАМ. ПОЛОНИНА РУНА. КЛУБ АКТИВНОГО ОТДЫХА «ПЕШКОМ ПО УКРАИНЕ»'
		title='Любите ли Вы места, редко посещаемые туристами, где видна вся красота девственной природы? 
		Отправляемся с нами в летний поход по самым загадочным местам Карпат'
		data-src='http://po-ua.com/'>
		
		<img src="/sela/Panoramio/slider-oleg/img/splav_desna.jpg"
		alt='СПЛАВЫ ПО ДЕСНЕ. КЛУБ АКТИВНОГО ОТДЫХА «ПЕШКОМ ПО УКРАИНЕ»'
		title='Деснянская природа удивит Вас свой красотой. 
		Путешествие по реке, вечер у костра, звездное небо и отдых на природе подарят Вам приятное чувство единения с природой'
		data-src='http://po-ua.com/'>
		
		<img src="/sela/Panoramio/slider-oleg/img/tyrciya.jpg"
		alt='ПОХОД ПО ТУРЦИИ. ЛИКИЙСКАЯ ТРОПА. ВЕСНА 2015. КЛУБ АКТИВНОГО ОТДЫХА «ПЕШКОМ ПО УКРАИНЕ»'
		title='Предлагаем составить нам компанию в классическом пешем походе по Юго-Восточному побережью Средиземноморского побережья Турции, 
		а именно по территориям древнего царства — Ликия'
		data-src='http://po-ua.com/lycia_way3'>
		
		<img src="/sela/Panoramio/slider-oleg/img/zaporoshie.jpg"
		alt='ПУТЕШЕСТВИЯ ПО САКРАЛЬНЫМ ЦЕНТРАМ ЗАПОРОЖЬЯ'
		title='Есть такие места, посетив которые, человек чувствует прилив сил, заряд бодрости и хорошего настроения. 
		Отправляемся в «места силы» с нами'
		data-src='http://vk.com/kamen_mog'>
		
		<img src="/sela/Panoramio/slider-oleg/img/lvov.jpg"
		alt='ТРЕХДНЕВНЫЙ ТУР ПО ЗАМКАМ ЛЬВОВЩИНЫ'
		title='Приглашаем всех романтиков посетить таинственные замки Львовщины и провести незабываемых три дня в самом европейском городе Украины!'
		data-src='http://vk.com/lviv_tur'>
		
		<img src="/sela/Panoramio/slider-oleg/img/odessa.jpg"
		alt='ОТДЫХ В ОДЕССЕ - ПАЛАТОЧНЫЙ ГОРОДОК НА БЕРЕГУ МОРЯ В ЦЕНТРЕ ГОРОДА'
		title='Вы таки не были до сих пор в Одессе? Тогда вам срочно нужно это исправить! 
		Предлагаем бюджетное проживание в палаточном лагере, который расположен в самом центре Одессы на берегу Черного моря.'
		data-src='http://vk.com/odessa_zp'>
		
		<img src="/sela/Panoramio/slider-oleg/img/oposnya.jpg"
		alt='ПОЛТАВСКИЙ КОЛОРИТ: ОПОШНЯ, ЦЕНТР ГОНЧАРСТВА'
		title='Хотите посетить этнический символ украинской культуры? Предлагаем увидеть все своими глазами!'
		data-src='http://vk.com/opishnya_kava'>
		
		<img src="/sela/Panoramio/slider-oleg/img/dnepr.jpg"
		alt='ТЕАТР ОДНОГО АКТЕРА «КРИК», Г.ДНЕПРОПЕТРОВСК'
		title='Хотите получить взрыв эмоций и чувств? Посетите вместе с нами театр, 
		в котором главный актер является и режиссером, и сценаристом, и художником …'
		data-src='http://vk.com/krik_kava'>
		
		<img src="/sela/Panoramio/slider-oleg/img/hibini.jpg"
		alt='ПОХОД В ХИБИНЫ. ОЗЕРА ХИБИНСКИХ ТЕНДР. КЛУБ АКТИВНОГО ОТДЫХА «ПЕШКОМ ПО УКРАИНЕ»'
		title='Поход проходит по двум красивейшим горным районам удивительной заполярной страны – 
		Российской Лапландии (Мурманской области). 
		Всего только 80 лет тому назад они были нанесены на подробные карты!'
		data-src='http://po-ua.com/http%3A/%252Fpo-ua.com/pohod-v-hibiny-2015'>
		
		
		<ul></ul>
	</div>
<!-- end slider -->



<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!--<div id="header" class="gainlayout">   -->
<div style="height:10px;">
	  <div >
        <?php if($this->countModules('login')) : ?>
          <div id="banner">
            <jdoc:include type="modules" name="login" style="xhtml" /> 
          </div>
        <?php endif; ?>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      

</div>



<!--++++++++++++++++++++++++++++++++++++++++++++-->      
<div id="allwrap" class="gainlayout" style="width:<?php echo $pageWidth + $outermargin; ?>px;">

<?php
/*

<div id="header" class="gainlayout">   
      <div id="logo" class="gainlayout">
         	<h2><a href="<?php echo JURI::base(); ?>" title="<?php echo htmlspecialchars($logoText); ?>"><?php echo htmlspecialchars($logoText); ?></a></h2>
			<h3><?php echo htmlspecialchars($slogan); ?></h3> 
      </div>
	  <div id="headerright" class="gainlayout">
        <?php if($this->countModules('banner')) : ?>
          <div id="banner">
            <jdoc:include type="modules" name="banner" style="xhtml" /> 
          </div>
        <?php endif; ?>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      

</div>
*/
?>

<div id="wrap" class="gainlayout">

  <div id="topmenuwrap" class="gainlayout">
     <?php if($this->countModules('position-1')) : ?>
         <div id="topmenu" class="gainlayout">
           <jdoc:include type="modules" name="position-1" style="xhtml" />
           <div class="clr"></div>
         </div> 
     <?php endif; ?>
     <?php if($this->countModules('position-0')) : ?>
        <div id="search" class="gainlayout">
          <jdoc:include type="modules" name="position-0" style="xhtml" /> 
		<div class="clr"></div>  
        </div>
     <?php endif; ?>
     <div class="clr"></div>
  </div> 
  <?php if ($frontpagediv == "1" && $headerType != "4") {?>
	<div id="slideshow-container">
		<?php
/*		
		$imgrootdir = "templates/".$this->template."/images/";
		if ($headerType == "0" || $headerType == "2") {
			echo '<img src="'.$imgrootdir.$myimage.'" alt="" />';
		} elseif ($headerType == "1" || $headerType == "3") {
			$picDir= $imgrootdir.$myfolder;
			$picDir .="/";
			if (file_exists($picDir) && is_readable($picDir)) {
				$folder = opendir($picDir);
			} else {
				echo '<div class="message">Error! Please check the parameter settings and make sure you have entered a valid image folder path!</div>';
				return;
			}
			$allowed_types = array("jpg","JPG","jpeg","JPEG","gif","GIF","png","PNG","bmp","BMP");
			$index = array();
			while ($file = readdir ($folder)) {
				if(in_array(substr(strtolower($file), strrpos($file,".") + 1),$allowed_types)) {array_push($index,$file);}
			}
			closedir($folder);
			if($display == 'random') {shuffle($index);} else {sort($index);}

			foreach ($index as $file) {
				$finalpath = $picDir.$file;	
				// output
				echo '<img src="'.$finalpath.'" alt="'.$file.'" />';
			}
			if ($showControl) echo '<div id="slcontrol"> </div>';
		}
*/		
		?>
	</div>
  <?php } ?> 
  <?php if($this->countModules('position-2')) : ?>
	  <div id="pathway" class="gainlayout">
        <jdoc:include type="modules" name="position-2" />
      <div class="clr"></div>
	  </div>
  <?php endif; ?> 
  <div id="cbody" class="gainlayout">
  <?php if($showLeftColumn) : ?>
  <div id="sidebar" style="width:<?php echo $leftColumnWidth; ?>px;">     
      <jdoc:include type="modules" name="position-7" style="xhtml" />    

<?php /*
<!--TRUST-->
<div class="google" style="width:300px;height:250px;float:left;">
<?php
  define('TRUSTLINK_USER', '307a5cdf61ac0e80ca3cd61d3b87e8e6746d651d');
  require_once($_SERVER['DOCUMENT_ROOT'].'/'.TRUSTLINK_USER.'/trustlink.php');
  $o['charset'] = 'UTF-8';//????????
  $o['force_show_code'] = true;
  $o['use_cache'] = true;//????????
  $o['cache_clusters'] = 10;
  $o['cache_dir'] = 'cache/';
  $o['request_uri'] = $_SERVER['REQUEST_URI'];
  $o['host'] = 'galleryua.com'; 

//print_r($o);
  $trustlink = new TrustlinkClient($o);
  unset($o);

  echo ''.$trustlink->build_links();
?>
</div>
*/ 
?>

  </div>
  <?php endif; ?>
  <div id="content60" style="width:<?php echo $contentWidth; ?>px;">    
      <div id="content" class="gainlayout">
	  <jdoc:include type="message" />
      <jdoc:include type="component" /> 
      </div>    
  </div>
  <?php if($showRightColumn) : ?>
  <div id="sidebar-2" style="width:<?php echo $rightColumnWidth; ?>px;">     
      <jdoc:include type="modules" name="position-6" style="xhtml" />     
  </div>
  <?php endif; ?>
  <div class="clr"></div>
  </div>
  
<!--end of wrap-->
</div>
  
<!--end of allwrap-->
</div>
<div id="footerwrap" class="gainlayout" style="width:<?php echo $pageWidth + $outermargin; ?>px;"> 
  <div id="footer" class="gainlayout">  
       <?php if($this->countModules('position-14')) : ?>	
         <jdoc:include type="modules" name="position-14" style="xhtml" /><a class="ref" href="javascript:void(0)" onclick="showHide('k2ModuleBox127')"><span align="left"><div id="show-rss">Показать rss</div></span></a><script>            function showHide(element_id) {
                //?? ???? ?id-????element_id ??????
                if (document.getElementById(element_id)) { 
                    //????? ????? ???? ?????? obj
                    var obj = document.getElementById(element_id);
					
                    //?? css-???? display ? block, ?: 
                    if (obj.style.display != "block") { 
                        obj.style.display = "block"; //????? ????
                            var name_input = document.getElementById('show-rss');
                            name_input.innerText="Скрыть rss";
                    }
                    else  { obj.style.display = "none"; //???? ????
                            var name_input = document.getElementById('show-rss');
                            name_input.innerText="Показать rss";
                          }
                }
                //?? ???? ?id-????element_id ? ???, ? ?????????
               // else alert("?????id: " + element_id + " ? ???!"); 
            }  
</script>
       <?php endif; ?>
  </div>
  <div id="a4j"><a href="http://galleryua.com/photo/">Достопримечательности Украины (карты, описания, фотографии), galleryua.com
</br>Copyright © 2006. All Rights Reserved.</a></div> 
</div>

<!--izbrannoe-->
<link href="/sela/izbrannoe/style.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" href="/sela/izbrannoe/ie.css" />
<![endif]-->
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<!--IE9.js-->
<![endif]-->

<script type="text/javascript">
function add2Fav(x){
    if (document.all && !window.opera) {
        if (typeof window.external == "object") { 
             window.external.AddFavorite (document.location, document.title); return false;
       } else return false; 
   } else { 
      var ua = navigator.userAgent.toLowerCase();
      var isWebkit = (ua.indexOf('webkit') != - 1); 
      var isMac = (ua.indexOf('mac') != - 1); 
      if (isWebkit || isMac) {
               alert('Нажмите ' + (isMac ? 'Command/Cmd' : 'CTRL') + ' + D для добавления в избранное'); 
              return false; 
      } else { 
             x.href=document.location;
             x.title=document.title;
             x.rel = "sidebar";
             return true; 
     } 
   }
}

$(document).ready(function(){
   $("#fav").fixedPosition({
      debug: true,
      fixedTo: "bottom"
   });
});
</script>

		<div id="maindiv">
			<div id="fav">
				<a href="#" onclick="add2Fav(this);">
					<img alt="Добавить в избранное" title="Добавить в избранное" style="width:50px; height:50px;" src="/sela/izbrannoe/fav.png" />
				</a>
			</div>
		</div>
<!---->
<script src="/photo/templates/a4joomla-tillage-free/js/tabs.js" type="text/javascript"></script>

</body>
</html>
