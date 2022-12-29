<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Classroom</title>
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
                margin: 15px auto;
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

            .editClassBtn {
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
                ?>
                <a href="homepage.php?<?php echo"instructorID={$instructorID}";?>">Classroom List</a>
                <div class="backBtn">
                    <a href="homepage.php?<?php echo"instructorID={$instructorID}";?>">cancel</a>
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
                <h1>Edit Classroom Form</h1>
                <div class="addClassFormContainer">
                    
                    <?php
                    $instructorID = $_GET['instructorID'];
                    $classID = $_GET['classID'];
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    $query = "select * from classroom WHERE classID = '$classID'";
                    $result = $con->query($query);

                    if($result){
                        while($row = $result->fetch_assoc()){
                            $className = $row["className"];
                            $classDescription = $row["classDescription"];
                            $classSubject = $row["classSubject"];
                        }
                    }
                    
                    function errorDetect(){
                        global $className, $classDescription, $classSubject;

                        $error = array();

                        if(strlen($className)>50){
                            $error['className'] = '<div class="errormsg"><b>Class Name</b> cannot be more than 50 characters.</div>';
                        }else if(strlen($classDescription)>100){
                            $error['classDescription'] = '<div class="errormsg"><b>Class Description</b> cannot be more than 100 characters.</div>';
                        }
                        else if(strlen($classSubject)>50){
                            $error['classSubject'] = '<div class="errormsg"><b>Class Subject</b> cannot be more than 50 characters.</div>';
                        }

                        return $error;
                    }
                    
                    if(isset($_POST["edit"])){
                        $className = strtoupper($_POST['className']);
                        $classDescription = ucfirst($_POST['classDescription']);
                        $classSubject = ucwords($_POST['classSubject']);
                        
                        $error = errorDetect();
                        
                        if(empty($error) == TRUE){
                            $sql = "UPDATE Classroom 
                                    SET className = '$className', classDescription = '$classDescription', classSubject = '$classSubject'
                                    WHERE classID = '$classID'";

                            if ($con->query($sql) === TRUE) {
                                echo"<script type='text/javascript'> 
                                    location.replace('homepage.php?instructorID={$instructorID}')
                                    alert('Classroom edited.')
                                     </script>";
                            } else {
                                echo"<script type='text/javascript'> 
                                    location.replace('homepage.php?instructorID={$instructorID}')
                                    alert('Failed to edit classroom.')
                                     </script>";
                            }
                        }
                    }
                    $con->close();
                    ?>
                    
                    <form action="" method="post" class="addClassForm">
                        <label for="className">Classroom Name</label><br>
                        <input type="text" id="className" name="className" value="<?php echo $className; ?>" autofocus><br>
                        <?php
                            if(!empty($error['className'])){
                                echo $error['className'];
                            }
                        ?>
                        <label for="classDescription">Description</label><br>
                        <textarea style="resize:none" id="classDescription" name="classDescription" rows="6" cols="39"><?php echo $classDescription; ?></textarea><br>
                        <?php
                            if(!empty($error['classDesc'])){
                                echo $error['classDesc'];
                            }
                        ?>
                        <label for="classSubject">Subject</label><br>
                        <input type="text" id="classSubject" name="classSubject" value="<?php echo $classSubject; ?>"><br>
                        <?php
                            if(!empty($error['classSubject'])){
                                echo $error['classSubject'];
                            }
                        ?>
                        <input type="submit" name="edit" value="EDIT CLASS" class="editClassBtn">
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
