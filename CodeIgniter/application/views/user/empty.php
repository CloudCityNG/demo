<?php
foreach($id as $item)
{
    $item=(array)$item;

     $user_id=$item['user_id'];
    echo $user_id;
    header('location:'.base_url()."UserControl/ids/".$user_id);
   //  header('Location : ids?'.$user_id);
}