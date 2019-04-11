<?php
include 'core/database/connect.php';

    $post_data = array();
    $post_data[] = array('title' => 'Test asd fasdg asdg sdfg sdf ', 'start' => '2017-11-13');
    $post_data[] = array('title' => 'Test2', 'start' => '2017-11-14');
    $post_data[] = array('title' => 'Test2', 'start' => '2017-11-15');

echo json_encode($post_data);

?>