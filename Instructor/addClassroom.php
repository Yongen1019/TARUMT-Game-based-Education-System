<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Classroom</title>
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

            .addClassBtn {
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
                <h1>Add New Classroom</h1>
                <?php
                $instructorID = $_GET['instructorID'];
                
                function random_strings($length_of_string){
                    // String of all alphanumeric character
                    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

                    // Shuffle the $str_result and returns substring of specified length
                    return substr(str_shuffle($str_result), 0, $length_of_string);
                }
                
                function errorDetect(){
                    global $className, $classDescription, $classSubject;
                    
                    $error = array();

                    if(strlen($className)>50){
                        $error['className'] = '<div class="errormsg"><b>Class Name</b> cannot be more than 50 characters.</div>';
                    }else if(strlen($classDescription)>100){
                        $error['classDescription'] = '<div class="errormsg"><b>Class Description</b> cannot be more than 100 characters.</div>';
                    }else if(strlen($classSubject)>50){
                        $error['classSubject'] = '<div class="errormsg"><b>Class Subject</b> cannot be more than 50 characters.</div>';
                    }
                    
                    return $error;
                }
                
                //add classroom
                if(isset($_POST["submit"])){
                    $className = strtoupper($_POST['className']);
                    $classDescription = ucfirst($_POST['classDescription']);
                    $classSubject = ucwords($_POST['classSubject']);
                    
                    $error = errorDetect();
                    
                    if(empty($error) == TRUE){
                        //generate class code
                        $classCodeGen = random_strings(6);
                       
                        //connect DB
                        $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                        
                        //sql query
                        $findLastID = "SELECT * FROM Classroom
                                        ORDER BY classID DESC LIMIT 1";
                        
                        //execute find last id query
                        $findresult = $con->query($findLastID);
                        if ($findresult) {
                            while ($row = $findresult->fetch_assoc()){
                                $latestClassID = $row["classID"];
                                $latestClassID++;
                            }
                        } else {
                            $latestClassID = "CL000001";
                        }
                        
                        //sql query
                        $insertSql = "INSERT INTO Classroom (classID, className, classDescription, classSubject, classCode, instructorID) VALUES 
                           ('$latestClassID', '$className', '$classDescription', '$classSubject', '$classCodeGen', '$instructorID')";                   
                        
                        
                        //execute classroom
                        if($con->query($insertSql) == true){
                            echo"<script type='text/javascript'> 
                                location.replace('homepage.php?instructorID={$instructorID}')
                                alert('Classroom successfully created.')
                                 </script>";
                        }else{
                            echo"<script type='text/javascript'> 
                                location.replace('homepage.php?instructorID={$instructorID}')
                                alert('Failed to create Classroom.')
                                 </script>";
                        }
                        
                        $con->close();
                    }
                }
                
                ?>
                
                <div class="addClassFormContainer">
                    <form action="addClassroom.php?<?php echo"instructorID={$instructorID}";?>" method='POST' class="addClassForm">
                        <label for="className">Classroom Name</label><br>
                        <input type="text" id="className" name="className" placeholder="Eg. 2205 BMIT3094 ACN" required autofocus><br>
                        <?php
                            if(!empty($error['className'])){
                                echo $error['className'];
                            }
                        ?>
                        <label for="classDescription">Description</label><br>
                        <textarea style="resize:none" id="classDescription" name="classDescription" rows="6" cols="39" placeholder="Eg. Lecture Class"></textarea><br>
                        <?php
                            if(!empty($error['classDesc'])){
                                echo $error['classDesc'];
                            }
                        ?>
                        <label for="classSubject">Subject</label><br>
                        <input type="text" id="classSubject" name="classSubject" placeholder="Eg. Computer Network" required><br>
                        <?php
                            if(!empty($error['classSubject'])){
                                echo $error['classSubject'];
                            }
                        ?>
                        <input type="submit" name="submit" value="ADD CLASS" class="addClassBtn">
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
