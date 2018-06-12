<?php
set_time_limit(0);
require_once 'playstore.php';

use iamroot_play_parse\playstore;

$push = new playstore();
$push->keyword = ("a");
//misal keyword 'rpg' maka muncul aplikasi yg terkait rpg 
$push->page = (1);
// jumlah package_name per page = 15-30
$push = $push->brute_force();


if(file_put_contents('package_list.txt',$push) == true){
	echo "success";
}
