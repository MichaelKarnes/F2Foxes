<?php
    function update_assignment_grade($db, &$assignment) {
        $id = $assignment['ID'];
        $query = $db->query("SELECT * FROM Grade_Assignment WHERE ID = $id");
        $current = mysqli_fetch_assoc($query);
        $current = array_filter(explode(";", $current['Grades']));
        $totalnum = count($current);
        $grade = 0;
        for($i = 0; $i < count($current); $i++) {
            $gradexplode = array_filter(explode("@", $current[$i]));
            $grade += $gradexplode[2];
        }
        $grade = $grade/$totalnum;
        $assignment['Grade'] = $grade;
        $db->query("UPDATE Grade_Assignment SET Grade = $grade WHERE ID = $id");
    }

    function update_class_grade($db, &$class) {
        $id = $class['ID'];
        $query = $db->query("SELECT * FROM Grade_Assignment WHERE ClassID = $id");
        $assignments = array();
        $totalweight = 0;
        $grade = 0;
        while($row = mysqli_fetch_assoc($query)) {
            update_assignment_grade($db, $row);
            if(empty($row['Grade']))
                continue;
            $totalweight += $row['Weight'];
            $grade += $row['Grade'] * $row['Weight'];
            array_push($assignments, $row);
        }
        if($totalweight == 0) {
            $db->query("UPDATE Grades_Classes SET Grade = NULL WHERE ID = $id");
            return;
        }
        $grade = $grade/$totalweight;
        $class['LetterGrade'] = 4;
        if($grade < 90)
            $class['LetterGrade'] = 3;
        if($grade < 80)
            $class['LetterGrade'] = 2;
        if($grade < 70)
            $class['LetterGrade'] = 1;
        if($grade < 60)
            $class['LetterGrade'] = 0;
        $db->query("UPDATE Grades_Classes SET Grade = $grade WHERE ID = $id");
    }

    function update_gpa($db, $userid) {
        $query = $db->query("SELECT * FROM Grades_Classes WHERE UserID = $userid");
        $classes = array();
        $totalcredits = 0;
        $gpa = 0;
        while($row = mysqli_fetch_assoc($query)) {
            update_class_grade($db, $row);
            if(empty($row['Grade']))
                continue;
            $totalcredits += $row['Credits'];
            $gpa += $row['LetterGrade'] * $row['Credits'];
            array_push($classes, $row);
        }
        if($totalcredits == 0) {
            $db->query("UPDATE Account_info SET SemesterGPA = NULL WHERE UserID = $userid");
            return;
        }
        $gpa = $gpa/$totalcredits;
        $db->query("UPDATE Account_info SET SemesterGPA = $gpa WHERE UserID = $userid");
    }
?>