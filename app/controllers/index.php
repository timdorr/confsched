<?php

require_once 'AppController.php';

class Index_Controller extends App_Controller
{

    public function main() {
        
        // Get some data from the database for agenda
        $this->agenda = EventQuery::create()
                        ->filterByStart( strtotime('-14 days') , Criteria::GREATER_THAN )
                        ->orderByStart()
                        ->find();
        
        // Prep the input and time
        $this->month_num = ( $this->input['month'] ) ? $this->input['month'] : date('n');
        $year_num = ( $this->input['year'] ) ? $this->input['year'] : date('Y');
        $start_day = mktime( 0, 0, 0, $this->month_num, 1, $year_num);
        
        $this->month = date( 'F', $start_day );
        $this->year = date( 'Y', $start_day );

        $start_dow = date( 'w', $start_day );
        $thismonth_days = date( 't', $start_day );
        $lastmonth_days = date( 't', strtotime( '-1 month', $start_day ) );
    
        // Get some data from the database for the side calendar
        $events = EventQuery::create()
                  ->filterByStart( strtotime( '-10 days', $start_day ), Criteria::GREATER_THAN )
                  ->find();
        
        $event_dates = array();
        foreach( $events as $event ) {
            $event_dates[] = date( 'n-j-Y', strtotime( $event->getStart() . ' +1 day' ) );
        }
        
        // Create an array of the days on the calendar
        $this->day_array = array();
        $cycles = 0;
        for( $i = 1 - $start_dow; $i < $thismonth_days || $cycles % 7 != 0; $i++ ) {
            $cycles++;

            if( $i < 1 ) {
                $this->day_array[] = array( 'month' => date( 'n', strtotime( '-1 month', $start_day ) ), 
                                            'day' => $lastmonth_days + $i, 
                                            'occupied' => in_array( date( 'n-j-Y', strtotime( "+".($i)." days", $start_day ) ), $event_dates ) );
            } elseif( $i > $thismonth_days ) {
                $this->day_array[] = array( 'month' => date( 'n', strtotime( '+1 month', $start_day ) ), 
                                            'day' => $i - $thismonth_days, 
                                            'occupied' => in_array( date( 'n-j-Y', strtotime( "+".($i)." days", $start_day ) ), $event_dates ) );
            } else {
                $this->day_array[] = array( 'month' => $this->month_num, 'day' => $i, 
                                            'today' => ( $i == date( 'j' ) ) ? true : false, 
                                            'occupied' => in_array( date( 'n-j-Y', strtotime( "+".($i)." days", $start_day ) ), $event_dates ) );
            }
        }
    }

    public function add() {
        $this->noglobal = true;
    }

    public function checkemail() {
        $this->noglobal = true;    
    }

}