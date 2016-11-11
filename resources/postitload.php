<?php

namespace postitload;

use postitload\loader as loader;

$loader=new loader();
$loader->postitmapper($loader);

class loader {

private $app;

public function __construct(){
if(isset($_POST['verify'])){
$this->app=$_POST['verify'];
}else{
die("Aplicação não definida");
}
}

public function postitmapper(loader $obj){
if(file_exists("../public/posted/".$obj->app."")){
$domain=scandir("../public/posted/".$obj->app."");
$resposta=[];
foreach($domain as $keya => $valua){
if($valua!=="." && $valua!==".."){
$postites=scandir("../public/posted/".$obj->app."/".$valua);
foreach($postites as $keyb => $valub){
if($valub!=="." && $valub!==".."){
$resposta[$valub]=$valua;
}
}
}
}
$msg=json_encode($resposta);
print_r($msg);
}
}

}

?>