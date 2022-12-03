<?php

class LetoPeriodBean implements LetoPeriod {

    private $mAbsoluteNumber = 0; // long
    
    private $mNumber = 0; // long
    
    private $mActualName = "";                  // String
    
    private $mType = null; // LetoPeriodType
    
    private $mStructure = null; // LetoPeriodStructure
    
    private $mStartAfterEpoch = 0; // long
    
    /** @param days long */
    public function setStartAtDaysAfterEpoch($days) {
        $this->mStartAfterEpoch = $days;
    }
    
    public function setAbsoluteNumber($absoluteNumber) {
        $this->mAbsoluteNumber = $absoluteNumber;
    }
    
    /** @return long*/
    public function getAbsoluteNumber() {
        return $this->mAbsoluteNumber;
    }

    public function setActualName($name) {
        if ($name === null) {
            throw new LetoException("The actual name of a period cannot be null."
                    . "If you want to leave it unspecified, please use empty string \"\" instead. "
                    . "Examples for such names are: \"Monday\", \"Tuesday\", \"Wednessday\", etc... "
                    . "if the period is day of the week for examle.");
        }
        $this->mActualName = $name;
    }
    
    
    public function getActualName() {
        return $this->mActualName;
    }

    /** @param number (long) */
    public function setNumber($number) {
        $this->mNumber = $number;
    }
    
    public function getNumber() {
        return $this->mNumber;
    }

    /** @param type LetoPeriodType */
    public function setType($type) {
        $this->mType = $type;
    }
    
    /** @return LetoPeriodType */
    public function getType() {
        return $this->mType;
    }

    /** @param structure LetoPeriodStructure */
    public function setStructure(&$structure) {
        $this->mStructure = &$structure;
    }
    
    public function getStructure() {
        return $this->mStructure;
    }

    public function startsAtDaysAfterEpoch() {
        return $this->mStartAfterEpoch;
    }

}
?>
