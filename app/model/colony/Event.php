<?php



/**
 * Skeleton subclass for representing a row from the 'event' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.colony
 */
class Event extends BaseEvent {

    public function getTitle() {
        if( $this->getIspublic() == 1 )
            return parent::getTitle();
        else
            return "Reserved";
    }

} // Event
