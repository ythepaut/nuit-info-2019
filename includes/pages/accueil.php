<h1>OK</h1>

<h2><?php echo(($_SESSION["blindMode"])?"vrai":"faux");?></h2>

<form action='./includes/classes/actions.php' method="POST"> 
    <input type="hidden" name="action" value="blind-mode" />
    <div style="text-align: center;">
        <input type="submit" value="Mode Aveugle" />
    </div>
</from>