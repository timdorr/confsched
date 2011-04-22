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

    <div id="thatsawrap">
    
        <div id="beheader">
            
            <a href="/" class="home">Conference Room Schedule</a>
            <a href="/add" class="add">Schedule Room</a>
        
        </div>

        {include file=$templatefile}
    
    </div>

</body>
</html>
{/if}