<?php

class LetoCorrectnessChecks {

    private static $sCalculated = array();

    /*
     * @param periodStructure LetoPeriodStructure 
     * @return Map<LetoPeriodType, Long>
     */
    public static function calcuateLengthInPeriodTypes($periodStructure) {
        $lengths = null;
        $lengths = $sCalculated.get($periodStructure);
        if ($lengths != null) {
            return $lengths;
        }
        $lengths = array();
        $substructures = $periodStructure.getSubPeriods();
        for ($i = 0; $substructures != null && $i < $substructures.length; $i++) {
            $substructure = $substructures[$i];
            $subtype = $substructure.getPeriodType();
            
            $count = $lengths.get($subtype);
            if ($count == null) {
                $count = new Long(1);
            } else {
                $count = new Long($count.longValue() + 1);
            }
            $lengths.put($subtype, $count);
            
            if ($substructure.getTotalLengthInDays() > $periodStructure.getTotalLengthInDays()) {
                throw new RuntimeException("Illegal state. The Period Type structure which has " 
                      . $periodStructure.getTotalLengthInDays() 
                      . " days has been declared to contain a substructure " . $subtype.getName() . " with " 
                      . $substructure.getTotalLengthInDays() . " days.");
            }
            
            $subLengths = calcuateLengthInPeriodTypes($substructure);
            $keySet = $subLengths.keySet();
            $iterator = $keySet.iterator();
            while ($iterator.hasNext()) {
                $type = $iterator.next();
                $len = $subLengths.get($type);
                
                $numberCount = $lengths.get($type);
                if ($numberCount == null) {
                    $numberCount = $len;
                } else {
                    $numberCount = new Long($numberCount.longValue() + $len.longValue());
                }
                $lengths.put($type, $numberCount);

            }
        }
        $sCalculated.put($periodStructure, $lengths);
        return $lengths;
    }
    
    
    /**
     * Internal member variable that stores the already calculated lengths in days of period types.
     * @return Map<LetoPeriodStructure, Long>
     */
    private static $sCalculatedLеngths = array();
    /**
     * Calculate the duration in days of a given leto period structure.
     * @param periodStructure (LetoPeriodStructure)
     * @return long
     */
    private static function calculateTotalLengthInDaysOfPeriodType($periodStructure) {
        
        if ($sCalculatedLеngths.get($periodStructure) != null) {
            $value = $sCalculatedLеngths.get($periodStructure);
            return $value.longValue();
        }
        $subPeriods = $periodStructure.getSubPeriods();
        $defaultLength = $periodStructure.getTotalLengthInDays();
    
        if ($subPeriods == null) {
            $sCalculatedLеngths.put($periodStructure, $defaultLength);
            return $defaultLength;
        }
        $totalLengthInDays = 0;
        for ($subPeriodIndex = 0; $subPeriodIndex < $subPeriods.length; $subPeriodIndex++) {
            $subPeriod = $subPeriods[$subPeriodIndex];
            if ($subPeriod == null) {
                continue;
            }
            $type = $subPeriod.getPeriodType();
            if ($type == null) {
                continue;
            }
            $structures = $type.getPossibleStructures();
            if ($structures == null) {
                continue;
            }

            $structure = $subPeriod;
            $totalLengthInDays += calculateTotalLengthInDaysOfPeriodType($structure);
        }
        $sCalculatedLеngths.put($periodStructure, $totalLengthInDays);
        return $totalLengthInDays;
    }
    
    
    /**
     * Check the correctness of the definition of a given type and return a human redable representation of the errors 
     * that have happened during this check. This method is intended to be used during debug or while the code is of 
     * a new child of LetoBase is created. It is intended to help developers create their own derivatives from 
     * LetoBase.
     * @param type The period type definition to be checked for correctness. (LetoPeriodType)
     * @return Human redable representation ofthe errors that hace happened. (String)
     */
    public static function checkCorrectness($type) {
        $structures = $type.getPossibleStructures();
        if ($structures == null) {
            return "No possible structures defined for period " . $type.getName() . " (" . $type.getDescription() . ").";
        }
        $errors = new StringBuffer();
        for ($structureIndex = 0; $structureIndex < $structures.length; $structureIndex ++) {
            $structure = $structures[$structureIndex];
            if ($structure == null) {
                $errors.=" *** Period named \"" . $type.getName() . "\" (" . $type.getDescription() 
                        . ") has been declared to support " . $structures.length 
                        . "types of internal structures. However the format of internal structure with index " 
                        . $structureIndex . " has not been declared (indexes start from 0).";
                continue;
            }
            $totalLengthInDays = $structure.getTotalLengthInDays();
            $calculatedTotalLength = calculateTotalLengthInDaysOfPeriodType($structure);
            if ($totalLengthInDays <= 0) {
                $errors.=" *** Period named \"" . $type.getName() . "\" (" . $type.getDescription() 
                        . ") has been declared to last for " + $totalLengthInDays 
                        . "days, which is non possitive number.";
                continue;
            }
            if ($calculatedTotalLength <=0 ) {
                $errors.=" *** Period named \"" . $type.getName() . "\" (" . $type.getDescription() 
                        . ") has been declared to last for " . $totalLengthInDays 
                        . " days, but has been calculated to actually be " . calculatedTotalLength 
                        . " days, which is a non positive number.";
            }
            if ($totalLengthInDays != $calculatedTotalLength) {
                $subPeriods = $structure.getSubPeriods();
                $subPeriodsString = new StringBuffer();
                if ($subPeriods != null) {
                    for ($subPeriodIndex = 0; $subPeriodIndex < $subPeriods.length; $subPeriodIndex++) {
                        try {
                            $subPeriodType = null;
                            $subPeriodLength = 0;
                            try {
                                $subPeriodType = $subPeriods[$subPeriodIndex].getPeriodType();
                                
                                $subPeriodStructure = $subPeriods[$subPeriodIndex];
                                $subPeriodLength = 
                                    calculateTotalLengthInDaysOfPeriodType($subPeriodStructure);
                            } catch (Throwable $t) {
                            }
                            $subPeriodsString.="\"";
                            $subPeriodsString.=$subPeriodType.getName();
                            $subPeriodsString.="\" (";
                            $subPeriodsString.=$subPeriodLength;
                            $subPeriodsString.=" days); ";
                        } catch (Throwable $t) {
                            $subPeriodsString.="Exception: " . $t.getClass().getName() . " : " 
                                    . t.getLocalizedMessage() . ".; ";
                        }
                    }
                }
                $errors.=" *** Period named \"" . $type.getName() . "\" (" . $type.getDescription() 
                        . "), has defined " . $structures.length 
                        . " possible structures. The structure with index " . $structureIndex 
                        . " has been declared to take up " . $totalLengthInDays 
                        . " days, hawever it was calculated to " . $calculatedTotalLength 
                        . " days (indexes start from 0). This structure consists of " 
                        . $subPeriodsString.toString() . ".";
            }

            
        }
        if ($errors == null || $errors.length() <= 0) {
            return null;
        }
        return $errors.toString();
    }
    
    /**
     * Check internal correctness of the calendar definitions.
     * This is a method that is intended to be run during debug and testing only. It is intended to support developers
     * when deffining new classes that derive from LetoBase.
     * @param types (LetoPeriodType[]) 
     * @param leto (Leto)
     * @return A string representation of the errors that happened while checking the correctness of the type 
     * definitions in the calendar. (String)
     */
    public static function checkCorrectnessTypeLeto($types, $leto) {
        if ($types == null) {
            return " ### Calendar Instance " . $leto.getClass().getName() . " : " . $leto.toString() 
                . " does not have any period types defined.";
        }
        $errors = new StringBuffer();
        for ($typeIndex = 0; $typeIndex < $types.length; $typeIndex++) {
            $type = $types[$typeIndex];
            if ($type == null) {
                $errors.=" ### Calendar Instance " . $leto.getClass().getName() . " : " . $leto.toString() 
                        . " has " . $types.length . " period type definitions. However period type definition with index "
                        . $typeIndex . " is invalid (null) (indexes start from 0).";
            } else {
                if ($type instanceof LetoPeriodTypeBase) {
                    $error = checkCorrectness($type);
                    if ($error != null && $error.length() > 0) {
                        $errors.=" ### Calendar Instance " . $leto.getClass().getName() . " : " 
                                . $leto.toString() . " has " . $types.length 
                                . " period type definitions. However period type definition with index "
                                . $typeIndex . " (" . $type.getName() . " : " . $type.getDescription() 
                                . ") has some errors (indexes start at 0). Errors are: " . $error . ".";
                    }
                }
            }
        }
        if ($errors == null || $errors.length() <= 0) {
            return null;
        }
        return $errors.toString();
    }
    
}
?>
