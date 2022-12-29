<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Student Manually</title>
        <link rel="stylesheet" href="style.css">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
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

            .userProfileFormContainer{
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 30px 20px;
                width: 50%;
                margin: 150px auto;
                box-shadow: 1px 2px 9px 0px rgba(153, 124, 124, 0.3);
            }

            input[type=text]{
                width: 100%;
                padding: 12px 10px;
                margin: 10px 0 22px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                
            }
            
            .addBtn {
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
            
            .userProfilePic{
                border-radius: 50%; 
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 70%;
                margin-bottom: 20px;
                cursor:default;
            }
            
            .errormsg{
                margin-bottom: 10px;
                padding-bottom: 0;
                color: red;
                font-size: 13px;
            }
            
            .tooltip {
                position: relative;
                display: inline-block;
                cursor: default;
            }

            .tooltip .tooltiptext {
                font-size: 12px;
                padding: 2px 10px;
                visibility: hidden;
                width: 280px;
                background-color: #541b1a;
                color: #fff;
                text-align: center;
                border-radius: 50px;
                margin-left: 2px;
                /* Position the tooltip */
                position: absolute;
                z-index: 1;
                top:-10px;
            }

            .tooltip:hover .tooltiptext {
                visibility: visible;
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
                ?>
                <a href="classroom.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Classroom</a>
                <a href="studentList.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Student List</a>
                
                <div class="backBtn">
                    <a href="studentList.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">cancel</a>
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
                <h1>Add Student Manually</h1>
                <div class="userProfileFormContainer">
                    <?php
                    $instructorID = $_GET['instructorID'];
                    $classID = $_GET['classID'];
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    
                    function emailExist($email){
                        $exist = false;
                        $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                        $emails = explode(",", $email);
                        foreach($emails as $e) {
                            $query = "SELECT * FROM StudentAccount WHERE email = '$e'";

                            if($result = $con->query($query)){
                                if($result->num_rows > 0)
                                {
                                    $exist = true;
                                }else{
                                    $exist = false;
                                }
                            }
                        }
                        $result->free();
                        $con->close();
                        return $exist;
                    }
                    
                    function errorDetect(){
                        global $email;

                        $error = array();

                        $emails = explode(",", $email);
                        foreach($emails as $e) {
                            if(!preg_match('^(([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)(\s*;\s*|\s*$))*$^', $e)){
                                $error['email'] = '<div class="errormsg">Invalid format of <b>Email</b>.</div>';
                            }else if(!preg_match('/^([a-zA-Z0-9_\-\.]+)@student\.tarc\.edu\.my/', $e)){
                                $error['email'] = '<div class="errormsg">Please enter valid student <b>Email</b>.</div>';
                            }else if(emailExist($e) == false){
                                $error['email'] = '<div class="errormsg">Student <b>Email</b> does not exist.</div>';
                            }
                        }
                        return $error;
                    }
                    
                    if(isset($_POST["add"])){
                        if(!empty($_POST['email'])) $email = trim($_POST['email']);
                        date_default_timezone_set('Asia/Kuala_Lumpur');
                        $todayDate = date('d-m-y h:i:s');
                        
                        $error = errorDetect();
                        
                        if(empty($error) == TRUE && emailExist($email) == TRUE){
                            //seperate email to find student id
                            $emails = explode(",", $email);
                            foreach($emails as $e) {
                                
                                //execute find student id using student email
                                $findStudentID= "SELECT * FROM StudentAccount
                                                WHERE email = '$e'";
                                $findStudentResult = $con->query($findStudentID);
                                if ($findStudentResult) {
                                    while ($row = $findStudentResult->fetch_assoc()){
                                       $studentID = $row["studentID"];
                                        //check whether student already in classroom
                                        $checkStudentExist= "SELECT * FROM ClassroomJoined
                                                        WHERE classID='$classID' AND studentID='$studentID'";

                                        $existResult = $con->query($checkStudentExist);
                                        if ($existResult->num_rows > 0) {
                                            echo"<script type='text/javascript'> 
                                                    location.replace('studentList.php?instructorID={$instructorID}&classID={$classID}')
                                                    alert('Student already in classroom.')
                                                     </script>";
                                        }else{    
                                            // find last id of classroomJoined
                                            $findLastID = "SELECT * FROM ClassroomJoined
                                                            ORDER BY classJoinedID DESC LIMIT 1";
                                            $findresult = $con->query($findLastID);
                                            if ($findresult) {
                                                while ($row = $findresult->fetch_assoc()){
                                                    $latestClassJoinedID = $row["classJoinedID"];
                                                    $latestClassJoinedID++;
                                                }
                                            } else {
                                                $latestClassJoinedID = "CJ000001";
                                            }
                                            
                                            //add new student into classroom
                                            $sql = "INSERT INTO ClassroomJoined(classJoinedID, joinedDate, classID, studentID)
                                                    VALUES('$latestClassJoinedID', '$todayDate', '$classID', '$studentID')";

                                            if ($con->query($sql) === TRUE) {
                                                echo"<script type='text/javascript'> 
                                                    location.replace('studentList.php?instructorID={$instructorID}&classID={$classID}')
                                                    alert('Student successfully added into classroom.')
                                                     </script>";
                                            } else {
                                                echo"<script type='text/javascript'> 
                                                    location.replace('studentList.php?instructorID={$instructorID}&classID={$classID}')
                                                    alert('Failed to add student.')
                                                     </script>";
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $con->close();
                    
                    ?>
                    <form action="" method="post" >
                        <label for="className">Email</label>
                        <div class="tooltip"><i style="font-size:16px" class="fa">&#xf29c;</i>
                            <span class="tooltiptext">Allow to manually add multiple email addresses, please link the addresses with comma(,).</span>
                        </div>
                        <br>
                        <input type="text" id="email" name="email" placeholder="Eg. aaa-bb19@student.tarc.edu.my,bbb-wb21@student.tarc.edu.my" value="<?php if(!empty($error)) echo $_POST['email']?>"><br>
                        <?php
                            if(!empty($error['email'])){
                                echo $error['email'];
                            }
                        ?>
                        <input type="submit" name="add" value="ADD" class="addBtn">                    
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
