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
</div>