<h2>Schedule Room</h2>

<form action="/add" method="post" id="addform">

<fieldset>
    Your email address:<br>
    <input type="text" size="40" name="email" id="email">
    <span id="emailcheck"></span>
</fieldset>

<fieldset>
    <legend>Event Details</legend>
    
    <div>
        Title:<br>
        <input type="text" size="55" name="title">
    </div>
    
    <div class="checkbox">
        <input type="checkbox" name="public"> Open to the public    
    </div>

    <div>
        Date:<br>
        <input type="text" size="20" name="date" class="datepicker">
    </div>
    
    <div>
        Time:<br>
        <input type="text" size="10" name="start" class="timepicker">
        <input type="text" size="10" name="end" class="timepicker">
    </div>
    
    <div>
        Description:<br>
        <textarea name="description" cols="75" rows="5"></textarea>
    </div>
</fieldset>

<input type="submit" value="Book your time">

</form>
