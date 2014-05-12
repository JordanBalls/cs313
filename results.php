<?php
session_start();
$major = $_POST['major'];
$os = $_POST['os'];
$grade = $_POST['grade'];
$internship = $_POST['internship'];

if(!isset($_SESSION['done']));
{
$fp = fopen("formdata.txt", "a");
$savestring = $major . ", " . $os . ", " . $grade . ", " . $internship . "\r\n";
fwrite($fp, $savestring);
fclose($fp);
$_SESSION['done']=1;
}
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" type="text/css" href="styles.css"/>
  <title>Welcome to Jordan Balls' Homepage!</title>
</head>

<body>
 <h1>Results Page!</h1>
 <div class="links">
  <a href="index.php">Home</a><br/>
  <a href="assignments.html">Assignments</a>
 </div>

<div class="main">
<?php
   echo "Your Major: ", $major, '<br/>';
   echo "Your Preferred OS: ", $os, '<br/>';
   echo "Your Grade Level: ", $grade, '<br/>';
   echo "Done Internship?: ", $internship, '<br/>';
?>
<br/><br/>

Results<br/><br/>

<?php
$text = file_get_contents("formdata.txt");

echo "Majors: ", substr_count($text, 'CS'), " CS--",
     substr_count($text, 'CE'), " CE--",
     substr_count($text, 'CIT'), " CIT--",
     substr_count($text, 'Web'), " Web--",
     substr_count($text, 'Other'), " Other<br/>";

echo "OS: ", substr_count($text, 'Windows'), " Windows--",
     substr_count($text, 'Mac'), " Mac--",
     substr_count($text, 'Linux'), " Linux--",
     substr_count($text, 'Other'), " Other<br/>";

echo "Grade Level: ", substr_count($text, 'Freshman'), " Freshman--",
     substr_count($text, 'Sophomore'), " Sophomore--",
     substr_count($text, 'Junior'), " Junior--",
     substr_count($text, 'Senior'), " Senior<br/>";

echo "Internships: ", substr_count($text, 'Yes'), " Completed--",
     substr_count($text, 'No'), " Have Not<br/>";
?>

</div>
</body>

</html>