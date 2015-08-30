<?php
    
//reference=https://www.youtube.com/watch?v=v8HoVdenZFM
    $username=$_SESSION ['username'];
    $userid= ($_SESSION['grades']==1 && !empty($_GET['id']) && $_GET['id'] != 2) ? $_GET['id'] : $_SESSION ['userid'];

    date_default_timezone_set('America/Chicago');

    require_once('functions.php');

    if(isset($_POST['delete'])) {
        $query = $db->query("SELECT * FROM Grade_Assignment WHERE ID = ".$_POST['assignment']);
        $current = mysqli_fetch_assoc($query);
        $current = array_filter(explode(";", $current['Grades']));
        for($i = 0; $i < count($current); $i++) {
            if($current[$i] == $_POST['delete']) {
                unset($current[$i]);
                $current = implode(";", $current);
                $db->query("UPDATE Grade_Assignment SET Grades = '".$current."' WHERE ID = ".$_POST['assignment']);
                break;
            }
        }
        update_gpa($db, $userid);
    }

    if(isset($_POST['edit'])) {
        $query = $db->query("SELECT * FROM Grade_Assignment WHERE ID = ".$_POST['oldassignment']);
        $current = mysqli_fetch_assoc($query);
        $current = array_filter(explode(";", $current['Grades']));
        for($i = 0; $i < count($current); $i++) {
            if($current[$i] == $_POST['edit']) {
                unset($current[$i]);
                $current = implode(";", $current);
                $db->query("UPDATE Grade_Assignment SET Grades = '".$current."' WHERE ID = ".$_POST['oldassignment']);
                break;
            }
        }
        $query = $db->query("SELECT * FROM Grade_Assignment WHERE ID = ".$_POST['assignment']);
        $current = mysqli_fetch_assoc($query);
        $current = array_filter(explode(";", $current['Grades']));
        array_push($current, $_POST['name']."@".date("Y-m-d H:i")."@".$_POST['grade']);
        $current = implode(";", $current);
        $db->query("UPDATE Grade_Assignment SET Grades = '".$current."' WHERE ID = ".$_POST['assignment']);
        update_gpa($db, $userid);
    }

    if(isset($_POST['create'])) {
        $query = $db->query("SELECT * FROM Grade_Assignment WHERE ID = ".$_POST['assignment']);
        $current = mysqli_fetch_assoc($query);
        $current = array_filter(explode(";", $current['Grades']));
        array_push($current, $_POST['name']."@".date("Y-m-d H:i")."@".$_POST['grade']);
        $current = implode(";", $current);
        $db->query("UPDATE Grade_Assignment SET Grades = '".$current."' WHERE ID = ".$_POST['assignment']);
        update_gpa($db, $userid);
    }

    if(isset($_POST['createcat'])) {
        $class = $_POST['class'];
        $name = $_POST['name'];
        $weight = $_POST['weight'];
        $db->query("INSERT INTO Grade_Assignment (ClassID, Name, Weight, Grades) VALUES ($class, '$name', $weight, '')");
    }

    if(isset($_POST['deletecat'])) {
        $id = $_POST['deletecat'];
        $db->query("DELETE FROM Grade_Assignment WHERE ID = $id");
        update_gpa($db, $userid);
    }

    if(isset($_POST['deleteclass'])) {
        $id = $_POST['deleteclass'];
        $db->query("DELETE FROM Grades_Classes WHERE ID = $id");
        update_gpa($db, $userid);
    }

    if(isset($_POST['createclass'])) {
        $name = $_POST['name'];
        $credits = $_POST['credits'];
        $db->query("INSERT INTO Grades_Classes (UserID, Name, Credits) VALUES ($userid, '$name', $credits)");
    }

    $query = $db->query("SELECT * FROM Account_info WHERE UserID = ".$userid);
    $row = mysqli_fetch_assoc($query);
    $gpa = $row['SemesterGPA'];
    $query = $db->query("SELECT * FROM Grades_Classes WHERE UserID = ".$userid." ORDER BY Name ASC");
    $classes = array();
    $class = NULL;
    while($row = mysqli_fetch_assoc($query)) {
        if(isset($_GET['class']) && $_GET['class'] == $row['ID'])
            $class = $row;
        array_push($classes, $row);
    }
    $class = isset($class) ? $class : $classes[0];
    $query = $db->query("SELECT * FROM Grade_Assignment WHERE ClassID = ".$class['ID']." ORDER BY Name ASC");
    $assignments = array();
    while($row = mysqli_fetch_assoc($query))
        array_push($assignments, $row);

    $canedit = TRUE;
?>

<script type="text/javascript" src="pagecontent/grades/grades.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<?php if($_SESSION['grades']==1 && (empty($_GET['id']) || $_GET['id'] == 2)) { ?>
<script type="text/javascript">
    $(document).ready(function () {
        resort_users();

        $("#users-order-type").on('change', resort_users);
    });
</script>
<!-- Main Wrapper -->
<div id="main-wrapper">
    <div class="wrapper style2">
        <div class="inner">
            <div class="container">
                <h2 style="text-align: center;">Admin Panel</h2>
                <table id="users">
                    <colgroup>
                        <col style="width: 45%;"></col>
                        <col style="width: 20%;"></col>
                        <col style="width: 35%;"></col>
                    </colgroup>
                    <tr style="background-color: #ddd;">
                        <td></td>
                        <td style="padding: 5px 20px; text-align: right;" colspan="2">
                            Order by:
                            <select id="users-order-type">
                                <option value="0">Name</option>
                                <option value="1">Last Updated</option>
                                <option value="2">Semester GPA</option>
                            </select>
                        </td>
                    </tr>
                    <tr style="background-color: #eee; border-bottom: 1px solid #999; height: 15px; line-height: 15px;">
                        <td style="padding: 5px 20px; font-size: 8pt;">NAME</td>
                        <td style="padding: 5px 20px; font-size: 8pt;">LAST UPDATED</td>
                        <td style="padding: 5px 20px; text-align: right; font-size: 8pt;">SEMESTER GPA</td>
                    </tr>
                    <?php
                        $query = $db->query("SELECT * FROM Account_info WHERE PositionID != 15");
                        while($user = mysqli_fetch_assoc($query)) {
                            $lastupdated = NULL;
                            $query2 = $db->query("SELECT * FROM Grades_Classes WHERE UserID = ".$user['UserID']);
                            while($row = mysqli_fetch_assoc($query2)) {
                                $query3 = $db->query("SELECT * FROM Grade_Assignment WHERE ClassID = ".$row['ID']);
                                while($row2 = mysqli_fetch_assoc($query3)) {
                                    $grades = $row2['Grades'];
                                    $grades = array_filter(explode(";", $row2['Grades']));
                                    foreach($grades as $grade) {
                                        $explodedgrade = array_filter(explode("@", $grade));
                                        if(empty($lastupdated) || $explodedgrade[1] < $lastupdated)
                                            $lastupdated = $explodedgrade[1];
                                    }
                                }
                            }
                    ?>
                    <tr class="user" style="border-bottom: 1px solid #ccc; height: 20px; line-height: 20px; position: relative;">
                        <td class="user-name" style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold;"><a href="?id=<?php echo $user['UserID']; ?>"><?php echo $user['LastName'].", ".$user['FirstName']; ?></a></td>
                        <td class="user-updated" style="padding: 10px 20px 5px 20px; font-size: 8pt;"><?php echo empty($lastupdated) ? "N/A" : $lastupdated; ?></td>
                        <td class="user-gpa" style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold; text-align: right;"><?php echo empty($user['SemesterGPA']) ? "N/A" : number_format($user['SemesterGPA'], 2, '.', ''); ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>


<!-- Main Wrapper -->
<div id="main-wrapper">
    <div class="wrapper style2">
        <div class="inner">
            <div class="container">
                <div style="height: 600px; position: relative; color: rgb(64, 66, 72);">
                    <div style="width:30%; height:100%; padding: 10px 20px; float: left; border-right: 1px solid #aaa;">
                        <h2 style="text-align: center;">My Grades</h2>
                        <?php foreach($classes as $thisclass) { ?>
                        <?php /* <?php if ($_SESSION['grades']==1){ ?><a href="?id=<?php echo $thisclas['ID']; ?><?php echo "?class=".$thisclass['ID']; ?>" style="text-decoration: none;"> <?php } 
                            else { ?><a href="<?php echo "?class=".$thisclass['ID']; ?>" style="text-decoration: none;"><?php   } ?>*/ ?>
                        <a href="<?php echo "?class=".$thisclass['ID']; ?>" style="text-decoration: none;">
                            <div style="background-color: #eee; border-radius: 5px; border: 1px solid #aaa; padding: 10px 20px; margin-bottom: 5px;">
                                <?php if($canedit) { ?>
                                <form action="" method="post">
                                    <input type="hidden" name="deleteclass" value="<?php echo $thisclass['ID']; ?>" />
                                    <i class="fa fa-times" title="Delete" style="position: absolute; left: 0; cursor: pointer;" onclick="if(confirm('Are you sure you want to delete?')) { $(this).parent().submit(); return false; }"></i>
                                </form>
                                <?php } ?>
                                <span><?php echo $thisclass['Name']." (".$thisclass['Credits'].")"; ?></span>
                                <h4 style="width: 50%; text-align: right; float: right;"><?php echo empty($thisclass['Grade']) ? "--" : number_format($thisclass['Grade'], 2, '.', '')."%"; ?></h4>
                            </div>
                        </a>
                        <?php } ?>
                        <?php if($canedit) { ?>
                        <div id="new-class" style="background-color: #eee; border-radius: 5px; border: 1px solid #aaa; padding: 10px 20px; margin-bottom: 5px; display: none;">
                            <i class="fa fa-ban" title="Cancel" style="position: absolute; left: 0; cursor: pointer;" onclick="$('#new-class-btn').show(); $('#new-class').hide();"></i>
                            <input id="new-class-name" type="text" name="name" placeholder="CRSE-NUM-SEC" style="width: 120px;" />
                            <input id="new-class-credits" type="text" name="credits" placeholder="Credits" style="width: 60px;" />
                            <form action="" method="post" style="display: inline;">
                                <input type="hidden" name="name" />
                                <input type="hidden" name="credits" />
                                <input type="hidden" name="createclass" />
                                <i class="fa fa-check" title="Confirm" style="margin-left: 10px; cursor: pointer;" onclick="create_class();"></i>
                            </form>
                        </div>
                        <?php } ?>
                        <h4>GPA: <?php echo empty($gpa) ? "N/A" : number_format($gpa, 2, '.', ''); ?><?php if($canedit) { ?><button id="new-class-btn" style="float: right;" onclick="$('#new-class-btn').hide(); $('#new-class').show();">New</button><?php } ?></h4>
                    </div>
                    <div style="width:70%; height:100%; padding: 10px 20px; float: right; border-left: 1px solid #aaa;">
                        <h2 style="text-align: center;"><?php echo empty($class) ? "N/A" : $class['Name']; ?></h2>
                        <table id="grades">
                            <colgroup>
                                <?php if($canedit) { ?>
                                <col style="width: 40%;"></col>
                                <col style="width: 20%;"></col>
                                <col style="width: 30%;"></col>
                                <col style="width: 5%;"></col>
                                <col style="width: 5%;"></col>
                                <?php } else { ?>
                                <col style="width: 45%;"></col>
                                <col style="width: 20%;"></col>
                                <col style="width: 35%;"></col>
                                <?php } ?>
                            </colgroup>
                            <tr style="background-color: #ddd;">
                                <td style="padding: 5px 20px;" colspan="1">
                                    <?php if($canedit) { ?>
                                    <form id="createcategory" action="" method="post">
                                        <input type="hidden" name="class" value="<?php echo $class['ID']; ?>" />
                                        <input type="hidden" name="createcat" />
                                        <input type="hidden" name="name" />
                                        <input type="hidden" name="weight" />
                                    </form>
                                    <form id="deletecategory" action="" method="post">
                                        <input type="hidden" name="deletecat" />
                                    </form>
                                    <?php } ?>
                                    Type:
                                    <select id="assignment-type">
                                        <option value="0" selected>All</option>
                                        <?php foreach($assignments as $assignment) { ?>
                                        <option value="<?php echo $assignment['ID']; ?>"><?php echo $assignment['Name']; ?> (<?php echo $assignment['Weight']; ?>%)</option>
                                        <?php } ?>
                                        <?php if($canedit) { ?><option value="-1">New</option><?php } ?>
                                    </select>
                                    <?php if($canedit) { ?>
                                    <i class="fa fa-times" style="margin-left: 5px; cursor: pointer;" onclick="delete_category();"></i>
                                    <?php } ?>
                                </td>
                                <td style="padding: 5px 20px; text-align: right;" colspan="2">
                                    Order by:
                                    <select id="order-type">
                                        <option value="0">Assignment Name</option>
                                        <option value="1" selected>Last Updated</option>
                                        <option value="2">Grade</option>
                                    </select>
                                </td>
                                <?php if($canedit) { ?>
                                <td></td>
                                <td></td>
                                <?php } ?>
                            </tr>
                            <tr style="background-color: #eee; border-bottom: 1px solid #999; height: 15px; line-height: 15px;">
                                <td style="padding: 5px 20px; font-size: 8pt;">ASSIGNMENT NAME</td>
                                <td style="padding: 5px 20px; font-size: 8pt;">LAST UPDATED</td>
                                <td style="padding: 5px 20px; text-align: right; font-size: 8pt;">GRADE</td>
                                <?php if($canedit) { ?>
                                <td></td>
                                <td></td>
                                <?php } ?>
                            </tr>
                            <?php
                                foreach($assignments as $assignment) {
                                    $grades = array_filter(explode(';', $assignment['Grades']));

                                    foreach($grades as $grade) {
                                        if(empty($grade))
                                            continue;
                                        $explgrade = array_filter(explode('@', $grade));
                                        $gradename = $explgrade[0];
                                        $gradeupdated = $explgrade[1];
                                        $gradeval = $explgrade[2];
                            ?>
                            <tr class="grade assignment-<?php echo $assignment['ID']; ?>" style="border-bottom: 1px solid #ccc; height: 20px; line-height: 20px; position: relative; display: none;">
                                <td class="grade-name" style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold;"><?php echo $gradename; ?></td>
                                <td class="grade-updated" style="padding: 10px 20px 5px 20px; font-size: 8pt;"><?php echo $gradeupdated; ?></td>
                                <td class="grade-val" style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold; text-align: right;"><?php echo $gradeval; ?>%</td>
                                <?php if($canedit) { ?>
                                <td><i class="fa fa-pencil-square-o" style="cursor: pointer;" onclick="$(this).parent().parent().next().show(); $(this).parent().parent().hide();"></i></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="assignment" value="<?php echo $assignment['ID']; ?>" />
                                        <input type="hidden" name="delete" value="<?php echo $grade; ?>" />
                                        <i class="fa fa-times" style="cursor: pointer;" onclick="if(confirm('Are you sure you want to delete?')) $(this).parent().submit();"></i>
                                    </form>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php if($canedit) { ?>
                            <tr class="grade assignment-<?php echo $assignment['ID']; ?>-edit" style="border-bottom: 1px solid #ccc; height: 20px; line-height: 20px; position: relative; display: none;">
                                <td style="padding: 6px 20px 6px 20px;"><input id="edit-grade-name" type="text" placeholder="Assignment Name" style="font-size: 8pt; font-weight: bold; width: 100%;" value="<?php echo $gradename; ?>" /></td>
                                <td style="text-align: left;">
                                    <select id="edit-grade-assignment" style="width: 100%">
                                        <?php foreach($assignments as $thisassignment) { ?>
                                        <option value="<?php echo $thisassignment['ID']; ?>" <?php if($thisassignment['ID'] == $assignment['ID']) echo 'selected'; ?>><?php echo $thisassignment['Name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td style="padding: 6px 20px 6px 20px; text-align: right; font-size: 8pt;"><input id="edit-grade-grade" type="text" placeholder="Grade" style="text-align: right; font-size: 8pt; font-weight: bold;" value="<?php echo $gradeval; ?>" />%</td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="name" value="" />
                                        <input type="hidden" name="assignment" value="" />
                                        <input type="hidden" name="oldassignment" value="<?php echo $assignment['ID']; ?>" />
                                        <input type="hidden" name="grade" value="" />
                                        <input type="hidden" name="edit" value="<?php echo $grade; ?>" />
                                        <i class="fa fa-check" style="cursor: pointer;" onclick="edit_grade($(this).parent().parent().parent());"></i>
                                    </form>
                                </td>
                                <td><i class="fa fa-ban" style="cursor: pointer;" onclick="$(this).parent().parent().prev().show(); $(this).parent().parent().hide();"></i></td>
                            </tr>
                            <?php } } } ?>
                            <?php if($canedit) { ?>
                            <tr id="new-grade" style="border-bottom: 1px solid #ccc; height: 20px; line-height: 20px; position: relative; display: none;">
                                <td style="padding: 6px 20px 6px 20px;"><input id="new-grade-name" type="text" placeholder="Assignment Name" style="font-size: 8pt; font-weight: bold; width: 100%;" /></td>
                                <td style="text-align: left;">
                                    <select id="new-grade-assignment" style="width: 100%">
                                        <?php foreach($assignments as $assignment) { ?>
                                        <option value="<?php echo $assignment['ID']; ?>"><?php echo $assignment['Name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td style="padding: 6px 20px 6px 20px; text-align: right; font-size: 8pt;"><input id="new-grade-grade" type="text" placeholder="Grade" style="text-align: right; font-size: 8pt; font-weight: bold;" />%</td>
                                <td colspan="2">
                                    <form action="" method="post">
                                        <input type="hidden" name="name" value="" />
                                        <input type="hidden" name="assignment" value="" />
                                        <input type="hidden" name="grade" value="" />
                                        <input type="hidden" name="create" value="" />
                                        <i class="fa fa-plus" style="cursor: pointer;" onclick="create_grade();"></i>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                        <?php if($canedit && !empty($class)) { ?>
                        <button id="new-grade-btn" style="float: right;" onclick="$('#new-grade').show(); $(this).hide(); $('#cancel-new-grade-btn').show();">New</button>
                        <button id="cancel-new-grade-btn" style="float: right; display: none;" onclick="$('#new-grade').hide(); $(this).hide(); $('#new-grade-btn').show();">Cancel</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="wrapper style3">
		<div class="inner">
			<div class="container">
				<div class="row">
					<div class="8u 12u(mobile)">
					</div>

					<div class="4u 12u(mobile)">


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>