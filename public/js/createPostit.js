var postit=(function(){
function postit(){}
function inprivate(trigger){
trigger.form.addEventListener("submit",function(e){
e.preventDefault();
var request=new XMLHttpRequest();
var postitconfig=null;
if(Object.prototype.toString.call(trigger.form.string)==='[object RadioNodeList]'){
for(var key in trigger.form.string){
if(typeof trigger.form.string[key].value!=="undefined" && trigger.form.string[key].value!==""){
postitconfig="domain="+trigger.form.domain[key].value+"&color="+trigger.form.color[key].value+"&string="+trigger.form.string[key].value+"";
}
}
}else{
postitconfig="domain="+trigger.form.domain.value+"&color="+trigger.form.color.value+"&string="+trigger.form.string.value+"";
}
request.open("POST","../resources/letters.php");
request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
request.onload=function(){
if(request.status==200 && request.responseText!==""){
console.log(request.responseText);
var path=window.location.pathname;
var fileIndex=path.lastIndexOf('/')+1;
var fileName=path.substr(fileIndex);
window.location.replace(fileName);
}
};
request.send(postitconfig);
});
}
postit.prototype.inpublic=function(trigger){
return inprivate.call(this,trigger);
};
return postit;
})();
function postitbridge(trigger){
var division=document.createElement("div");
var image=document.createElement("img");
var inputcolor=document.createElement("input");
var select=document.createElement("select");
var section=document.getElementsByTagName("h1");
for(var i=0;i<section.length;i++){
var option=document.createElement("option");
option.value=section.item(i).innerHTML;
option.innerHTML=section.item(i).innerHTML;
select.appendChild(option);
}
var inputtext=document.createElement("input");
var breakline=document.createElement("br");
var button=document.createElement("button");
division.className="division";
image.src="./postit/"+trigger.form.id+".bmp";
image.className="postit";
inputcolor.type="hidden";
inputcolor.name="color";
inputcolor.value=trigger.form.id;
inputcolor.className="postitcolor";
select.name="domain";
select.className="domain";
inputtext.type="text";
inputtext.name="string";
inputtext.className="postittext";
button.type="submit";
button.name="gerarpostit";
button.innerHTML="Postit";
button.className="postitbutton";
division.appendChild(image);
division.appendChild(inputcolor);
division.appendChild(select);
division.appendChild(inputtext);
division.appendChild(breakline);
division.appendChild(button);
trigger.form.appendChild(division);
var postobj=new postit();
postobj.inpublic(trigger);
}
function showpostit(postites){
document.getElementById("blue").style.zIndex="0";
document.getElementById("green").style.zIndex="0";
document.getElementById("pink").style.zIndex="0";
document.getElementById("red").style.zIndex="0";
document.getElementById("white").style.zIndex="0";
postites.style.zIndex++;
}