
 MatthewCore  =  function(element,interval,cursor,finishedCallback)
 {
   if((typeof document.getElementById == "undefined") || (typeof element.innerHTML == "undefined"))
   {
     this.running = true;
     return;
   }

   this.element = element;
   this.finishedCallback = ( finishedCallback ? finishedCallback : function() { return; } );
   this.interval = (typeof interval == "undefined" ? 100 : interval);
   this.origText = this.element.innerHTML;
   this.unparsedOrigText = this.origText;
   this.cursor = ( cursor ? cursor : "" );
   this.currentText = "";
   this.currentChar = 0;
   
   this.element.MatthewCore = this;
   
   if(this.element.id == "") this.element.id = " MatthewCore" + MatthewCore.currentIndex++;
   MatthewCore.all.push(this);
   this.running = false;
   this.inTag = false;
   this.tagBuffer = "";
   this.inHTMLEntity = false;
   this.HTMLEntityBuffer = "";
 }

 MatthewCore.all = new Array();
 MatthewCore.currentIndex = 0;

 MatthewCore.runAll = function()
 {
   MatthewCore.all[MatthewCore.all.length - 1].run();
 }

 MatthewCore.prototype.run = function()
 {

   if(this.running) return;

   if(typeof this.origText == "undefined")
   {
     setTimeout("document.getElementById('"+this.element.id+"'). MatthewCore.run()",this.interval);
     return;
   }

   if(this.currentText == "") 
   { 
    this.element.innerHTML = "";
   }

   if(this.currentChar < this.origText.length)
   {
     var scrollDown = document.getElementById('portfolio');
     scrollDown.scrollTop = scrollDown.scrollHeight;

     if       (this.origText.charAt(this.currentChar) == "<" &&! this.inTag)          { this.tagBuffer = "<"; this.inTag = true; this.currentChar++; this.run(); return; }
     else if  (this.origText.charAt(this.currentChar) == ">" && this.inTag)           { this.tagBuffer += ">"; this.inTag = false; this.currentText += this.tagBuffer; this.currentChar++; this.run(); return; }
     else if  (this.inTag)                                                            { this.tagBuffer += this.origText.charAt(this.currentChar); this.currentChar++; this.run(); return; }
     else if  (this.origText.charAt(this.currentChar) == "&" &&! this.inHTMLEntity)   { this.HTMLEntityBuffer = "&"; this.inHTMLEntity = true; this.currentChar++; this.run(); return; }
     else if  (this.origText.charAt(this.currentChar) == ";" && this.inHTMLEntity)    { this.HTMLEntityBuffer += ";"; this.inHTMLEntity = false; this.currentText += this.HTMLEntityBuffer; this.currentChar++; this.run(); return; }
     else if  (this.inHTMLEntity)                                                     { this.HTMLEntityBuffer += this.origText.charAt(this.currentChar); this.currentChar++; this.run(); return; }
     else                                                                             { this.currentText += this.origText.charAt(this.currentChar); }

     this.element.innerHTML = this.currentText;
     this.element.innerHTML += ( this.currentChar < this.origText.length-1 ? (typeof this.cursor == "function" ? this.cursor(this.currentText) : this.cursor) : "" );
     this.currentChar++;

     setTimeout("document.getElementById('" + this.element.id + "'). MatthewCore.run()", this.interval);

   }
   else
   {
    
     this.currentText = "";
     this.currentChar = 0;
     this.running = false;
     this.finishedCallback();
     
   }
 }

  if (document.addEventListener)
  {
    document.addEventListener('contextmenu', function(e)
    {
      e.preventDefault();
    }, false);

  }
  else
  {
    document.attachEvent('oncontextmenu', function()
    {
      window.event.returnValue  =  false;
    });
  }
