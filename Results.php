<html>
    <head>
        <title> State Statistics Assignment </title>
        <link href="/CSIS2440/StateStats/assignment/css/style.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
    </head>
</html>
<body>

<?php
$host = "localhost";
$user = "root";
$password = "dbpass";
$db = Library;
$tbl = StateStats;
$con = mysqli_connect($host, $user, $password, $db) or die (mysqli_error($con));

echo("<h1> State Statistics / MySql Data Manipulation </h1>");

$query = "";

echo("<h2> State with the largest population size: </h2>");
$query = "SELECT Name, Population FROM StateStats WHERE name !='District of Columbia' AND Population = (SELECT MAX(Population) FROM StateStats)";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Largest to smallest population size (excluding Washington DC): </h2>");
$query = "SELECT Name, Population FROM StateStats WHERE name !='District of Columbia' ORDER BY Population DESC";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> State with smallest population size (excluding Washington DC): </h2>");
$query = "SELECT Name, Population FROM StateStats WHERE name !='District of Columbia' AND Population = (SELECT MIN(Population) FROM StateStats)";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Smallest to largest population size (excluding Washington DC): </h2>");
$query = "SELECT Name, Population FROM StateStats WHERE name !='District of Columbia' ORDER BY Population ASC";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> State with the closest to average population size: </h2>");
$query = "SELECT AVG(Population) FROM StateStats";
include 'runQuery.php';
$resultArray = mysqli_fetch_array($return);
$average = $resultArray[0];
echo("<p> average population size = $average </p>");
$query = "SELECT Name, Population FROM StateStats WHERE ABS(Population - $average) = (SELECT Min(ABS(Population - $average)) FROM StateStats)";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> State with largest land size in square miles: </h2>");
$query = "SELECT Name, LandSqMiles FROM StateStats Where LandSqMiles = (SELECT Max(LandSqMiles) FROM StateStats)";     
include 'runQuery.php';
include 'printResults.php';

echo("<h2> State with smallest land size in square miles (excluding Washington DC): </h2>");
$query = "SELECT Name, LandSqMiles FROM StateStats WHERE LandSqMiles = (SELECT Min(LandSqMiles) FROM StateStats Where name !='District of Columbia')";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> State with the closest to average land size in square miles: </h2>");
$query = "SELECT AVG(LandSqMiles) FROM StateStats";
include 'runQuery.php';
$resultArray = mysqli_fetch_array($return);
$average = $resultArray[0];
echo("<p> average land size = $average </p>");
$query = "SELECT Name, LandSqMiles FROM StateStats WHERE ABS(LandSqMiles - $average) = (SELECT Min(ABS(LandSqMiles - $average)) FROM StateStats)";
include 'runQuery.php';
include 'printResults.php';

//The difference between TotalSqMiles and LandSqMiles is WaterSqMiles. 
echo("<h2> State with the largest size in square miles of water: </h2>");
$query = "SELECT Name, (TotalSqMiles - LandSqMiles) As WaterSqMiles FROM StateStats WHERE (TotalSqMiles - LandSqMiles) = (SELECT MAX(TotalSqMiles - LandSqMiles) FROM StateStats)";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> State with the smallest size in square miles of water: </h2>");
echo("<h3> (including DC) </h3>");
$query = "SELECT Name, (TotalSqMiles - LandSqMiles) As WaterSqMiles FROM StateStats WHERE (TotalSqMiles - LandSqMiles) = (SELECT MIN(TotalSqMiles - LandSqMiles) FROM StateStats);";
include 'runQuery.php';
include 'printResults.php';
echo("<h3> (excluding DC) </h3>");
$query = "SELECT Name, (TotalSqMiles - LandSqMiles) As WaterSqMiles FROM StateStats WHERE (TotalSqMiles - LandSqMiles) = (SELECT MIN(TotalSqMiles - LandSqMiles) FROM StateStats WHERE name !='District of Columbia')";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> State with the closest to average size in square miles of water: </h2>");
$query = "SELECT AVG(TotalSqMiles - LandSqMiles) FROM StateStats";
include 'runQuery.php';
$resultArray = mysqli_fetch_array($return);
$average = $resultArray[0];
echo("<p> average water square miles = $average </p>");
$query = "SELECT Name, TotalSqMiles - LandSqMiles FROM StateStats WHERE ABS(TotalSqMiles - LandSqMiles - $average) = (SELECT Min(ABS(TotalSqMiles - LandSqMiles - $average)) FROM StateStats)";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Total US population size: </h2>"); 
$query = "SELECT SUM(Population) AS TotalPopulation FROM StateStats";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Total US land size in square miles: </h2>");
$query = "SELECT SUM(LandSqMiles) AS TotalLandSize FROM StateStats";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Total US water size in square miles: </h2>");
$query = "SELECT SUM(TotalSqMiles - LandSqMiles) AS TotalWaterSize FROM StateStats";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Average population size per land square mile for each state: </h2>");
$query = "SELECT Name, (Population / LandSqMiles) FROM StateStats";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Average population size per land square mile for the entire United States: </h2>");
$query = "SELECT (SUM(Population) / SUM(LandSqMiles)) FROM StateStats";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Average population size per water square mile for each state: </h2>");
$query = "SELECT Name, (Population / (TotalSqMiles - LandSqMiles)) FROM StateStats";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Average population size per water square mile for the entire United States: </h2>");
$query = "SELECT (SUM(Population) / (SUM(TotalSqMiles) - SUM(LandSqMiles))) From StateStats";
include 'runQuery.php';
include 'printResults.php';

echo("<h2> Distinct state birds, state trees, and state flowers: </h2>");
echo("<h3> Distinct state birds: </h3>");
$query = "SELECT DISTINCT StateBird FROM StateStats ORDER BY StateBird";
include 'runQuery.php';
include 'printResults.php';
echo("<h3> Distinct state trees: </h3>");
$query = "SELECT DISTINCT StateTree FROM StateStats ORDER BY StateTree";
include 'runQuery.php';
include 'printResults.php';
echo("<h3> Distinct state flowers: </h3>");
$query = "SELECT DISTINCT StateFlower FROM StateStats ORDER BY StateFlower";
include 'runQuery.php';
include 'printResults.php';
        
echo("<h2> Number of states having the same state bird, state tree, state flower: </h2>");
echo("<h3> Number of states with the same state bird: </h3>");
$query = "SELECT StateBird, count(*) from StateStats Group By StateBird";
include 'runQuery.php';
include 'sumCount.php';
include 'runQuery.php';
include 'printResults.php';
echo("<h3> Number of states with the same state tree: </h3>");
$query = "SELECT StateTree, count(*) from StateStats Group By StateTree";
include 'runQuery.php';
include 'sumCount.php';
include 'runQuery.php';
include 'printResults.php';
echo("<h3> Number of states with the same state flower: </h3>");
$query = "SELECT StateFlower, count(*) from StateStats Group By StateFlower";
include 'runQuery.php';
include 'sumCount.php';
include 'runQuery.php';
include 'printResults.php';
        
echo("<h2> Order of statehood: </h2>");
$query = "SELECT Name, DateOfStatehood FROM StateStats ORDER BY DateOfStatehood";
include 'runQuery.php';
include 'printResults.php';
?>
    
</body>
