<?php

namespace postitunload;

use postitunload\unloader as unloader;

$unloader=new unloader();
$unloader->postitdelete($unloader);

class unloader {

private $target;

public function __construct(){
if(isset($_POST['deletepostit'])){
$this->target=$_POST['deletepostit'];
}else{
die("Target não definido");
}
}

public function postitdelete(unloader $obj){
if(file_exists("../public/posted/".$obj->target."")){
$delete=unlink("../public/posted/".$obj->target."");
if($delete){
print_r("Postit deletado de ".$obj->target);
}
}
}

}

?>