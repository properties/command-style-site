<?php

  require_once 'detectMobile.php';
  $detect = new Mobile_Detect;

  if( $detect->isMobile() && !$detect->isTablet() )
  {
    echo "My website does not fully work on a mobile yet, please try on a tablet or or any bigger size screen.";
    exit();
  }

  $cmd = $_GET["cmd"];


?>
<!-- https://github.com/properties/command-style-site -->
<html>
<head>

  <title>Matth.ee/w</title>

  <meta name="viewport" content="width=device-width">
  <meta name="author" content="https://github.com/properties/command-style-site">
  
  <link rel="stylesheet" href="style.css">
  <script src="scripts.js"></script>
  <script src="jquery.js"></script>

</head>

<body>
  <div>
    <textarea class="side" rows="10" cols="15" disabled="">
                       ,--.
                      /  /
     ,---.  ,---.    /  /,--.   ,--.
    | .-. :| .-. :  /  / |  |.'.|  |
.--.\   --.\   --. /  /  |   .'.   |
'--' `----' `----'/  /   '--'   '--'
                 `--'
------------------------------------
Command style portfolio & tools
Made by @grpje - matth.ee/w - coreSX
©2016 Core Inc Licensed.
------------------------------------
    </textarea>

    <div id="h">$ ></div>
    <textarea id="t" class="typ" autofocus spellcheck="false"></textarea>

  </div>

  <div id="portfolio" class="portfolio">Matth.ee/w > Enter your command left. Type "help" for all commands.</div>


  <script>

    var Command = '';
    var dataSpeed = 40;
    var setSpeed = false;

    $(".typ") . keydown( function (key)
    {
      var keyDown = key.which;
      if(keyDown == 38) $(".typ").val(Command);
      if(keyDown == 13) key.preventDefault();
      if(keyDown == 13)
      {
      
        $('#portfolio').html("Matth.ee/w > Loading..");
        Command = $(this).val();
        $(".typ").val('');

        var cmd = Command.split(" ");
        if(cmd[0] + cmd[1] == "setspeed")
        {
          dataSpeed = cmd[2];
          setSpeed = true;
        }

        $.post( "postCommand.php", { command:Command }, function( data )
        {
          $('#portfolio').html(data.message);

          if(setSpeed == false) dataSpeed = data.speed;

          new MatthewCore(document.getElementById("portfolio"), dataSpeed);
          MatthewCore.runAll();

        }, "json");
      }
    });
   </script>
</body>
</html>
