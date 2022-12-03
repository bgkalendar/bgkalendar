package bg.util.leto.base;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Iterator;
import java.util.LinkedHashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;
import java.util.Set;

import bg.util.leto.api.Leto;
import bg.util.leto.api.LetoException;
import bg.util.leto.api.LetoPeriod;
import bg.util.leto.api.LetoPeriodType;
import bg.util.leto.impl.LocaleStringId;
import bg.util.leto.impl.LocaleStrings;
import bg.util.leto.impl.gregorian.LetoGregorian;
import bg.util.leto.api.LetoPeriodStructure;

/**
 * This is an abstract class that can be used as base (parent) for any leto (calendar) implementation. 
 * It offers some usefull utilities like calculating the current date given the number of days from the 
 * leto (calendar) EPOCH.
 * <br>
 * In fact each instance of a class that inherits from LetoBase, is a representation of a given date.
 */
public abstract class LetoBase implements Leto {
    
    
    abstract protected LocaleStringId getNameTranslationIndex();
    
    abstract protected LocaleStringId getDescriptionTranslationIndex();
    
    /**
     * Get the 
     */
    @Override
    public String getName() {
        return getName(Locale.ENGLISH);
    }
    
    @Override
    public String getName(Locale locale) {
        LocaleStringId nameTranslationIndex = getNameTranslationIndex();
        return LocaleStrings.get(nameTranslationIndex, locale, null);
    }

    @Override
    public String getDescription() {
        return getDescription(Locale.ENGLISH);
    }
    

    @Override
    public String getDescription(Locale locale) {
        LocaleStringId descriptionTranslations = getDescriptionTranslationIndex();
        return LocaleStrings.get(descriptionTranslations, locale, null);
    }
    
    @Override
    public Map<Locale, String> getNameTranslations() {
        LocaleStringId nameTranslationIndex = getNameTranslationIndex();
        Map<Locale, String> translations = LocaleStrings.get(nameTranslationIndex);
        return translations;
    }
    
    @Override
    public Map<Locale, String> getDescriptionTranslations() {
        LocaleStringId descriptionTranslations = getDescriptionTranslationIndex();
        Map<Locale, String> translations = LocaleStrings.get(descriptionTranslations);
        return translations;
    }
    
    
    /**
     * All inheriting classes should define the beginning of their calendar in days before the java EPOCH. 
     * @return The beginning of calendar in days before java EPOCH.
     */
    public abstract long startOfCalendarInDaysBeforeJavaEpoch();
    
    /**
     * All inheriting classes should define the supported calendar period types. For example the Gregorian calendar 
     * would return day, month, year, century (a period of 100 years) and 400 years period.
     * @return An array of all of the supported period types sorted in increasing order. The smolest period first
     * (with lower index). 
     */
    public abstract LetoPeriodType[] getCalendarPeriodTypes();
    
    /**
     * Calculate the exact period values for the today's date. In general this method will calculate how much days have
     * elapsed since Java epoch (1-st January 1970) an then add the days from the beginning of the calendar.
     * Based on that data it would try to split that amount of dates into periods and fill in a LetoPeriod array. 
     * The LetoPeriod array should have the exact same size as the array returned by getCalendarPeriodTypes(). 
     * @return The exact period values of the current today's date.
     * @throws LetoException If there is a problem during calculation or if the calendar internal structures are not 
     *     well defined.
     */
    public LetoPeriod[] getToday() throws LetoException {
        long days = startOfCalendarInDaysBeforeJavaEpoch();
        long millisFromJavaEpoch = System.currentTimeMillis() + 2L * 60L * 60L * 1000L;  // Two hours ahead of GMT.
        long millisInDay = (1000L * 60 * 60 * 24);   // Millis in a day.
        long daysFromJavaEpoch = millisFromJavaEpoch / millisInDay;  // How much complete days have passed since EPOCH
        days = days + daysFromJavaEpoch; 
        
        return calculateCalendarPeriods(days);
    }
    
    
    /**
     * Calculate the periods based on the number of days since the leto (calendar) EPOCH.
     * @param days Number of days since the calendar starts.
     * @return The calculated array of periods.
     * @throws LetoException If there is some unrecoverable error while calculating the date.
     */
    public LetoPeriod[] calculateCalendarPeriods(long days) throws LetoException {
        LetoPeriodType[] types = getCalendarPeriodTypes();
        if (types == null || types.length <= 0) {
            throw new LetoException("This calendar does not define any periods.");
        }
        Map<LetoPeriodType, Long> periods = new HashMap<LetoPeriodType, Long>(types.length);
        Map<LetoPeriodType, Long> periodAbsoluteCounts = new HashMap<LetoPeriodType, Long>(types.length);
        Map<LetoPeriodType, Long> periodsStartDay = new HashMap<LetoPeriodType, Long>(types.length);
        Map<LetoPeriodType, LetoPeriodStructure>
        periodsStructures = new HashMap<LetoPeriodType, LetoPeriodStructure>(types.length);
        
        for (int i =0; i < types.length; i++) {
            periods.put(types[i], new Long(0));           periodAbsoluteCounts.put(types[i], new Long(0));
            periodsStartDay.put(types[i], new Long(0));   
        }
        
        LetoPeriodType currentType = types[types.length - 1];
        LetoPeriodStructure[] structures = currentType.getPossibleStructures();
        if (structures == null || structures.length <= 0) {
            throw new LetoException("This calendar does not define any structure for the period type \"" 
                  + currentType.getName(LocaleStrings.ENGLISH) 
                  + ", so it is not defined how long in days this period could be.");
        }
        if (structures.length > 1) {
            throw new LetoException("The biggest possible period type \"" + currentType.getName(LocaleStrings.ENGLISH) 
                  + "\" in this calendar has " + structures.length 
                  + " possible structures, but just one was expected. It is not defined which one should be used.");
        }
        
        long daysElapsed = 0;
        
        LetoPeriodStructure structure = structures[0];
        long value = days / structure.getTotalLengthInDays();
        days = days % structure.getTotalLengthInDays();
        daysElapsed = value * structure.getTotalLengthInDays();
        increaseCount(periods, structure, value);
        increaseAbsolutePeriodCounts(periodAbsoluteCounts, structure, value);
        periodsStartDay.put(structure.getPeriodType(), daysElapsed);
        periodsStructures.put(structure.getPeriodType(), structure);
        
        while ((structures = structure.getSubPeriods() ) != null) {
            if (structures.length <= 0) {
                break;
            }
            for (int i = 0; i < structures.length; i++) {
                structure = structures[i];
                if (structure.getTotalLengthInDays() > days) {
                    periodsStartDay.put(structure.getPeriodType(), daysElapsed);
                    periodsStructures.put(structure.getPeriodType(), structure);
                    break;
                } else {
                    
                    days = days - structure.getTotalLengthInDays();
                    daysElapsed = daysElapsed + structure.getTotalLengthInDays();
                    
                    increaseCount(periods, structure, 1);
                    increaseAbsolutePeriodCounts(periodAbsoluteCounts, structure, 1);
                }
            }
        }
        LetoPeriod[] reslt = new LetoPeriod[types.length];
        for (int i = 0; i < types.length; i++) {
            LetoPeriodType type = types[i];
            Long countLong = periods.get(type);
            long count = 0;
            if (countLong != null) {
                count = countLong.longValue();
            }
            LetoPeriodBean bean = new LetoPeriodBean();
            bean.setNumber(count);
            bean.setAbsoluteNumber(periodAbsoluteCounts.get(type));
            bean.setType(type);
            bean.setActualName("" + count);
            bean.setStartAtDaysAfterEpoch(periodsStartDay.get(type));
            bean.setStructure(periodsStructures.get(type));
            reslt[i] = bean;
        }
        return reslt;
    }
    
    
    /**
     * This method is the reverse of the prevuos method (calculateCalendarPeriods).
     * It would get year, month and a day and will try to get how many days have passes since
     * the start of the calendar.
     * That is a convenient method. Please note that the value of the year an absolute value
     * from the beginning of the calendar. It is not the year for the current
     * (upper level period such as a century).
     * On the other side the month is the manth iside the given year (day from the beginning of the year)
     * and day is the day inside the given month (day from the begining of the month).
     * @return Number of days since the begining of the calendar.
     */
    public long calculateDaysFronStartOfCalendar(long year, long month, long day) throws LetoException {
    	year  = year  > 0 ? year  - 1 : 0;
    	month = month > 0 ? month - 1 : 0;
    	day   = day   > 0 ? day   - 1 : 0;
    	
    	LetoPeriodType[] types = getCalendarPeriodTypes();
        if (types == null || types.length <= 0) {
            throw new LetoException("This calendar does not define any periods.");
        }
    	if (types.length < 3) {
    		throw new LetoException("Calendar does not support years. Year \"" + year + "\" is invalid for this calendar.");
    	}
    	
    	int MONTH_INDEX = 1;  LetoPeriodType monthType = types[MONTH_INDEX];
    	int YEAR_INDEX = 2;   LetoPeriodType yearType  = types[YEAR_INDEX];
        
        LetoPeriodType currentType = types[types.length - 1];
        LetoPeriodStructure[] structures = currentType.getPossibleStructures();
        if (structures == null || structures.length <= 0) {
            throw new LetoException("This calendar does not define any structure for the period type \"" 
                  + currentType.getName(LocaleStrings.ENGLISH) + ", so it is not defined how long in days this period could be.");
        }
        if (structures.length > 1) {
            throw new LetoException("The biggest possible period type \"" + currentType.getName(LocaleStrings.ENGLISH) 
                  + "\" in this calendar has " + structures.length 
                  + " possible structures, but just one was expected. It is not defined which one should be used.");
        }
        
        long daysElapsed = 0;
                
        LetoPeriodStructure structure = structures[0];
        
        long yearsInPeriod = structure.getTotalLengthInPeriodTypes(yearType);
        long daysInPeriod = structure.getTotalLengthInDays();
        long periods = year / yearsInPeriod;
        daysElapsed += (periods * daysInPeriod);
        year = year % yearsInPeriod;
        
        loopYears:
        while ((structures = structure.getSubPeriods() ) != null && structures.length > 0 && year > 0) {
            for (int i = 0; i < structures.length; i++) {
                structure = structures[i];
                if (year <= 0) {
                	break loopYears;
                }

                yearsInPeriod = structure.getTotalLengthInPeriodTypes(yearType);
                daysInPeriod = structure.getTotalLengthInDays();
                if (yearsInPeriod <= year) {
                	daysElapsed += daysInPeriod;
                	year = year - yearsInPeriod;
                } else {
                	break;
                }
            }
        }
        
        if (year > 0) {
        	throw new LetoException("Internal error while calculating years in date.");
        }
        
        loopMonths:
        while ((structures = structure.getSubPeriods() ) != null && structures.length > 0 && month > 0) {
            for (int i = 0; i < structures.length; i++) {
                structure = structures[i];
                if (month <= 0) {
                	break loopMonths;
                }

                long monthsInPeriod = structure.getTotalLengthInPeriodTypes(monthType);
                daysInPeriod = structure.getTotalLengthInDays();
                if (monthsInPeriod <= month) {
                	daysElapsed += daysInPeriod;
                	month = month - monthsInPeriod;
                } else {
                	break;
                }
            }
        }
        
        if (month > 0) {
        	throw new LetoException("Internal error while calculating months in date.");
        }
        
        loopDays:
        while ((structures = structure.getSubPeriods() ) != null && structures.length > 0 && day > 0) {
            for (int i = 0; i < structures.length; i++) {
                structure = structures[i];
                if (day <= 0) {
                	break loopDays;
                }
                daysInPeriod = structure.getTotalLengthInDays();
                if (daysInPeriod <= day) {
                	daysElapsed += daysInPeriod;
                	day = day - daysInPeriod;
                } else {
                	break;
                }
            }
        }
        
        if (day > 0) {
        	throw new LetoException("Internal error while calculating days in date.");
        }
        return daysElapsed;
    	
    }
    
    public static void main(String[] args) throws Throwable {
    	LetoGregorian gr = new LetoGregorian();
    	long days = gr.calculateDaysFronStartOfCalendar(2018, 12, 10);
    	LetoPeriod[] types = gr.calculateCalendarPeriods(days);
    	for (int i =0; i < types.length; i++) {
    		System.out.print(types[i].getType().getName(LocaleStrings.ENGLISH) + ": ");
    		System.out.print(types[i].getNumber() + "; ");
    		System.out.println();
    	}
    }
    
    private void increaseCount(Map<LetoPeriodType, Long> periods, LetoPeriodStructure structure, long value) {
        Long periodCount = periods.get(structure.getPeriodType());
        if (periodCount == null) {
            periodCount = new Long(value);
        } else {
            periodCount = new Long(periodCount.longValue() + value);
        }
        periods.put(structure.getPeriodType(), periodCount);
    }
    
    private void increaseAbsolutePeriodCounts(Map<LetoPeriodType, Long> periodAbsoluteCounts, 
                                        LetoPeriodStructure structure, 
                                        long value) {
        LetoPeriodType[] types = getCalendarPeriodTypes();
        for (int j = 0; j < types.length; j++) { 
            LetoPeriodType type = types[j];
            long totalCount = structure.getTotalLengthInPeriodTypes(type);
            Long sumLong = periodAbsoluteCounts.get(type);
            if (sumLong == null) {
                sumLong = new Long(totalCount * value);
            } else {
                sumLong = new Long(sumLong.longValue() + (totalCount * value) );
            }
            periodAbsoluteCounts.put(type, sumLong);
        }
    }
    
    /**
     * Given the representation of the date by periods, this method calculates the number of days since the 
     * start of the calendar.
     * @param periods An array of periods.
     * @return The number of days since the start of the calendar.
     * @throws LetoException If there is some unrecoverable error during calculation.
     */
    protected long calculateDaysFromPeriods(LetoPeriod[] periods) throws LetoException {
        long days = 0;
        int len = periods.length;
        for (int periodIndex = len-1; periodIndex >= 0; periodIndex--) {
            LetoPeriod period = periods[periodIndex];
            long number = period.getNumber();
            
            LetoPeriodStructure structure = period.getStructure();
            long totalLengthInDays = structure.getTotalLengthInDays();
            
            days += (number * totalLengthInDays); 
            
        }
        
        return days;
    }
    
    public String checkCorrectness() {
        return LetoCorrectnessChecks.checkCorrectness(getCalendarPeriodTypes(), this);
    }
    
    public Map<String, Object> toMap() {
        Map<String, Object> map = new LinkedHashMap<String, Object>();
        handleNameDescriptionAndTramslations(map, getName(), getDescription(), getNameTranslations(), getDescriptionTranslations());
        
        long startInDaysBeforeUnixEpoch = getStartOfCalendarBeforeUnixEpoch();
        map.put("start-in-days-before-unix-epoch", startInDaysBeforeUnixEpoch);
        
        LetoPeriodType[] periodTypes = getCalendarPeriodTypes();
        if (periodTypes == null) {
            return map;
        }
        List<Map<String, Object>> periodTypesResource = new ArrayList<Map<String, Object>>(periodTypes.length);
        map.put("period-types", periodTypesResource);
        
        for (LetoPeriodType periodType : periodTypes) {
            Map<String, Object> periodTypeResource = new LinkedHashMap<String, Object>();
            periodTypesResource.add(periodTypeResource);
            
            handleNameDescriptionAndTramslations(periodTypeResource, periodType.getName(), periodType.getDescription(), 
                    periodType.getNameTranslations(), periodType.getDescriptionTranslations());
            
            LetoPeriodStructure[] possibleStructures = periodType.getPossibleStructures();
            List<Map<String, Object>> possibleStructuresResource = new ArrayList<Map<String, Object>>(possibleStructures.length);
            periodTypeResource.put("possible-structures", possibleStructuresResource);
            
            for (LetoPeriodStructure possibleStructure : possibleStructures) {
                Map<String, Object> possibleStructureResource = new LinkedHashMap<String, Object>();
                possibleStructuresResource.add(possibleStructureResource);
                
                handleNameDescriptionAndTramslations(possibleStructureResource, possibleStructure.getName(), null, possibleStructure.getNameTranslations(), null);
                
                long days = possibleStructure.getTotalLengthInDays();
                possibleStructureResource.put("length-days", new Long(days));
                
                Map<String, Long> length = new LinkedHashMap<String, Long>();
                possibleStructureResource.put("length", length);
                LetoPeriodType[] types = getCalendarPeriodTypes();
                for (LetoPeriodType type : types) {
                    String lengthTypeName = type.getName();
                    long lengthInPeriodType = possibleStructure.getTotalLengthInPeriodTypes(type);
                    if (lengthInPeriodType > 0) {
                        length.put(lengthTypeName, new Long(lengthInPeriodType));
                    }
                }
                
                LetoPeriodStructure[] subStructures = possibleStructure.getSubPeriods();
                if (subStructures == null || subStructures.length <= 0) {
                    possibleStructureResource.put("sub-structure", new ArrayList<Map<String, Object>>(0));
                } else {
                    List<Map<String, Object>> subStructuresResource = new ArrayList<Map<String, Object>>(subStructures.length);
                    possibleStructureResource.put("sub-structure", subStructuresResource);
                    
                    for (LetoPeriodStructure subStructure : subStructures) {
                        Map<String, Object> subStructureResource = new LinkedHashMap<String, Object>();
                        subStructuresResource.add(subStructureResource);
                        
                        subStructureResource.put("period-type-name", subStructure.getPeriodType().getName());
                        subStructureResource.put("structure-name",  subStructure.getName());
                        subStructureResource.put("length-days",           subStructure.getTotalLengthInDays());
                    }
                }
            }
        }
        return map;
    }
    
    public String toJson(boolean indent) {
        Map<String, Object> map = toMap();
        StringBuffer sb = new StringBuffer();
        toJsonMap(map, sb, indent ? 0 : -1, indent ? 2 : 0);
        return sb.toString();
    }
    
    private String jsonEscape(String str) {
        StringBuffer sb = new StringBuffer(str.length());
        for (int i = 0; i < str.length(); i++) {
            char chr = str.charAt(i);
            switch (chr) {
                case '\\': 
                case '"':  sb.append('\\'); sb.append(chr); break;
                case '\r': sb.append('\\'); sb.append('r'); break;
                case '\n': sb.append('\\'); sb.append('n'); break;
                case '\t': sb.append('\\'); sb.append('t'); break;
                case '\b': sb.append('\\'); sb.append('b'); break;
                default: sb.append(chr);
            }
        }
        return sb.toString();
    }
    
    private void toJsonMap(Map<String, ?> map, StringBuffer sb, int identation, int step) {
        sb.append('{'); 
        if (identation >= 0) { sb.append('\n');}
        
        Set<String> keySet = map.keySet();
        Iterator<String> iterator = keySet.iterator();
        while (iterator.hasNext()) {
            String key = iterator.next();
            if (identation >= 0) { for (int i = 0; i < identation + step; i++) { sb.append(' ');}   }
            sb.append('"');
            sb.append(jsonEscape(key));
            sb.append("\": ");
            toJson(map.get(key), sb, identation + step, step);
            if (iterator.hasNext()) {
                sb.append(',');
            }
            if (identation >= 0) { sb.append('\n');}
        }
        
        if (identation >= 0) { for (int i = 0; i < identation; i++) { sb.append(' ');}   }        
        sb.append('}');
    }
    
    private void toJsonArray(Iterable<?> list, StringBuffer sb, int identation, int step) {
        sb.append('['); 
        if (identation >= 0) { sb.append('\n');}
        
        Iterator<?> iterator = list.iterator();
        while (iterator.hasNext()) {
            Object value = iterator.next();
            if (identation >= 0) { for (int i = 0; i < identation + step; i++) { sb.append(' ');}   }
            toJson(value, sb, identation + step, step);
            if (iterator.hasNext()) {
                sb.append(',');
            }
            if (identation >= 0) { sb.append('\n');}
        }
        
        if (identation >= 0) { for (int i = 0; i < identation; i++) { sb.append(' ');}   }        
        sb.append(']');
    }
    
    private void toJsonNumber(Number num, StringBuffer sb, int identation, int step) {
        sb.append("" + num);
    }
    
    private void toJsonString(String str, StringBuffer sb, int identation, int step) {
        sb.append('"');
        sb.append(jsonEscape(str));
        sb.append('"');
    }
    
    private void toJsonBoolean(boolean b, StringBuffer sb, int identation, int step) {
        sb.append(b?"true": "false");
    }
    
    @SuppressWarnings("unchecked")
    private void toJson(Object o, StringBuffer sb, int identation, int step) {
        if (o == null) {
            sb.append("null");
        } else if (o instanceof String) {
            toJsonString((String)o, sb, identation, step);
        } else if (o instanceof Character) {
            toJsonString("" + o, sb, identation, step);
        } else if (o instanceof CharSequence) {
            toJsonString(o.toString(), sb, identation, step);
        } else if (o instanceof Boolean) {
            toJsonBoolean((boolean)o, sb, identation, step);
        } else if (o instanceof Number) {
            toJsonNumber((Number)o, sb, identation, step);
        } else if (o instanceof Iterable) {
            toJsonArray((Iterable<?>)o, sb, identation, step);
        } else if (o instanceof Map) {
            Set<?> set = ((Map<?, ?>) o).keySet();
            Iterator<?> iterator = set.iterator();
            boolean ok = true;
            if (iterator.hasNext()) {
                Object k = iterator.next();
                if (! (k instanceof String)) {
                    sb.append("/* Cannot convert object to Json. Unsupported type. Maps with keys of type : " + k.getClass().getSimpleName() 
                            + " are not supported. Keys can only be strings */");
                    ok = false;
                }
            }
            if (ok) { 
               toJsonMap((Map<String, ?>)o, sb, identation, step);
            }
        } else {
            sb.append("/* Cannot convert object to Json. Unsupported type. Object is of type: " + o.getClass().getSimpleName() + " */");
        }
    }


    
    
    
    
    
    private void handleNameDescriptionAndTramslations(Map<String, Object> map, String name, String description, Map<Locale, String> nameTranslations, Map<Locale, 
            String> descriptionTranslations) 
    {
        if (name != null) { 
           map.put("name", name);
        }
        if (description != null) { 
           map.put("descrition", description);
        }
        Map<String, String> nameTranslationsResource        = null;
        Map<String, String> descriptionTranslationsResource = null;
        Map<String, Map<String, String>> translations = new LinkedHashMap<String, Map<String, String>>(2);
        boolean translated = false;
        if (nameTranslations != null) { 
          nameTranslationsResource        = new LinkedHashMap<String, String>(nameTranslations.size());
          for (Locale locale : nameTranslations.keySet()) {
            nameTranslationsResource.put(locale.getLanguage(), nameTranslations.get(locale));
            translated = true;
          }
          translations.put("name", nameTranslationsResource);
        }
        if (descriptionTranslations != null) { 
          descriptionTranslationsResource = new LinkedHashMap<String, String>(descriptionTranslations.size());
          for (Locale locale : descriptionTranslations.keySet()) {
            descriptionTranslationsResource.put(locale.getLanguage(), descriptionTranslations.get(locale));
            translated = true;
          }
          translations.put("description", descriptionTranslationsResource);
        }
        if (translated) { 
          map.put("translations", translations);
        }
    }
}
