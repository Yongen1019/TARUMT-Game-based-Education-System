<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update Power Status</title>
        <link rel="stylesheet" href="style.css">
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

            .backBtn a{
                color: #541b1a;
            }
            /*Form Start*/

            .addClassFormContainer{
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 30px 20px;
                width: 300px;
                margin: 25px auto;
                box-shadow: 1px 2px 9px 0px rgba(153, 124, 124, 0.3);
            }

            input[type=text], textarea{
                width: 100%;
                padding: 12px 10px;
                margin: 10px 0 22px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .updateBtn {
                width: 100%;
                background-color: #812928;
                color: white;
                padding: 14px 20px;
                margin-top: 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                letter-spacing: 2px;
            }
            
            .errormsg{
                margin-bottom: 10px;
                padding-bottom: 0;
                color: red;
                font-size: 13px;
            }
            
            /*Form End*/
        </style>
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
                $powerID = $_GET['powerID'];
                ?>
                <a href="editGame.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">Game - Question List</a>
                <a href="powerStore.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">Power Store</a>
                <div class="backBtn">
                    <a href="powerStore.php?<?php echo"instructorID={$instructorID}&classID={$classID}&gameID={$gameID}";?>">cancel</a>
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
                <h1>Update Power Status</h1>
                <div class="addClassFormContainer">
                    
                    <?php
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    $findPower = "select * from GamePower where gameID='$gameID' and powerID = '$powerID'";
                    $findPowerResult = $con->query($findPower);
                    
                    if($findPowerResult){
                        while ($row = $findPowerResult->fetch_assoc()){
                            $gamePowerID = $row["gamePowerID"];
                            $status = $row["status"];
                            $pointExchange = $row["pointExchange"];
                            $powerID = $row["powerID"];
                            
                            $query = "select * from Power WHERE powerID = '$powerID'";
                            $result = $con->query($query);

                            if($result){
                                while($row = $result->fetch_assoc()){
                                    $powerName = $row["powerName"];
                                    $powerDescription = $row["powerDescription"];

                                    if($status == 1){
                                        $action = "DISABLE";
                                        $newStatus = 0;
                                    }else{
                                        $action = "ENABLE";
                                        $newStatus = 1;
                                    }
                                }
                            }

                            if(isset($_POST["update"])){
                                $updateQuery = "UPDATE GamePower SET status = '$newStatus' WHERE gameID = '$gameID' and powerID = '$powerID'";
                                $updateResult = $con->query($updateQuery);
                                if($updateResult){
                                    echo"<script type='text/javascript'> 
                                    location.replace('powerStore.php?instructorID={$instructorID}&classID={$classID}&gameID={$gameID}')
                                    alert('Power status is successfully updated.')
                                    </script>";
                                }else{
                                    echo"<script type='text/javascript'> 
                                    location.replace('powerStore.php?instructorID={$instructorID}&classID={$classID}&gameID={$gameID}')
                                    alert('Failed to update power status.')
                                    </script>";
                                }
                            }
                        }
                    }
                    $con->close();
                    ?>
                    
                    <form action="" method="post" class="addClassForm">
                        <label for="className">Power Name</label><br>
                        <input type="text"  value="<?php echo $powerName; ?>"  disabled><br>
                        
                        <label for="classDescription">Description</label><br>
                        <textarea style="resize:none" rows="6" cols="39" disabled><?php echo $powerDescription; ?></textarea><br>
                        
                        <input type="submit" name="update" value="<?php echo $action; ?> POWER" class="updateBtn">
                    </form> 
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
