# Command style site

A simple light-weight command style looking website, working with jquery and PHP.

# Examples

In the postCommand.php file you can add commands simple as this:
```sh
  if($fullCommand[0] == "help")
  {
      sendEcho("You need some help?", 40);
  }
```
sendEcho is the function that sends the information back to the homepage. The int 40 is the typing speed, just play a little bit with that. (1=fastest)

If you want a multi word command, you can just stack it up:
```sh
  if($fullCommand[0] == "help")
  {
     if($fullCommand[1] == "me")
     {
         sendEcho("You just said help me", 40);
     }
  }
```
