<?php

abstract class LetoPeriodTypeBase implements LetoPeriodType {
    
    public abstract function getDescription(); // String 

    public abstract function getName();        // String

    /** @return LetoPeriodStructure[] */
    public abstract function getPossibleStructures();

}
?>
