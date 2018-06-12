<?php
set_time_limit(0);
require_once 'playstore.php';

use iamroot_play_parse\playstore;

$push = new playstore();
$push->keyword = ("a");
$push->page = (1);
$push = $push->brute_force();


if(file_put_contents('package_list.txt',$push) == true){
	echo "success";
}
