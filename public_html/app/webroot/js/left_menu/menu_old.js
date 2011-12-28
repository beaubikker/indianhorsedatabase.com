var menu1=new Array()
menu1[0]='<a href="sitemap.php">Site Map</a>'
menu1[1]='<a href="contactus.php">Contact Us</a>'


//Contents for menu 2, and so on
var menu2=new Array()
menu2[0]='<a href="help.php">How we can help</a>'
menu2[1]='<a href="uktrained.php">I am UK Trained</a>'
menu2[2]='<a href="oversistrained.php">I am Overseas Trained</a>'
menu2[3]='<a href="registration.php">Register my Details</a>'
menu2[4]='<a href="testimonial.php">Candidate Testimonials</a>'
menu2[5]='<a href="candidate_resources.php">Candidate Resources</a>'
menu2[6]='<a href="vacancies.php">Vacancies</a>'


//Contents for menu 3, and so on
var menu3=new Array()
menu3[0]='<a href="help.php">How we can help</a>'
menu3[1]='<a href="#">We need to feel a...</a>'
menu3[2]='<a href="vetting_procedures.php">Our Vetting Procedures</a>'
menu3[3]='<a href="client_testimonial.php">Client Testimonials</a>'
menu3[4]='<a href="client_resources.php">Client Resources</a>'
menu3[5]='<a href="vacency_registration.php">Register a Vacancy</a>'


//Contents for menu 4, and so on
var menu4=new Array()
menu4[0]='<a href="vacency_registration.php">Register a Vacancy</a>'
menu4[1]='<a href="vacancies.php">Search Vacancies</a>'
menu4[2]='<a href="jobalert.php">Register For Job Alerts</a>'


//Contents for menu 5, and so on
var menu5=new Array()
menu5[0]='<a href="makes_us_different.php">What makes us different</a>'
menu5[1]='<a href="help.php">We offer candidates</a>'
menu5[2]='<a href="offer.php">We offer clients</a>'
menu5[3]='<a href="testomonial_for_site.php">Testimonials</a>'
menu5[4]='<a href="contactus.php">Contact Us</a>'
menu5[5]='<a href="national.php">National Coverage</a>'
		
var disappeardelay=250  //menu disappear speed onMouseout (in miliseconds)
var horizontaloffset=2 //horizontal offset of menu from default location. (0-5 is a good value)

/////No further editting needed

var ie4=document.all
var ns6=document.getElementById&&!document.all

if (ie4||ns6)
document.write('<div id="dropmenudiv" style="visibility:hidden;width:160px;margin:14px 0 0 0;" onMouseover="clearhidemenu()" onMouseout="dynamichide(event)"></div>')

function getposOffset(what, offsettype){
var totaloffset=(offsettype=="left")? what.offsetLeft : what.offsetTop;
var parentEl=what.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}


function showhide(obj, e, visible, hidden, menuwidth){
if (ie4||ns6)
dropmenuobj.style.left=dropmenuobj.style.top=-500
dropmenuobj.widthobj=dropmenuobj.style
dropmenuobj.widthobj.width=menuwidth
if (e.type=="click" && obj.visibility==hidden || e.type=="mouseover")
obj.visibility=visible
else if (e.type=="click")
obj.visibility=hidden
}

function iecompattest(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function clearbrowseredge(obj, whichedge){
var edgeoffset=0
if (whichedge=="rightedge"){
var windowedge=ie4 && !window.opera? iecompattest().scrollLeft+iecompattest().clientWidth-15 : window.pageXOffset+window.innerWidth-15
dropmenuobj.contentmeasure=dropmenuobj.offsetWidth
if (windowedge-dropmenuobj.x-obj.offsetWidth < dropmenuobj.contentmeasure)
edgeoffset=dropmenuobj.contentmeasure+obj.offsetWidth
}
else{
var topedge=ie4 && !window.opera? iecompattest().scrollTop : window.pageYOffset
var windowedge=ie4 && !window.opera? iecompattest().scrollTop+iecompattest().clientHeight-15 : window.pageYOffset+window.innerHeight-18
dropmenuobj.contentmeasure=dropmenuobj.offsetHeight
if (windowedge-dropmenuobj.y < dropmenuobj.contentmeasure){ //move menu up?
edgeoffset=dropmenuobj.contentmeasure-obj.offsetHeight
if ((dropmenuobj.y-topedge)<dropmenuobj.contentmeasure) //up no good either? (position at top of viewable window then)
edgeoffset=dropmenuobj.y
}
}
return edgeoffset
}

function populatemenu(what){
if (ie4||ns6)
dropmenuobj.innerHTML=what.join("")
}


function dropdownmenu(obj, e, menucontents, menuwidth){
if (window.event) event.cancelBubble=true
else if (e.stopPropagation) e.stopPropagation()
clearhidemenu()
dropmenuobj=document.getElementById? document.getElementById("dropmenudiv") : dropmenudiv
populatemenu(menucontents)

if (ie4||ns6){
showhide(dropmenuobj.style, e, "visible", "hidden", menuwidth)
dropmenuobj.x=getposOffset(obj, "left")
dropmenuobj.y=getposOffset(obj, "top")
dropmenuobj.style.left=dropmenuobj.x-clearbrowseredge(obj, "rightedge")+obj.offsetWidth+horizontaloffset+"px"
dropmenuobj.style.top=dropmenuobj.y-clearbrowseredge(obj, "bottomedge")+"px"
}

return clickreturnvalue()
}

function clickreturnvalue(){
if (ie4||ns6) return false
else return true
}

function contains_ns6(a, b) {
while (b.parentNode)
if ((b = b.parentNode) == a)
return true;
return false;
}

function dynamichide(e){
if (ie4&&!dropmenuobj.contains(e.toElement))
delayhidemenu()
else if (ns6&&e.currentTarget!= e.relatedTarget&& !contains_ns6(e.currentTarget, e.relatedTarget))
delayhidemenu()
}

function hidemenu(e){
if (typeof dropmenuobj!="undefined"){
if (ie4||ns6)
dropmenuobj.style.visibility="hidden"
}
}

function delayhidemenu(){
	//alert(divid);
if (ie4||ns6)
delayhide=setTimeout("hidemenu()",disappeardelay)
}

function clearhidemenu(){
if (typeof delayhide!="undefined")
clearTimeout(delayhide)
}
