
<?php require_once('includes.php'); ?><!DOCTYPE html>

<h3><a name="imennik"></a><?php tr('Именник на българските владетели', 'Namelist of Bulgarian Rullers', 'Namensliste der bulgarischen Rullers', 'Именник болгарских правителей');?> </h3>
<?php if ($lang == 'bg') : ?>
  Именникът на Българските владетели е кратък откъс описваш 
  имената и годините на царуване на Български владетели. 
  Вмъкнат е в книгата &#xab;Елински и римски летописец&#xbb; 
  между първа и трета част без да е отделен от тях.
  Известни са три преписа които съдържат именника 
  - Уваров, Погодинов и Московски, между които има 
  известна разлика в транскрипцията на имената. 
  <br/><br/>
  Тъй като съдържа годините ( и месеците) на възкачване
  на владетелите изразени с древните им български имена, именникът е станал 
  основа за множество изследвания върху календара на древните българи.
<?php elseif ($lang == 'en') : ?>
  The Namelist of Bulgarian Rulers is a brief excerpt describing 
  the names and years of the reign of the Bulgarian rulers. 
  Inserted in the book &#xab;Hellenistic and Roman chronicler&#xbb;
  between the first and third part without being separated from them. 
  There are three transcripts that contain the namelist.
  They are referred as Uvarov, Pogodinov and Moscow, Uvarov.
  There are small differences in transcription of names between 
  the 3 of them. 

  <br/><br/>
  Because it contains the years (and months) to the accession 
  of rulers and expresses their names with the ancient Bulgarian, 
  the namelist  has become the basis for numerous studies on 
  the calendar of the ancient Bulgarians.
<?php elseif ($lang == 'de') : ?>
Die Übersetzung ist noch nicht fertig. Um diesen Absatz zu übersetzen, wenden Sie sich bitte an admin [a] bgkalendar.com.  Link zu einer Seite <a href="iztochnici.php?lang=en#imennik">in Englisch</a>.
<?php elseif ($lang == 'ru') : ?>
Перевод еще не готов. Чтобы помочь перевести этот пункт, пожалуйста, свяжитесь с admin [ a ]  bgkalendar.com.  Ссылка на страницу на <a href="iztochnici.php?lang=bg#imennik">болгарском языке.</a>
<?php endif ?>


<br/><br/>

<table>
   <tr>
      <td colspan="2">
          <?php tr('Уваров препис от 15<sup>-ти</sup> век', 'Uvarov transcript from 15<sup>-th</sup> Century', 'Uwarow-Transkript aus dem 15. Jahrhundert', 'Уваров препись 15<sup>-ого</sup> века');?>
      </td>
   </tr>
   <tr>
      <td class="oldbg" style="text-align: left;" >
          Авитохолъ житъ л&#x0463;т. &#x0483;т. р&#x0461;д ему Дуло. 
          а л&#x0463;т ему дил&#x0461;мъ твирем. <br/>
          Ирникъ. житъ л&#x0463;т. &#x0483;ри. р&#x0461;д ему Дуло.
          а л&#x0463;т ему дилом твиремь. <br/>
          Гостунъ наместникъ сь&#x0457; два л&#x0463;та. р&#x0461;д ему. Ерми.
          а л&#x0463;т рму дохсъ. втиремь. <br/>
          Курт: &#x0483;&#x046F; л&#x0463;т дръжа. р&#x0461;д ему Дуло. 
          а л&#x0463;т ему шегоръ вечемь. <br/>
          Безмеръ &#x0483;г л&#x0463;т. а р&#x0461;д сему Дуло. 
          а л&#x0463;т ему шегоръ вемь.<br/><br/>

          c&#x0456;&#x0456; &#x0483;е кн&#x0467;з. дръжаше 
          кн&#x0467;жен&#x0457;е обонъ страну Дуна&#x0467;. 
          л&#x0463;т &#x0483;ф &#x0483;е&#x0456; 
          <br/>остриженами главами.<br/> 
          И пот&#x0461;м пр&#x0456;иде на страну Дуна&#x0467;. 
          Исперих кн&#x0467;з тожде и дoсел&#x0463;. <br/><br/>  

          Есперих кн&#x0467;з. &#x046F;&#x0483;а л&#x0463;т р&#x0461;д Дуло.
          а л&#x0463;т ему верени алем. <br/>
          Тервен. к&#x0483;а. л&#x0463;то. р&#x0461;д ему Дуло.
          а л&#x0463;т ему текучитем. <br/>
          твирем. к&#x0483;и. л&#x0463;т. р&#x0461;д ему Дуло, а л&#x0463;тему дваншехтем. <br/>
          Севаръ. е&#x0483;&#x0456;. л&#x0463;т. р&#x0461;д ему Дуло. 
          а л&#x0463;т ему тохалтом. <br/>
          Кормисошь. з&#x0483;&#x0456;. л&#x0463;т. р&#x0461;д ему Вокиль. 
          а л&#x0463;т ему шегоръ твиремь. <br/><br/>

          С&#x0457;и же княз изм&#x0463;ни 
          р&#x0461;д Дулов. рекше Вихтунь. <br/><br/>
          Винех. &#x0483;з. л&#x0463;т. а р&#x0461;д ему Оуколь. 
          а л&#x0463;т ему имашегоралемь. <br/>
          Телець. &#x0483;г. л&#x0463;та. р&#x0461;д Оугаинь.
          а л&#x0463;т ему соморъ. алтемь.<br/>
          И с&#x0457;и иного рад. <br/>
          Оуморъ. &#x0483;м. дн&#x0457;и. р&#x0461;д ему Оукиль а ему 
          дил&#x0461;м тоут&#x0461;м. <br/>
          
          
      </td>
<?php if ($lang != 'bg') : ?>
      <td class="transl" style="text-align: left;" >
        <?php include('iztochnici-imennik-translate.php');?>
      </td>
   </tr>
   <tr>
<?php endif ?>
      <td class="calendartable" style="text-align: center; width: 400px;">
          <a href="images/uvarov.jpg">
          <img width="400" src="images/uvarov.jpg" />
          </a><br/>
          <?php tr('Оригинал', 'Original', 'Original', 'Оригиналь');?><br/>
          <?php tr('Уваровского собрания № 10, лист 69, оборот 70.', "Uvarov's transcript № 10, sheet 69, turnover 70.", 'Uwarow Collection No. 10, Blatt 69, Umsatz 70.', 'Уваровского собрания № 10, лист 69, оборот 70.');?>
      </td>
   </tr>
   <tr>
      <td colspan="2">
          <br/><br/>
          <?php tr('Погодинов препис от 16<sup>-ти</sup> век', "Pogodin's transcript from 16<sup>-th</sup> century", 'Pogodinow - Transkript aus dem 16. Jahrhundert', 'Погодинов препись 16<sup>-ого</sup> века');?>
      </td>
   </tr>
   <tr>
      <td class="oldbg" style="text-align: left;">
          Авитохолъ житъ л&#x0463;т &#x0483;т. родъ рму дуло.
          а л&#x0463;т ему. диломтвиремъ.<br/>
          &#x0301;Ирникъ. житъ л&#x0463;т 
          &#x0483;р и&#x0301; &#x0483;и л&#x0463;т. род ему дуло
          а л&#x0463;т ему диломътвиремъ. <br/>
          Гостунь нам&#x0463;стникъ сь&#x0457;. 
          &#x0483;в. л&#x0463;та. род &#x0451;му е&#x0301;рми. 
          а л&#x0463;т ему дохсъ втиремъ. <br/>
          Куртъ &#x0483;&#x046F; л&#x0463;т дръжа. род ему дуло.
          а л&#x0463;т &#x0451;му. шегоръвечем <br/>
          Безм&#x0463;ръ. &#x0483;г. л&#x0463;та. а род семоу дуло.
          а л&#x0463;т е&#x0301;му шегоръв&#x0463;чемъ. <br/><br/>

          с&#x0457;&#x0301;и &#x0483;&#x0454;. кн&#x0483;зь дръжаше 
          кн&#x0467;жен&#x0457;е&#x0301; &#x0461;б ону 
          страну дуна&#x0467;.  
          л&#x0463;т &#x0483;ф и&#x0301; &#x0454;&#x0303;&#x0456;. <br/>
          &#x0461;стриженами главами. <br/>и потом 
          пр&#x0457;и&#x0301;де
          на страну дуна&#x0467; И&#x0301;сперих кн&#x0483;зь 
          тожде и&#x0301; до сел&#x0463; <br/> <br/>

          &#x0401;сперерих кн&#x0483;зь. &#x0483;&#x046F; и 
          &#x0461;дино л&#x0463;то. род дуло. 
          а л&#x0463;т &#x0451;му верениа&#x0301;лемъ. <br/>
          Тервель. &#x0483;к и&#x0301; &#x0483;а л&#x0463;тто род 
          е&#x0301;му дуло. 
          а л&#x0463;т е&#x0301;му текучитемъ <br/>
          Твиремъ. &#x0483;к. и&#x0301; &#x0483;и. л&#x0463;т. 
          род е&#x0301;му дуло.
          а л&#x0463;т е&#x0301;му дв&#x030F;аншехтемъ <br/>
          Севаръ &#x0454;&#x0303;&#x0456; л&#x0463;т род е&#x0301;му дуло.
          а л&#x0463;т е&#x0301;му. тохалтомъ <br/>
          Кормисошь. з&#x0303;&#x0456;. л&#x0463;т род е&#x0301;му
          вокилъ. 
          а л&#x0463;т &#x0451;му. шегорътвиримъ. <br/><br/>
         
          С&#x0457;и&#x0301;же кн&#x0483;зь изм&#x0463;ни род 
          дуловъ рекше вихтунь                    <br/><br/>

          Винех. &#x0483;з л&#x0463;т а род е&#x0301;му оукиль 
          а л&#x0463;т &#x0451;му им&#x0467;шегоралемъ. <br/>
          Телецъ &#x0483;г л&#x0463;т. род &#x0451;му 
          оугаи&#x0301;нъ
          a л&#x0463;т ему соморъалтемъ.
          И с&#x0457;и&#x0301; и&#x0301;ного рад <br/>
          Oуморъ &#x0483;м дн&#x0483;&#x0457;и&#x0301; 
          род е&#x0301;му оу&#x0301;киль. л&#x0301; е&#x0301;му
          диломтоутомъ. <br/>
      </td>
<?php if ($lang != 'bg') : ?>
      <td class="transl" style="text-align: left;" >
        <?php include('iztochnici-imennik-translate.php');?>
      </td>
   </tr>
   <tr>
<?php endif ?>
      <td class="calendartable" style="text-align: center;">
          <a href="images/pogodinov.jpg">
          <img width="400" src="images/pogodinov.jpg" />
          </a><br/>
          <?php tr('Оригинал', 'Original', 'Original', 'Оригиналь');?> <br/>
          <?php tr('Съхранява се в Петроградската обществена библиотека под № 1437, лист 72а-73.', 'It is kept in the public library in Petrograd as № 1437, sheet 72a-73.', 'Es wird in der öffentlichen Bibliothek in Petrograd als Nr. 1437, Blatt 72a-73 aufbewahrt.', 'Хранится в публичной библиотеке в Петрограде по состоянию на 1437, лист 72а-73.');?>
      </td>
   </tr>
   <tr>
      <td colspan="2">
          <br/><br/>
          <?php tr('Московски препис от 16<sup>-ти</sup> век', 'Transcript from Moscow from  16<sup>-th</sup> century', 'Moskauer Transkript des 16. Jahrhundert', 'Московский препись 16<sup>-ого</sup> века'); ?>
      </td>
   </tr>
   <tr>
      <td class="oldbg" style="text-align: left;">
      </td>
<?php if ($lang != 'bg') : ?>
      <td class="transl" style="text-align: left;" >
        <?php include('iztochnici-imennik-translate.php');?>
      </td>
   </tr>
   <tr>
<?php endif ?>
      <td class="calendartable" style="text-align: center;">
          <a href="images/moskovski.jpg">
          <img width="400" src="images/moskovski.jpg" />
          </a><br/>
          <?php tr('Оригинал', 'Original', 'Original', 'Оригиналь');?> <br/>
          <?php tr('Съхранява се в Московската синодална библиотека под № 280, лист 68а-69.', 'It is kept in the synodal library in Moscow as № 280, sheet 68a-69.', 'Es wird in der Moskauer Synoidalbibliothek unter Nr. 280, Blatt 68 a-69 aufbewahrt.', 'Хранится в Московской синоидальной библиотеке no 280, лист 68 а-69.'); ?>
      </td>
   </tr>
</table>

<br/>
<br/>
<br/>
<a name="numeric"></a>
<?php if ($lang == 'bg') : ?>
Таблица за преобразуване на числови стойности изразени с кирилски букви към 
съвременен запис на числата с арабски цифри.
<?php elseif ($lang == 'en') : ?>
Table for conversoin from number values represented as cyrillic letters 
to modern representation of the numbers with arabic digits.
<?php elseif ($lang == 'de') : ?>
Tabelle zum Konvertieren numerischer Werte in kyrillischen Buchstaben in
Eine zeitgenössische Zahlenaufzeichnung mit arabischen Ziffern.
<?php elseif ($lang == 'ru') : ?>
Таблица для преобразования численных значений, выраженных в кириллических буквах, в
Современный запись чисел с арабскими цифрами.
<?php endif ?>


<table class="calendartable">
   <tr class="calendartable">
      <td class="calendartable" style="text-align: center; font-weight: bold;" colspan="4"><?php tr('единици', 'units', 'Einheiten', 'единиц'); ?> </td>
      <td rowspan="11"> &nbsp; </td> 
      <td class="calendartable" style="text-align: center; font-weight: bold;" colspan="4"><?php tr('десетици', 'tenths', 'Dutzende', 'десятки');?> </td>
      <td rowspan="11"> &nbsp; </td> 
      <td class="calendartable" style="text-align: center; font-weight: bold;" colspan="4"><?php tr('стотици', 'hundreds', 'Hunderte', 'сотни');?> </td>
      <td rowspan="11"> &nbsp; </td> 
      <td class="calendartable" style="text-align: center; font-weight: bold;" colspan="4"><?php tr('други', 'others', 'andere', 'другие'); ?> </td>
   </tr>
   <tr class="calendartable">
      <td class="calendartable"><?php tr('стойност', 'value', 'Wert', 'значение');?></td>
      <td class="calendartable"><?php tr('Буква', 'letter', 'Wert', 'письмо');?></td>
      <td class="calendartable" colspan="2"><?php tr('Наименование', 'name', 'Name', 'имя');?></td> 
      <td class="calendartable"><?php tr('стойност', 'value', 'Wert', 'значение');?></td>
      <td class="calendartable"><?php tr('Буква', 'letter', 'Wert', 'письмо');?></td>
      <td class="calendartable" colspan="2"><?php tr('Наименование', 'name', 'Name', 'имя');?></td> 
      <td class="calendartable"><?php tr('стойност', 'value', 'Wert', 'значение');?></td>
      <td class="calendartable"><?php tr('Буква', 'letter', 'Wert', 'письмо');?></td>
      <td class="calendartable" colspan="2"><?php tr('Наименование', 'name', 'Name', 'имя');?></td> 
      <td class="calendartable"><?php tr('стойност', 'value', 'Wert', 'значение');?></td>
      <td class="calendartable"><?php tr('Буква', 'letter', 'Wert', 'письмо');?></td>
      <td class="calendartable" colspan="2"><?php tr('Наименование', 'name', 'Name', 'имя');?></td> 
      </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">1 </td>
      <td class="oldbg" style="text-align: center;"> а </td>
      <td class="oldbg" style="text-align: left;"> азъ </td>
      <td class="name"  style="text-align: left;">az</td>
      <td class="calendartable">10 </td>
      <td class="oldbg" style="text-align: center;"> &#x0457; </td>
      <td class="oldbg" style="text-align: left;"> &#x0457;жеи </td>
      <td class="name"  style="text-align: left;">zhei</td>
      <td class="calendartable">100 </td>
      <td class="oldbg" style="text-align: center;"> р </td>
      <td class="oldbg" style="text-align: left;"> рьци </td>
      <td class="name"  style="text-align: left;">rtsi</td>
      <td class="calendartable"></td>
      <td class="oldbg" style="text-align: center;"> </td>
      <td class="oldbg" style="text-align: left;"> </td>
      <td class="name"  style="text-align: left;"> </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">2 </td>
      <td class="oldbg" style="text-align: center;"> в </td>
      <td class="oldbg" style="text-align: left;"> в&#x0463;д&#x0463; </td>
      <td class="name"  style="text-align: left;">vedi</td>
      <td class="calendartable">20 </td>
      <td class="oldbg" style="text-align: center;"> к </td>
      <td class="oldbg" style="text-align: left;"> како </td>
      <td class="name"  style="text-align: left;">kako</td>
      <td class="calendartable">200 </td>
      <td class="oldbg" style="text-align: center;"> с</td>
      <td class="oldbg" style="text-align: left;"> слово </td>
      <td class="name"  style="text-align: left;">slovo</td>
      <td class="calendartable"></td>
      <td class="oldbg" style="text-align: center;"> </td>
      <td class="oldbg" style="text-align: left;">  </td>
      <td class="name"  style="text-align: left;"> </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">3 </td>
      <td class="oldbg" style="text-align: center;"> г </td>
      <td class="oldbg" style="text-align: left;"> глаголи </td>
      <td class="name"  style="text-align: left;"> glagoli </td>
      <td class="calendartable">30 </td>
      <td class="oldbg" style="text-align: center;"> л </td>
      <td class="oldbg" style="text-align: left;"> люди&#x0465; </td>
      <td class="name"  style="text-align: left;"> ljudi </td>
      <td class="calendartable">300 </td>
      <td class="oldbg" style="text-align: center;"> т</td>
      <td class="oldbg" style="text-align: left;"> тврьдо </td>
      <td class="name"  style="text-align: left;"> tverdo </td>
      <td class="calendartable"> </td>
      <td class="oldbg" style="text-align: center;"> </td>
      <td class="oldbg" style="text-align: left;"> </td>
      <td class="name"  style="text-align: left;"> </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">4 </td>
      <td class="oldbg" style="text-align: center;"> д </td>
      <td class="oldbg" style="text-align: left;"> добро </td>
      <td class="name"  style="text-align: left;"> dobro </td>
      <td class="calendartable">40 </td>
      <td class="oldbg" style="text-align: center;"> м </td>
      <td class="oldbg" style="text-align: left;"> м&#x044b;слит&#x0454; </td>
      <td class="name"  style="text-align: left;"> mislete </td>
      <td class="calendartable">400 </td>
      <td class="oldbg" style="text-align: center;"> &#x0479;</td>
      <td class="oldbg" style="text-align: left;"> &#x0479;къ </td>
      <td class="name"  style="text-align: left;"> uk </td>
      <td class="calendartable">400 </td>
      <td class="oldbg" style="text-align: center;"> &#x0475;</td>
      <td class="oldbg" style="text-align: left;"> &#x0475;жица </td>
      <td class="name"  style="text-align: left;"> izhitsa </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">5 </td>
      <td class="oldbg" style="text-align: center;"> &#x0454; </td>
      <td class="oldbg" style="text-align: left;"> &#x0454;сть </td>
      <td class="name"  style="text-align: left;"> jest </td>
      <td class="calendartable">50 </td>
      <td class="oldbg" style="text-align: center;"> н </td>
      <td class="oldbg" style="text-align: left;"> нашь </td>
      <td class="name"  style="text-align: left;"> nash </td>
      <td class="calendartable">500 </td>
      <td class="oldbg" style="text-align: center;"> ф</td>
      <td class="oldbg" style="text-align: left;"> фрьтъ </td>
      <td class="name"  style="text-align: left;"> fert </td>
      <td class="calendartable">400 </td>
      <td class="oldbg" style="text-align: center;"> &#x0477;</td>
      <td class="oldbg" style="text-align: left;"> &#x0477;жица </td>
      <td class="name"  style="text-align: left;"> vzhitsa </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">6 </td>
      <td class="oldbg" style="text-align: center;"> &#x0455; </td>
      <td class="oldbg" style="text-align: left;"> &#x0455;&#x0463;л&#x0461; </td>
      <td class="name"  style="text-align: left;"> dzelo</td>
      <td class="calendartable">60 </td>
      <td class="oldbg" style="text-align: center;"> &#x046F; </td>
      <td class="oldbg" style="text-align: left;"> &#x046F;и, кси </td>
      <td class="name"  style="text-align: left;"> ksi </td>
      <td class="calendartable">600 </td>
      <td class="oldbg" style="text-align: center;"> х</td>
      <td class="oldbg" style="text-align: left;"> х&#x0463;ръ </td>
      <td class="name"  style="text-align: left;"> kher</td>
      <td class="calendartable"></td>
      <td class="oldbg" style="text-align: center;"> </td>
      <td class="oldbg" style="text-align: left;"> </td>
      <td class="name"  style="text-align: left;"> </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">7 </td>
      <td class="oldbg" style="text-align: center;"> з </td>
      <td class="oldbg" style="text-align: left;"> земл&#x0463; </td>
      <td class="name"  style="text-align: left;"> zemlja</td>
      <td class="calendartable">70 </td>
      <td class="oldbg" style="text-align: center;"> о</td>
      <td class="oldbg" style="text-align: left;"> онъ </td>
      <td class="name"  style="text-align: left;"> on</td>
      <td class="calendartable">700 </td>
      <td class="oldbg" style="text-align: center;"> &#x0471;</td>
      <td class="oldbg" style="text-align: left;"> &#x0471;и, пси</td>
      <td class="name"  style="text-align: left;"> psi</td>
      <td class="calendartable"> </td>
      <td class="oldbg" style="text-align: center;"> </td>
      <td class="oldbg" style="text-align: left;"> </td>
      <td class="name"  style="text-align: left;"></td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">8 </td>
      <td class="oldbg" style="text-align: center;"> и </td>
      <td class="oldbg" style="text-align: left;"> иже </td>
      <td class="name"  style="text-align: left;"> izhe </td>
      <td class="calendartable">80 </td>
      <td class="oldbg" style="text-align: center;"> п </td>
      <td class="oldbg" style="text-align: left;"> покои </td>
      <td class="name"  style="text-align: left;"> pokoj</td>
      <td class="calendartable">800 </td>
      <td class="oldbg" style="text-align: center;"> &#x0461;</td>
      <td class="oldbg" style="text-align: left;"> &#x0461;тъ</td>
      <td class="name"  style="text-align: left;"> oht</td>
      <td class="calendartable">800 </td>
      <td class="oldbg" style="text-align: center;"> &#x047f;</td>
      <td class="oldbg" style="text-align: left;"> &#x047f;тъ, отъ</td>
      <td class="name"  style="text-align: left;"> wht</td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">9 </td>
      <td class="oldbg" style="text-align: center;"> &#x0473; </td>
      <td class="oldbg" style="text-align: left;"> &#x0473;ита, тита </td>
      <td class="name"  style="text-align: left;"> thita</td>
      <td class="calendartable">90 </td>
      <td class="oldbg" style="text-align: center;"> &#x0481; </td>
      <td class="oldbg" style="text-align: left;"> &#x0481;опа, копа</td>
      <td class="name"  style="text-align: left;"> kopa</td>
      <td class="calendartable">900 </td>
      <td class="oldbg" style="text-align: center;"> ц</td>
      <td class="oldbg" style="text-align: left;"> ци </td>
      <td class="name"  style="text-align: left;"> tsi</td>
      <td class="calendartable">900 </td>
      <td class="oldbg" style="text-align: center;"> &#x0467;</td>
      <td class="oldbg" style="text-align: left;"> &#x0467;съ (малка носовка) </td>
      <td class="name"  style="text-align: left;"> ya, small yus</td>
   </tr>
</table>
<br/>
<br/>
<table class="calendartable" style="border-right-width: 0px;">
   <tr class="calendartable">
      <td class="calendartable" style="text-align: center; font-weight: bold;" colspan="3">хиляди </td>
      <td rowspan="11"> &nbsp; &nbsp; </td>
      <td rowspan="11" style="text-align: left; border-top-width: 0px; border-bottom-width: 0px; border-right-width: 0px;">
           <?php if ($lang == 'bg') : ?>
             Десетки хиляди са се изразявали като се загради съответната 
             буква за единици  
             с кръгче. Например а заградено в кръгче е 10 000. <br/>
             Стотици хиляди - заградено с пунктирно кръгче. <br/>
             Милиони - заграждане в кръгче от вълнички. <br/>
             Стотици милиони - заграждане в кръгче от кръстчета. <br/>
           <?php elseif ($lang == 'en') : ?>
             Tenths of thousands had been represented as the corresponding 
             letter for units surrounded in a cyrcle. 
             For example a surrounded in a cyrcle means 10 000.<br/>
             Hundreds of thousands - corresponding letter surrounded with a dashed cyrcle.<br/>
             Millions - corresponding letter surrounded in a cyrcle with wave lines.<br/> 
             Hundreds of millions - corresponding letter surrounded in a cyrcle of crosses. <br/>
           <?php elseif ($lang == 'de') : ?>
             Zehntausende haben sich mit dem Beifügen des entsprechenden Ausdrucks geäußert Einheitsbuchstabe mit einem Kreis. <br/>
             Hunderttausende - umgeben von einem gepunkteten Kreis. <br/>
             Millionen - im Kreis der Wellen. <br/>
             Hunderte von Millionen - Einfriedung in einem Kreis von Kreuzen. <br/>
           <?php elseif ($lang == 'ru') : ?>
             Десятки тысяч выразились, приложив соответствующий единичное письмо с кругом. Например а, вложенноев вокруг равно 10000. <br/>
             Сотни тысяч - заключены в пунктирный круг. <br/>
             Миллионы - кружатся в круге волн. <br/>
             Сотни миллионов - вложение в круг крестов. <br/>
           <?php endif ?>
      </td>
   </tr>
   <tr class="calendartable">
      <td class="calendartable"><?php tr('стойност', 'value', '', '');?> </td>
      <td class="calendartable"><?php tr('Буква', 'letter', '', '');?></td>
      <td class="calendartable"><?php tr('Наименование', 'name', '', '');?></td> 
      </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">1 000 </td>
      <td class="oldbg" style="text-align: center;"> &#x0482;а </td>
      <td class="oldbg" style="text-align: left;" rowspan="9"> </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">2 000 </td>
      <td class="oldbg" style="text-align: center;"> &#x0482;в </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">3 000</td>
      <td class="oldbg" style="text-align: center;"> &#x0482;г </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">4 000</td>
      <td class="oldbg" style="text-align: center;"> &#x0482;д </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">5 000</td>
      <td class="oldbg" style="text-align: center;"> &#x0482;&#x0454; </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">6 000</td>
      <td class="oldbg" style="text-align: center;"> &#x0482;&#x0455; </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">7 000</td>
      <td class="oldbg" style="text-align: center;"> &#x0482;з </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">8 000</td>
      <td class="oldbg" style="text-align: center;"> &#x0482;и </td>
   </tr>
   <tr class="oldbg">
      <td class="calendartable">9 000</td>
      <td class="oldbg" style="text-align: center;"> &#x0482;&#x0473; </td>
   </tr>
</table>
<br/>
