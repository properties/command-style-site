<?php

  error_reporting(0);
  $command = $_POST["command"];
  $fullCommand = explode(" ", $command);

  function sendEcho($message, $speed)
  {
    global $command;

    $returnEcho["message"]  = "Matth.ee/w > " . $message;
    $returnEcho["speed"]    = $speed;
    echo json_encode($returnEcho);
    exit();
    
  }

  if(empty($command))
  {
    sendEcho("Do you expect me to understand that??", 40);
  }


  if($fullCommand[0] == "get")
  {
    if($fullCommand[1] == "website")
    {

      $checkBefore = str_split($fullCommand[2], 7);
      if($checkBefore[0] == "http://" || $checkBefore[0] == "https:/")
      {
          $sourceCode = file_get_contents($fullCommand[2]);
      }
      else
      {
        $sourceCode = file_get_contents("http://" . $fullCommand[2]);
      }

      if(!empty($sourceCode))
      {

        $highCode = curl_init('https://tohtml.com/');
        
        curl_setopt( $highCode, CURLOPT_POST, 1);
        curl_setopt( $highCode, CURLOPT_POSTFIELDS, 'style=black&code_src=' . urlencode($sourceCode));
        curl_setopt( $highCode, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $highCode, CURLOPT_HEADER, 0);
        curl_setopt( $highCode, CURLOPT_RETURNTRANSFER, 1);
        
        $fullCode = curl_exec($highCode);

        $pregMatch = preg_match_all("/<div style=\"overflow: scroll; width: 100%;\">(.*?)<\/div>/s", $fullCode, $htmlCode);
        $finalCode = str_replace("background:", "matth:", $htmlCode[1][0]);
        sendEcho($finalCode, 1);

      }
      else
      {
        sendEcho("Unable to resolve hostname", 40);
      }
    }
  }

  if($fullCommand[0] == "set")
  {
    if($fullCommand[1] == "speed")
    {
      sendEcho('New speed is set to ' . $fullCommand[2], 1);
    }
  }
  
  if($fullCommand[0] == "help")
  {
      sendEcho('Help? What?', 1);
  }

?>
