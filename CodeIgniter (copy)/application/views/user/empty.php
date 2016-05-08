<?php
foreach($id as $item)
{
    $item=(array)$item;

     $user_id=$item['user_id'];
    echo $user_id;
    header('location:'.base_url()."Userlogin/ids/".$user_id);

}