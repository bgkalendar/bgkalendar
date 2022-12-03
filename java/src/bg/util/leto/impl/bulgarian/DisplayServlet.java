package bg.util.leto.impl.bulgarian;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.Locale;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

import bg.util.leto.api.LetoException;
import bg.util.leto.api.LetoPeriod;
import bg.util.leto.api.LetoPeriodStructure;

public class DisplayServlet extends HttpServlet {
    
    /**
     * 
     */
    private static final long serialVersionUID = 1L;

    public static final String[] WEEKDAYS = new String[] {
        "Понеделник", "Вторник", "Сряда", "Четвъртък", "Петък", "Събота", "Неделя"
    };
    
    public static final String[] WEEKDAYS_SHORT = new String[] {
        "пн", "вт", "ср", "чт", "пт", "сб", "не"
    };
    
    public static final String[] PERIOD_NAMES = new String[] {"Ден", "Месец", "Година", "Четиригодие", 
                    "Звезден Ден", "Звездна Седмица", "Звезден месец" , "Звездна Година", "Звездна Епоха"};
    
    public static final String[] YEAR_ANIMALS = new String[] {
        "Плъх", "Вол", "Барс", "Заек", "Дракон", "Змия", 
        "Кон", "Овен", "Маймуна", "Петел", "Куче", "Глиган"
    };
    
    public static final String[] YEAR_ANIMALS_BG = new String[] {
        "Сомор", "Шегор", "Вери", "Дванш", "Дракон", "Дилом", 
        "Морин", "Теку", "Маймуна", "Тох", "Етх", "Дохс"
    };
    
    private String DETAILS_URL_PARAMETER = "m";
    private String DAYS_URL_PARAMETER = "d";
    
    private static boolean getBoolean(String str) {
        if (str == null) {
            return false;
        }
        str = str.trim();
        String[] TRUE = new String[] {"t", "true", "enable", "enabled", "visible", "on", "yes"};
        String[] FALSE = new String[] {"f", "false", "disable", "disabled", "invisible", "off", "no", ""};
        for (int i = 0; i < TRUE.length; i++) {
            if (str.equalsIgnoreCase(TRUE[i])) {
                return true;
            }
        }
        for (int i =0; i < FALSE.length; i++) {
            if (str.equalsIgnoreCase(FALSE[i])) {
                return false;
            }
        }
        return false;
    }
    
    private static long getLongInteger(String str) {
        if (str == null) {
            return -1;
        }
        try {
            long longValue = Long.parseLong(str.trim());
            return longValue;
        } catch (NumberFormatException nfe) {
            return -1;
        }
    }
    
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) 
    throws ServletException, IOException 
    {
        
        Locale locale = new Locale("bg");
        resp.setContentType("text/html; charset=UTF-8");
        PrintWriter out = resp.getWriter();
        out.println("<html>");
        out.println("<head><http-equiv name=\"Content-Type\" content=\"text/html; charset=UTF-8\"/><title>Българският Календар</title>");
        out.println("<script language=\"javascript\">");
        out.println("   <!--");
        out.println("   function showdetails() {");
        out.println("        var details = document.getElementById(\"details\");");
        out.println("        if (details == null) {");
        out.println("            return;");
        out.println("        }");
        out.println("        if (details.style != null && details.style.visibility != null && details.style.visibility == \"visible\") {");
        out.println("            details.style.visibility = \"hidden\";");
        out.println("            details.style.display = \"none\";");
        out.println("        } else {");
        out.println("            details.style.visibility = \"visible\";");
        out.println("            details.style.display = \"block\";");
        out.println("        }");
        out.println("   }");
        out.println("   //-->");
        out.println("</script>");
        out.println("<style type=\"text/css\">");
        out.println("    .datestyle");
        out.println("    {");
        out.println("       text-align: right;");
        out.println("       border-collapse: collapse;");
        out.println("       border: 1px solid blue;");
        out.println("       vertical-align: top;");
        out.println("    }");
        out.println("</style>");
        out.println("</head>");
        out.println("<body background=\"/backgrnd.gif\">");
        
        out.println("<center><h3>Българският Календар</h3></center>");
        try {
            
            boolean areDetailsVisible = getBoolean(req.getParameter(DETAILS_URL_PARAMETER)); // details
            long daysFromStartOfCalendar = getLongInteger(req.getParameter(DAYS_URL_PARAMETER));
            int weekdayCorrection = -2;
            long hour    = -1;
            long minute  = -1;
            long secund  = -1;


            LetoBulgarian bg = new LetoBulgarian();
            LetoPeriod[] periods = null;
            if (daysFromStartOfCalendar == -1) {
                
                long timezoneCorrection    = (2L * 60L * 60L * 1000L); // Two hours ahead of GMT
                long dailysavingCorrection = 0;//(1L * 60L * 60L * 1000L); // One hour ahead of usual winter time. 0 - means winter time.  
                
                long millisFromJavaEpoch = System.currentTimeMillis() + timezoneCorrection + dailysavingCorrection; // Two hour ahead of GMT
                long millisInDay = (1000L * 60 * 60 * 24);   // Millis in a day.
                long remainng = millisFromJavaEpoch % millisInDay;  // How much complete days have passed since EPOCH
                hour     = remainng / (1000L * 60 * 60);
                remainng = remainng % (1000L * 60 * 60);
                minute   = remainng / (1000L * 60);
                remainng = remainng % (1000L * 60);
                secund   = remainng / (1000L);
                
                long daysFromStartOfCalendarTillJavaEpoch = bg.startOfCalendarInDaysBeforeJavaEpoch();
                long daysFromJavaEpoch = millisFromJavaEpoch / millisInDay;  // How much complete days have passed since EPOCH
                daysFromStartOfCalendar = daysFromStartOfCalendarTillJavaEpoch + daysFromJavaEpoch;
                
                periods  = bg.getToday();
            } else {
                periods = bg.calculateCalendarPeriods(daysFromStartOfCalendar);
            }
            if (periods == null) {
                throw new LetoException("Невъзможно изчисляването на текущата дата поради неизвестна причина.");
            }
            if (periods.length < PERIOD_NAMES.length) {
                throw new LetoException("Изчислените календарни периоди (" + periods.length 
                                + ") са по малко от очакваните (" + PERIOD_NAMES.length + ").");
            }
            long day   = periods[0].getNumber() + 1;
            long month = periods[1].getNumber() + 1; String monthName = periods[1].getStructure().getName(locale);
            long year  = periods[2].getAbsoluteNumber() + 1;
            String shortName = PERIOD_NAMES[0] + ": " + day + ", "
                             + PERIOD_NAMES[1] + ": " + monthName + ", "
                             + PERIOD_NAMES[2] + ": " + year+ " &nbsp; &nbsp ["
                             + formatMimimumDigits(day, 2) + "-" + formatMimimumDigits(month, 2) + "-" 
                             + formatMimimumDigits(year,4) + " " 
                             + (hour   == -1 ? "" : formatMimimumDigits(hour, 2) + ":") 
                             + (minute == -1 ? "" : formatMimimumDigits(minute, 2) + ": ")
                             + (secund == -1 ? "" : formatMimimumDigits(secund, 2) + "] ");
            long days = periods[0].getAbsoluteNumber();
            int weekday = (int)((days + weekdayCorrection )% 7);
            
            long nextDay = daysFromStartOfCalendar + 1;
            long previousDay = daysFromStartOfCalendar <= 0 ? 0 : daysFromStartOfCalendar - 1;
            long nextMonth = (periods[1].getStructure().getTotalLengthInDays() == 31 && periods[1].getNumber() != 31) ? daysFromStartOfCalendar + 31 : daysFromStartOfCalendar + 30;
            long previousMonth = periods[1].getStructure().getTotalLengthInDays() == 31 ? (daysFromStartOfCalendar-31 <= 0 ? 0 : daysFromStartOfCalendar-31) : daysFromStartOfCalendar-30;
            long nextYear = 0;// TODO
            
            
            out.println("<center>" + shortName + "<a href=\"#\" onclick=\"javascript:showdetails();\">[Детайли]</a></center>");
            out.println("<div id=\"details\" ");
            out.println("     style=\"visibility: " + (areDetailsVisible ? "visible" : "hidden") + "; display:" + (areDetailsVisible ? "block" :  "none" ) + "\">");
            out.println("<center>");
            out.println("<table border=\"0\">");
            out.println("   <tr>");
            out.println("       <td>" + PERIOD_NAMES[0] + "</td>");
            out.println("       <td>" + day + "</td>");
            out.println("       <td> &nbsp; &nbsp; &nbsp; </td>");
            out.println("       <td colspan=\"3\">");
            out.println(WEEKDAYS[weekday] + " &nbsp; ");
            if (day == 31 && month == 12) {
                out.println("Еднажден, Игнажден, Ани-Алем");
            } else if (day == 31 && month == 6) {
                out.println("Ени-Джитем");
            } else {
                out.println("&nbsp;");
            }
            out.println("       </td>");
            out.println("   </tr>");
            
            out.println("   <tr>");
            out.println("       <td>" + PERIOD_NAMES[1] + "</td>");
            out.println("       <td>" + month + "</td>");
            out.println("       <td> &nbsp; &nbsp; &nbsp; </td>");
            out.println("       <td colspan=\"3\">" + monthName + "</td>");
            out.println("   </tr>");
            out.println("   <tr>");
            out.println("       <td valign=\"top\"><a href=\"kalendar.html#nachalo\">" + PERIOD_NAMES[2] + "</a></td>");
            out.println("       <td valign=\"top\">" + year + "</td>");
            out.println("       <td> &nbsp; &nbsp; &nbsp; </td>");
            out.println("       <td colspan=\"3\"><a href=\"kalendar.html#12g\">" + YEAR_ANIMALS[(int)((year -1) % 12)] + "</a>"
                                      + " (" + YEAR_ANIMALS_BG[(int)((year-1) % 12)] + ");<br/>"
                                      + seqPrefix(((year - 1) % 4) + 1)  + " от началото на " + PERIOD_NAMES[3] + ", <br/>" 
                                      + seqPrefix(((year -1 )%60)  + 1)  + " от началото на 60 годишния " + PERIOD_NAMES[4] 
                                      + " </td>");
            out.println("   </tr>");
            out.println("   <tr>");
            out.println("       <td colspan=\"6\" >");
            out.println("           <table border=\"0\">");
            out.println("              <tr>");
            out.println("                <td><a href=\"kalendar.html#4g\">" + PERIOD_NAMES[3] + "</a></td>");
            out.println("                <td>" + (periods[3].getNumber() + 1) + "</td>");
            out.println("                <td> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>");
            out.println("                <td><a href=\"kalendar.html#1680g\">" + PERIOD_NAMES[6] + "</a></td>");
            out.println("                <td>" + (periods[6].getNumber() + 1) + "</td>");
            out.println("                <td>&nbsp;</td>");
            out.println("              </tr><tr>");
            out.println("                 <td><a href=\"kalendar.html#60g\">" + PERIOD_NAMES[4] + "</a></td>");
            out.println("                 <td>" + (periods[4].getNumber() + 1) + "</td>");
            out.println("                 <td>&nbsp;</td>");
            out.println("                <td><a href=\"kalendar.html#20160g\">" + PERIOD_NAMES[7] + "</a></td>");
            out.println("                <td>" + (periods[7].getNumber() + 1) + "</td>");
            out.println("                <td>&nbsp;</td>");
            out.println("              </tr><tr>");
            out.println("                 <td><a href=\"kalendar.html#420g\">" + PERIOD_NAMES[5] + "</a></td>");
            out.println("                 <td>" + (periods[5].getNumber() +1) + "</td>");
            out.println("                 <td>&nbsp;</td>");
            out.println("                <td><a href=\"kalendar.html#10080000g\">" + PERIOD_NAMES[8] + "</a></td>");
            out.println("                <td>" + (periods[8].getNumber() + 1) + "</td>");
            out.println("                <td>&nbsp;</td>");
            out.println("              </tr>");
            out.println("           </table>");
            out.println("       </td>");
            out.println("   </tr>");
            out.println("</table>");
            out.println("</center>");
            out.println("</div>");
            //////////////////////////////////////////////////////////////////////////////////////////////////////
            LetoPeriod monthPeriod = periods[1];
            LetoPeriod yearPeriod  = periods[2];
            
            LetoPeriodStructure structure = yearPeriod.getStructure();
            LetoPeriodStructure[] months = structure.getSubPeriods();

            String colsParameter = req.getParameter("cols"); 
            int cols = colsParameter == null ? 3 : Integer.parseInt(colsParameter); 
            out.println("<center><table border=\"0\">");
            int i = 0;
            int currentWeekday = (int) ((yearPeriod.startsAtDaysAfterEpoch() + weekdayCorrection)% 7);
            
            for (; i < months.length;) {
                
                if (i % cols == 0) {
                    out.println("<tr>");
                }
                
                int currentDay = -1;
                if (monthPeriod.getNumber() == i) {
                    currentDay = (int)day;
                }
                String str = drawMonth(-1, months[i].getName(locale), i, (int)months[i].getTotalLengthInDays(), 
                                currentWeekday, currentDay);
                out.println("<td valign=\"top\">");
                out.println(str);
                out.println("</td>");
                currentWeekday = currentWeekday + (int)months[i].getTotalLengthInDays();
                currentWeekday = currentWeekday % 7;
                i++;
                if (i % cols == 0) {
                    out.println("</tr>");
                }
            }
            if (i % cols != 0) {
                out.println("<td colspan=\"" + (cols - (i % cols) ) + "\"> &nbsp; </td>");
                out.println("</tr>");
            }
            out.println("</table></center>");
        } catch (LetoException le) {
            out.println("<font color=\"red\"><pre>");
            out.println(le.getLocalizedMessage());
            le.printStackTrace(out);
            out.println("</pre></font>");
        } catch (Exception e) {
            out.println("<font color=\"darkred\"><pre>");
            out.println(e.getLocalizedMessage());
            e.printStackTrace(out);
            out.println("</pre></font>");
        }
        out.println("</body>");
        out.println("</html>");
        out.flush();
        out.close();
    }
    
    
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) 
    throws ServletException, IOException 
    {
        doGet(req, resp);
    }

    
    private String seqPrefix(long year) {
        if (year>= 10 && year <= 20) {
            return year + "<sup>-та</sup>";
        }
        int rem = (int)((long)year % 10); 
        switch (rem) {
            case 1: 
                    return "" + year + "<sup>-ва</sup>";
            case 2: 
                    return "" + year + "<sup>-ра</sup>";
            case 7: 
            case 8: 
                    return "" + year + "<sup>-ма</sup>";
            default: 
                    return "" + year  + "<sup>-та</sup>";
        }
    }
    
    private String formatMimimumDigits(long display, int minimumLetters) {
        String str = "" + display;
        int len = str.length();
        if (len < minimumLetters) {
            int additional = minimumLetters - len;
            StringBuffer sb = new StringBuffer();
            for (int i =0; i < additional; i++) {
                sb.append("0");
            }
            str = sb.toString() + str;
        }
        return str;
    }
    /**
     * 
     * @param year
     * @param monthName
     * @param numDays
     * @param startAtDayOfWeek Should be between 0 and 6. 0 means Monday and 6 means Sunday.
     * @param todayInMonth
     * @return
     */
    private static String drawMonth(int year, String monthName, int monthNumber, int numDays, int startAtDayOfWeek, int todayInMonth) {
        StringBuffer sb = new StringBuffer();
        if (startAtDayOfWeek >=7 ) {
            throw new RuntimeException("Starting day of week cannot be " + startAtDayOfWeek 
                     + ". It should be between 0 and 7.");
        }
        if (startAtDayOfWeek < 0) {
            throw new RuntimeException("Starting day of week cannot be negative (" + startAtDayOfWeek + ").");
        }
        if (numDays >= 100) {
            throw new RuntimeException("A month of " + numDays + " days is not allowed. Month is not allowed to have "
                     + "more than 99 days. That is because each day should be no more than two deciimal digits.");
        }
        if (numDays <= 0) {
            throw new RuntimeException("A month of " + numDays 
                     + " days is not allowed. Month should have at least one day.");
        }
        if (todayInMonth != -1 && (todayInMonth <= 0 || todayInMonth > numDays)) {
            throw new RuntimeException("Todays date (" + todayInMonth + ") is not allowed to be outside the range 0 : " 
                     + numDays + " , since month " + monthName + " " + year + " is requested to have " + numDays 
                     + " days.");
        }
        
        sb.append("<table class=\"datestyle\">");
        sb.append("<tr class=\"datestyle\">");
        sb.append("    <td class=\"datestyle\" style=\"text-align: left; font-weight: bold;\" colspan=\"7\">");
        sb.append(monthName);
        sb.append("    </td>");
        sb.append("</tr>");
        sb.append("<tr class=\"datestyle\">");
        for (int i =0; i < WEEKDAYS_SHORT.length; i++) {
            sb.append("<td class=\"datestyle\" style=\"background-color: lightgray;\">" + WEEKDAYS_SHORT[i] + "</td>");
        }
        sb.append("</tr>");

        int rows = numDays + startAtDayOfWeek;
        rows = (rows / 7) + (rows % 7 > 0 ? 1 : 0);
        String[][] month = new String[rows][WEEKDAYS_SHORT.length];
        
        int todayRow = -1;
        int todayCol = -1;
        int dayOfWeek = startAtDayOfWeek;
        int row = 0;
        for (int i = 1; i <= numDays; i++) {
            if (todayInMonth == i) {
                todayRow = row;
                todayCol = dayOfWeek;
            }
            month[row][dayOfWeek] = "" + i; 
            dayOfWeek++;
            if (dayOfWeek >= WEEKDAYS_SHORT.length) {
                dayOfWeek = 0;
                row++;
            }
        }
        for (row = 0; row < rows; row++) {
            sb.append("<tr class=\"datestyle\">");
            for (int col = 0; col < WEEKDAYS_SHORT.length; col++) {
                String str = month[row][col];  
                String start = "";

                if (monthNumber == 5 && month[row][col] != null && month[row][col].equals("31")) {
                    start = "<td class=\"datestyle\" style=\"background-color: rgba(255, 255, 0, 0.5);;\">";
                } else if (monthNumber == 11 && month[row][col] != null && month[row][col].equals("31")) {
                    start = "<td class=\"datestyle\" style=\"background-color: rgba(255, 0, 0, 0.25);\">";
                } else {
                    start = "<td class=\"datestyle\">";
                    start =  col == 5 && str != null ? "<td class=\"datestyle\" style=\"background-color: rgba(200,200,200, 0.5);\">" : col == 6 && str != null ? "<td class=\"datestyle\" style=\"background-color: lightgray;\">" : start;
                } 
                if (row == todayRow && col == todayCol) {
                    start =  "<td class=\"datestyle\" style=\"background-color: blue;\">";
                }
                str = (str == null) ? "&nbsp;" : str;
                String end = "</td>";
                sb.append(start);
                sb.append(str);
                sb.append(end);
            }
            sb.append("</tr>");
        }
        sb.append("</table>");
        return sb.toString();
    }
}
