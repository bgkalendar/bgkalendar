
function LetoCorrectnessChecks() {

    this.sCalculated = new Map(); // LetoPeriodStructure, Map<LetoPeriodType, Long>
    this.calcuateLengthInPeriodTypes = function (periodStructure) {
        var lengths = null; // Map<LetoPeriodType, Long>
        lengths = sCalculated.get(periodStructure);
        if (lengths != null) {
            return lengths;
        }
        lengths = new Map();                              //<LetoPeriodType, Long>
        substructures = periodStructure.getSubPeriods();  // LetoPeriodStructure[] 
        for (var i = 0; substructures != null && i < substructures.length; i++) {
            substructure = substructures[i];              //LetoPeriodStructure 
            subtype = substructure.getPeriodType();       //LetoPeriodType 
            
            var count = lengths.get(subtype);
            if (count == null) {
                count = 1;
            } else {
                count = count + 1;
            }
            lengths.put(subtype, count);
            
            if (substructure.getTotalLengthInDays() > periodStructure.getTotalLengthInDays()) {
                throw new Error("Illegal state. The Period Type structure which has " 
                      + periodStructure.getTotalLengthInDays() 
                      + " days has been declared to contain a substructure " + subtype.getName(LocaleStrings.ENGLISH) 
                      + " with " + substructure.getTotalLengthInDays() + " days.");
            }
            
            var subLengths = calcuateLengthInPeriodTypes(substructure);    // Map<LetoPeriodType, Long>
            var keySet = subLengths.keySet();                              // <LetoPeriodType>
            var iterator = keySet.iterator();                              // Iterator<LetoPeriodType>
            while (iterator.hasNext()) {
                var type = iterator.next();                                // LetoPeriodType
                var len = subLengths.get(type);
                
                var numberCount = lengths.get(type);
                if (numberCount == null) {
                    numberCount = len;
                } else {
                    numberCount = numberCount + len;
                }
                lengths.put(type, numberCount);

            }
        }
        sCalculated.put(periodStructure, lengths);
        return lengths;
    }
    
    
    /**
     * Internal member variable that stores the already calculated lengths in 
     * days of period types.
     */
    this.sCalculatedLеngths = new Map(); //Map<LetoPeriodStructure, Long>

    /**
     * Calculate the duration in days of a given leto period structure.
     * @param periodStructure
     * @return
     */
    this.calculateTotalLengthInDaysOfPeriodType = function (periodStructure) {
        
        if (sCalculatedLеngths.get(periodStructure) != null) {
            var value = sCalculatedLеngths.get(periodStructure);
            return value.longValue();
        }
        var subPeriods = periodStructure.getSubPeriods();                 //  LetoPeriodStructure[]
        var defaultLength = periodStructure.getTotalLengthInDays();
    
        if (subPeriods == null) {
            sCalculatedLеngths.put(periodStructure, defaultLength);
            return defaultLength;
        }
        var totalLengthInDays = 0;
        for (var subPeriodIndex = 0; subPeriodIndex < subPeriods.length; subPeriodIndex++) {
            var subPeriod = subPeriods[subPeriodIndex];                   // LetoPeriodStructure
            if (subPeriod == null) {
                continue;
            }
            var type = subPeriod.getPeriodType();                         //  LetoPeriodType
            if (type == null) {
                continue;
            }
            var structures = type.getPossibleStructures();                // LetoPeriodStructure[]
            if (structures == null) {
                continue;
            }

            var structure = subPeriod;                                    //  LetoPeriodStructure
            totalLengthInDays += calculateTotalLengthInDaysOfPeriodType(structure);
        }
        sCalculatedLеngths.put(periodStructure, totalLengthInDays);
        return totalLengthInDays;
    }
    
    
    /**
     * Check the correctness of the definition of a given type and return a 
     * human redable representation of the errors that have happened during 
     * this check. This method is intended to be used during debug or while the
     * code is of a new child of LetoBase is created. It is intended to help 
     * developers create their own derivatives from LetoBase.
     * @param type The period type definition to be checked for correctness.
     * @return Human redable representation ofthe errors that hace happened.
     */
    this.checkCorrectness = funciton (type) {
        var structures = type.getPossibleStructures();                                         // LetoPeriodStructure[] 
        if (structures == null) {
            return "No possible structures defined for period " + type.getName(LocaleStrings.ENGLISH) + " (" 
                     + type.getDescription(Locale.ENGLISH) + ").";
        }
        var errors = "";
        for (var structureIndex = 0; structureIndex < structures.length; structureIndex ++) {
            var structure = structures[structureIndex];                                       // LetoPeriodStructure
            if (structure == null) {
                errors+= " *** Period named \"" + type.getName("en") + "\" (" 
                        + type.getDescription("en") 
                        + ") has been declared to support " + structures.length 
                        + "types of internal structures. However the format of internal structure with index " 
                        + structureIndex + " has not been declared (indexes start from 0).";
                continue;
            }
            var totalLengthInDays = structure.getTotalLengthInDays();
            var calculatedTotalLength = calculateTotalLengthInDaysOfPeriodType(structure);
            if (totalLengthInDays <= 0) {
                errors += " *** Period named \"" + type.getName("en") + "\" (" 
                        + type.getDescription("en") 
                        + ") has been declared to last for " + totalLengthInDays 
                        + "days, which is non possitive number.";
                continue;
            }
            if (calculatedTotalLength <=0 ) {
                errors.append(" *** Period named \"" + type.getName("en") + "\" (" 
                        + type.getDescription("en") 
                        + ") has been declared to last for " + totalLengthInDays 
                        + " days, but has been calculated to actually be " + calculatedTotalLength 
                        + " days, which is a non positive number.");
            }
            if (totalLengthInDays != calculatedTotalLength) {
                var subPeriods = structure.getSubPeriods(); // LetoPeriodStructure[]
                var subPeriodsString = "";
                if (subPeriods != null) {
                    for (var subPeriodIndex = 0; subPeriodIndex < subPeriods.length; subPeriodIndex++) {
                        try {
                            var subPeriodType = null; // LetoPeriodType 
                            var subPeriodLength = 0;
                            try {
                                subPeriodType = subPeriods[subPeriodIndex].getPeriodType();
                                
                                LetoPeriodStructure subPeriodStructure = subPeriods[subPeriodIndex];
                                subPeriodLength = 
                                    calculateTotalLengthInDaysOfPeriodType(subPeriodStructure);
                            } catch (t) {
                            }
                            subPeriodsString += "\"";
                            subPeriodsString += subPeriodType.getName("en");
                            subPeriodsString += "\" (";
                            subPeriodsString += subPeriodLength;
                            subPeriodsString += " days); ";
                        } catch (t) {
                            subPeriodsString += "Exception: " + t.getClass().getName() + " : " 
                                    + t.getLocalizedMessage() + ".; ";
                        }
                    }
                }
                errors += " *** Period named \"" + type.getName("en") + "\" (" 
                        + type.getDescription("en") 
                        + "), has defined " + structures.length 
                        + " possible structures. The structure with index " + structureIndex 
                        + " has been declared to take up " + totalLengthInDays 
                        + " days, hawever it was calculated to " + calculatedTotalLength 
                        + " days (indexes start from 0). This structure consists of " 
                        + subPeriodsString.toString() + ".";
            }

            
        }
        if (errors == null || errors.length <= 0) {
            return null;
        }
        return errors;
    }
    
    /**
     * Check internal correctness of the calendar definitions.
     * This is a method that is intended to be run during debug and testing only
     * . It is intended to support developers when deffining new classes that 
     * derive from LetoBase.
     * @return A string representation of the errors that happened while 
     * checking the correctness of the type definitions in the calendar.
     */
    this.checkCorrectness = function (/*LetoPeriodType[]*/ types, /*Leto*/ leto) {
        if (types == null) {
            return " ### Calendar Instance " + leto.getClass().getName() + " : " + leto 
                + " does not have any period types defined.";
        }
        var errors = "";
        for (var typeIndex = 0; typeIndex < types.length; typeIndex++) {
            var type = types[typeIndex]; // LetoPeriodType 
            if (type == null) {
                errors += " ### Calendar Instance " + leto.getClass().getName() + " : " + leto
                        + " has " + types.length + " period type definitions. However period type definition with index "
                        + typeIndex + " is invalid (null) (indexes start from 0).";
            } else {
                if (type instanceof LetoPeriodTypeBase) {
                    var error = checkCorrectness(type);
                    if (error != null && error.length() > 0) {
                        errors += " ### Calendar Instance " + leto.getClass().getName() + " : " 
                                + leto.toString() + " has " + types.length 
                                + " period type definitions. However period type definition with index "
                                + typeIndex + " (" + type.getName("en") + " : " 
                                + type.getDescription("en") 
                                + ") has some errors (indexes start at 0). Errors are: " + error + ".";
                    }
                }
            }
        }
        if (errors == null || errors.length() <= 0) {
            return null;
        }
        return errors;
    }
}

if (module != null && module.exports != null)  {
  module.exports = LetoCorrectnessCheck
}

