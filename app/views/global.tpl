{if $noglobal eq true}{include file=$templatefile}{else}
<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <title>{if $page_title}{$page_title} | {/if}IA Conference Room Scheduler</title>

    <link rel="stylesheet" href="/static/style/reset.css">
    <link rel="stylesheet" href="/static/style/main.css">
    <link rel="stylesheet" href="/static/style/jqueryui.css">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    <script src="/static/script/jquery.calendrical.js"></script>

</head>
<body>

    <div id="addbox"></div>
    <div id="blackout"></div>

    <div id="thatsawrap">
    
        <div id="beheader">
            
            <a href="/" class="home">Conference Room Schedule</a>
            <a href="/add" class="add">Schedule Room</a>
        
        </div>

        <div id="contents">

            {include file=$templatefile}

        </div>

    </div>
    
    

<script type="text/javascript">
$('#beheader .add').click(function(e){
    $('#thatsawrap').css({ top: -540 });
    $('#blackout').fadeIn();
    $('#addbox').fadeIn().load('/add',function(){ $( ".datepicker" ).datepicker(); $( ".timepicker" ).calendricalTimeRange({ padding: 10 }); });
    e.preventDefault();
});
$('#beheader .add').click();

function closeAddBox(e) {
    $('#blackout').fadeOut('normal',function(){ $('#thatsawrap').css({ top: 0 }); });
    $('#addbox').fadeOut();
    e.preventDefault();
}

$('#blackout').click(closeAddBox);
$('#closebox').live('click', closeAddBox);

$('#addform').live('submit',function(e){
    $.post('/add', $('#addform').serialize(), function(data){
        if(data.status == 0) {
            $('#addbox').html(data.message);      
        } else {
            $('#errorbox').html(data.message).fadeIn();
        }
    },'json');
    e.preventDefault();
});

$('#email').live('change',function(e){
    if( $(this).val().length == 0 )
        $('#emailcheck').html('');
    else {
        $('#emailcheck').attr('class','').html('<img src="/static/image/loading.gif"> Checking membership...');
        $.post('/checkemail', { email: $(this).val() }, function(data){ 
            $('#emailcheck').html(data.message);
            if(data.status == 1) {
                $('#emailcheck').attr('class','success');
                $('#addform input[type=submit]').attr('disabled','');
            } else {
                $('#emailcheck').attr('class','error');
                $('#addform input[type=submit]').attr('disabled','disabled');
            }
        }, 'json');
    }
});
</script>

</body>
</html>
{/if}