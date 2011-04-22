<?php

require_once 'AppController.php';

class Index_Controller extends App_Controller
{

    public function main() {
        $this->month = date('F');
        $this->year = date('Y');
        
        $month_num = date('n');
        $year_num = date('Y');
        
        $start_day = mktime( 0, 0, 0, $month_num, 1, $year_num);
        $start_dow = date( 'w', $start_day );
        $thismonth_days = date( 't', $start_day );
        $lastmonth_days = date( 't', strtotime( '-1 month', $start_day ) );
        
        $this->day_array = array();
        $cycles = 0;
        for( $i = 1 - $start_dow; $i < $thismonth_days || $cycles % 7 != 0; $i++ ) {
            $cycles++;
            
            $occupied = rand(1,4);
            
            if( $i < 1 ) {
                $this->day_array[] = array( 'day' => $lastmonth_days + $i, 'occupied' => ( $occupied == 1 ) );
            } elseif( $i > $thismonth_days ) {
                $this->day_array[] = array( 'day' => $i - $thismonth_days, 'occupied' => ( $occupied == 1 ) );
            } else {
                $this->day_array[] = array( 'day' => $i, 'today' => ( $i == date( 'j' ) ) ? true : false, 'occupied' => ( $occupied == 1 ) );
            }
        }
    }

}