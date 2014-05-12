<?php
session_start();

if(isset($_SESSION['views']))
{
header("location: results.php");
}
else
$_SESSION['views']=1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" type="text/css" href="styles.css"/>
  <title>Survey</title>
</head>

<body>
 <h1> Welcome to the Survey Page! </h1>
 
 <div class="links">
  <a href="index.php">Home</a><br/>
  <a href="assignments.html">Assignments</a>
 </div>


 <div class="main">
 <form action="results.php" method="post">
 What is your major?<br/>
 CS     <input type="radio" name="major" value="CS" checked>
 CE     <input type="radio" name="major" value="CE">
 CIT    <input type="radio" name="major" value="CIT">
 Web    <input type="radio" name="major" value="Web">
 Other  <input type="radio" name="major" value="Other"><br/><br/>
 
 Preferred OS?<br/>
 Windows<input type="radio" name="os" value="Windows" checked>
 Mac    <input type="radio" name="os" value="Mac">
 Linux  <input type="radio" name="os" value="Linux">
 Other  <input type="radio" name="os" value="Other"><br/><br/>

 How far into your coursework are you?<br/>
 Freshman   <input type="radio" name="grade" value="Freshman" checked>
 Sophomore  <input type="radio" name="grade" value="Sophomore">
 Junior     <input type="radio" name="grade" value="Junior">
 Senior     <input type="radio" name="grade" value="Senior"><br/><br/>

 Have you completed an internship?<br/>
 Yes <input type="radio" name="internship" value="Yes" checked>
 No  <input type="radio" name="internship" value="No"><br/><br/>

 <input type="submit">
 </form>
 </div>

<php
$_SESSION['major'] = $_POST['major'];
$_SESSION['os'] = $_POST['os'];
$_SESSION['grade'] = $_POST['grade'];
$_SESSION['internship'] = $_POST['internship'];
?>

</body>

</html>