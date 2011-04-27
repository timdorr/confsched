<div id="sidecalendar">

    <div class="sideheader">
        This Month
    </div>
    
    <div class="calendar">
        <div class="title">{$month} {$year}</div>
        <table>
            <tr>
            {foreach from=$day_array item=day key=key}
                <td class="{if $day.today}today{/if} {if $day.month != $month_num}other{/if}">
                    {$day.day}
                    {if $day.occupied}<img src="/static/image/dot.png">{/if}
                </td>
                
                {$key=$key+1}
                {if $key is div by 7}
                    </tr><tr>
                {/if}
            {/foreach}
            </tr>
        </table>
    </div>

</div>

<div id="sideagenda">

    <div class="sideheader">
        On The Agenda
    </div>
    
    <div id="agenda">
        {$prevstart=0}
        {foreach from=$agenda item=event}
        {if $prevstart < time() && $event->getStart('U') > time()}
        <div class="nowhr"><span>Right Now</span></div>
        {/if}
        <div class="event{if $event->getStart('U') < time()} old{/if}">
            <h3{if $event->getIspublic() == 0} class="private"{/if}>{$event->getTitle()}</h3>
            <h6>{$event->getStart('F j g:i a')} - {$event->getEnd('g:i a')}</h6>
            {if $event->getDescription() && $event->getIspublic() == 1}<p>{$event->getDescription()}</p>{/if}
        </div>
        {$prevstart=$event->getStart('U')}
        {/foreach}
    </div>
    
</div>