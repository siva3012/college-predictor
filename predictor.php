
<?php
echo " <p style='font-size: 40px;'>EXPECTED COLLEGES...</p>";

$opening=$_POST['open'];
$ct=$_POST['ct'];
$pwd=$_POST['pwd'];
$round=$_POST['round'];
$counsil=$_POST['counselling'];
$cat=$_POST['category'];
$catrank=$_POST['categoryrank'];
$gender=$_POST['gender'];
$state=$_POST['state'];
$selectedbranch=$_POST['selectedbranch'];
$selectedcollege=$_POST['institute-name'];
$instutiontype=$_POST['institute-type'];
$intial=1;
$final=110;
if($selectedcollege>100 && $selectedcollege<200){
    $selectedcollege=$selectedcollege%100;
}
elseif($selectedcollege>200 && $selectedcollege<300){
    $selectedcollege=($selectedcollege%200)+23;
}
elseif($selectedcollege>300 && $selectedcollege<400){
    $selectedcollege=($selectedcollege%300)+55;
}
elseif($selectedcollege>400 && $selectedcollege<500){
    $selectedcollege=($selectedcollege%400)+81;
}
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
if($ct=="joosa"){
$link = mysqli_connect("localhost", "root","","collegepredictor");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
if($pwd=="yes"){
    $cat=$cat. ' ' ."(PWD)";
}
if($counsil=="advance"){
    $ci_id="1";
    $cf_id="23";
}
elseif($counsil=="mains" && $instutiontype=="ALL"){
    $ci_id="24";
    $cf_id="110";
}
elseif($counsil=="mains" && $instutiontype=="NIT"){
    $ci_id="24";
    $cf_id="55";
}
elseif($counsil=="mains" && $instutiontype=="3IT"){
    $ci_id="55";
    $cf_id="81";
}
elseif($counsil=="mains" && $instutiontype=="CFI"){
    $ci_id="81";
    $cf_id="110";
}
 if($gender=="Gender-Neutral"){
     if($cat=="OPEN"){
$sql = "SELECT institute,branch,quota,Types,Gender,openingrank,closingrank,id FROM $round  where  Types='$cat' and closingrank>=$opening and branch=if(STRCMP('$selectedbranch','ALL')=0,branch,'$selectedbranch') and Gender='$gender' and id=if(STRCMP($selectedcollege,0)=0,id,$selectedcollege)  and id between '$ci_id' and '$cf_id' order By closingrank";
 }
 else{
    $sql = "SELECT institute,branch,quota,Types,Gender,openingrank,closingrank,id FROM $round  where  Types='$cat' and closingrank>=$catrank and branch=if(STRCMP('$selectedbranch','ALL')=0,branch,'$selectedbranch') and Gender='$gender' and id=if(STRCMP($selectedcollege,0)=0,id,$selectedcollege)  and id between '$ci_id' and '$cf_id' order By closingrank";
     
 }
}
 else 
 {
     if($cat=="OPEN"){
    $sql = "SELECT institute,branch,quota,Types,Gender,openingrank,closingrank,id FROM $round  where  Types='$cat' and closingrank>=$opening and branch=if(STRCMP('$selectedbranch','ALL')=0,branch,'$selectedbranch') and id=if(STRCMP($selectedcollege,0)=0,id,$selectedcollege)   and id between '$ci_id' and '$cf_id' order By closingrank";
     }
     else{
        $sql = "SELECT institute,branch,quota,Types,Gender,openingrank,closingrank,id FROM $round  where Types='$cat' and closingrank>=$catrank and branch=if(STRCMP('$selectedbranch','ALL')=0,branch,'$selectedbranch')  and id=if(STRCMP($selectedcollege,0)=0,id,$selectedcollege)   and id between '$ci_id' and '$cf_id' order By closingrank";
     
     }
 }
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
               echo "<p style='font-size: larger;'>Congratulations! These are the colleges that fit your rank among all the colleges. Take your time to choose the best and write to us if you get stuck while selecting! Thank you for choosing PLADEX to look up for colleges!</p>
";
        echo "<table>";
            echo "<tr>";
                echo "<th>Institute</th>";
                echo "<th>Branch</th>";
                echo "<th>Quota</th>";
                echo "<th>Types</th>";
                echo "<th>Gender</th>";
               echo "<th>Opening Rank</th>";
                echo "<th>Closing Rank</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
     
            echo "<tr>";
            if($row[2]=="HS"&&$row[7]!="$state"||$row[2]=="JK"&&$row[7]!="$state"){}
            else{
                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[2] . "</td>";
                echo "<td>" . $row[3] . "</td>";
                echo "<td>" . $row[4] . "</td>";
                echo "<td>" . $row[5] . "</td>";
                echo "<td>" . $row[6] . "</td>";
            }
        
            echo "</tr>";
        }
    
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records found.. 
        Hey there! Don't worry. We wish you all the best for the next time. Be persistent and confident as you are now. You deserve better! Thank you for choosing PLADEX to look up for the colleges";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}
else{
    $link = mysqli_connect("localhost","root","","csabpredictor");
 
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    if($pwd=="yes"){
        $cat=$cat. ' ' ."(PWD)";
    }
     if($gender=="Gender-Neutral"){
         
    $sql = "SELECT institute,branch,quota,Types,Gender,openingrank,closingrank,id FROM $round where  Types='$cat' and closingrank>=$opening and branch=if(STRCMP('$selectedbranch','ALL')=0,branch,'$selectedbranch') and id=if(STRCMP($selectedcollege,0)=0,id,$selectedcollege)   and Gender='$gender' order By closingrank";
     }
    
     else 
     {
        $sql = "SELECT institute,branch,quota,Types,Gender,openingrank,closingrank,id FROM $round where  Types='$cat' and closingrank>=$opening and branch=if(STRCMP('$selectedbranch','ALL')=0,branch,'$selectedbranch') and id=if(STRCMP($selectedcollege,0)=0,id,$selectedcollege) order By closingrank";
         }
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){
                       echo "<p style='font-size: larger;'>Congratulations! These are the colleges that fit your rank among all the colleges. Take your time to choose the best and write to us if you get stuck while selecting! Thank you for choosing PLADEX to look up for colleges!</p>
";
            echo "<table>";
                echo "<tr>";
                    echo "<th>Institute</th>";
                    echo "<th>Branch</th>";
                    echo "<th>Quota</th>";
                    echo "<th>Types</th>";
                    echo "<th>Gender</th>";
                   echo "<th>Opening Rank</th>";
                    echo "<th>Closing Rank</th>";
                echo "</tr>";
            while($row = mysqli_fetch_array($result)){

                echo "<tr>";
                //for($i=1;$i<=110;$i++){
                if(($row[2]=="HS"&&$row[7]!="$state")||$row[2]=="JK"&&$row[7]!="$state"){}
                else{
                    echo "<td>" . $row[0] . "</td>";
                    echo "<td>" . $row[1] . "</td>";
                    echo "<td>" . $row[2] . "</td>";
                    echo "<td>" . $row[3] . "</td>";
                    echo "<td>" . $row[4] . "</td>";
                    echo "<td>" . $row[5] . "</td>";
                    echo "<td>" . $row[6] . "</td>";
                }
           // }
                echo "</tr>";
            }
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "No records found..
            Hey there! Don't worry. We wish you all the best for the next time. Be persistent and confident as you are now. You deserve better! Thank you for choosing PLADEX to look up for the colleges";
        }
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    } 
}
 
 
 
// Close connection
mysqli_close($link);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXPECTED COLLEGES</title>
    <link rel="stylesheet" href="josaatable.css">
</head>
</html>
