<?php

class LetoPeriodStructureBean implements LetoPeriodStructure {

    private $mSubPeriods = null; // LetoPeriodStructure[]
    
    private $mPeriodType = null; // LetoPeriodType
    private $mTotalLengthInDays = 0; // long
    private $mTotalLengthInPeriodTyps = null; // Map<LetoPeriodType, Long>
    private $isLeap;
    
    
    /** long totalLengthInDays, LetoPeriodStructure[] subPeriods */
    public function __construct($totalLengthInDays, $subPeriods, $isLeap = false) 
    {
        $this->mSubPeriods = $subPeriods;
        $this->mTotalLengthInDays = $totalLengthInDays;
	$this->isLeap = $isLeap;
    }
    
    /**
     * @return LetoPeriodType
     */
    public function getPeriodType() {
        return $this->mPeriodType;
    }
    
    /**
     * @param period (LetoPeriodType)
     * @throws LetoExceptionUnrecoverable
     */
    public function setPeriodType($period) {
        if ($this->mPeriodType != null && $period != null) {
            throw new LetoExceptionUnrecoverable("Period Type for " . $this->mTotalLengthInDays 
                  . " day period is already set to \"" 
                  . $period->getName() . "\". Cannot reset it to \"" . $period->getName() . "\".");
        }
        $this->mPeriodType = $period;
    }
    
    /** @param subPeriods LetoPeriodStructure[] */
    public function setSubPeriods($subPeriods) {
        $this->mSubPeriods = $subPeriods;
    }
    
    /** @return LetoPeriodStructure[]*/
    public function getSubPeriods() {
        return $this->mSubPeriods;
    }

    /** @param lengthInDays (long)*/
    public function setTotalLengthInDays($lengthInDays) {
        $this->mTotalLengthInDays = $lengthInDays;
    }
    
    /** Map<LetoPeriodType, Long> lengthsInPeriodTypes*/
    public function setTotalLengthInPeriodTypes($lengthsInPeriodTypes) {
        $this->mTotalLengthInPeriodTyps = $lengthsInPeriodTypes;
    }
    
    /** @return long*/
    public function getTotalLengthInDays() {
         return $this->mTotalLengthInDays;
    }

    /** 
     * @param periodType LetoPeriodType
     * @return long
     */
    public function getTotalLengthInPeriodTypes($periodType) {
        if ($periodType == $this->getPeriodType()) {
            return 1;
        }
        if ($this->mTotalLengthInPeriodTyps == null) {
            return 0;
        }
        $countLong = 0;
        if( isset($this->mTotalLengthInPeriodTyps[$periodType->getName()])) {
           $countLong = $this->mTotalLengthInPeriodTyps[$periodType->getName()];
        }
        return $countLong;
    }
    
    public function toString() {
        return getPeriodType() . " of " . $this->getTotalLengthInDays() . " days";
    }

    public function getName($locale) {
        return $this->getPeriodType()->getName().($this->isLeap?' Leap':'');
    }

}
?>
