    <div id="confirm">
    
    <h2>Confirm Your Event</h2>
    
    <p>Please check the details below for your event. If you see an errors, simply click the Schedule Room button in the upper right to enter the event details again. If you don't wish to confirm, simply do nothing.</p>
    
    <div class="event">
        <h3>{$event->getTitle()}</h3>
        <h6>{$event->getStart('F j g:i a')} - {$event->getEnd('g:i a')}</h6>
        <h5>{if $event->getIspublic() == 1}Public Event{else}Private Event{/if}</h5>
        <p>{$event->getDescription()}</p>
    </div>
    
    <form action="/confirm" method="post">
        <input type="hidden" name="key" value="{$event->getKey()}">
        <input type="submit" value="Confirm Event">
    </form>
    
    </div>