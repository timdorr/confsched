{if $noglobal eq true}{include file=$templatefile}{else}
<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <title>{if $page_title}{$page_title} | {/if}IA Conference Room Scheduler</title>

    <link rel="stylesheet" href="/static/style/reset.css">
    <link rel="stylesheet" href="/static/style/main.css">
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

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
    $('#addbox').fadeIn().load('/add');
    e.preventDefault();
});

$('#blackout').click(function(e){
    $('#blackout').fadeOut('normal',function(){ $('#thatsawrap').css({ top: 0 }); });
    $('#addbox').fadeOut();
    e.preventDefault();
});
</script>

</body>
</html>
{/if}