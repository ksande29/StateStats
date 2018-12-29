<?php

$return = mysqli_query($con, $query);
if (!$return) 
{
    $message = "Whole query " . $select;
    echo $message;
    die('Invalid query: ' . mysqli_error($con));
}


