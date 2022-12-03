package bg.util.leto.base;

import java.util.HashMap;
import java.util.Iterator;
import java.util.Locale;
import java.util.Map;
import java.util.Set;

import bg.util.leto.api.Leto;
import bg.util.leto.api.LetoPeriodStructure;
import bg.util.leto.api.LetoPeriodType;
import bg.util.leto.impl.LocaleStrings;

public class LetoCorrectnessChecks {

    private static Map<LetoPeriodStructure, Map<LetoPeriodType, Long>>
    sCalculated = new HashMap<LetoPeriodStructure, Map<LetoPeriodType, Long>>();
    public static Map<LetoPeriodType, Long> calcuateLengthInPeriodTypes(LetoPeriodStructure periodStructure) {
        Map<LetoPeriodType, Long> lengths = null;
        lengths = sCalculated.get(periodStructure);
        if (lengths != null) {
            return lengths;
        }
        lengths = new HashMap<LetoPeriodType, Long>();
        LetoPeriodStructure[] substructures = periodStructure.getSubPeriods();
        for (int i = 0; substructures != null && i < substructures.length; i++) {
            LetoPeriodStructure substructure = substructures[i];
            LetoPeriodType subtype = substructure.getPeriodType();
            
            Long count = lengths.get(subtype);
            if (count == null) {
                count = new Long(1);
            } else {
                count = new Long(count.longValue() + 1);
            }
            lengths.put(subtype, count);
            
            if (substructure.getTotalLengthInDays() > periodStructure.getTotalLengthInDays()) {
                throw new RuntimeException("Illegal state. The Period Type structure which has " 
                      + periodStructure.getTotalLengthInDays() 
                      + " days has been declared to contain a substructure " + subtype.getName(LocaleStrings.ENGLISH) 
                      + " with " + substructure.getTotalLengthInDays() + " days.");
            }
            
            Map<LetoPeriodType, Long> subLengths = calcuateLengthInPeriodTypes(substructure);
            Set<LetoPeriodType> keySet = subLengths.keySet();
            Iterator<LetoPeriodType> iterator = keySet.iterator();
            while (iterator.hasNext()) {
                LetoPeriodType type = iterator.next();
                Long           len = subLengths.get(type);
                
                Long numberCount = lengths.get(type);
                if (numberCount == null) {
                    numberCount = len;
                } else {
                    numberCount = new Long(numberCount.longValue() + len.longValue());
                }
                lengths.put(type, numberCount);

            }
        }
        sCalculated.put(periodStructure, lengths);
        return lengths;
    }
    
    
    /**
     * Internal member variable that stores the already calculated lengths in days of period types.
     */
    private static Map<LetoPeriodStructure, Long> sCalculatedLеngths = new HashMap<LetoPeriodStructure, Long>();
    /**
     * Calculate the duration in days of a given leto period structure.
     * @param periodStructure
     * @return
     */
    private static long calculateTotalLengthInDaysOfPeriodType(LetoPeriodStructure periodStructure) {
        
        if (sCalculatedLеngths.get(periodStructure) != null) {
            Long value = sCalculatedLеngths.get(periodStructure);
            return value.longValue();
        }
        LetoPeriodStructure[] subPeriods = periodStructure.getSubPeriods();
        long defaultLength = periodStructure.getTotalLengthInDays();
    
        if (subPeriods == null) {
            sCalculatedLеngths.put(periodStructure, defaultLength);
            return defaultLength;
        }
        long totalLengthInDays = 0;
        for (int subPeriodIndex = 0; subPeriodIndex < subPeriods.length; subPeriodIndex++) {
            LetoPeriodStructure subPeriod = subPeriods[subPeriodIndex];
            if (subPeriod == null) {
                continue;
            }
            LetoPeriodType type = subPeriod.getPeriodType();
            if (type == null) {
                continue;
            }
            LetoPeriodStructure[] structures = type.getPossibleStructures();
            if (structures == null) {
                continue;
            }

            LetoPeriodStructure structure = subPeriod;
            totalLengthInDays += calculateTotalLengthInDaysOfPeriodType(structure);
        }
        sCalculatedLеngths.put(periodStructure, totalLengthInDays);
        return totalLengthInDays;
    }
    
    
    /**
     * Check the correctness of the definition of a given type and return a human redable representation of the errors 
     * that have happened during this check. This method is intended to be used during debug or while the code is of 
     * a new child of LetoBase is created. It is intended to help developers create their own derivatives from 
     * LetoBase.
     * @param type The period type definition to be checked for correctness.
     * @return Human redable representation ofthe errors that hace happened.
     */
    public static String checkCorrectness(LetoPeriodType type) {
        LetoPeriodStructure[] structures = type.getPossibleStructures();
        if (structures == null) {
            return "No possible structures defined for period " + type.getName(LocaleStrings.ENGLISH) + " (" 
                     + type.getDescription(Locale.ENGLISH) + ").";
        }
        StringBuffer errors = new StringBuffer();
        for (int structureIndex = 0; structureIndex < structures.length; structureIndex ++) {
            LetoPeriodStructure structure = structures[structureIndex];
            if (structure == null) {
                errors.append(" *** Period named \"" + type.getName(LocaleStrings.ENGLISH) + "\" (" 
                        + type.getDescription(Locale.ENGLISH) 
                        + ") has been declared to support " + structures.length 
                        + "types of internal structures. However the format of internal structure with index " 
                        + structureIndex + " has not been declared (indexes start from 0).");
                continue;
            }
            long totalLengthInDays = structure.getTotalLengthInDays();
            long calculatedTotalLength = calculateTotalLengthInDaysOfPeriodType(structure);
            if (totalLengthInDays <= 0) {
                errors.append(" *** Period named \"" + type.getName(LocaleStrings.ENGLISH) + "\" (" 
                        + type.getDescription(Locale.ENGLISH) 
                        + ") has been declared to last for " + totalLengthInDays 
                        + "days, which is non possitive number.");
                continue;
            }
            if (calculatedTotalLength <=0 ) {
                errors.append(" *** Period named \"" + type.getName(LocaleStrings.ENGLISH) + "\" (" 
                        + type.getDescription(Locale.ENGLISH) 
                        + ") has been declared to last for " + totalLengthInDays 
                        + " days, but has been calculated to actually be " + calculatedTotalLength 
                        + " days, which is a non positive number.");
            }
            if (totalLengthInDays != calculatedTotalLength) {
                LetoPeriodStructure[] subPeriods = structure.getSubPeriods();
                StringBuffer subPeriodsString = new StringBuffer();
                if (subPeriods != null) {
                    for (int subPeriodIndex = 0; subPeriodIndex < subPeriods.length; subPeriodIndex++) {
                        try {
                            LetoPeriodType subPeriodType = null;
                            long subPeriodLength = 0;
                            try {
                                subPeriodType = subPeriods[subPeriodIndex].getPeriodType();
                                
                                LetoPeriodStructure subPeriodStructure = subPeriods[subPeriodIndex];
                                subPeriodLength = 
                                    calculateTotalLengthInDaysOfPeriodType(subPeriodStructure);
                            } catch (Throwable t) {
                            }
                            subPeriodsString.append("\"");
                            subPeriodsString.append(subPeriodType.getName(LocaleStrings.ENGLISH));
                            subPeriodsString.append("\" (");
                            subPeriodsString.append(subPeriodLength);
                            subPeriodsString.append(" days); ");
                        } catch (Throwable t) {
                            subPeriodsString.append("Exception: " + t.getClass().getName() + " : " 
                                    + t.getLocalizedMessage() + ".; ");
                        }
                    }
                }
                errors.append(" *** Period named \"" + type.getName(LocaleStrings.ENGLISH) + "\" (" 
                        + type.getDescription(Locale.ENGLISH) 
                        + "), has defined " + structures.length 
                        + " possible structures. The structure with index " + structureIndex 
                        + " has been declared to take up " + totalLengthInDays 
                        + " days, hawever it was calculated to " + calculatedTotalLength 
                        + " days (indexes start from 0). This structure consists of " 
                        + subPeriodsString.toString() + ".");
            }

            
        }
        if (errors == null || errors.length() <= 0) {
            return null;
        }
        return errors.toString();
    }
    
    /**
     * Check internal correctness of the calendar definitions.
     * This is a method that is intended to be run during debug and testing only. It is intended to support developers
     * when deffining new classes that derive from LetoBase.
     * @param types The period types of the given calendar.
     * @param leto Check correctness of the calculation of a particular calendar.
     * @return A string representation of the errors that happened while checking the correctness of the type 
     * definitions in the calendar.
     */
    public static String checkCorrectness(LetoPeriodType[] types, Leto leto) {
        if (types == null) {
            return " ### Calendar Instance " + leto.getClass().getName() + " : " + leto.toString() 
                + " does not have any period types defined.";
        }
        StringBuffer errors = new StringBuffer();
        for (int typeIndex = 0; typeIndex < types.length; typeIndex++) {
            LetoPeriodType type = types[typeIndex];
            if (type == null) {
                errors.append(" ### Calendar Instance " + leto.getClass().getName() + " : " + leto.toString() 
                        + " has " + types.length + " period type definitions. However period type definition with index "
                        + typeIndex + " is invalid (null) (indexes start from 0).");
            } else {
System.out.println("Checking type: " + type.getName(LocaleStrings.ENGLISH));
                if (type instanceof LetoPeriodTypeBase) {
                    String error = checkCorrectness(type);
                    if (error != null && error.length() > 0) {
                        errors.append(" ### Calendar Instance " + leto.getClass().getName() + " : " 
                                + leto.toString() + " has " + types.length 
                                + " period type definitions. However period type definition with index "
                                + typeIndex + " (" + type.getName(LocaleStrings.ENGLISH) + " : " 
                                + type.getDescription(Locale.ENGLISH) 
                                + ") has some errors (indexes start at 0). Errors are: " + error + ".");
                    }
                }
            }
        }
        if (errors == null || errors.length() <= 0) {
            return null;
        }
        return errors.toString();
    }
    

    
}
