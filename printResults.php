<?php

//display results
echo("<table>");
while ($row = mysqli_fetch_array($return)) 
{
    $print = "<tr> <td> $row[0] </td>";
    if (!empty($row[1]))
        $print = $print . "<td> $row[1] </td></tr>";
    else
        $print = $print . "</tr>";
    echo($print);
}
echo("</table> <br>");

