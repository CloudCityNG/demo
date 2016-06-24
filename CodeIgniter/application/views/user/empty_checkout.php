<?php
foreach($id as $item)
{
    $item=(array)$item;

    $user_id=$item['user_id'];
    echo $user_id;
    header('location:'.base_url()."checkout/ids/".$user_id);
}