<?php

require_once 'AppController.php';

class Index_Controller extends App_Controller
{

    public function main() {
        $this->month_num = ( $this->input['month'] ) ? $this->input['month'] : date('n');
        $year_num = ( $this->input['year'] ) ? $this->input['year'] : date('Y');
        $start_day = mktime( 0, 0, 0, $this->month_num, 1, $year_num);
        
        $this->month = date( 'F', $start_day );
        $this->year = date( 'Y', $start_day );

        $start_dow = date( 'w', $start_day );
        $thismonth_days = date( 't', $start_day );
        $lastmonth_days = date( 't', strtotime( '-1 month', $start_day ) );
        
        $this->day_array = array();
        $cycles = 0;
        for( $i = 1 - $start_dow; $i < $thismonth_days || $cycles % 7 != 0; $i++ ) {
            $cycles++;
            
            $occupied = rand(1,4);
            
            if( $i < 1 ) {
                $this->day_array[] = array( 'month' => date( 'n', strtotime( '-1 month', $start_day ) ), 
                                            'day' => $lastmonth_days + $i, 
                                            'occupied' => ( $occupied == 1 ) );
            } elseif( $i > $thismonth_days ) {
                $this->day_array[] = array( 'month' => date( 'n', strtotime( '+1 month', $start_day ) ), 
                                            'day' => $i - $thismonth_days, 
                                            'occupied' => ( $occupied == 1 ) );
            } else {
                $this->day_array[] = array( 'month' => $this->month_num, 'day' => $i, 
                                            'today' => ( $i == date( 'j' ) ) ? true : false, 
                                            'occupied' => ( $occupied == 1 ) );
            }
        }
    }

}