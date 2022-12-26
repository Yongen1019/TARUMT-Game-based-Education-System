<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Student List</title>
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
            
            .contentTopNavBar ul li{
                display: inline;
            }
            
            .shareCodebtn, .manualAddbtn{
                border:none;
                font-size: 16px;
            }
            
            .btnSelections{
                margin-left: 35px;
                margin-top: 10px;
                margin-bottom: 35px;
            }
            
            .shareCodebtn:hover{
                box-shadow: 1px 1px 5px rgba(153, 124, 124, 0.7);
            }
            
            .manualAddbtn a, .shareCodebtn{
                color: white;
                text-decoration: none;
                background-color: #997c7c;
                border-radius: 2px;
            }
            
            .classroom{
                position: absolute;
                bottom: 10px;
                width: 100%;
            }
            
            /*Game Page Content Start*/
            
            .titleBar{
                margin: 10px 35px;
                background-color: rgba(129, 41, 40, 0.2);
                max-width: 100%;
                min-height: 200px;
                border-radius: 10px;
                padding: 2%;
                position: relative;
                margin-bottom: 40px;
                color: black;
            }
            
            .classroomTxt, .subjectTxt, .descTxt, .classCodeTxt{
                padding: 8px;
                color: #541b1a;
            }
            
            .classroomTxt{
                text-transform: uppercase;
                font-size: 22px;
                padding-bottom: 30px;
                font-weight: 600;
            }
            
            #classCode{
                font-weight: 700;
            }
            
            .subjectTxt{
                font-size: 18px;
                text-transform: capitalize;
            }

            .descTxt{
                opacity: 0.8;
                text-transform: capitalize;
            }
            
            .classCodeTxt{
                opacity: 0.8;
            }

            .menuButtonContainer{
                float: right;
            }   
            
            .shareCode{
                display: inline-block;
            }
            
            .manualAddBtn{
                display: inline-block;
                margin-left: 20px;
            }
            
            .removeStudBtn{
                display: inline-block;
                margin-left: 60px;
            }
            
            .manualAddBtn a, .removeBtnIcon{
                text-decoration: none;
                color:white;
                display:block;
                width: 120%;
                text-align: center;
                padding-top: 10px;
                padding-bottom: 10px;
                background-color: #997c7c;
                border-radius: 2px;
            }
            
            .manualAddBtn a:hover, .removeBtnIcon:hover{
                box-shadow: 1px 1px 5px rgba(153, 124, 124, 0.7);
            }
                
            .removeBtnIcon{
                border:none;
                font-size: 16px;
            }
            
                /*----------- Instructor & Student List Start ------------*/
               
                .instructorList, .studentList{
                    max-width: 100%;
                    padding: 10px 30px;
                    margin: 10px 50px 30px 50px;
                    color: #541b1a;
                }
               
                .instructorPic, .studentPic{
                    border-radius: 50%; 
                    width: 35px;
                    height: 35px;
                    margin-right: 20px;
                }
                
                .iListName, .sListName{
                    font-size: 17px;
                    text-transform: capitalize;
                }
                
                .removeStudentBtn{
                    border:none;
                    color: #812928;
                    background-color: #fffafa;
                    vertical-align: text-bottom;
                    border-radius: 50px;
                    padding: 12px 16px;
                    font-size: 16px;
                    cursor: pointer;
                }
                
                .viewStudentBtn{
                    border:none;
                    color: #812928;
                    background-color: #fffafa;
                    vertical-align: text-bottom;
                    border-radius: 50px;
                    padding: 12px 16px;
                    font-size: 16px;
                    cursor: pointer;
                }
                
                .removeStudentBtn:hover, .viewStudentBtn:hover{
                    color:white;
                }
                
                .instructorListTable, 
                .studentListTable{
                    width: 100%;
                    border-collapse: collapse;
                }
                
                .instructorListTable th, 
                .studentListTable th{
                    border-bottom: 1px solid rgba(129, 41, 40, 0.9);
                    font-size: 20px;
                    padding-bottom: 15px;
                    text-transform: uppercase;
                    font-size: 22px;
                }
                
                .instructorListTable tr:last-child td,
                .studentListTable tr:last-child td{
                    border-bottom: 1px solid rgba(129, 41, 40, 0.9);
                }
                
                .instructorListTable td,
                .studentListTable td{
                    padding: 10px;
                    text-align: left;
                    border-bottom: 1px dashed rgba(129, 41, 40, 0.2);
                }
                
                .studentListTable tr:not(:first-child):hover {
                    background-color: rgba(129, 41, 40, 0.2);
                }
                
                .studentListTable tr:not(:first-child):hover .removeStudentBtn,
                .studentListTable tr:not(:first-child):hover .viewStudentBtn{
                    background-color: rgba(129, 41, 40, 0);
                }
                
                .studentListTable tr:not(:first-child):hover .removeStudentBtn:hover,
                .studentListTable tr:not(:first-child):hover .viewStudentBtn:hover{
                    background-color: rgba(129, 41, 40, 0.2);
                }
                
                .instructorListTable .left,
                .studentListTable .left{
                    width: 3%;
                }
                
                .instructorListTable .center,
                .studentListTable .center{
                    width: 92%;
                }
                
                .studentListTable .right{
                    width: 5%;
                }
                
                .instructorListTable, .studentListTable{
                    color: #541b1a;
                }
                
                /*-----------  Instructor & Student List End ------------*/
            
            /*Game Page Content End*/
        </style>
        <script>
            function shareClassroomCode() {
                /* Get the text field */
                var copyText = document.getElementById("classCodeTxt");

                /* Select the text field */
                copyText.select();

                /* Copy the text inside the text field */
                navigator.clipboard.writeText(copyText.value);

                /* Alert the copied text */
                alert("The classroom code [ " + copyText.value + " ] is copied.");
            }
            
            function removeAllStudent() {
                let text = "Are you sure to remove all the students?\nPress OK to remove.";
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
                ?>
                <a href="classroom.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Classroom</a>
                <a class="active" href="studentList.php?<?php echo"instructorID={$instructorID}&classID={$classID}";?>">Student List</a>
                
                <div class="backBtn">
                    <a href="homepage.php?<?php echo"instructorID={$instructorID}";?>">home</a>
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
                
                <?php
                $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                $query = "select * from classroom WHERE classID = '$classID'";
                $result = $con->query($query);
                $str="instructorID={$instructorID}&classID={$classID}";
                
                if($result){
                    while($row = $result->fetch_assoc()){
                        $className = $row["className"];
                        $classDescription = $row["classDescription"];
                        $classSubject = $row["classSubject"];
                        $classCode = $row["classCode"];
                    }
                }
                
                if(isset($_POST["remove"])){
                    $findStudentSql = "select * from ClassroomJoined WHERE classID = '$classID'";
                    $findStudentResult = $con->query($findStudentSql);

                    if($findStudentResult->num_rows > 0){
                        $sql = "DELETE FROM ClassroomJoined WHERE classID = '$classID'";
                    
                        if ($con->query($sql) === TRUE) {
                            echo"<script type='text/javascript'> 
                                location.replace('studentList.php?instructorID={$instructorID}&classID={$classID}')
                                alert('Students are removed from the classroom successfully.')
                                 </script>";
                        } else {
                            echo"<script type='text/javascript'> 
                                location.replace('studentList.php?instructorID={$instructorID}&classID={$classID}')
                                alert('Failed to remove all the students.')
                                 </script>";
                        }
                    }else{
                        echo"<script type='text/javascript'> 
                                location.replace('studentList.php?instructorID={$instructorID}&classID={$classID}')
                                alert('Classroom does not have any student.')
                                 </script>";
                    }
                }
                
                $con->close();
                ?>
                <!-- Classroom Title Bar -->
                <div class="titleBar">
                    <div class="classroom">
                        <p class="classroomTxt"><?php echo $className; ?></p>
                        <p class="subjectTxt"><?php echo $classSubject; ?></p>
                        <p class="descTxt"><?php echo $classDescription; ?></p>
                        <p class="classCodeTxt">Classroom Code: <span id="classCode"><?php echo $classCode; ?></span></p>
                        <input type="hidden" id="classCodeTxt" name="classCodeTxt" value="<?php echo $classCode; ?>">
                    </div>
                </div>
                
                <!-- Buttons -->
                <div class="btnSelections">
                <form method="post"  onsubmit="return removeAllStudent();">
                    <div class="btnContainer">
                        
                        <!-- Manual Add -->
                        <div class="manualAddBtn">
                            <a href="manualAddStudent.php?<?php echo $str; ?>">
                            <i style='font-size:16px;margin-right:3px;' class='fas'>&#xf067;</i> 
                            Manually Add Student</a>
                        </div>
                        <?php
                        $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                        $studentExist = "select * from ClassroomJoined WHERE classID = '$classID'";
                        $studentExistResult = $con->query($studentExist);

                        if($studentExistResult->num_rows > 0){
                            printf('
                            <div class="removeStudBtn">
                                <input type="submit" name="remove" value="X  Remove All Students" class="removeBtnIcon">
                            </div>
                                     ');
                        }
                        
                        ?>
                    </div>
                </form>
                </div>
                <p id="demo"></p>
                <!-- Instructor -->
                <div class="instructorList">

                    <?php
                    $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                    $sql = "select * from InstructorAccount WHERE instructorID = '$instructorID'";
                    $result = $con->query($sql);

                    if($result){
                        while($row = $result->fetch_assoc()){
                            $username = $row["username"];
                            $profilePicture = $row["profilePicture"];
                            $instructorName = $row["instructorName"];
                        }
                    }
                    $con->close();
                    ?>
                    <!-- Instructor List Table -->
                    <table class="instructorListTable">
                        <th colspan="3">Instructor</th>
                        <tr>
                            <td class="left">
                                <img class="instructorPic" src="profileImage/<?php echo $profilePicture; ?>" />
                            </td>
                            <td class="center iListName"><?php echo $username." (".$instructorName.")"; ?></td>
                        </tr>
                    </table>
                </div>
                
                <!-- Student List -->
                
                <form>
                        <?php
                        
                        $instructorID = $_GET['instructorID'];
                        $classID = $_GET['classID'];
                        
                        $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                        $sql = "select * from ClassroomJoined WHERE classID = '$classID'";
                        $result = $con->query($sql);

                        if($result->num_rows > 0){
                            printf('
                                <div class="studentList">
                                <table class="studentListTable">
                                    <th colspan="4">Student List (%s)</th>

                                     ', $result->num_rows);
                            while($row = $result->fetch_assoc()){
                                $studentID = $row["studentID"];
                                
                                $listSQL = "select * from StudentAccount WHERE studentID = '$studentID'";
                                $findresult = $con->query($listSQL);
                                
                                if($findresult->num_rows > 0){
                                    while($row = $findresult->fetch_assoc()){
                                    $username = $row["username"];
                                    $studentName = $row["studentName"];
                                    $profilePicture = $row["profilePicture"];
                                    $str="instructorID={$instructorID}&classID={$classID}&studentID={$studentID}";

                                    printf('
                                        <tr>
                                        <td class="left">
                                            <img class="studentPic" src="../Student/img/%s" />
                                        </td>
                                        <td class="center sListName">%s (%s)</td>',$profilePicture, $username, $studentName);?>
                                         <td>
                                            <a href="studentProfile.php?<?php echo $str; ?>" class="viewStudentBtn" style="font-size:18px"><i class="fa fa-user-circle-o"></i></a>
                                        </td>
                                        <td class="right">
                                            <a href="removeStudent.php?<?php echo $str; ?>" class="removeStudentBtn" style="font-size:20px"><i class="fa fa-close"></i></a>
                                        </td>
                                    <?php   
                                    }
                                }
                            } 
                        }
                        $con->close();
                        ?>
                    </table>
                </div>
                </form>
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
