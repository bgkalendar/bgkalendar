<?php

class LetoGregorianDayPeriodBc extends LetoPeriodBean {

    private $mDayPeriod = null;
    private $mParentMonth = null;

    public function __construct($dayperiod, $parentmonth) {
      $this->mDayPeriod = $dayperiod;
      $this->mParentMonth = $parentmonth;
      
      $absoluteNumber = $this->mDayPeriod->getAbsoluteNumber();
      $number          = $this->mDayPeriod->getNumber();
      $type           = $this->mDayPeriod->getType();
      $struct         = $this->mDayPeriod->getStructure();
      $daysAfterEpoch = $this->mDayPeriod->startsAtDaysAfterEpoch(); 

      parent::setAbsoluteNumber ($absoluteNumber);
      parent::setNumber         ($number);
      parent::setType           ($type);
      parent::setStructure      ($struct);
      parent::setStartAtDaysAfterEpoch($daysAfterEpoch); 

      $structures = parent::getType()->getPossibleStructures();
      if ($structures == null || count($structures) <= 0) {
        throw new LetoExceptionUnrecoverable("No structure defned for day Before Christ. A structure with total number of days 1 was expected.");
      }
      if (count($structures) > 1) {
        throw new LetoExceptionUnrecoverable("More thatn one (" . count($structures).") defined for a day Before Christ. Just one structure with total length of 1 day was expected.");
      }
      $structure = $structures[0];
      if ($structure == null) {
        throw new LetoExceptionUnrecoverable("The inturnal structure for a day Before Christ is missing. A structure of total length of just one day was expected.");
      }
      $days = $structure->getTotalLengthInDays();
      if ($days != 1) {
        throw new LetoExceptionUnrecoverable("Internal structure for a day Before Christ cannot be ".$days." days. A structure with total length of just one day was expected.");
      }
      $days = parent::getStructure()->getTotalLengthInDays();
      if ($days != 1) {
        throw new LetoExceptionUnrecoverable("Structure for a day Before Christ cannot be ".$days." days. A structure with total length of just one day was expected.");
      }
    }
    
    public function getActualName() {
      $number = $this->getNumber();
      return "".$number;
    }

    public function getNumber() {
      $days = $this->mParentMonth->getStructure()->getTotalLengthInDays();
      $number = $days - parent::getNumber() - 1; // Because getNumber() returns and should return a 0-based index  
      return $number;
    }
}
?>
