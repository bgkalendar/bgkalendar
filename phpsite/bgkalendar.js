
   /** 
    * This is a global variable to store the id of the new timeout.
    * Essentially you queue up the resize handling code, and then 
    * if the window resize occurs again, you cancel it, and re-queue it.
    * This keeps happening until the resize is complete, at which point, 
    * your doResizeCode() function is actually executed.
    */
   var resizeTimeoutId = null;
   window.addEventListener('resize', function(event){
      var detailsbg = document.getElementById('detailsbg');
      var detailsgr = document.getElementById('detailsgr');
      detailsbg.style.height = null;
      detailsgr.style.height = null;
      window.clearTimeout(resizeTimeoutId);
      resizeTimeoutId = window.setTimeout('windowResized();', 50);
   });

   /**
    * Window got resized finally.  
    */
   function windowResized() {
     var detailsbg = document.getElementById('detailsbg');
     var detailsgr = document.getElementById('detailsgr');
     if (detailsbg.style.display == "none" || detailsgr.style.display == "none") {
       return;
     }
     var maxHeight = 0;
     maxHeight = detailsbg.clientHeight > maxHeight ? detailsbg.clientHeight : maxHeight;
     maxHeight = detailsgr.clientHeight > maxHeight ? detailsgr.clientHeight : maxHeight;
     
     if (maxHeight != 0) { 
         detailsbg.style.height = maxHeight + "px";
         detailsgr.style.height = maxHeight + "px";
     }
   }

   function openclosebutton(cls, opn, display) {
       document.getElementById(cls).style.display = "none";
       document.getElementById(opn).style.display = display;
   }
   function showhidedetails(detailsid) {
       var details = document.getElementById(detailsid);
       if (details != null) {
          if (details.style.display == "none") {
              details.style.display = "block";
              windowResized();
          } else {
              details.style.display = "none";
          }
       }
   }
   var oldbgbackground = null;
   var oldgrbackground = null;
   var curbgid = null;
   var curgrid = null;

   /**
    * This function is called when the mouse pointer enters one of the date box-es in the 
    * Old Bulgarian Calendar or the Modern Gregorian Calendar. 
    * Its purpose is to highlight the date box and its corresponding box on the other 
    * calendar that corresponds to the same date. 
    * The highlighting is done by changing the backgorund color of the date box. The 
    * previous background colors before the highlighting will be remembered in the global 
    * javascript variables 'oldbgbackground' and 'oldgrbackground',
    * so that they can later be reused by the mout function when the mouse pointer leaves 
    * the data box.
    *
    * @param daybg - The id of the date box in the Old Bulgarian Calendar that corresponds 
    *                to the same date as the corresponding box in the Modern Gregorian 
    *                Calendar.
    * @param daygr - The id of the date box in the Modern Gregorian Calendar that 
    *                corresponds to the same date as the corresponding box in the Old 
    *                Bulgarian Calendar.
    */
    function mover(daybg, daygr) {
       var focused = false;
       var bg = null;
       var gr = null;
       if (daybg != null) {
           bg = document.getElementById(daybg);
       }
       if (daygr != null) {
           gr = document.getElementById(daygr);
       }
       if (bg != null && daybg != curbgid) {
           curbgid = daybg;
           bg.focus();
           focused = true;
       }
       if (gr != null && daygr != curgrid) {
           curgrid = daygr;
           if (!focused) {
              gr.focus();
              focused = true;
           }
       }
    }

    /**
     * This function is called when the mouse pointer leaves one of the date box-es in the 
     * Old Bulgarina Calendar or the Modern Gregorian Calendar. It is assumed that 
     * prevoiusly, when the mouse entered that same box, it was higlighted (by changing its 
     * background-color style). That should have been done by the 'mover' function.
     *
     * So the purpose of this function is to remove the highlight. That is done by using 
     * the previous (original) background-color syle that have been stored in global 
     * javascript variables 'oldbgbackground' and 'oldgrbackground'.
     * 
     * @param daybg - The id of the date box in the Old Bulgarian Calendar that corresponds 
     *                to the same date as the corresponding box in the Modern Gregorian 
     *                Calendar.
     * @param daygr - The id of the date box in the Modern Gregorian Calendar that 
     *                corresponds to the same date as the corresponding box in the Old 
     *                Bulgarian Calendar.
     */
     function mout(daybg, daygr, dontsetblur) {
         unfocused(curbgidfocus, curgridfocus);
         var bg = null;
         var gr = null;
         if (daybg != null) {
             bg = document.getElementById(daybg);
         }
         if (daygr != null) {
             gr = document.getElementById(daygr);
         }
         if (bg != null && oldbgbackground != null) {
          bg.style.backgroundColor = oldbgbackground;
          oldbgbackground = null;
          curbgid = null;
            if (!dontsetblur) { 
                bg.blur();
            }
         }
         if (gr != null && oldgrbackground != null) {
          gr.style.backgroundColor = oldgrbackground;
          oldgrbackground = null;
          curgrid = null;
            if (!dontsetblur) { 
                gr.blur();
            }
         }
     }

     var mdownjepochindex = null;
     var mdownparam = null;
     function mdown(daybg, daygr, param, jepochindex) {
         mdownjepochindex = jepochindex;
         mdownparam = param;
     }

     function mup(daybg, daygr, param, jepochindex, lang) {
        window.location = window.location.protocol + '//' 
                        + window.location.host 
                        + window.location.port
                        + window.location.pathname 
                        + "?" + (mdownparam != null ? mdownparam : param )
                        + "=" + (mdownjepochindex != null ? mdownjepochindex : jepochindex)
	                + "&lang=" + getLang(lang);
     }

     /**
      * Make sure that we support just the predefined languages and any invalid input 
      * for the language is translated to the default language: in our case, that is 
      * Bulgarian "bg".
      * 
      * @param lang - the language as specified in the query string of the given page. 
      *               That one should have been captured by the backend logic and hsould 
      *               have been then passed to the javascript.
      */
     function getLang(lang) {
       if (lang == null) {
         return "bg";
       } else if (lang == "en" || lang == "de" || lang == "ru") {
         return lang;
       } else {
         return "bg";
       }
     }


     function kpress(e, daybg, daygr, param, jepochindex) {
      /*
         alert( "e = " + e + "\n"
               +"daybg = " + daybg + "\n"
               +"daygr = " + daygr + "\n"
               +"jepochindex = " + jepochindex)
         var evtobj=window.event? event : e;
         */
     }

     var oldbgbackgroundfocus = null;
     var oldgrbackgroundfocus = null;
     var curbgidfocus = null;
     var curgridfocus = null;
     function focused(daybg, daygr) {
         mout(curbgid, curbgid, true);
         var bg = null;
         var gr = null;
         if (daybg != null) {
             bg = document.getElementById(daybg);
         }
         if (daygr != null) {
             gr = document.getElementById(daygr);
         }
         if (bg != null && daybg != curbgidfocus) {
            curbgidfocus = daybg;
            oldbgbackgroundfocus = bg.style.backgroundColor;
            bg.style.backgroundColor = 'red';
         }
         if (gr != null && daygr != curgridfocus) {
            curgridfocus = daygr;
            oldgrbackgroundfocus = gr.style.backgroundColor;
            gr.style.backgroundColor = 'red';
         }
     }

     function unfocused(daybg, daygr) {
         var bg = null;
         var gr = null;
         if (daybg != null) {
             bg = document.getElementById(daybg);
         }
         if (daygr != null) {
             gr = document.getElementById(daygr);
         }
         if (bg != null && oldbgbackgroundfocus != null) {
            bg.style.backgroundColor = oldbgbackgroundfocus;
            oldbgbackgroundfocus = null;
            curbgidfocus = null;
         }
         if (gr != null && oldgrbackgroundfocus != null) {
            gr.style.backgroundColor = oldgrbackgroundfocus;
            oldgrbackgroundfocus = null;
            curgridfocus = null;
         }
     }

     function setFuncOnFocus( setName, namebg, namegr ) { this[setName] = function() {   focused(namebg, namegr); }; }
     function setFuncOnBlur ( setName, namebg, namegr ) { this[setName] = function() { unfocused(namebg, namegr); }; }
     function setFuncOnmover( setName, namebg, namegr ) { this[setName] = function() {     mover(namebg, namegr); }; }
     function setFuncOnmout ( setName, namebg, namegr ) { this[setName] = function() {      mout(namebg, namegr); }; }
     function setFuncOnmdown( setName, namebg, namegr, param, jepoch       ){ this[setName] = function(){mdown (namebg, namegr, param, jepoch      );}; }
     function setFuncOnmup  ( setName, namebg, namegr, param, jepoch, lang ){ this[setName] = function(){mup   (namebg, namegr, param, jepoch, lang);}; }
     function setFuncOnkpres( setName, namebg, namegr, param, jepoch       ){ this[setName] = function(){kpress(namebg, namegr, param, jepoch      );}; }


