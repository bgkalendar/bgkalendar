<?php

class LetoPeriodTypeBean extends LetoPeriodTypeBase {

    private $mName = null;
    
    private $mDescription = null;
    
    private $mPossibleStructures = null; // LetoPeriodStructure[]

    private $mTotalLengthDays = 0;
    
    /** 
     * @param structures LetoPeriodStructure[]
     * @throws LetoExceptionUnrecoverable
     */
    public function __construct($name, $description, $structures) 
    {
        $this->setName($name);
        $this->setDescription($description);
        $this->setPossibleStructures($structures);
        if ($structures != null) {
            for ($i = 0; $i < count($structures); $i++) {
                $structures[$i]->setPeriodType($this);             // Can throw LetoException 
            }
        }
    }

    public function setDescription($description) {
        $this->mDescription = $description;
    }
    
    
    public function getDescription() {
        return $this->mDescription;
    }

    public function setName($name) {
        $this->mName = $name;
    }
    
    public function getName() {
        return $this->mName;
    }

    /** @param structures LetoPeriodStructure[]*/
    public function setPossibleStructures($structures) {
        $this->mPossibleStructures = $structures;
    }
    
    /**
     * @return LetoPeriodStructure[] 
     */
    public function getPossibleStructures() {
        return $this->mPossibleStructures;
    }
    
    public function toString() {
        return $this->getName();
    }

    public function setTotalLengthInDays($days) {
        $this->mTotalLengthDays = $days;
    }

    public function getTotalLengthInDays() {
        return $this->mTotalLengthDays;
    }
}
?>
