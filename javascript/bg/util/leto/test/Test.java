package bg.util.leto.test;

import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.GregorianCalendar;
import java.util.Locale;
import java.util.SimpleTimeZone;
import java.util.TimeZone;

import bg.util.leto.api.Leto;
import bg.util.leto.api.LetoException;
import bg.util.leto.api.LetoPeriod;
import bg.util.leto.api.LetoPeriodType;
import bg.util.leto.base.LetoBase;
import bg.util.leto.impl.bulgarian.LetoBulgarian;
import bg.util.leto.impl.gregorian.LetoGregorian;
import bg.util.leto.impl.julian.LetoJulian;

public class Test extends LetoGregorian {

    
    private static String eraName(int era) {
        switch (era) {
            case GregorianCalendar.BC: return "BC";
            case GregorianCalendar.AD: return "AD";
            default: return "Era " + era;
        }
    }
    
    private static String weekDay(int day) {
        switch (day) {
            case Calendar.MONDAY:     return "Monday";
            case Calendar.TUESDAY:     return "Tuesday";
            case Calendar.WEDNESDAY:return "Wednesday";
            case Calendar.THURSDAY: return "Thursday";
            case Calendar.FRIDAY:     return "Friday";
            case Calendar.SATURDAY: return "Saturday";
            case Calendar.SUNDAY:     return "Sunday";
            default: return "" + day + "-th Day in Week";
        }
    }
    
    private static String extend(int number, int positions) {
        
        String str = "" + number;
        if (str.length() >= positions) {
            return str;
        }
        StringBuffer sb = new StringBuffer();
        for (int i =0; i < positions - str.length(); i++) {
            sb.append("0");
        }
        sb.append(str);
        return sb.toString();
    }
    
    private static void printDayGregorianJava(Calendar day) {
        StringBuffer sb = new StringBuffer();
        sb.append("Era: ");
        sb.append(extend(day.get(Calendar.ERA), 2));
        sb.append(" ");
        sb.append(eraName(day.get(Calendar.ERA)));
        sb.append("      ");
        sb.append(extend(day.get(Calendar.YEAR), 4));
        sb.append("-");
        sb.append(extend(day.get(Calendar.MONTH) + 1, 2));
        sb.append("-");
        sb.append(extend(day.get(Calendar.DAY_OF_MONTH), 2));
        sb.append(" Day Of Year: ");
        sb.append(extend(day.get(Calendar.DAY_OF_YEAR), 3));
        sb.append(" Day Of Week: (");
        sb.append(day.get(Calendar.DAY_OF_WEEK));
        sb.append(")");
        sb.append(weekDay(day.get(Calendar.DAY_OF_WEEK)));
        System.out.print(sb.toString());
    }
    
    
    private static void printDayGregorianJava(LetoPeriod[] periods) {
        if (periods == null) {
            System.out.println("ERROR: Periods are null.");
        }

        StringBuffer sb = new StringBuffer();        
        int DAY = 0;
        int MONTH = 1;
        int YEAR = 2;
        int YEARS4 = 3;
        int YEARS400 = 5;
        
        if (periods.length < 6) {
            for (int i =0; i < periods.length; i++) {
                sb.append(periods[i].getType().getName(Locale.ENGLISH));
                sb.append(" ");
                sb.append(periods[i].getActualName());
                sb.append(" ");
                sb.append(extend((int)periods[i].getNumber(), 4));
                sb.append("    ");
            }        
        } else {
            long year = periods[YEAR].getNumber() + periods[YEARS4].getNumber() * 4 + periods[YEARS400].getNumber() *400; 
            sb.append("Era: 01 AD      ");
            sb.append(extend((int)year, 4));
            sb.append("-");
            sb.append(extend((int)periods[MONTH].getNumber(), 2));
            sb.append("-");
            sb.append(extend((int)periods[DAY].getNumber(), 2));
        }
        
        System.out.println(sb.toString());
    }
    
    
    
    public static void mainComparision(String[] argv) throws Exception {
        Calendar cal = Calendar.getInstance();
        cal.set(1, 0, 0);
        int day = 0;
        
        
        int i = 0; 
        while (true) {
            cal.add(Calendar.DAY_OF_MONTH, 1);
            cal.get(Calendar.DAY_OF_MONTH);
            if (i > 8000 * 366) {
                break;
            }
            printDayGregorianJava(cal);
            
            System.out.print("\t\t\t");
            Leto gr = new LetoJulian();
            LetoPeriod[] periods = gr.calculateCalendarPeriods(day);
            System.out.print((periods[2].getAbsoluteNumber() + 1) + "-" + (periods[1].getNumber() + 1)  + "-" + ( periods[0].getNumber() + 1 ));
            System.out.println("     \tDif: " + ( cal.get(Calendar.DAY_OF_MONTH) - (periods[0].getNumber() + 1 ) ));
            day++;
            i++;
        }
        
    }
    
    public static void main(String[] argv) throws Exception {
        LetoBulgarian bg = new LetoBulgarian();
        System.out.println(bg.toJson(true));
    }
    
//    public static void mainPrintGregorian(String[] argv) throws Exception {
    public static void mainTimeZones(String[] argv) throws Exception {
        
        
         // get the supported ids for GMT-08:00 (Pacific Standard Time)
         String[] ids = TimeZone.getAvailableIDs(-8 * 60 * 60 * 1000);
         // if no ids were returned, something is wrong. get out.
         if (ids.length == 0)
             System.exit(0);

          // begin output
         System.out.println("Current Time");

         // create a Pacific Standard Time time zone
         SimpleTimeZone pdt = new SimpleTimeZone(-8 * 60 * 60 * 1000, ids[0]);

         // set up rules for daylight savings time
         pdt.setStartRule(Calendar.APRIL, 1, Calendar.SUNDAY, 2 * 60 * 60 * 1000);
         pdt.setEndRule(Calendar.OCTOBER, -1, Calendar.SUNDAY, 2 * 60 * 60 * 1000);

         // create a GregorianCalendar with the Pacific Daylight time zone
         // and the current date and time
         Calendar calendar = new GregorianCalendar();
         

        @SuppressWarnings("unused")
        GregorianCalendar gc = new GregorianCalendar(2000, 1, 28);
        @SuppressWarnings("unused")
        GregorianCalendar cal = new GregorianCalendar(1, 0, 1);;
        
        int i = 0; 
        while (true) {
            calendar.add(Calendar.DAY_OF_MONTH, -1);
            calendar.get(Calendar.DAY_OF_MONTH);
            if (i > 8000 * 366) {
                break;
            }
            printDayGregorianJava(calendar);
            System.out.println();
            i++;
        }
        System.out.println("Number of days: " + i);
        
    }
    
    
    public static void mainCountDays(String[] argv) throws Exception {
        LetoBase bg = new LetoBulgarian();
        @SuppressWarnings("unused")
        String error = bg.checkCorrectness();
//        if (error == null) {
//            System.out.println("Everything is correct.");
//        } else {
//            System.out.println(error);
//        }
        
        GregorianCalendar gc = new GregorianCalendar(2000, 1, 28);
        GregorianCalendar ne = new GregorianCalendar(1, 0, 1);
        GregorianCalendar cal = new GregorianCalendar(1, 0, 1);;
        
        int i = 0; 
        while (true) {
            cal.add(Calendar.DAY_OF_MONTH, 1);
            cal.get(Calendar.DAY_OF_MONTH);
            if (cal.after(gc) || i > 4000 * 365) {
                break;
            }
            i++;
        }
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy.MM.dd G HH:mm:ss z");
        System.out.println("From \"" +formatter.format(ne.getTime()) 
                + "\" to \"" + formatter.format(gc.getTime()) + "\" there are " + i + " days");
        
        LetoBase gre = new LetoGregorian();
        LetoPeriod[] periods = gre.calculateCalendarPeriods(i);
        for (int pi = 0; pi < periods.length; pi++) {
            LetoPeriod period = periods[pi];
            LetoPeriodType type = period.getType();
            System.out.println("Period: " + type.getName(Locale.ENGLISH) + ": \t " + period.getNumber() 
                 + "\t\t" + type.getDescription(Locale.ENGLISH));
        }
    }
    
       
    public static void mainTest1(String[] argv) {
//    public static void main(String[] argv) {
        
        
        int i = 0;
        int day = 734119;
        LetoBase gre = new LetoGregorian();
        while (true) {
            LetoPeriod[] periods = null;
            try {
                periods = gre.calculateCalendarPeriods(day);
            } catch (LetoException e) {
                System.err.println(e);
                e.printStackTrace();
            }
            
            if (i > 3000 * 365) {
                break;
            }
            printDayGregorianJava(periods);
            day--;
            i++;
        }
    }
    
    
    public static void mainCheckCorrectness(String[] argv) throws Throwable {
        
        LetoBase gre = new LetoGregorian();
        System.out.println("Gregorian Calendar");
        String correctness = gre.checkCorrectness();
        if (correctness == null) {
            System.out.println("Correct");
        } else {
            System.out.println("Incorrect: " + correctness);
        }
        LetoBase bg = new LetoBulgarian();
        System.out.println("Bulgarian Calendar");
        correctness = bg.checkCorrectness();
        if (correctness == null) {
            System.out.println("Correct");
        } else {
            System.out.println("Incorrect: " + correctness);
        }

    }
    

    
    public static void mainTestToday(String[] argv) throws Throwable {
//      public static void main(String[] argv) throws Throwable {
        LetoGregorian gre = new LetoGregorian();
//        LetoBase gre = new LetoBulgarian();
        LetoPeriod[] periods = gre.getToday();
        
        if (periods == null) {
            System.err.println("Error getting today.");
            return;
        }
        for (int i =0; i < periods.length; i++) {
            LetoPeriod period = periods[i];
            System.out.println(period.getType().getName(Locale.ENGLISH) + ": " + period.getNumber() 
                            + "(" + period.getActualName() + ")\t\t" + period.getAbsoluteNumber());
        }
    }
}
