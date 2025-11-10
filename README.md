Welcome to the Bulgarian Calendar Project
=========================================

<!-- Please use markdown-toc -i README.md to update the table of contents -->
<!-- -->
**Table of Contents**  *generated with [Markdown-TOC](https://www.npmjs.com/package/markdown-toc#install)*

<!-- toc -->

  * [What is the Ancient Bulgarian Calendar](#what-is-the-ancient-bulgarian-calendar)
- [Java Library](#java-library)
- [PHP Library and Web Site](#php-library-and-web-site)
- [Gregorian and Julian Calendar](#gregorian-and-julian-calendar)
- [Ancient Bulgarain Calendar Principles](#ancient-bulgarain-calendar-principles)
  * [Beginning of the Calendar](#beginning-of-the-calendar)
  * [Structure of the year](#structure-of-the-year)
  * [Cycles for correction of the calendar](#cycles-for-correction-of-the-calendar)
    + [Four year period](#four-year-period)
    + [Twelve year period](#twelve-year-period)
    + [Sixty year period (star day)](#sixty-year-period-star-day)
    + [Four hundred and twenty year period (STAR WEEK)](#four-hundred-and-twenty-year-period-star-week)
    + [Star month](#star-month)
    + [Star year](#star-year)
    + [Period of 4 star years](#period-of-4-star-years)
    + [Star Epoch](#star-epoch)
- [Docker Build](#docker-build)
- [License](#license)

<!-- tocstop -->

What is the Ancient Bulgarian Calendar
--------------------------------------

There have been lots of researches regarding how Ancient Bulgarians have measured 
times and the researches showed that there has been an Ancient Bulgarian calendar 
which has been (according to most researchers) solar based.

This project aims to provide a library and a 
[web-site](http://bgkalendar.com/) for calculation of the 
current year, month and day according to the assumptive Ancient Bulgarian calendar.

Calculation is based on some assumptions. For example when does the calendar 
begin. When is day 1, month 1 from year 1, and others. 

This calendar and library is not to be assumed an extensive research or the 
final source of truth at all.  

Please feel free to obtain/use/modify the code according to your own research. 

Java Library
============

Please get more information [here](https://github.com/bgkalendar/bgkalendar/tree/master/java).

PHP Library and Web Site
========================

Under the `phpsite` sub-directory, you can find a PHP version of the library. 
That makes it easy to use that library in your own PHP Web site. 

We also have a sample site with a main page `phpsite/index.php` and some `css` 
styling and so on. Look at the [`phpsite/kalendar-en.php`](https://github.com/bgkalendar/bgkalendar/blob/master/phpsite/kalendar-en.php) 
for an explanation of the principles of the calendar.

Sample of this site has been installed on [http://bgkalendar.com](http://bgkalendar.com).

Gregorian and Julian Calendar
=============================
Although the primary goal of the project was to calculate the current date based 
on the Ancient Bulgarian calendar, it has been designed in a generic and extendable 
way, so it in fact provides an API and a framework for calculating the date on 
any calendar (not even just solar based calendars). 

Then 3 implementations on top of this API interface has been implemented: 

  - Implementation of the Julian calendar
  - Implementation of the Gregorian calendar (the modern calendar used in European countries)
  - Implementation of the Ancient Bulgarain calendar.

Ancient Bulgarain Calendar Principles
=================================

The Bulgarian calendar is the calendar of the ancient Bulgarians restored from 
written historical data 
[Nominalia of the Bulgarian khans](https://en.wikipedia.org/wiki/Nominalia_of_the_Bulgarian_khans) 
and the folk tales and legends. 
There are studies of various scholars who sometimes quite differ in  
conclusions reached.

Beginning of the Calendar
-------------------------
Most researchers accept the starting point on the 22-nd day of the winter 
solstice (December 21) during the year 5505 BC – in other words, we can assume 
that the first year of the Bulgarian calendar coincides almost completely 
with 5504 BC in the Gregorian calendar.

````
+---------------------------------------+------------------------------+
| .. 20 21 22 23 24 25 26 27 28 29 30 31| 1 2 3 4 5 6 7 8 9 10 11 ...  |
+-------^-------------------------------+------------------------------+
| December 5505 yr. before Christ       | January 5504 yr. before Ch.  |
+-------^-------------------------------+------------------------------+
        |
        |
        +-------------------------------------------------------------+
        |1  2  3  4  5  6  7  8  9 10 11 12           ...             |
        +-------------------------------------------------------------+
        | First Month of the First year of Ancient Bulgarian Calendar |
        +-------------------------------------------------------------+
        ^
        |
        |
        Winter Solar solstice
````

When doing calculations and comparison with the Gregorian and/or Julian calendar, 
please bare in mind that in both Julian and Gregorian calendars there is no zero year - that is to say, 
that 1-st year BC is immediately followed by the 1-st year after Christ.

````
+---------------------------------------+------------------------------+
| .. 20 21 22 23 24 25 26 27 28 29 30 31| 1 2 3 4 5 6 7 8 9 10 11 ...  |
+---------------------------------------+------------------------------+
|        December 1-st year BC          |      January 1 year AC       |
+---------------------------------------+------------------------------+
````

In our calendar model, we have adopted for the start of the calendar to be a year earlier. 
So 21-st of December 5506 BC (Monday according to the Grigorian calendar) was adopted as 
the first day of the Bulgarian calendar.


Structure of the year
---------------------
According to researchers, the year has been divided into 12 months + one or two (in leap years) 
business days, which were beyond the months. Months were grouped in quarters of 3 months. 
First month of each quarter always had 31 days * , and the remaining two months had 30 days. 
So each quarter, there are exactly 91 days or 364 days that makes for four quarters. 
At the end of the year (or at the beginning according to some researchers) there has been 
one additional day that is outside months and was called Eni. 
The analogue of the day Eni is today's Ignazhden (St. Ignatius day), also called `ednazhden`. 
Counting the day Eni, the year had already 365 days. Similar to the Julian and Gregorian 
calendar once on every 4 years additional leap day (midsummer day) was added based on some rules, 
which we would reviw further on. The leap day (midsummer day), just like the day Eni was beyond any month.
It was put after the end of the 6-th month, before the start of the 7-th month. 
The leap day was called Behti. The analogue of the Midsummer day is today's [Enyovden](https://en.wikipedia.org/wiki/Saint_John's_Eve) .

In our model the conditional Behti is represented as the last 31-st day in the 6-th month only on leap years, 
Eni is represented as the last 31-st day in the 12-th month.

````
                                        YEAR                                 
                                                                             
            First Month             Second Month           Third Month
                                                                             
        I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII
                                                                              
        1  2  3   4  5  6  7              1  2  3  4                    1  2  
        8  9 10  11 12 13 14    5  6  7   8  9 10 11    3  4  5   6  7  8  9
 Q1     15 16 17  18 19 20 21   12 13 14  15 16 17 18   10 11 12  13 14 15 16
        22 23 24  25 26 27 28   19 20 21  22 23 24 25   17 18 19  20 21 22 23
        29 30 31                26 27 28  29 30         24 25 26  27 28 29 30
                                                                             
                                                                             
            Forth Month              Fifth Month             Sixth Month
                                                                             
        I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII
                                                                              
        1  2  3   4  5  6  7              1  2  3  4                    1  2  
        8  9 10  11 12 13 14    5  6  7   8  9 10 11    3  4  5   6  7  8  9
 Q2    15 16 17  18 19 20 21   12 13 14  15 16 17 18   10 11 12  13 14 15 16
       22 23 24  25 26 27 28   19 20 21  22 23 24 25   17 18 19  20 21 22 23
       29 30 31                26 27 28  29 30         24 25 26  27 28 29 30
                                                                            
                                                          Day Behty (31-st) - only on leap years
                                                                            
            Sevent Month             Eight Month             Nineth Month
                                                                             
        I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII
                                                                             
        1  2  3   4  5  6  7              1  2  3  4                    1  2  
        8  9 10  11 12 13 14    5  6  7   8  9 10 11    3  4  5   6  7  8  9
 Q3    15 16 17  18 19 20 21   12 13 14  15 16 17 18   10 11 12  13 14 15 16
       22 23 24  25 26 27 28   19 20 21  22 23 24 25   17 18 19  20 21 22 23
       29 30 31                26 27 28  29 30         24 25 26  27 28 29 30
                                                                             
                                                                             
            Tenth Month              Eleventh Month         Twelveth Month   
                                                                             
        I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII
                                                                             
        1  2  3   4  5  6  7              1  2  3  4                    1  2  
        8  9 10  11 12 13 14    5  6  7   8  9 10 11    3  4  5   6  7  8  9
 Q4    15 16 17  18 19 20 21   12 13 14  15 16 17 18   10 11 12  13 14 15 16
       22 23 24  25 26 27 28   19 20 21  22 23 24 25   17 18 19  20 21 22 23
       29 30 31                26 27 28  29 30         24 25 26  27 28 29 30
                                                                              
                                                          Day Eni (31-st)

````

It is assumed that the days Eni and Behti, are not counted as days of a week. 
These are the so-called days which are not «not counted». 
Without them, the rest of the days that count, form exactly 52 weeks. 
So if the year begins on Monday, the next year will also begin on Monday and
each calendar date remains fixed forever in a specific day of the week.

Some researchers suggest that Bulgarian week began with Sunday. Basis for such an 
assumption is the name of a day Wednesday - `sryada`  - that means in Bulgarian 'middle' (of the week).
An alternative assumption is that Monday was widely adopted as the first day of the week. 
The grounds for such an alternative assumption are the names of the following days: Tuesday (`vtornik`), 
Thursday (`chetvartak`) and Friday (`petak`) - meaning, respectively, second, fourth and fifth (day of the week)  - in bulgarian 
sekond - `vtori`, fourth - `chetvarti`, fifth - `peti`. That is to say if Tuesday is the second day, 
then Monday is supposed to be the first. In our model, we accept contingent names of days of the week - 
1-st, 2-nd, 3-rd, 4-th, 5-th, 6-th and 7-th.

In the table above, we have represented them with the latin numbers (I, II, III, IV, V, VI, VII) to destinguish them 
from the days of the month.

In any case, the days of the week do not match to the days of the week that we know from the modern Gregorian calendar. 
This is because in the modern calendar, there are no days that are not counted and are not included in the 
composition of the week. As we said in the Bulgarian calendar, such days are Eni and Behti.


`*`: There are also hypotheses, that the first and second month of each quarter had 30 days, but the third had 31 days. 
Common across all hypotheses is that the year is divided into quarters of 91 days.

Cycles for correction of the calendar
-------------------------------------
Tropical Earth year - that is the time for which the Earth makes one complete lap around the Sun, equals 190 419 365.242 Earth days - that is to say 365 days, 5 hours, 48 minutes and 45.5 seconds. So in a calendar year of 365 days, it goes faster with a quarter day (5 hours, 48 minutes and seconds 45.5) each year. After four years, the calendar year is starting approximately 1 day before completing the astronomical round of the Earth around the Sun.


To stay in sync, the calendar year need to be corrected by adding a leap day every four years - the so-called day Behti that is added at the end of the 6th month. This adjustment, however, is not sufficient because the high gain of the calendar was not exactly a day (24 hours). It is 23 hours, 15 minutes and 2 seconds. So after adding the leap day the calendar begins to lag.


This requires a system of additional adjustments. This system divides the calendar into periods, as shown below.


### Four year period


Every forth year has an additional leap day named Behti at the end of the 6-th month. A year with a leap day would be called a leap year. An year without a leap day would be called a non-leap year.

````
   +----------------+-----------------+---------------+-----------------+
   | First Non Leap | Second Non Leap | Thir Non Leap | *Fourth LEAP*   |
   | Year           | Year            | Year          | *Year*          |
   +----------------+-----------------+---------------+-----------------+

````

### Twelve year period

Three four - year periods form one 12 year period. This period is not characterized by a calendar adjustment, but what makes it specila is that each year from the 12 year cycle has an animal assigned to it - that is why this 12 year cycle is also called animalian cycle. Various researchers adopt different order of animals, as well as different starting animal. The names of the animals are also controversial. Here are some examples:

````
 +---------------------------------------------------------------------------------------------+
 |                                       According To                                          |
 +-------------------------+---------------------------------------------+---------------------+
 |       Georgi Krustev    |             Yordan Vulchev                  |    Petur Dobrev     |
 +-------------------------+---------------------------------------------+---------------------+
 | animal       | name(s)  |    animal    |          name(s)             |  animal  |  name(s) |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Pig          |   Dox    | Pig          | dox, dok, prase              |                     |
 +--------------+----------+--------------+------------------------------+---------------------+
 | Mouse        |   Karan  | Mouse        | somor, shushi                | Mouse    | Somor    |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Ox           |   Shegor | Ox           | shegor, kuvrat, buza, busman | Ox       | Shegor   |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Snow Leopard |   Barus  | Tiger        | bars, parus, barus           | -        |          |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Rabbit       |   Dvan   | Rabbit       | dvansh                       | Rabbit   | Dvan     |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Dragon       |   Hala   | Dragon-Snake | ver, dragun, kala, slav      | Dragon   | Ver      |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Snake        |          | Snake        | dilom, delyan, attilla       | Snake    | Dilom    |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Horse        |   Tag    | Horse        | tek, tag, tih, alasha        | Horse    | Teku     |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Monkey       |   Pisin  | Monkey       | pesin, pisin                 | -        | -        |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Ram          |          | Ram          | suruh, sever, rasate         | -        | -        |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Cock         |   Tox    | Cock         | toh, tah                     | Cock     | Toh      |
 +--------------+----------+--------------+------------------------------+----------+----------+
 | Dog          |   Et-h   | Dog          | et-h                         | Dog      | Et-h     |
 +--------------+----------+--------------+------------------------------+----------+----------+
                                                                         | Boar     | Dohs     |
                                                                         +----------+----------+
```` 
Each 12-year period has been either male or female. In a male period - all years within this period were male - the corresponding animals have been male. In a female period - all years within the period comply with the animals of the female sex. After each male 12 year period, a female one follows. After that a mail period again and so on...

### Sixty year period (star day)

A period of 60 years equals exactly to 5 twelve-year cycles or 15 four-year cycles. It was conventially called "star day" Yordan Vulchev. Since the 60-year cycle is multiple of 4 year periods, then it, generally, ends in a leap year. Such a star day would be called - a leap star day.


In certain cases, for the correction of the calendar, the leap day of the last year in the 60 year period neet to be taken away. In such case, we will call the star day a non leap star day.

````
                  Leap Star Day                                         NON Leap Star Day              
  +-------+--------------+------+---------------+       +-------+--------------+------+----------------+
  | BLACK | Four Yrs: 1  | № 1. | Non leap year |       | BLACK | Four Yrs: 1  | № 1. | Non leap year  |
  |       |              | № 2. | Non leap year |       |       |              | № 2. | Non leap year  |
  |       |              | № 3. | Non leap year |       |       |              | № 3. | Non leap year  |
  |       |              | № 4. | Leap year     |       |       |              | № 4. | Leap year      |
  |       |-------------------------------------+       |       |--------------------------------------+
  |       | Four Yrs: 2  | № 5. | Non leap year |       |       | Four Yrs: 2  | № 5. | Non leap year  |
  |       |              | № 6. | Non leap year |       |       |              | № 6. | Non leap year  |
  |       |              | № 7. | Non leap year |       |       |              | № 7. | Non leap year  |
  |       |              | № 8. | Leap year     |       |       |              | № 8. | Leap year      |
  |       |-------------------------------------+       |       |--------------------------------------+
  |       | Four Yrs: 3  | № 9. | Non leap year |       |       | Four Yrs: 3  | № 9. | Non leap year  |
  |       |              | № 10.| Non leap year |       |       |              | № 10.| Non leap year  |
  |       |              | № 11.| Non leap year |       |       |              | № 11.| Non leap year  |
  |       |              | № 12.| Leap year     |       |       |              | № 12.| Leap year      |
  +---------------------------------------------+       +----------------------------------------------+
  | RED   | Four Yrs: 4  | № 13.| Non leap year |       | RED   | Four Yrs: 4  | № 13.| Non leap year  |
  |       |              | № 14.| Non leap year |       |       |              | № 14.| Non leap year  |
  |       |              | № 15.| Non leap year |       |       |              | № 15.| Non leap year  |
  |       |              | № 16.| Leap year     |       |       |              | № 16.| Leap year      |
  |       |-------------------------------------+       |       |--------------------------------------+
  |       | Four Yrs: 5  | № 17.| Non leap year |       |       | Four Yrs: 5  | № 17.| Non leap year  |
  |       |              | № 18.| Non leap year |       |       |              | № 18.| Non leap year  |
  |       |              | № 19.| Non leap year |       |       |              | № 19.| Non leap year  |
  |       |              | № 20.| Leap year     |       |       |              | № 20.| Leap year      |
  |       |-------------------------------------+       |       |--------------------------------------+
  |       | Four Yrs: 6  | № 21.| Non leap year |       |       | Four Yrs: 6  | № 21.| Non leap year  |
  |       |              | № 22.| Non leap year |       |       |              | № 22.| Non leap year  |
  |       |              | № 23.| Non leap year |       |       |              | № 23.| Non leap year  |
  |       |              | № 24.| Leap year     |       |       |              | № 24.| Leap year      |
  +---------------------------------------------+       +----------------------------------------------+
  | Y     | Four Yrs: 7  | № 25.| Non leap year |       | Y     | Four Yrs: 7  | № 25.| Non leap year  |
  | E     |              | № 26.| Non leap year |       | E     |              | № 26.| Non leap year  |
  | L     |              | № 27.| Non leap year |       | L     |              | № 27.| Non leap year  |
  | L     |              | № 28.| Leap year     |       | L     |              | № 28.| Leap year      |
  | O     |-------------------------------------+       | O     |--------------------------------------+
  | W     | Four Yrs: 8  | № 29.| Non leap year |       | W     | Four Yrs: 8  | № 29.| Non leap year  |
  |       |              | № 30.| Non leap year |       |       |              | № 30.| Non leap year  |
  |       |              | № 31.| Non leap year |       |       |              | № 31.| Non leap year  |
  |       |              | № 32.| Leap year     |       |       |              | № 32.| Leap year      |
  |       |-------------------------------------+       |       |--------------------------------------+
  |       | Four Yrs: 9  | № 33.| Non leap year |       |       | Four Yrs: 9  | № 33.| Non leap year  |
  |       |              | № 34.| Non leap year |       |       |              | № 34.| Non leap year  |
  |       |              | № 35.| Non leap year |       |       |              | № 35.| Non leap year  |
  |       |              | № 36.| Leap year     |       |       |              | № 36.| Leap year      |
  +---------------------------------------------+       +----------------------------------------------+
  | BLUE  | Four Yrs: 10 | № 37.| Non leap year |       | BLUE  | Four Yrs: 10 | № 37.| Non leap year  |
  |       |              | № 38.| Non leap year |       |       |              | № 38.| Non leap year  |
  |       |              | № 39.| Non leap year |       |       |              | № 39.| Non leap year  |
  |       |              | № 40.| Leap year     |       |       |              | № 40.| Leap year      |
  |       |-------------------------------------+       |       |--------------------------------------+
  |       | Four Yrs: 11 | № 41.| Non leap year |       |       | Four Yrs: 11 | № 41.| Non leap year  |
  |       |              | № 42.| Non leap year |       |       |              | № 42.| Non leap year  |
  |       |              | № 43.| Non leap year |       |       |              | № 43.| Non leap year  |
  |       |              | № 44.| Leap year     |       |       |              | № 44.| Leap year      |
  |       |-------------------------------------+       |       |--------------------------------------+
  |       | Four Yrs: 12 | № 45.| Non leap year |       |       | Four Yrs: 12 | № 45.| Non leap year  |
  |       |              | № 46.| Non leap year |       |       |              | № 46.| Non leap year  |
  |       |              | № 47.| Non leap year |       |       |              | № 37.| Non leap year  |
  |       |              | № 48.| Leap year     |       |       |              | № 48.| Leap year      |
  +---------------------------------------------+       +----------------------------------------------+
  | WHITE | Four Yrs: 13 | № 49.| Non leap year |       | WHITE | Four Yrs: 13 | № 49.| Non leap year  |
  |       |              | № 50.| Non leap year |       |       |              | № 50.| Non leap year  |
  |       |              | № 51.| Non leap year |       |       |              | № 51.| Non leap year  |
  |       |              | № 52.| Leap year     |       |       |              | № 52.| Leap year      |
  |       |-------------------------------------+       |       |--------------------------------------+
  |       | Four Yrs: 14 | № 53.| Non leap year |       |       | Four Yrs: 14 | № 53.| Non leap year  |
  |       |              | № 54.| Non leap year |       |       |              | № 54.| Non leap year  |
  |       |              | № 55.| Non leap year |       |       |              | № 55.| Non leap year  |
  |       |              | № 56.| Leap year     |       |       |              | № 56.| Leap year      |
  |       |-------------------------------------+       |       |--------------------------------------+
  |       | Four Yrs: 15 | № 57.| Non leap year |       |       | Four Yrs: 15 | № 57.| Non leap year  |
  |       |              | № 58.| Non leap year |       |       |              | № 58.| Non leap year  |
  |       |              | № 59.| Non leap year |       |       |              | № 59.| Non leap year  |
  |       |              | № 60.| *Leap year*   |       |       |              | № 60.| *Non leap year*|
  +---------------------------------------------+       +----------------------------------------------+
````

Actually the only difference between the `leap star day` and `non-leap star day` is in the last year - the 60-th year.
In the `leap star day` it is a leap year. In the `non-leap star day` it is not.
Each star day is split into 5 12 year periods. Each of these periods has been assigned an element, a corresponding color and direction. 
The five elements/colors/directions are:

````

       Element    Color      Direction
     
  1.   Water      BLACK      Center
  2.   Fire       RED        South 
  3.   Earth      YELLOW     West
  4.   Tree       BLUE       North
  5.   Metal      WHITE      East
  
````

Each of the 5 12-year periods, is considered either male or female in an alternating sequence.
Star day, which begins with the male 12-year period, will be called male, 
and one that begins with the female 12-year period would be called female. 
Within two consecutive star days (120 years), we can find all of the possible combinations of element, sex and animal.
So the combination of element, sex and animal can be used to identify a date within a 120-year period.

````
                    Element    SEX        Years
          +--------------------------------------------------------------------------------+
          |    I.   Water       MALE       1   2   3   4   5   6   7   8   9  10  11  12   |
   MALE   |   II.   Fire      FEMALE      13  14  15  16  17  18  19  20  21  22  23  24   |
   STAR   |  III.   Earth       MALE      25  26  27  28  29  30  31  32  33  34  35  36   |
   YEAR   |   IV.   Tree      FEMALE      37  38  39  40  41  42  43  44  45  46  47  48   |
          |    V.   Metal       MALE      49  50  51  52  53  54  55  56  57  58  59  60   |
          +--------------------------------------------------------------------------------+
          |   VI.   Water     FEMALE      61  62  63  64  65  66  67  68  69  70  71  72   |
   FEMALE |  VII.   Fire        MALE      73  74  75  76  77  78  79  80  81  82  83  84   |
   STAR   | VIII.   Earth     FEMALE      85  86  87  88  89  90  91  92  93  94  95  96   |
   YEAR   |   IX.   Tree        MALE      97  98  99 100 101 102 103 104 105 106 107 108   |
          |    X.   Metal     FEMALE     109 110 111 112 113 114 115 116 117 118 119 120   |
          +--------------------------------------------------------------------------------+
````


### Four hundred and twenty year period (STAR WEEK)

When we group 7 star days (each consisting of 60 years), we receive an amount of 420 years, 
which we call a `star week`.The first, third and fifth `star day`s in each `star week` are always non-leap star days. 
The second, fourth and sixth are always leap. 
The seventh Star day in general is also leap, but when there is a need for further correction in the calendar, it is replaced by a non-leap one. 
A star week in which the last star day is non-leap, will be called - non-leap. Similarly if the last star day is leap, the whole star week 
would be called - leap. 

````


        LEAP STAR WEEK                                NON-LEAP STAR WEEK
                       years      days                               years      days
1.  Non-Leap star day:    60    21 914        1.  Non-Leap star day:    60    21 914
2.      Leap star day:    60    21 915        2.      Leap star day:    60    21 915
3.  Non-Leap star day:    60    21 914        3.  Non-Leap star day:    60    21 914
4.      Leap star day:    60    21 915        4.      Leap star day:    60    21 915
5.  Non-Leap star day:    60    21 914        5.  Non-Leap star day:    60    21 914
6.      Leap star day:    60    21 915        6.      Leap star day:    60    21 915
7.      Leap star day:    60    21 915        7.      Leap star day:    60    21 914
 
                Total:   420   153 402                        Total:   420   153 401
  
````

Some researchers call the first star day - "Star Monday", the second - "Star Tuesday" etc..., 
while others are starting from "Star Sunday". 
In our research that is unimportant and in the table above we have indicated them just with the numbers from 1 to 7.
Each star week consists of 420 Earth years. 
The difference between a non leap leap and leap star week is only in the last start day. 
The leap star week ends on a leap star day, which in its turn means that this star day (60 years) ends on a leap year. 
Conversely, the non-leap star week ends on non-leap star day, which in turn means that this star day (60 years)
ends on a non-leap year.

### Star month

Like the weeks on Earth are grouped stars in a month, the same way every 4 star weeks are grouped in a star month.
So one star month equals 1 680 Earth years. Star month could also be a "leap" or "non leap".
Here is its structure in both cases.

````
                                 LEAP STAR MONTH                    

                     Sequential number of star day  Years       Days  
                     -----------------------------                    
     Leap star week    1   2   3   4   5   6   7      420    153 402  
 Non-Leap star week    8   9  10  11  12  13  14      420    153 401  
     Leap star week   15  16  17  18  19  20  21      420    153 402  
     Leap star week   22  23  24  25  26  27  28      420    153 402  
     
                                          Total:    1 680    613 607  



                             NON LEAP STAR MONTH

                     Sequential number of star day  Years       Days
                     -----------------------------
     Leap star week    1   2   3   4   5   6   7      420    153 402
 Non-Leap star week    8   9  10  11  12  13  14      420    153 401
     Leap star week   15  16  17  18  19  20  21      420    153 402
 Non-Leap star week   22  23  24  25  26  27  28      420    153 401
     
                                           Total:   1 680    613 606
````

### Star year

Twelve star months form a so-called star year. Star year consists of exactly 20 160 Earth years. 
Sixth star month of the star year is always non leap. The other star months except the last month are always leap. 
The last star month is generally leap but can be non leap if further adjustment to the calendar is needed. 
To understand when such correction happens, see the description of star age.

````
                            STRUCTURE OF LEAP STAR YEAR                                 
                                                                             
           Star Month 1 LEAP       Star Month 2 LEAP       Star Month 3 LEAP
                                                                             
         I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII <-- Sequential 
                                                                                   number of
         1  2  3   4  5  6  7    1  2  3   4  5  6  7    1  2  3   4  5  6  7      Star Day
         8  9 10  11 12 13 14    8  9 10  11 12 13 14    8  9 10  11 12 13 14
        15 16 17  18 19 20 21   15 16 17  18 19 20 21   15 16 17  18 19 20 21
        22 23 24  25 26 27 28   22 23 24  25 26 27 28   22 23 24  25 26 27 28
                                                                             
                                                                             
           Star Month 4 LEAP       Star Month 5 LEAP    Star Month 6 NON-LEAP  <-- NON-LEAP 
                                                                             
         I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII <-- Sequential
                                                                                   number of
         1  2  3   4  5  6  7    1  2  3   4  5  6  7    1  2  3   4  5  6  7      Star Day
         8  9 10  11 12 13 14    8  9 10  11 12 13 14    8  9 10  11 12 13 14
        15 16 17  18 19 20 21   15 16 17  18 19 20 21   15 16 17  18 19 20 21
        22 23 24  25 26 27 28   22 23 24  25 26 27 28   22 23 24  25 26 27 28
                                                                             
           Star Month 7 LEAP       Star Month 8 LEAP       Star Month 9 LEAP
                                                                             
         I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII <-- Sequential
                                                                                   number of
         1  2  3   4  5  6  7    1  2  3   4  5  6  7    1  2  3   4  5  6  7      Star Day
         8  9 10  11 12 13 14    8  9 10  11 12 13 14    8  9 10  11 12 13 14
        15 16 17  18 19 20 21   15 16 17  18 19 20 21   15 16 17  18 19 20 21
        22 23 24  25 26 27 28   22 23 24  25 26 27 28   22 23 24  25 26 27 28
                                                                             
                                                                             
          Star Month 10 LEAP      Star Month 11 LEAP      Star Month 12 LEAP
                                                                             
         I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII <-- Sequential
                                                                                   number of
         1  2  3   4  5  6  7    1  2  3   4  5  6  7    1  2  3   4  5  6  7      Star Day
         8  9 10  11 12 13 14    8  9 10  11 12 13 14    8  9 10  11 12 13 14
        15 16 17  18 19 20 21   15 16 17  18 19 20 21   15 16 17  18 19 20 21
        22 23 24  25 26 27 28   22 23 24  25 26 27 28   22 23 24  25 26 27 28



                                                                             

                            STRUCTURE OF NON-LEAP STAR YEAR                                 
                                                                             
           Star Month 1 LEAP       Star Month 2 LEAP       Star Month 3 LEAP
                                                                             
         I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII <-- Sequential 
                                                                                   number of
         1  2  3   4  5  6  7    1  2  3   4  5  6  7    1  2  3   4  5  6  7      Star Day
         8  9 10  11 12 13 14    8  9 10  11 12 13 14    8  9 10  11 12 13 14
        15 16 17  18 19 20 21   15 16 17  18 19 20 21   15 16 17  18 19 20 21
        22 23 24  25 26 27 28   22 23 24  25 26 27 28   22 23 24  25 26 27 28
                                                                             
                                                                             
           Star Month 4 LEAP       Star Month 5 LEAP    Star Month 6 NON-LEAP  <-- NON-LEAP
                                                                             
         I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII <-- Sequential
                                                                                   number of
         1  2  3   4  5  6  7    1  2  3   4  5  6  7    1  2  3   4  5  6  7      Star Day
         8  9 10  11 12 13 14    8  9 10  11 12 13 14    8  9 10  11 12 13 14
        15 16 17  18 19 20 21   15 16 17  18 19 20 21   15 16 17  18 19 20 21
        22 23 24  25 26 27 28   22 23 24  25 26 27 28   22 23 24  25 26 27 28
                                                                             
           Star Month 7 LEAP       Star Month 8 LEAP       Star Month 9 LEAP
                                                                             
         I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII <-- Sequential
                                                                                   number of
         1  2  3   4  5  6  7    1  2  3   4  5  6  7    1  2  3   4  5  6  7      Star Day
         8  9 10  11 12 13 14    8  9 10  11 12 13 14    8  9 10  11 12 13 14
        15 16 17  18 19 20 21   15 16 17  18 19 20 21   15 16 17  18 19 20 21
        22 23 24  25 26 27 28   22 23 24  25 26 27 28   22 23 24  25 26 27 28
                                                                             
                                                                             
          Star Month 10 LEAP      Star Month 11 LEAP    Star Month 12 NON-LEAP <-- NON-LEAP
                                                                             
         I II III IV  V VI VII   I II III IV  V VI VII   I II III IV  V VI VII <-- Sequential
                                                                                   number of
         1  2  3   4  5  6  7    1  2  3   4  5  6  7    1  2  3   4  5  6  7      Star Day
         8  9 10  11 12 13 14    8  9 10  11 12 13 14    8  9 10  11 12 13 14
        15 16 17  18 19 20 21   15 16 17  18 19 20 21   15 16 17  18 19 20 21
        22 23 24  25 26 27 28   22 23 24  25 26 27 28   22 23 24  25 26 27 28
                                                                             
````

Each star year consists of 48 weeks star. That equals exactly 336 star days (every star day consisting of 60 Earth years). Thus, each star year consists of 20 160 Earth years. Within a leap star year there are always exactly 7 363 283 (seven million, three hundred and sixty-three thousand, two hundred eighty-three) Earth days. Within a non leap star year there are always exactly 7 363 282 earth days. 

### Period of 4 star years

Star years just like earth years are grouped in fours. In general, only the second star year is a non leap year. From the rest - the first, the third and the fourth are leap. However when there is a need of correction to he calendar, all the four star years are leap. To understand when that happens, please see section for star epoch. Every period of 4 star years consists of just 80 640 Earth years. The usual non-leap period of 4 star years (when the second star year is non-leap, and the other star years are leap) consists of 29 453 131 earth days. The leap period of 4 star years (when all the four star years are leap due to the need for correction) consists of 29 453 132 earth days. 

````    
             NON-LEAP PERIOD OF
             4 STAR YEARS
             (80 640 EARTH YEARS)

                         years          days
 1. Leap star year:     20 160     7 363 283
 2. Non-Leap star year: 20 160     7 363 282
 3. Leap star year:     20 160     7 363 283
 4. Leap star year:     20 160     7 363 283
                 total: 80 640    29 453 131 



             LEAP PERIOD OF
             4 STAR YEARS
             (80 640 EARTH YEARS)

                         years          days
 1. Leap star year:     20 160     7 363 283
 2. Leap star year:     20 160     7 363 283
 3. Leap star year:     20 160     7 363 283
 4. Leap star year:     20 160     7 363 283
                 total: 80 640    29 453 132 

````
### Star Epoch

Star epoch is the last and greatest period in the Bulgarian calendar. That period completes the correction of the calendar, so this period does not have a leap and non-leap variants. It consists of 125 periods of 4 star years, or exactly 500 star years. 
All the periods of 4 star years are non leap (which means that the second star year is non leap and the first, the third and the fourth star years are leap), with the exception of the 63-rd period of 4 star years. It is leap, which means, that all its 4 star years are leap.

That is to say that star year with number 250 is leap.

Each star epoch consists of 10 080 000 (ten million and eighty thousand) Earth years, or exactly 3 681 641 376 (three billion, six hundred eighty-one million, six hundred Forty-one thousand, three hundred seventy-six) Earth days. 

````
              1                2                3                4                5                6                7                8                9               10
001 002 003 004  005 006 007 008  009 010 011 012  013 014 015 016  017 018 019 020  021 022 023 024  025 026 027 028  029 030 031 032  033 034 035 036  037 038 039 040
 
             11               12               13               14               15               16               17               18               19               20
041 042 043 044  045 046 047 048  049 050 051 052  053 054 055 056  057 058 059 060  061 062 063 064  065 066 067 068  069 070 071 072  073 074 075 076  077 078 079 080


             21               22               23               24               25               26               27               28               29               30
081 082 083 084  085 086 087 088  089 090 091 092  093 094 095 096  097 098 099 100  101 102 103 104  105 106 107 108  109 110 111 112  113 114 115 116  117 118 119 120

             31               32               33               34               35               36               37               38               39               40
121 122 123 124  125 126 127 128  129 130 131 132  133 134 135 136  137 138 139 140  141 142 143 144  145 146 147 148  149 150 151 152  153 154 155 156  157 158 159 160

             41               42               43               44               45               46               47               48               49               50
161 162 163 164  165 166 167 168  169 170 171 172  173 174 175 176  177 178 179 180  181 182 183 184  185 186 187 188  189 190 191 192  193 194 195 196  197 198 199 200

             51               52               53               54               55               56               57               58               59              60
201 202 203 204  205 206 207 208  209 210 211 212  213 214 215 216  217 218 219 220  221 222 223 224  225 226 227 228  229 230 231 232  233 234 235 236  237 238 239 240

             61               62  
241 242 243 244  245 246 247 248  

             63  
249 250 251 252   <--- 63-rd period of 4 star years is the only in the star epoch when all its star years are leap star years. 

             64               65
253 254 255 256  257 258 259 260  

             66               67               68               69               70               71               72               73               74              75
261 262 263 264  265 266 267 268  269 270 271 272  273 274 275 276  277 278 279 280  281 282 283 284  285 286 287 288  289 290 291 292  293 294 295 296 297 298 299 300

 
             76               77               78               79               80               81               82               83               84              85
301 302 303 304  305 306 307 308  309 310 311 312  313 314 315 316  317 318 319 320  321 322 323 324  325 326 327 328  329 330 331 332  333 334 335 336 337 338 339 340


             86               87               88               89               90               91               92               93               94              95
341 342 343 344  345 346 347 348  349 350 351 352  353 354 355 356  357 358 359 360  361 362 363 364  365 366 367 368  369 370 371 372  373 374 375 376 377 378 379 380

             96               97               98               99              100              101              102              103              104             105
381 382 383 384  385 386 387 388  389 390 391 392  393 394 395 396  397 398 399 400  401 402 403 404  405 406 407 408  409 410 411 412  413 414 415 416 417 418 419 420

            106              107              108              109              110              111              112              113              114             115
421 422 423 424  425 426 427 428  429 430 431 432  433 434 435 436  437 438 439 440  441 442 443 444  445 446 447 448  449 450 451 452  453 454 455 456 457 458 459 460

            116              117              118              119              120              121              122              123              124             125
461 462 463 464  465 466 467 468  469 470 471 472  473 474 475 476  477 478 479 480  481 482 483 484  485 486 487 488  489 490 491 492  493 494 495 496 497 498 499 500

````

# Docker Build
This script builds and runs the project using **Docker Compose**, automatically selecting the correct Dockerfile for your system architecture (`x86_64` or `arm64`).

## Usage

```bash
./docker-build-publish.sh [options]
```

### Options

| Option            | Description                                                      |
| ----------------- | ---------------------------------------------------------------- |
| `-p, --publish`   | Tag & push the image (`:latest` and `:YYYY-MM-DD`) to Docker Hub |
| `-P, --port PORT` | Map host port to container port 80 (default: 80)                 |
| `-h, --help`      | Show usage information                                           |

## Behavior

* Always builds and starts via **Docker Compose**.
* Automatically uses the right Dockerfile based on system architecture.
* With `-p`, pushes both `:latest` and date-based tags to Docker Hub.

## Examples

```bash
./docker-build-publish.sh
./docker-build-publish.sh -P 8089
./docker-build-publish.sh -p
```

License
=======

[MIT License](http://adampritchard.mit-license.org/).
