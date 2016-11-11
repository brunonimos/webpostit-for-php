var verpostit=(function(){
function verpostit(){}
function inprivate(){
var request=new XMLHttpRequest();
var postitconfig="verify=user.application";
request.open("POST","../resources/postitload.php");
request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
request.onload=function(){
if(request.status==200 && request.responseText!==""){
var postitString=JSON.stringify(eval("("+request.responseText+")"));
var postitJSON=JSON.parse(postitString);
for(var key in postitJSON){
if(postitJSON[key]!==null){
var division=document.createElement("div");
var image=document.createElement("img");
image.src="posted/user.application/"+postitJSON[key]+"/"+key+"";
image.className="posted";
image.id="user.application/"+postitJSON[key]+"/"+key+"";
image.addEventListener("drag",function(e){
e.preventDefault();
var deletepostit=new XMLHttpRequest();
var target="deletepostit="+this.id+"";
deletepostit.open("POST","../resources/postitunload.php");
deletepostit.setRequestHeader("Content-type","application/x-www-form-urlencoded");
deletepostit.onload=function(){
if(deletepostit.status==200 && deletepostit.responseText!==""){
var path=window.location.pathname;
var fileIndex=path.lastIndexOf('/')+1;
var fileName=path.substr(fileIndex);
window.location.replace(fileName);
}
};
deletepostit.send(target);
});
var section=document.getElementsByTagName("h1");
division.appendChild(image);
for(var i=0;i<section.length;i++){
if(section.item(i).innerHTML==postitJSON[key]){
section.item(i).parentNode.appendChild(division);
}
}
}
}
}
};
request.send(postitconfig);
}
verpostit.prototype.inpublic=function(){
return inprivate.call(this);
};
return verpostit;
})();
var verobj=new verpostit();
verobj.inpublic();