<html>
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        echo"Creating database.....<br/>";   
        // Create connection
        $conn = new mysqli('localhost',  'root', '');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "DROP DATABASE TARUMTEducationDB";
        mysqli_query($conn, $sql);
        
        $sql = "CREATE DATABASE TARUMTEducationDB";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully.<br/><br/>";
        } else {
            echo "Error creating database: " . $conn->error . "<br/>";
        }

        $conn->close();
        
        $db = mysqli_connect('localhost', 'root', '', 'TARUMTEducationDB') or
        die ("Could not connect to MYSQL.".mysqli_error());
 
//Create Table     
        echo"Creating table.....<br/>";
        //InstructorAccount
        $query = "CREATE TABLE InstructorAccount (
                instructorID varchar(8) not null,
                email varchar(50) not null,
                password varchar(100) not null,
                profilePicture varchar(20) not null,
                instructorName varchar(40) not null,
                username varchar(50) not null,
                gender char(1) not null,
                PRIMARY KEY(instructorID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"InstructorAccount table created.<br/>";
        
        //StudentAccount
        $query = "CREATE TABLE StudentAccount (
                studentID varchar(8) not null,
                email varchar(50) not null,
                password varchar(100) not null,
                profilePicture varchar(20) not null,
                studentName varchar(40) not null,
                username varchar(50) not null,
                gender char(1) not null,
                PRIMARY KEY(studentID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"StudentAccount table created.<br/>";
        
        //Classroom
        $query = "CREATE TABLE Classroom (
                classID varchar(8) not null,
                className varchar(50) not null,
                classDescription varchar(100) not null,
                classSubject varchar(50) not null,
                classCode varchar(6) not null,
                instructorID varchar(8) not null,
                PRIMARY KEY(classID),
                FOREIGN KEY(instructorID) REFERENCES InstructorAccount(instructorID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"Classroom table created.<br/>";
        
        //ClassroomJoined
        $query = "CREATE TABLE ClassroomJoined (
                classJoinedID varchar(8) not null,
                joinedDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                classID varchar(8) not null,
                studentID varchar(8) not null,
                PRIMARY KEY(classJoinedID),
                FOREIGN KEY(classID) REFERENCES Classroom(classID),
                FOREIGN KEY(studentID) REFERENCES StudentAccount(studentID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"ClassroomJoined table created.<br/>";
        
        //Game
        $query = "CREATE TABLE Game (
                gameID varchar(8) not null,
                quizName varchar(50) not null,
                totalScore int(8) not null,
                classID varchar(8) not null,
                PRIMARY KEY(gameID),
                FOREIGN KEY(classID) REFERENCES Classroom(classID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"Game table created.<br/>";
        
        //GameQuestion
        $query = "CREATE TABLE GameQuestion (
                questionID varchar(8) not null,
                questionType varchar(30) not null,
                question varchar(100) not null,
                duration int(8) not null,
                scoreAwarded int(8) not null,
                pointEarned int(8) not null,
                gameID varchar(8) not null,
                PRIMARY KEY(questionID),
                FOREIGN KEY(gameID) REFERENCES Game(gameID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"GameQuestion table created.<br/>";
        
        //AnswerOption
        $query = "CREATE TABLE AnswerOption (
                answerID varchar(8) not null,
                answerText varchar(50) not null,
                correctness int(1) not null,
                questionID varchar(8) not null,
                PRIMARY KEY(answerID),
                FOREIGN KEY(questionID) REFERENCES GameQuestion(questionID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"AnswerOption table created.<br/>";
        
        //Score
        $query = "CREATE TABLE Score (
                scoreID varchar(8) not null,
                score int(8) not null,
                time int(8) not null,
                gameID varchar(8) not null,
                studentID varchar(8) not null,
                PRIMARY KEY(scoreID),
                FOREIGN KEY(studentID) REFERENCES StudentAccount(studentID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"Score table created.<br/>";
        
        //Power
        $query = "CREATE TABLE Power (
                powerID varchar(8) not null,
                powerName varchar(30) not null,
                powerDescription varchar(100) not null,
                PRIMARY KEY(powerID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"Power table created.<br/>";
        
        //GamePower
        $query = "CREATE TABLE GamePower (
                gamePowerID varchar(8) not null,
                status int(1) not null,
                pointExchange int(3) not null,
                gameID varchar(8) not null,
                powerID varchar(8) not null,
                PRIMARY KEY(gamePowerID),
                FOREIGN KEY(gameID) REFERENCES Game(gameID),
                FOREIGN KEY(powerID) REFERENCES Power(powerID)
                )";
        
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"GamePower table created.<br/><br/>";
        
//Insert Data
        echo"Inserting data.....<br/>";    
        //InstructorAccount
        $query = "INSERT INTO InstructorAccount (instructorID, email, password, profilePicture, instructorName, username, gender) VALUES 
                ('IN000001', 'yappl@tarc.edu.my', '721010145562', 'IN000001.jpeg', 'yap pooi lee', 'ypl', 'F'),
                ('IN000002', 'mukck@tarc.edu.my', '660628106411', 'IN000002.jpeg', 'muk chee keong', 'mck', 'M'),
                ('IN000003', 'siowkc@tarc.edu.my', '990420123456', 'IN000003.jpg', 'siow kien chun', 'skc', 'M'),
                ('IN000004', 'ongky@tarc.edu.my', '971022000999', 'IN000004.png', 'ong kar yan', 'oky', 'F'),
                ('IN000005', 'looix@tarc.edu.my', '981212778899', 'IN000005.jpg', 'looi xiong', 'lx', 'M'),
                ('IN000006', 'jyseptember01@gmail.com', '010922100972', 'red.png', 'muk yin man', 'mym', 'F')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"InstructorAccount inserted.<br/>"; 
        
        //StudentAccount
        $query = "INSERT INTO StudentAccount (studentID, email, password, profilePicture, studentName, username, gender) VALUES
                ('ST000001', 'mukym-wm19@student.tarc.edu.my', '012345678900', 'ST000001101010.jpeg', 'muk yin man', 'mym', 'F'),
                ('ST000002', 'yapye-wm19@student.tarc.edu.my', '001122334455', 'ST000002101010.jpeg', 'yap yoon en', 'yye', 'F'),
                ('ST000003', 'mukkj-wm19@student.tarc.edu.my', '987654321234', 'ST000003101010.jpeg', 'muk ka jun', 'mkj', 'M'),
                ('ST000004', 'cliffcy-wm19@student.tarc.edu.my', '998877665544', 'ST000004101010.jpeg', 'cliff chong', 'ccy', 'M'),
                ('ST000005', 'yongjk-wb21@student.tarc.edu.my', '098765432101', 'ST000005101010.jpeg', 'yong jun keat', 'yjk', 'M'),
                ('ST000006', 'tarumteducationstudent@gmail.com', '011223344567', 'ST000006101010.jpeg', 'chan man wei', 'cmw', 'F')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"StudentAccount inserted.<br/>"; 
        
        //Classroom
        $query = "INSERT INTO Classroom (classID, className, classDescription, classSubject, classCode, instructorID) VALUES
                ('CL000001', '202205 BMIT3094 Practical', 'Practical Class - Monday 8-10am', 'Advanced Computer Network', 'eY2Mn9','IN000001'),
                ('CL000002', '202205 BASC3033 RSD3S1G10', 'Wed 9-10am', 'Social And Professional Issues', 'De77m0','IN000002'),
                ('CL000003', 'BBFA1043 (RSD) TUESDAY', 'Tues 9.00am-10.30am', 'Principles Of Accounting', 'RXZb3a','IN000001'),
                ('CL000004', '(TUTORIAL CLASS) BAIT1093', '202109 Tutorial', 'Introduction To Computer Security', '5kUU1p','IN000001'),
                ('CL000005', 'BACS2163 Software Engineering', '062021', 'Software Enginering', 'djOO94','IN000002'),
                ('CL000006', 'BMIS2004 202201', 'Lecture(Monday 8.00-10.00am)', 'Blockchain Application Development', 'AwEfn9','IN000001')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"Classroom inserted.<br/>"; 
        
        //ClassroomJoined
        $query = "INSERT INTO ClassroomJoined(classJoinedID, joinedDate, classID, studentID) VALUES
                ('CJ000001', '2022-08-01 12:31:00', 'CL000001', 'ST000001'),
                ('CJ000002', '2022-08-01 12:32:46', 'CL000001', 'ST000002'),
                ('CJ000003', '2022-08-01 12:33:10', 'CL000001', 'ST000003'),
                ('CJ000004', '2022-08-01 12:33:21', 'CL000001', 'ST000004'),
                ('CJ000005', '2022-08-05 11:01:43', 'CL000002', 'ST000002'),
                ('CJ000006', '2022-08-06 08:00:38', 'CL000003', 'ST000001'),
                ('CJ000007', '2022-08-06 08:00:47', 'CL000003', 'ST000003'),
                ('CJ000008', '2022-08-06 08:00:52', 'CL000003', 'ST000004'),
                ('CJ000009', '2022-08-06 08:00:59', 'CL000003', 'ST000005'),
                ('CJ000010', '2022-08-11 13:05:33', 'CL000004', 'ST000005'),
                ('CJ000011', '2022-08-11 13:06:33', 'CL000001', 'ST000006')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"ClassroomJoined inserted.<br/>"; 
        
        //Game
        $query = "INSERT INTO Game(gameID, quizName, totalScore, classID) VALUES
                ('GA000001', 'Quiz 1: Introduction', '3', 'CL000001'),
                ('GA000002', 'Quiz 2: OSPF', '3', 'CL000001'),
                ('GA000003', 'QUIZ: test 1', '0', 'CL000002'),
                ('GA000004', 'Weekly test', '0', 'CL000004'),
                ('GA000005', 'Prepare for mid-term', '0', 'CL000002')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"Game inserted.<br/>"; 
        
        //GameQuestion
        $query = "INSERT INTO GameQuestion(questionID, questionType, question, duration, scoreAwarded, pointEarned, gameID) VALUES
                ('GQ000001', 'multiple-choice question', 'What is ACL?', '30', '1', '2', 'GA000001'),
                ('GQ000002', 'true-false question', 'Is ip route 0.0.0.0 0.0.0.0 s0/0/0 a default static route?', '30', '1', '2', 'GA000001'),
                ('GQ000003', 'fill-in-the-blank question', 'The range of standard access is from 1 to ____?', '20', '1', '2', 'GA000001'),
                ('GQ000004', 'true-false question', 'Passive interface is used to increase the security.', '20', '1', '1', 'GA000002'),
                ('GQ000005', 'multiple-choice question', 'Describe the precedence how the router derives router ID', '45', '2', '5', 'GA000002')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"GameQuestion inserted.<br/>"; 
        
        //AnswerOption
        $query = "INSERT INTO AnswerOption(answerID, answerText, correctness, questionID) VALUES
                ('QA000001', 'Anterior Cruciate Ligament', '0', 'GQ000001'),
                ('QA000002', 'Account Credit List', '0', 'GQ000001'),
                ('QA000003', 'Access Control List', '1', 'GQ000001'),
                ('QA000004', 'Advanced Control List', '0', 'GQ000001'),
                ('QA000005', 'True', '1', 'GQ000002'),
                ('QA000006', 'False', '0', 'GQ000002'),
                ('QA000007', '99', '1', 'GQ000003'),
                ('QA000008', 'True', '1', 'GQ000004'),
                ('QA000009', 'False', '0', 'GQ000004'),
                ('QA000010', 'Router-id command', '0', 'GQ000005'),
                ('QA000011', 'Loopback', '0', 'GQ000005'),
                ('QA000012', 'The highest IP address', '1', 'GQ000005'),
                ('QA000013', 'I do not know', '0', 'GQ000005')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"AnswerOption inserted.<br/>"; 
        
        //Score
        $query = "INSERT INTO Score(scoreID, score, time, gameID, studentID) VALUES
                ('SC000001', '3', '10', 'GA000001', 'ST000001'),
                ('SC000002', '2', '20', 'GA000001', 'ST000004'),
                ('SC000003', '3', '15', 'GA000001', 'ST000002'),
                ('SC000004', '1', '10', 'GA000001', 'ST000003'),
                ('SC000005', '2', '18', 'GA000002', 'ST000001'),
                ('SC000006', '1', '14', 'GA000002', 'ST000004')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"Score inserted.<br/>"; 
        
        //Power
        $query = "INSERT INTO Power(powerID, powerName, powerDescription) VALUES
                ('PO000001', 'Gain Double Points', 'Get double points when answer correctly(used for power exchange)'),
                ('PO000002', 'Eliminate Wrong Option', 'Remove one incorrect option in a multiple-choice question'),
                ('PO000003', 'Gain Double Scores', 'Get double scores when answer correctly(used for ranking)')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"Power inserted.<br/>"; 
        
        //GamePower
        $query = "INSERT INTO GamePower(gamePowerID, status, pointExchange, gameID, powerID) VALUES
                ('GP000001', '1', '2', 'GA000001', 'PO000001'),
                ('GP000002', '1', '2', 'GA000001', 'PO000002'),
                ('GP000003', '1', '5', 'GA000001', 'PO000003'),
                ('GP000004', '1', '2', 'GA000002', 'PO000001'),
                ('GP000005', '1', '2', 'GA000002', 'PO000002'),
                ('GP000006', '1', '5', 'GA000002', 'PO000003'),
                ('GP000007', '1', '2', 'GA000003', 'PO000001'),
                ('GP000008', '1', '2', 'GA000003', 'PO000002'),
                ('GP000009', '1', '5', 'GA000003', 'PO000003'),
                ('GP000010', '1', '2', 'GA000004', 'PO000001'),
                ('GP000011', '1', '2', 'GA000004', 'PO000002'),
                ('GP000012', '1', '5', 'GA000004', 'PO000003')
                ";
        mysqli_query($db, $query) or die(mysqli_error($db));
        echo"GamePower inserted.<br/><br/>"; 
        
        echo"End of database formation.<br/>";
        echo"Please click <a href='../TARUMT_Game-Based_Education_System/Instructor/login.php'>HERE</a> to Instructor Login.";
        ?>
    </body>
</html>