<?php

$total = 0;
while ($row = mysqli_fetch_array($return)) 
{
    if ($row[1] > 1)
        $total = $total + $row[1];
}
echo("<p> Total: $total </p>");

