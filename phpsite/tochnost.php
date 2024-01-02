<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <link rel="stylesheet" type="text/css" href="navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar.css" /> 
   <title>Българският календар</title>
   <style>
    .tochnosttbl
    {
      border-collapse: collapse;
    }
    .tochnosttblhdr
    {
      vertical-align: top;
      border-collapse: collapse;
      border-width: 1px;
      border-color: blue;
      border-style: solid;
      vertical-align: top;
      text-align: right;
      padding-left: 0.5em;
      padding-right: 0.5em;
    }
    .tochnosttblrow
    {
      vertical-align: top;
      border-collapse: collapse;
      border-width: 1px;
      border-color: blue;
      border-style: solid;
      vertical-align: top;
      text-align: right;
    }
    .tochnosttbldata
    {
      vertical-align: top;
      border-collapse: collapse;
      border-width: 1px;
      border-color: blue;
      border-style: solid;
      vertical-align: top;
      text-align: right;
    }

   </style>
<title>Точност на българският календар</title>
</head>
<body class="calendarbody">
<?php include('navigation.php');?>
<p>
<ul>
  <li><a href="#tochnost">Точност на календара</a>
  <ul>
    <li><a href="#julianski">Юлиански Календар</a></li>
    <li><a href="#grigorianski">Григориански Каленар</a></li>
    <li><a href="#bulgarski">Древен Български Каленар</a></li>
    <li><a href="#obobshtenie">Обобщение</a></li>
  </ul>
</li>
</ul>
<a name="tochnost"><h1>Точност на календара</h1></a>
Твърди се, че Българският Календар е най-точният в света. Това е също и становището на ЮНЕСКО от 1976-та година.
Дали обаче това наистина е така. Нека проверим. 
<br/><br/>
За целта, ще сравним Древния Български Календар с 
<a href="https://bg.wikipedia.org/wiki/%D0%AE%D0%BB%D0%B8%D0%B0%D0%BD%D1%81%D0%BA%D0%B8_%D0%BA%D0%B0%D0%BB%D0%B5%D0%BD%D0%B4%D0%B0%D1%80">юлианския календар</a> 
и григорианския календар.
<br/><br/>
Ще определяме точността на календара като сравняваме средната продължителност на годината с продължителността на така нареченатта 
астрономическа тропическа година - времето за което земята прави една пълна обиколка около слънцето - 
от зимно слънцестоене, до зимно слънцестоене.
<br/><br/>
За целите на календарните системи, стойнотта на астрономическатата тропична година се приема за 365,2422 дена или това се равнява на 
365 дена, 5 часа, 48 минути 46 секунди и 8 стотни от секундата.
Източник - <a href="https://www.grc.nasa.gov/www/k-12/Numbers/Math/Mathematical_Thinking/calendar_calculations.htm#:~:text=The%20tropical%20year%20is%20the%20period%20of%20time,to%20keep%20track%20of%20seasons%2C%20planting%2C%20and%20harvesting.">НАСА - Календарни изчисления</a>
<br/><br/>
<div style="border: 1px solid darkgray; border-radius: 1em; background-color: rgb(200,200,200, 0.5); padding: 1em;">
  <span style="font-size: small">
  (<i>Забележка: Астрономически погледнато съвременната наука изчислява тропическата година между 8 000 г. пр. Хс и 12000 г. след Хс по формулата: </i><br/>  <br/>

  365,242 189 669 800 - 6,153 590 ✕ 10<sup>-6</sup>Т - 7,290 ✕ 10<sup>-10</sup>Т<sup>2</sup> + 2,640 ✕ 10<sup>-10</sup>Т<sup>3</sup><br/><br/>

  <i>където</i> Т <i>е броят на изминалите столетия от по 365,25 дена, всеки от по 86 400 <a href="https://bg.wikipedia.org/wiki/%D0%A1%D0%B5%D0%BA%D1%83%D0%BD%D0%B4%D0%B0">секунди</a> (по ситемата 
  <a href="https://bg.wikipedia.org/wiki/%D0%9C%D0%B5%D0%B6%D0%B4%D1%83%D0%BD%D0%B0%D1%80%D0%BE%D0%B4%D0%BD%D0%B0_%D1%81%D0%B8%D1%81%D1%82%D0%B5%D0%BC%D0%B0_%D0%B5%D0%B4%D0%B8%D0%BD%D0%B8%D1%86%D0%B8">СИ</a>)
  изминали от 1<sup>-ви</sup> Януари 2000 година.<br/>
  Както виждате астрономически тропическата година непрекъснато намалява - става по кратка, но с много бавни темпове.
  <a href="https://en.wikipedia.org/wiki/Tropical_year#Mean_tropical_year_current_value">Източник</a></i>.)
</span>
</div>
<br/><br/>


<a name="julianski"><h2>Юлиански Календар</h2></a>
При юлианския календар имаме (невисокосна) година от 365 дена, като на всеки 4 години (когато номерът на годината се дели на 4 без остатък) 
годината става високосна от 366 дена, като допълнителният 366<sup>-ти</sup> ден се добавя като допълнителен 29<sup>-ти</sup> ден на месец Февруари.

<br/><br/>
Така се получава следната средна продължителност на юлианската година:
<br/><br/>
<div style="display: flex;">

<div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
365 + &nbsp; &nbsp;
</div>

<div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
  <div style="display: inline-block;"> 4</div>
</div>

<div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
&nbsp; &nbsp; = 365,25 дена
</div>

</div>

Така се получава, че средната продължителност на годината при юлианския календар (365,25 дена) е по-голяма от 
средната продължителност на тропическата година (365,2422 дена) с около 0,0078 дена.
Това отклонение е 11 минути, 13 секунди и 92 стотни от секундата. Така отклонение от един ден се натрупва за 129 години.
Това е била причината и при няколко стотин години прилагане на юлианския календар да бъде заменен с григорианския календар.

<a name="grigorianski"><h2>Григориански Календар</h2></a>
Григорианския календар е подобен на юлианския, но с две допълнителни правила за високосните години: 
<ul>
  <li>ако годината се дели на 4 (без остатък) е високосна</li>
  <li>ако обаче се дели на 100 (без остатък), не е високосна</li>
  <li>ако въпреки това се дели на 400 (без остатък) е все пак високосна</li>
</ul>
Правилата се прилагат подред и последното, печели с с предимство пред останалите.

Така за средната продължителност на григорианската година получаваме: 

<br/><br/>
Така се получава следната средна продължителност на григорианска година:
<br/><br/>
<div style="display: flex;">
  
  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365 + &nbsp; &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 4</div>
  </div>


  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 100</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; + &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 400</div>
  </div>


  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; &nbsp; =  
  </div>

</div><br/>
<div style="display: flex;">

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365 + 0,25 - &nbsp; 
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 100</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; + &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 400</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; &nbsp; =  
  </div>

</div><br/>
<div style="display: flex;">

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365 + 0,25 - 0,01 + &nbsp; 
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 400</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; &nbsp; =  
  </div>
	
</div><br/>
<div style="display: flex;">

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365 + 0,25 - 0,01 + 0,0025 =  
  </div>

</div><br/>
<div style="display: flex;">

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365,2425 дена  
  </div>


</div>

Тук приближението е по-добро. Но все пак григорианската година (365,2425 дена) е по дълга от тропическата година (365,2422 дена) с около 0,0003 дена. 
Това се равнява на 25 секунди и 92 стотни от секундата. Отклонение от цял ден би се натрупало след 3 334 години.

<a name="bulgarski"><h2>Древен Български Календар</h2></a>
Нака видим каква е средната продължителност на годината на Древния Български Календар <a href="kalendar-bg.php">при така направеният модел</a>.
При него имаме следните правила: 
<ul>
   <li>на всеки 4 години се добавя високосен ден (31<sup>-ви</sup> ден от Шести месец по Дреяния Български Календар). Виж <a href="kalendar-bg.php#godina">Структура на годината</a> и <a href="kalendar-bg.php#4g">четиригодишен период</a></li>	
   <li>на всеки 420 години се отнемат 3 високосни дена, съответно на 60<sup>-тата</sup>, 180<sup>-тата</sup> и 300<sup>-ната</sup> година. Виж <a href="kalendar-bg.php#60g">звезден ден</a> и <a href="kalendar-bg.php#420g">звездна седмица</a>.</li>
   <li>на всеки 1 680 години се отнема 1 високосен ден. Виж <a href="kalendar-bg.php#1680g">звезден месец</a>.</li>
   <li>на всеки 2 160 години се отнема 1 високосен ден. Виж <a href="kalendar-bg.php#2160g">звездна година</a>.</li>
   <li>на всеки 80 640 години се отнама 1 високосен ден. Виж <a href="kalendar-bg.php#80640g">период от четири звездни години</a>.</li>
   <li>на всеки 10 080 000 години не се отнема високосен ден. Виж <a href="kalendar-bg.php#10080000g">Звездна епоха</a>.</li>
</ul>	

Нека изчислим средната продължителкност на Древната Българска година:

<br/><br/>
<div style="display: flex;">
  
  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365 + &nbsp; &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 4</div>
  </div>


  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 3</div><br/>
    <div style="display: inline-block;"> 420</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 1680</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 20160</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 80640</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; + &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 10080000</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; &nbsp; =  
  </div>

</div><br/>
Разлагаме знаменателите на прости множители
<div style="display: flex;">
  
  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365 + &nbsp; &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 2<sup>2</sup></div>
  </div>


  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 3</div><br/>
    <div style="display: inline-block;"> 2<sup>2</sup>.3.5.7</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 2<sup>4</sup>.3.5.7</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 2<sup>6</sup>.3<sup>2</sup>.5.7</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 2<sup>8</sup>.3<sup>2</sup>.5.7</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; + &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 2<sup>8</sup>.3<sup>2</sup>.5<sup>4</sup>.7</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; &nbsp; =  
  </div>

</div><br/>

Най-малкото общо кратно е  2<sup>8</sup>.3<sup>2</sup>.5<sup>4</sup>.7 = 10080000.<br/><br/>

Привеждаме под общ занаменатал и получаваме:<br/><br/>

<div style="display: flex;">
  
  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365 + &nbsp; &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1 . 2 520 000</div><br/>
    <div style="display: inline-block;"> 10080000</div>
  </div>


  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 3 . 24 000</div><br/>
    <div style="display: inline-block;"> 10080000</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1 . 6 000</div><br/>
    <div style="display: inline-block;"> 10080000</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1 . 500 </div><br/>
    <div style="display: inline-block;"> 10080000</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; - &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1 . 125 </div><br/>
    <div style="display: inline-block;"> 10080000</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; + &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 1</div><br/>
    <div style="display: inline-block;"> 10080000</div>
  </div>

  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  &nbsp; &nbsp; =  
  </div>

</div><br/>

което е 

<div style="display: flex;">
  
  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365 + &nbsp; &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 2 441 376</div><br/>
    <div style="display: inline-block;"> 10080000</div>
  </div>

</div><br/>

Делим числителя и знаменателя на 1 008 и получаваме:

<div style="display: flex;">
  
  <div style="height: 2.5em; width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
  365 + &nbsp; &nbsp;
  </div>

  <div style="height: .5width: fit-content; border: 0px solid blue; display: grid; align-items: center;">
    <div style="border-bottom: 1px solid black; display: inline-block;"> 2 422</div><br/>
    <div style="display: inline-block;"> 10 000</div>
  </div>
</div><br/>

Тук дробната част се равнява на точно 2 422 (две хиляди, четиристотин двайсет и две) десетохилядни, което като десетична дроб е 0,2422. 

Така получаваме за средната продължителност на годината: 365,2422 дена. 

Отклонението от тропическата година е нулево и никога не би се натрупало.<br/><br/>

<div style="border: 1px solid darkgray; border-radius: 1em; background-color: rgb(200,200,200, 0.5); padding: 1em;">
  <span style="font-size: small">
В някои источници стойността, която се приема за тропическа година, не е 365,2422 денонощия, а 365,24219 денонощия. 
Дори при такова приемане отклонението би било едва 0,00001 (една стохилядна от денонощието - 86 стотни от секундата) и отклонение от един ден би се натрупало за 100 000 години, което е точност поне 30 пъти по добра от григорианския календар. 
</span>
</div>


<a name="obobshtenie"><h2>Обобщение</h2></a>

<table class="tochnosttbl" >
  <tr class="tochnosttblrow" style="border-left: 0px; border-top: 0px;">
    <td class="tochnosttblhdr" rowspan="2" style="border-top: 0px; border-left: 0px; border-top: 0px;">&nbsp;</th>
    <th class="tochnosttblhdr" rowspan="2">година в дни</th>
    <th class="tochnosttblhdr" rowspan="2">отклонение в дни</th>
    <th class="tochnosttblhdr" colspan="4">отклонение</th>
    <th class="tochnosttblhdr" rowspan="2">натрупване на отклонение <br/>от един ден за (години)</th>
  </tr>
  <tr class="tochnosttblrow" style="border-left: 0px;">
    <th class="tochnosttblhdr">часове</th>
    <th class="tochnosttblhdr">минути</th>
    <th class="tochnosttblhdr">секунди</th>
    <th class="tochnosttblhdr">стотни</th>
  </tr>
  <tr class="tochnosttblrow">
    <th class="tochnosttblhdr" align="left">Тропична година</th>
    <td class="tochnosttbldata">365,242 190 419</td>
    <td class="tochnosttbldata" align="center">-</td>
    <td class="tochnosttbldata" align="center">-</td>
    <td class="tochnosttbldata" align="center">-</td>
    <td class="tochnosttbldata" align="center">-</td>
    <td class="tochnosttbldata" align="center">-</td>
    <td class="tochnosttbldata" align="center">-</td>     
  </tr>
  <tr class="tochnosttblrow">
    <th class="tochnosttblhdr" align="left">Юлиански Календар</th>
    <td class="tochnosttbldata">365,25</td>
    <td class="tochnosttbldata">0,007 809 581</td>
    <td class="tochnosttbldata" align="center">-</td>
    <td class="tochnosttbldata">11</td>
    <td class="tochnosttbldata">13</td>
    <td class="tochnosttbldata">92</td>
    <td class="tochnosttbldata" align="right">129 години</td>     
  </tr>
  <tr class="tochnosttblrow">
    <th class="tochnosttblhdr" align="left">Григориански Календар</th>
    <td class="tochnosttbldata">365,2425</td>
    <td class="tochnosttbldata">0,000 309 581</td>
    <td class="tochnosttbldata" align="center">-</td>
    <td class="tochnosttbldata" align="center">-</td>
    <td class="tochnosttbldata">~25</td>
    <td class="tochnosttbldata">~92</td>
    <td class="tochnosttbldata" align="right">3 334 години</td>     
  </tr>
  <tr class="tochnosttblrow">
    <th class="tochnosttblhdr" align="left">Древен Български Календар</th>
    <td class="tochnosttbldata">365,2422</td>
    <td class="tochnosttbldata">~0</td>
    <td class="tochnosttbldata" align="center">~0</td>
    <td class="tochnosttbldata" align="center">~0</td>
    <td class="tochnosttbldata" align="center">~0</td>
    <td class="tochnosttbldata" align="center">~0</td>
    <td class="tochnosttbldata" align="center">-</td>     
  </tr>
</table>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
</body>
</html>
