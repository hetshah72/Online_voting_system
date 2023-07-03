
<?php
 
 session_start();

include("../API/connect.php");


$check = mysqli_query($connect,"SELECT * FROM user WHERE role = 2 order by votes desc");
$groupsdata=0;

if(mysqli_num_rows($check)>0){
    $groupsdata = mysqli_fetch_all($check, MYSQLI_ASSOC);
}   

?>

<html>
<body>
<link rel="stylesheet" href="../css/tablestyle.css">
    <h1><b><u>RESULT</u></b></h1>
    <table div id="main">
    <?php if($groupsdata){?>
    <tr>
        <td div id="gn"><b> Group name</b></td>
        <td div id="vot"><b>Votes</b></td>
    </tr>
    <?php
        for($i=0;$i<count($groupsdata);$i++){
        ?>
        <tr div id="data">
            <td><?php echo $groupsdata[$i]['name']?><br><br></td>
            <td><?php echo $groupsdata[$i]['votes']?><br><br> </td>
        </tr>                
        <?php
            }
        }else{
            echo 'No groups Avaliable';    
        }
        ?>
    </table>
    <a href = "dashboard.php"><button id="backbutn">back</button></a>
</body>
</html>
