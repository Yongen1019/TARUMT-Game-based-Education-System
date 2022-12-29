<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Power Store</title>
        <link rel="stylesheet" href="style.css" />
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <style>
            .profileBtn{
                background-color: #fffafa;
                margin-left: 15px;
                border:none;
                font-weight: bold;
                color: #812928;
                vertical-align: top;
                width: 38px;
            }
            
            .contentTopNavBar ul li{
                display: inline;
            }
            
            h1{
                color: #541b1a;
                text-align: center;
                font-size: 20px;
                margin-top: 20px;
                font-weight: 550;
            }
            
            .backBtn{
                position: absolute;
                bottom: 0px;
                width: 100%;
                text-transform: uppercase;
                text-align: center;
                font-weight: 600;
                letter-spacing: 1px;
                font-size: 22px;
            }

            
            .titleBar{
                margin: 0px 35px 30px 25px;
                max-width: 100%;
                border-radius: 10px;
                padding: 0px 20px 10px 20px;
                position: relative;
                color: #541b1a;
                font-weight: 600;
                font-size: 22px;
            }
            
            .backBtn a{
                color: #541b1a;
            }
            
            .addPowerBtn{
                margin-left: 25px;
                margin-top: 10px;
                margin-bottom: 40px;
            }
            
            .addPowerBtn a:hover{
                box-shadow: 1px 1px 5px rgba(153, 124, 124, 0.7);
            }
            
            .addPowerBtn a{
                color: white;
                text-decoration: none;
                margin-left: 10px;
                background-color: #997c7c;
                padding: 10px 20px;
                border-radius: 2px;
            }
            
            /*----------- Power Card Start ------------*/
            
            .powerRow{
                margin-left: 25px;
                overflow: auto;
                white-space: nowrap;
            }
            
            /* Float four columns side by side */
            .powerColumn {
                padding: 0 10px;
                margin: 0px 15px;
                margin-left: 0px;
                margin-bottom: 30px;
                display: inline-block;
            }

            /* Responsive columns */
            @media screen and (max-width: 600px) {
              .powerColumn {
                width: 100%;
                display: block;
                margin-bottom: 30px;
              }
            }

            /* Style the counter cards */
            .card {
                box-shadow: 0 2px 5px 0 rgba(129, 41, 40, 0.3);
                padding: 16px;
                text-align: center;
                background-color: #f1f1f1;
                color: #812928;
                width: 140px;
            }
            
            .powerMenuBtn{
                border:none;
                font-weight: bold;
                color: #812928;
                vertical-align: top;
                font-size: 17px;
            }
            
            .powerCardContent{
                text-align: left;
                margin: 0px 10px;
            }
            
            .powerTitle{
                font-weight: 600;
                text-transform: uppercase;
                margin: 10px 0;
                width: 100%;
            }
            
            /*----------- Power Card End ------------*/
            
            /*----------- Drop Down Menu Start ------------*/
            
            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                right: 0;
                background-color: #f9f9f9;
                min-width: 50px;
                box-shadow: 0px 8px 16px 0px rgba(153, 124, 124, 0.4);
                z-index: 1;
                text-transform: capitalize;
                text-align: left;
            }

            .dropdown-content .removePowerBtn, .disablePowerBtn, .enablePowerBtn, .updatePowerPointBtn{
                color: black;
                padding: 10px;
                text-decoration: none;
                display: block;
                font-size: 15px;
                font-weight: 400;
            }
            
            .removePowerBtn, .disablePowerBtn, .enablePowerBtn, .updatePowerPointBtn{
                border:none;
                text-align:left;
            }

            .removePowerBtn:hover, .disablePowerBtn:hover,  .enablePowerBtn:hover, .updatePowerPointBtn:hover{
                background-color: #997c7c;
                color:white;
            }

            .disablePowerBtn:hover, .enablePowerBtn:hover, .updatePowerPointBtn:hover{
                width:100px;
            }
            
            .dropdown:hover .dropdown-content {
                display: block;
                width: 120px;
            }

            /*----------- Drop Down Menu End ------------*/
            
            
            
            .powerStatus{
                text-transform: uppercase;
                font-size: 14px;
                letter-spacing: 1px;
                text-align: center;
                border-radius: 3px;
                padding: 3px 0;
                margin: 30px 15px 20px 15px;
                font-weight: 700;
            }
            
            .powerStatus-dis{
                border: 2.5px solid salmon;
                background-color: salmon;
                color: white;
            }
            
            .powerStatus-en{
                border: 2.5px solid darkseagreen;
                background-color: darkseagreen;
                color: white;
            } 
            
            .belowContentPoints{
                background-color: #812928;
                color:white;
                text-align: center;
                border-radius: 20px;
                padding: 8px 30px;
            }
            
            .powerTitle{
                margin: 40px 10px;
                color: #997c7c;
            }
            
            .powerTitleText{
                width: 100px;
                height: 80px;
                white-space: initial;
                text-align: left;
            }
            
            .belowContentDesc{
                white-space: initial;
                width:auto;
                height: 210px;
                font-size: 15px;
            }
            
            .powerType{
                text-align: center;
                font-size: 15px;
                margin-bottom: 20px;
                font-weight: bold;
                text-decoration: underline;
                color: #541b1a;
            }
            
            .belowContentPoints{
                background-color: #812928;
                color:white;
                text-align: center;
                border-radius: 20px;
                padding: 8px 30px;
            }
        </style>
        
        <script>            
            function powerConfirmation() {
              let text = "Are you sure to update the power status?\nPress OK to update.";
              if (confirm(text)) {
                return true;
              }
              return false;
            }
        </script>
    </head>
    <body>
        <?php
        if($_SESSION["email"]) {
            define('directAccess', TRUE);
        ?>           
            <!-- The sidebar -->
            <div class="sidebar">
                <?php
                $instructorID = $_GET['instructorID'];
                $classID = $_GET['classID'];
                $gameID = $_GET['gameID'];
                ?>
                <a href="editGame.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">Game - Question List</a>
                <a class="active" href="powerStore.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">Power Store</a>
                <div class="backBtn">
                    <a href="classroom.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">back</a>
                </div>
            </div>
            <?php
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                $query = "select * from instructorAccount WHERE instructorID = '$instructorID'";
                $result = $con->query($query);

                if($result){
                    while($row = $result->fetch_assoc()){
                        $profilePicture = $row["profilePicture"];
                    }
                }
                $con->close();
            ?>
            <!-- Page content -->
            <div class="content">
                <!-- Page content: TOP navigation bar -->
                <div class="contentTopNavBar">
                    <a href="#"  style="color: #541b1a;font-weight: 650;">TARUMT Game-based Teaching System</a>
                    <div class="usernamePosition">
                        <ul>
                            <li>
                                <button  onclick="window.location.href='userProfile.php?<?php echo"instructorID={$instructorID}";?>'" class="profileBtn">
                                    <img class="profilePic" src="profileImage/<?php echo$profilePicture;?>" />
                                </button>
                            </li>
                            <li>
                                <a href="logout.php" id="logoutBtn">logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <!-- Page content: Main Content -->
            <div class="contentMiddle">
                <?php
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                
                $findGameName = "select * from Game where gameID = '$gameID'";
                $findGameNameResult = $con->query($findGameName);
                    if($findGameNameResult){
                        while ($row = $findGameNameResult->fetch_assoc()){
                            $quizName = $row["quizName"];
                        }
                    }
                ?>
                <div class="titleBar">
                    <p class="classroomTxt"><?php echo"$quizName";?></p>
                </div>
                <div class="addPowerBtn">
                    <a href="mailto:tarumteducation@gmail.com?Subject=Request for Extra Power&body=I want to request for adding a new power into TARUMT Education System. "><i style='font-size:16px;margin-right:3px;' class='fas'>&#xf067;</i> Request to Add New Power</a>
                </div>
                <div class="powerRow">
                    <?php
                    
                    $findPower = "select * from GamePower where gameID='$gameID'";
                    $findPowerResult = $con->query($findPower);
                    
                    if($findPowerResult){
                        while ($row = $findPowerResult->fetch_assoc()){
                            $gamePowerID = $row["gamePowerID"];
                            $status = $row["status"];
                            $pointExchange = $row["pointExchange"];
                            $powerID = $row["powerID"];
                            
                            $query = "select * from POWER where powerID = '$powerID'";
                            $result = $con->query($query);
                            if($result){
                                while($row = $result->fetch_assoc()){
                                    $powerID = $row["powerID"];
                                    $powerName = $row["powerName"];
                                    $powerDescription = $row["powerDescription"];

                                    if($status == 1){
                                        $powerStatus = "ENABLED";
                                        $powerCss = "powerStatus-en";
                                        $powerAction = "Disable";
                                        $newStatus = 0;
                                    }else if($status == 0){
                                        $powerStatus = "DISABLED";
                                        $powerCss = "powerStatus-dis";
                                        $powerAction = "Enable";
                                        $newStatus = 1;
                                    }
                                    
                                    if($pointExchange > 1){
                                        $pointTxt = "points";
                                    }else{
                                        $pointTxt = "point";
                                    }

                                    printf(' 
                                        <div class="powerColumn">
                                            <div class="card">
                                                <div class="powerType">Default Power</div>

                                                <div class="dropdown" style="float:right;margin-bottom: 10px;">
                                                    <button class="powerMenuBtn">
                                                        <i style="font-size:16px;cursor:pointer" class="fa">&#xf0c9;</i>
                                                    </button>');?>
                                        <form method="post">
                                            <div class="dropdown-content">
                                                <a class="enablePowerBtn" href="updatePowerStatus.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}&powerID={$powerID}";?>"><?php echo$powerAction;?> Power</a>
                                                <a class="updatePowerPointBtn" href="updatePowerPoints.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}&powerID={$powerID}";?>">Update Points</a>
                                            </div>
                                        </form>
                                     <?php 
                                     printf('</div>
                                                <div class="powerTitle">
                                                    <div class="powerTitleText">%s</div>
                                                </div>

                                                <div>
                                                    <p class="powerCardContent belowContentDesc">%s</p>
                                                </div>
                                                
                                                <div class="cardContentBelow">
                                                    <p class="powerCardContent belowContentPoints">
                                                        %s %s
                                                    </p>
                                                </div>

                                                <div class="cardContentBelow">
                                                    <p class="powerCardContent powerStatus %s">%s</p>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    ', $powerName, $powerDescription, $pointExchange, $pointTxt, $powerCss, $powerStatus);
                                }
                            }
                        }
                    }
                    $con->close();
                    ?>  
                </div>
            </div>
        </div>
        <?php
            if(!defined('directAccess')){
                echo"<script type='text/javascript'> 
                    location.replace('login.php')
                    alert('Direct access not permitted, please login first.')
                     </script>";
            }
        }else {
            echo '<script type="text/javascript">'; 
            echo 'alert("Please login first to continue.");'; 
            echo 'window.location.href = "login.php";';
            echo '</script>';
        };
        ?>
    </body>
</html>
