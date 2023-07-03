<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location:../");
    }
    
    
    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];
    if($_SESSION['userdata']['status']==0)
    {
        $status = '<b style="color:red">Not Voted</b>';
    }
    else
    {
        $status = '<b style="color:green">Voted</b>';
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>
    <style>
        #backbtn{
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color: #b2bec3;
            color: black;
            float:left;
            margin:15px;
        }
        #logoutbtn{
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color: #b2bec3;
            color: black;
            float: right;
            margin:15px;
        }
        #profile{
            background-color: white;
            width: 35%;
            padding: 30px;
            float: left;
        }
        #group{
            background-color: white;
            width: 55%;
            padding: 35px;
            float: right;
        }
        #votebtn{
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color: #b2bec3;
            color: black;
        }

        #mainpanel{
            padding: 10px;
        }

        #voted{
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color: green;
            color:white 
        }
        #vr{
            padding: 10px;
            font-size: 15px;
            border-radius: 5px;
            background-color: #b2bec3;
            color: black;
            float: left;
            margin:15px;
        }
        
        
   </style>
    <div id="mainsection">
        <center>
        <div id="headersection">
        <a href = "../"><button id="backbtn">back</button></a>
        <a href = "logout.php"><button id="logoutbtn">Logout</button></a>
        <h1>Online Voting System</h1>
        </div>
        </center>
        <hr>
        <div id="mainpanel">
        <div id="profile">
          <center><img src="../upload/<?php echo $userdata['photo']?>"height="150" width="150"></center><br><br>
          <b>Name: </b><?php echo $userdata['name']?><br><br>
          <b>Mobile: </b><?php echo $userdata['mobile']?><br><br>
          <b>Address: </b><?php echo $userdata['address']?><br><br>
          <?php
                if($_SESSION['userdata']['role'] == 1 ){
                ?>
                    <b>Status: </b><?php echo $status?><br><br> 
                <?php
                }
                ?>
          <a href="http://localhost/voting/routes/result.php"><button id="vr">view result</button></a>
        </div>
        <div id="group">
            <?php
                if($_SESSION['groupsdata']){
                    for($i=0;$i<count($groupsdata);$i++){
                        ?>
                        <div>
                            <img style="float:right" src="../upload/<?php echo $groupsdata[$i]['photo']?>" height="150" width="150"><br><br>
                            <b>Group Name : </b><?php echo $groupsdata[$i]['name']?><br><br>
                            <b>Votes : </b><?php echo $groupsdata[$i]['votes']?><br><br>
                            <form action="../api/vote.php" method="post">
                                <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
                                <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
                                <?php
                                    if($_SESSION['userdata']['status']==0 && $_SESSION['userdata']['role'] == 1 )
                                    {
                                        ?>
                                        <input type="submit" name="votebtn" value="vote" id="votebtn">
                                        <?php
                                    }
                                    else if($_SESSION['userdata']['status']==1){
                                        ?>
                                        <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
                                        <?php
                                    }
                                ?>

                            </form>                           
                        </div>
                        <hr>
                        <?php
                    }
                }
                else{
                        
                }
            
            ?>
        </div>
        </div>
        
    </div>
      
</body>
</html>