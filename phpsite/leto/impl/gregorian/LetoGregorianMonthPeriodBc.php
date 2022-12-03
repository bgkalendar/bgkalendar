<?php

class LetoGregorianMonthPeriodBc extends LetoPeriodBean {

    private $mMonthPeriod = null;

    public function __construct($dayperiod) {
      $this->mMonthPeriod = $dayperiod;
      
      $absoluteNumber = $this->mMonthPeriod->getAbsoluteNumber();
      $number          = $this->mMonthPeriod->getNumber();
      $type           = $this->mMonthPeriod->getType();
      $struct         = $this->mMonthPeriod->getStructure();
      $daysAfterEpoch = $this->mMonthPeriod->startsAtDaysAfterEpoch(); 

      parent::setAbsoluteNumber ($absoluteNumber);
      parent::setNumber         ($number);
      parent::setType           ($type);
      parent::setStructure      ($struct);
      parent::setStartAtDaysAfterEpoch($daysAfterEpoch); 
    }
    
    public function getActualName() {
      $number = $this->getNumber();
      return "".$number;
    }

    public function getNumber() {
      $number = 11 - parent::getNumber();  
      return $number;
    }
}
?>
