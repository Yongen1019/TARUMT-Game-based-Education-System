<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <link rel="stylesheet" href="style.css"/>
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
            
            .createClassBtn{
                margin-top: 10px;
                margin-bottom: 40px;
            }
            
            .createClassBtn a:hover{
                box-shadow: 1px 1px 5px rgba(153, 124, 124, 0.7);
            }
            
            .createClassBtn a{
                color: white;
                text-decoration: none;
                margin-left: 10px;
                background-color: #997c7c;
                padding: 10px 20px;
                border-radius: 2px;
            }
            
            /*----------- Classroom Card Start ------------*/
            
            .classRow{
                margin-left: 25px;
            }
            
            /* Float four columns side by side */
            .classColumn {
              float: left;
              width: 30%;
              padding: 0 10px;
              margin: 15px;
              margin-left: 0px;
              margin-bottom: 30px;
            }

            /* Clear floats after the columns */
            .classRow:after {
              content: "";
              display: table;
              clear: both;
            }

            /* Responsive columns */
            @media screen and (max-width: 600px) {
              .classColumn {
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
            }
            
            .classMenuBtn{
                border:none;
                font-weight: bold;
                color: #812928;
                vertical-align: top;
            }
            
            .classCardContent{
                text-align: left;
                margin: 15px 10px;
            }
            
            .classTitle{
                font-weight: 600;
                text-transform: uppercase;
                margin: 10px 0;
                height: 50px;
                white-space: initial;
            }
           
            .subjectTxt, .descTxt{
                text-transform: capitalize;
                white-space: initial;
            }
            
            .subjectTxt{
                text-align: center;
                background-color: rgba(129, 41, 40, 0.2);
                color: rgba(129, 41, 40, 0.9);
                font-weight: 550;
                justify-content: center;
                font-size: 14px;
                padding: 10px;
                border-radius: 20px;
            }
            
            .descTxt{
                height: 40px;
                opacity: 0.8;
            }
            
            .intoClassBtn{
                width:100%;
                background-color: #997c7c;
                color: white;
                border: 3px solid #997c7c;
                padding: 10px;
                text-transform: uppercase;
                letter-spacing: 1px;
                box-shadow: 0 2px 5px 0 rgba(129, 41, 40, 0.3);
            }
            
            #selectClassroom{
                display:block;
                width: 93%;
                text-align: center;
                text-decoration: none;
            }
            
            .intoClassBtn:hover{
                text-decoration: underline;
            }
            
            /*----------- Classroom Card End ------------*/
            
            .dropdown{
                position: relative;
                display: inline-block;
            }

            .dropdown-content{
                display: none;
                position: absolute;
                right: 0;
                background-color: #f9f9f9;
                min-width: 110px;
                box-shadow: 0px 8px 16px 0px rgba(153, 124, 124, 0.4);
                z-index: 1;
                text-transform: capitalize;
                text-align: left;
            }

            .dropdown-content a, .deleteClassroomBtn {
                color: black;
                padding: 10px;
                text-decoration: none;
                display: block;
                font-size: 15px;
                font-weight: 400;
            }

            .deleteClassroomBtn{
                border: none;
                width: 100%;
                text-align: left;
                background-color: #f9f9f9;
            }
            
            .dropdown-content a:hover, .deleteClassroomBtn:hover{
                background-color: #997c7c;
                color:white;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }            
            
            
        </style>
        
        <script>
            function deleteClassConfirmation() {
              let text = "Are you sure to delete this classroom?\nPress OK to delete.";
              if (confirm(text) == true) {
                //
              }
            }
        </script>
        
    </head>
    <body>
        <?php
        if($_SESSION["email"]) {
            define('directAccess', TRUE);
            $instructorID = $_GET['instructorID'];
        ?>
            <!-- The sidebar -->
            <div class="sidebar">
                <?php
                $instructorID = $_GET['instructorID'];
                ?>
                <a class="active" href="homepage.php?<?php echo"instructorID={$instructorID}";?>">Classroom List</a>
                
                
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
                <div class="classRow">
                <!-- Create Classroom button -->
                <div class="createClassBtn">
                    <a href="addClassroom.php?<?php echo"instructorID={$instructorID}";?>"><i style='font-size:16px;margin-right:3px;' class='fas'>&#xf067;</i> Create Classroom</a>
                </div>
                
                <!-- Classroom List -->
                    <?php
                        
                        //connect database
                        $con = new mysqli('localhost', 'root', '', 'TARUMTEducationDB');
                        $sql = "select * from classroom WHERE instructorID = '$instructorID'";
                        $result = $con->query($sql);

                        if($result){
                            while($row = $result->fetch_assoc()){
                                $classID = $row["classID"];
                                $className = $row["className"];
                                $classDescription = $row["classDescription"];
                                $classSubject = $row["classSubject"];
                                $classCode = $row["classCode"];
                                $str="instructorID={$instructorID}&classID={$classID}";

                                printf('
                                    <div class="classColumn">
                                    <div class="card">
                                        <h3 class="classTitle">
                                            %s
                                            <div class="dropdown" style="float:right;">
                                                <button class="classMenuBtn">
                                                    <i style="font-size:16px;cursor:pointer" class="fa">&#xf0c9;</i>
                                                </button>
                                                <div class="dropdown-content">', $className);
                    ?>
                    
                    <a href="editClassroom.php?<?php echo $str; ?>">Edit</a>
                    <a href="deleteClassroom.php?<?php echo $str; ?>">Delete</a>
                
                    <?php
                                printf('
                                    </div>
                                    </div>
                                    </h3>
                                    <p class="classCardContent subjectTxt">%s</p>
                                    <p class="classCardContent descTxt">%s</p></div>', $classSubject, $classDescription);
                    ?>
                                    
                    <a class="intoClassBtn" id="selectClassroom" href="classroom.php?<?php echo $str; ?>">Select</a>
                    <?php
                            printf('</div>');
                                

                            }
                            //if no such item will display an error message.
                            $row_cnt = mysqli_num_rows($result);

                            if($row_cnt == 0){
                                echo'<div class="nonexist">Sorry, you have not create any classroom yet.</div> ';
                            }
                        }else{
                            echo$con->error;
                        }
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
