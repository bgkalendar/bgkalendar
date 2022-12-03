Java API for Ancient Bulgarian, Modern Gregorin and Julian Calendars
====================================================================

<!-- Please use markdown-toc -i README.md to update the table of contents -->
<!-- -->
**Table of Contents**  *generated with [Markdown-TOC](https://www.npmjs.com/package/markdown-toc#install)*

<!-- toc -->

- [Supported Features](#supported-features)
- [Sample Usage](#sample-usage)
  * [Get current date in Ancient Bulgarian Calendar](#get-current-date-in-ancient-bulgarian-calendar)
  * [Convert a date written as date in Ancient Bulgarian Calendar into a date in the Modern Gregorian Calendar](#convert-a-date-written-as-date-in-ancient-bulgarian-calendar-into-a-date-in-the-modern-gregorian-calendar)
- [Compile](#compile)
  * [Windows](#windows)
  * [Linux or UNIX](#linux-or-unix)
- [Generate Java Documentation (JavaDoc)](#generate-java-documentation-javadoc)
  * [Windows](#windows-1)
  * [Linux or UNIX](#linux-or-unix-1)

<!-- tocstop -->

Supported Features
------------------
 * Calculating the current date in Ancient Bulgarian, Modern Gregorian or Julian Calendar
 * Conversion of dated between calendars

Sample Usage
------------

### Get current date in Ancient Bulgarian Calendar

```java
import bg.util.leto.api.Leto;
import bg.util.leto.api.LetoPeriod;
import bg.util.leto.impl.bulgarian.LetoBulgarian;
import bg.util.leto.impl.gregorian.LetoGregorian;
import bg.util.leto.impl.julina.LetoJulian;
...
Leto calendar = null;
try {

  calendar = new LetoBulgarian();
  // calendar = new LetoGregorian();
  // calendar = new LetoJulian();
  long startOfCalendarBeforeJavaEpochDays = calendar.getStartOfCalendarBeforeUnixEpoch();
  long daysAfterJavaEpoch = System.currentTimeMillis() / (1000 * 60 * 60 * 24L );
  long daysAfterBeginningOfCalendar = startOfCalendarBeforeJavaEpochDays + daysAfterJavaEpoch;

  LetoPeriod[] periods = calendar.calculateCalendarPeriods(daysAfterBeginningOfCalendar);
  long   day       = periods[0].getNumber();
  long   month     = periods[1].getNumber();
  String monthName = periods[1].getActualName();
  long   year      = periods[2].getAbsoluteNumber();

  System.out.println("Date:  " + year + "-" + month + "-" + day);
  System.out.println("Day:   " + day);
  System.out.println("Month: " + monthName + " (" + month + ")");
  System.out.println("Year:  " + year);

} catch (LetoException exception) {
  String calendarName = "";
  if (calendar != null) {
    calendarName = calendar.getName();
  } 
  System.err.println("Cannot get current date " + calendarName);
  exception.printStackTrace();
}
```

### Convert a date written as date in Ancient Bulgarian Calendar into a date in the Modern Gregorian Calendar

```java
import bg.util.leto.api.Leto;
import bg.util.leto.api.LetoPeriod;
import bg.util.leto.impl.bulgarian.LetoBulgarian;
import bg.util.leto.impl.gregorian.LetoGregorian;
import bg.util.leto.impl.julina.LetoJulian;
...

long bgYear  = ... // Some year in Ancient Bulgarian Calendar. Example: 7524
long bgMonth = ... // Some month number inside the year in Ancient Bulgarian Calendar. Example: 5. Range: 1-12 including 1 and 12.
long bgDay   = ... // Some day number inside the given month. Range 1-31. Example: 15. Note: some months have just 30 days. 

Leto bulgarian = null;
Leto gregorian = null;
try {

  bulgarian  = new LetoBulgarian();
  gregorian    = new LetoGregorian();
  //gregorian    = new LetoJulian(); 

  long daysAfterbeginningOfCalendarBulgarian       = bulgarian.calculateDaysFronStartOfCalendar(bgYear, bgMonth, bgDay);
  long startOfCalendarBeforeJavaEpochDaysBulgarian = bulgarian.getStartOfCalendarBeforeUnixEpoch(); 
  long startOfCalendarBeforeJavaEpochDaysGregorian = gregorian.getStartOfCalendarBeforeUnixEpoch();
  long daysAfterJavaEpoch  = daysAfterbeginningOfCalendarBulgarian - startOfCalendarBeforeJavaEpochDaysBulgarian;
  long daysAfterbeginningOfCalendarGregorian  = startOfCalendarBeforeJavaEpochDaysGregorian + daysAfterJavaEpoch; 
 
  LetoPeriod[] periods = gregorian.calculateCalendarPeriods(daysAfterbeginningOfCalendarGregorian);

  long grDay   = periods[0].getNumber();
  long grMonth = periods[1].getNumber();
  long grYear  = periods[2].getAbsoluteNumber(); 

  System.out.println("Bulgarian: " + bgYear + "-" + bgMonth + "-" + bgDay + "     corresponds to ") ;
  System.out.println("Gregorian: " + grYear + "-" + grMonth + "-" + grDay) ;

} catch (LetoException exception) {
  String calendarName = "";
  if (calendar != null) {
    calendarName = calendar.getName();
  } 
  System.err.println("Cannot convert Ancient Bulgarian Date: " + bgYear + "-" + bgMonth + "-" + bgDay + " into Modern Greforian Date.");
  exception.printStackTrace();
}
```

Note: That would not work very well for dates before Java EPOCH (1-st of January 1970). 


Absolutely no guarantee for dates Before Christ (BC)
Also keep in mind that the Gregorian calendar was accepted at different time in different countries, so in some cases you might prefer LetoJulian as target calendar 
if a specific country has not accepted the Gregorian Calendar yet. See section Adoption of Gregorain Calendar in [Wikipedia](https://en.wikipedia.org/wiki/Gregorian_calendar#Adoption).  


In many countries the Julian calendar has been used for some time even after official adoption of Gregorian calendar. The date in Julian calendar was reffered to as Old Style, while the 
date in Gregorian calendar was reffered as New Style. In the example above substitute `LetoGregorian` with `LetoJulian` if you want to calculate Old Style.


Compile
--------

You need to have [Java Development Kit](https://www.oracle.com/technetwork/java/javase/downloads/jdk11-downloads-5066655.html) (JDK) in order to be able to compile the source code. 
Once you have installed that, simply run the gradle wrapper in this directory: 

### Windows

```cmd
 .\gradlew.bat clean build 
```

### Linux or UNIX

Just in case make sure that the `gradlew` script has execute permissions and then run it.

```bash
chmod a+x gradlew
./gradlew clean build
```

Compiled classes will be available under `build/classes/java/main`.

The jar bundle will be available as `build/libs/leto-x.y.z.jar` where `x.y.z` would correspond to the current version. For example `1.0.0`. 


Generate Java Documentation (JavaDoc)
------------------------------------

Simply run `gradlew javadoc`

### Windows

```cmd
.\gradlew.bat javadoc
```


### Linux or UNIX

```bash
./gradlew javadoc
```

The generated API documentation pages will be available under `build/docs/javadoc`. 

An online version can also be found [on the official site here](https://bgkalendar.com/javadoc/).
