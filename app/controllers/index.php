<?php

require_once 'AppController.php';
require_once 'HTTP/Request.php';

class Index_Controller extends App_Controller
{

    public function main() {
        
        // Get some data from the database for agenda
        $this->agenda = EventQuery::create()
                        ->filterByStart( strtotime('-14 days') , Criteria::GREATER_THAN )
                        ->filterByKey( '' )
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
        $this->result = 0;
        
        // If we're submitting
        if( $this->input['email'] ) {
            $this->result = 1;
            
            // Error checking
            $errors = array();
            
            // Empty checks
            if( empty( $this->input['title'] ) )
                $errors[] = 'The event must have a title';
            
            if( empty( $this->input['date'] ) )
                $errors[] = 'The event must have a date';
            
            if( empty( $this->input['start'] ) || empty( $this->input['end'] ) )
                $errors[] = 'The event must have a time';
                
            // Save the start and end time for later
            $start = strtotime( $this->input['date'] . ' ' . $this->input['start'] );
            $end = strtotime( $this->input['date'] . ' ' . $this->input['end'] );
            
            // Check that formatting was correct
            if( $start == 0 || $end == 0 )
                $errors[] = "The time and/or date isn't formatted correctly";
            
            // Swap the times if they're backwards
            if( $end < $start ) {
                $t = $end;
                $end = $start;
                $start = $t;
            }
            
            // Can't be in the past.
            if( $start < time() )
                $errors[] = "The event can't be in the past";

            // Check for overlapping events                
            $start_overlap = EventQuery::create()
                        ->filterByStart( $start, Criteria::LESS_EQUAL )
                        ->filterByEnd( $start, Criteria::GREATER_THAN )
                        ->filterByKey( '' )
                        ->find();
            $end_overlap = EventQuery::create()
                        ->filterByStart( $end, Criteria::LESS_THAN )
                        ->filterByEnd( $end, Criteria::GREATER_EQUAL )
                        ->filterByKey( '' )
                        ->find();
            $mid_overlap = EventQuery::create()
                        ->filterByStart( $start, Criteria::GREATER_EQUAL )
                        ->filterByEnd( $end, Criteria::LESS_EQUAL )
                        ->filterByKey( '' )
                        ->find();
            if( count($start_overlap) + count($end_overlap) + count($mid_overlap) > 0 )
                $errors[] = "The room is already reserved at that time";
            
            // If there are no errors, success!
            if( count( $errors ) == 0 ) {
                // Create the event
                $event = new Event();
                
                $event->setTitle( $this->input['title'] );
                $event->setDescription( $this->input['description'] );
                $event->setIspublic( $this->input['public'] );
                
                $event->setStart( $start );
                $event->setEnd( $end );
                
                $event->setEmail( $this->input['email'] );
                $event->setKey( sha1( time() + rand() ) );
            
                $event->save();
                
                mail( $this->input['email'],
                      "Ignition Alley :: Confirm Your Event",
"Hi There,

We've gotten your request to reserve the Ignition Alley conference room. In order to confirm your time, please click the link below:

http://".$_SERVER["HTTP_HOST"]."/confirm?key=".$event->getKey()."

If you've gotten this message in error, please let us know. Thanks and enjoy your time in the conference room!

-The Ignition Alley Crew",
                      "From: Ignition Alley <info@ignitionalley.com>\r\n" );
            
                // Prepare the response
                $this->jaysawn = json_encode( array( 'message' => '<h2>Thanks for adding your event!</h2><p>You will get an email with a link to activate the listing. Please be sure to click that link or your event will not show up and your time will not be reserved!</p><input type="submit" id="closebox" value="Back to the calendar">', status => 0 ) );
            } else {
                // Prepare the error list
                $message = '<p>You had the following errors:</p><ul>';
                foreach( $errors as $e )
                    $message .= "<li>$e</li>";
                $message .= '</ul>';
                
                $this->jaysawn = json_encode( array( 'message' => $message, status => 1 ) );
            }
        }
    }

    public function checkemail() {
        $this->noglobal = true; 
        
        // First, find them in the active client list
        $client = $this->fb_request( 'client.list', array( 'email' => $this->input['email'] ) );
        if( $client && $client->clients->client ) {
            // Next, find if they've got an active membership
            $profile = $this->fb_request( 'recurring.list', array( 'client_id' => $client->clients->client->client_id ) );
            if( $profile && $profile->recurrings->recurring && $profile->recurrings->recurring->stopped == 0 )
                $this->jaysawn = json_encode( array( 'message' => "<img src='/static/image/success.png'> You're a member! Yay!", 'status' => 1 ) );
            else
                $this->jaysawn = json_encode( array( 'message' => '<img src="/static/image/error.png"> You are not an active member', 'status' => 0 ) );
        } else
            $this->jaysawn = json_encode( array( 'message' => '<img src="/static/image/error.png"> Email address not found', 'status' => 0 ) );
    }
    
    public function confirm() {
        // Find the event via the key and make sure it's valid
        $this->event = EventQuery::create()->findOneByKey( $this->input['key'] );
        if( !$this->event )
            exit();
        
        // If we're POSTing    
        if( strncasecmp( $_SERVER['REQUEST_METHOD'], "POST", 4 ) == 0 ) {
            $this->event->setKey( '' );
            $this->event->save();
            
            $this->redirect( '' );
        }
    }


    /******************
     * Freshbooks API *
     ******************/

    private function fb_request( $method, $data = array() ) {
        $fb_url = 'https://ignitionalley.freshbooks.com/api/2.1/xml-in';
        $fb_tok = '2a16ae2359fba460612fbe22bb8e8166';
        
        $req =& new HTTP_Request( $fb_url );
        $req->setBasicAuth( $fb_tok, 'X' );
        $req->setMethod(HTTP_REQUEST_METHOD_POST);
        $req->setBody( "<?xml version='1.0' encoding='utf-8'?><request method='$method'>".$this->fb_build_request($data)."</request>" );
        
        if (!PEAR::isError($req->sendRequest())) {
            $xml = simplexml_load_string( $req->getResponseBody() );
            return $xml;
        }
        else
             return false;
    }
    
    private function fb_build_request( $data ) {
    $ret = '';
    foreach( $data as $key => $val ) {
        $ret .= "<$key>";
        if( is_array($val ) )
            $ret .= fb_build_request( $val );
        else
            $ret .= $val;
        $ret .= "</$key>";
    }
    return $ret;
}

}