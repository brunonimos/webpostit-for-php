<?php

namespace letters;

use letters\letters as let;
use ArrayIterator as arrayiterator;

$l=new let();
$l->loadImage($l);

class letters {

private $postit;

private $domain;

private $text;

private $color;

private $image;

public function __construct(){
if(isset($_POST['domain']) && isset($_POST['color']) && isset($_POST['string'])){
$this->postit=file_get_contents('../public/postit/'.$_POST['color'].'.bmp');
$this->image=bin2hex($this->postit);
$this->domain=$_POST['domain'];
$this->text=$_POST['string'];
$this->color=$_POST['color'];
}else{
die("Postit não configurado");
}
}

public function loadImage(let $obj){
$domain=$obj->domain;
$string=strtolower($obj->text);
$color=$obj->color;
$letterindex=0;
$linespace=0;
$spacechar=0;
$msg=null;
for($i=0;$i<strlen($string)*100;$i+=100){
if(substr($string,$letterindex,1)==" "){
$linespace-=100;
$spacechar++;
$letterindex++;
continue;
}
$letter=substr($string,$letterindex,1);
$file="letters/en/arial-48/".$letter.".xml";
if(file_exists($file)){
$lib=file_get_contents($file);
$data=simplexml_load_string($lib,"SimpleXMLElement",LIBXML_NOCDATA);
$json=json_encode($data);
$vetores=json_decode($json,TRUE);
$initialhex=$vetores['@attributes']['initialhex'];
if($letterindex+$spacechar>=13){
$initialhex-=158200;
print_r($initialhex);
}
if($letterindex+$spacechar>=27){
$initialhex-=158200;
}
$offsetfix=(float)$vetores['@attributes']['alignfix'];
$initialhex+=(int)$vetores['@attributes']['startingfix'];
$initialhex=$initialhex+$i-$linespace;
$obj->image=$obj->writeonImage($vetores,$initialhex,$obj->image,$offsetfix);
}else{
$msg.=" Char ".$letter." não suportado \n\r";
}
$letterindex++;
}
$imageData=hex2bin($obj->image);
if(!file_exists("../public/posted/user.application/".$domain."")){
mkdir("../public/posted/user.application/".$domain."",0777,true);
}
$imagefile=fopen('../public/posted/user.application/'.$domain.'/'.$color."-".$string.'.bmp',"wb");
fwrite($imagefile,$imageData);
$finish=fclose($imagefile);
if($finish){
$msg.="Postit ".$color." ".$string." Anexado em ".$domain."";
}
print_r($msg);
}

private function writeonImage($vetores,$initialhex,$image,$xoffset){
for($i=0;$i<sizeof($vetores['line']);$i++){
$iterator=new arrayiterator($vetores['line'][$i]['hex']);
while($iterator->valid()){
$hex=$vetores['line'][$i]['hex'][$iterator->key()]['@attributes']['hexa'];
$distance=$vetores['line'][$i]['dist'][$iterator->key()]['@attributes']['decimal'];
if($hex!=="nulo" && $distance!=="nulo"){
$hexes=substr($image,$initialhex,$initialhex+strlen($hex));
$image=substr_replace($image,$hex,$initialhex,strlen($hex));
$initialhex=$initialhex+strlen($hex)+$distance+$xoffset;
}
$iterator->next();
}
}
return $image;
}

}

?>