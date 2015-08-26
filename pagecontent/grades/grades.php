<?php
    
//reference=https://www.youtube.com/watch?v=v8HoVdenZFM
    $username=$_SESSION ['username'];
    $userid=$_SESSION ['userid'];

    date_default_timezone_set('America/Chicago');

    if(isset($_POST['delete'])) {
        $query = $db->query("SELECT * FROM Grade_Assignment WHERE ID = ".$_POST['assignment']);
        $current = mysqli_fetch_assoc($query);
        $current = explode(";", $current['Grades']);
        for($i = 0; $i < count($current); $i++) {
            if($current[$i] == $_POST['delete']) {
                unset($current[$i]);
                $current = implode(";", $current);
                $db->query("UPDATE Grade_Assignment SET Grades = '".$current."' WHERE ID = ".$_POST['assignment']);
                break;
            }
        }
        // NEED UPDATE GPA FUNCTIONS
    }

    if(isset($_POST['create'])) {
        $query = $db->query("SELECT * FROM Grade_Assignment WHERE ID = ".$_POST['assignment']);
        $current = mysqli_fetch_assoc($query);
        $current = explode(";", $current['Grades']);
        array_push($current, $_POST['name']."@".date("Y-m-d H:i")."@".$_POST['grade']);
        $current = implode(";", $current);
        $db->query("UPDATE Grade_Assignment SET Grades = '".$current."' WHERE ID = ".$_POST['assignment']);
        // NEED UPDATE GPA FUNCTIONS
    }

    $query = $db->query("SELECT * FROM Grades_Classes WHERE UserID = ".$userid." ORDER BY Name ASC");
    $classes = array();
    while($row = mysqli_fetch_assoc($query))
        array_push($classes, $row);
    $class = $classes[0];
    $query = $db->query("SELECT * FROM Grade_Assignment WHERE ClassID = ".$class['ID']." ORDER BY Name ASC");
    $assignments = array();
    while($row = mysqli_fetch_assoc($query))
        array_push($assignments, $row);
?>

<script type="text/javascript" src="pagecontent/grades/grades.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


<!-- Main Wrapper -->
<div id="main-wrapper">
    <div class="wrapper style2">
        <div class="inner">
            <div class="container">
                <div style="height: 600px; position: relative; color: rgb(64, 66, 72);">
                    <div style="width:30%; height:100%; padding: 10px 20px; float: left; border-right: 1px solid #aaa;">
                        <h2 style="text-align: center;">My Grades</h2>
                        <?php foreach($classes as $thisclass) { ?>
                        <div style="background-color: #eee; border-radius: 5px; border: 1px solid #aaa; padding: 10px 20px; margin-bottom: 5px;" onclick="">
                            <span><?php echo $thisclass['Name']; ?></span>
                            <h4 style="width: 50%; text-align: right; float: right;"><?php echo empty($thisclass['Grade']) ? "--" : number_format($thisclass['Grade'], 2, '.', '')."%"; ?></h4>
                        </div>
                        <?php } ?>
                    </div>
                    <div style="width:70%; height:100%; padding: 10px 20px; float: right; border-left: 1px solid #aaa;">
                        <h2 style="text-align: center;"><?php echo empty($class) ? "N/A" : $class['Name']; ?></h2>
                        <table id="grades">
                            <colgroup>
                                <?php if(true) { ?>
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
                                    Type:
                                    <select id="assignment-type">
                                        <option value="0" selected>All</option>
                                        <?php foreach($assignments as $assignment) { ?>
                                        <option value="<?php echo $assignment['ID']; ?>"><?php echo $assignment['Name']; ?> (<?php echo $assignment['Weight']; ?>%)</option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td style="padding: 5px 20px; text-align: right;" colspan="2">
                                    Order by:
                                    <select id="order-type">
                                        <option value="0">Assignment Name</option>
                                        <option value="1" selected>Last Updated</option>
                                        <option value="2">Grade</option>
                                    </select>
                                </td>
                                <?php if(true) { ?>
                                <td></td>
                                <td></td>
                                <?php } ?>
                            </tr>
                            <tr style="background-color: #eee; border-bottom: 1px solid #999; height: 15px; line-height: 15px;">
                                <td style="padding: 5px 20px; font-size: 8pt;">ASSIGNMENT NAME</td>
                                <td style="padding: 5px 20px; font-size: 8pt;">LAST UPDATED</td>
                                <td style="padding: 5px 20px; text-align: right; font-size: 8pt;">GRADE</td>
                                <?php if(true) { ?>
                                <td></td>
                                <td></td>
                                <?php } ?>
                            </tr>
                            <?php
                                foreach($assignments as $assignment) {
                                    $grades = explode(';', $assignment['Grades']);

                                    foreach($grades as $grade) {
                                        $explgrade = explode('@', $grade);
                                        $gradename = $explgrade[0];
                                        $gradeupdated = $explgrade[1];
                                        $gradeval = $explgrade[2];
                            ?>
                            <tr class="grade assignment-<?php echo $assignment['ID']; ?>" style="border-bottom: 1px solid #ccc; height: 20px; line-height: 20px; position: relative; display: none;">
                                <td class="grade-name" style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold;"><?php echo $gradename; ?></td>
                                <td class="grade-updated" style="padding: 10px 20px 5px 20px; font-size: 8pt;"><?php echo $gradeupdated; ?></td>
                                <td class="grade-val" style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold; text-align: right;"><?php echo $gradeval; ?>%</td>
                                <?php if(true) { ?>
                                <td><a href=""><i class="fa fa-pencil-square-o"></i></a></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="assignment" value="<?php echo $assignment['ID']; ?>" />
                                        <input type="hidden" name="delete" value="<?php echo $grade; ?>" />
                                        <i class="fa fa-times" style="cursor: pointer;" onclick="if(confirm('Are you sure you want to delete?')) $(this).parent().submit();"></i>
                                    </form>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php } } ?>
                            <?php if(true) { ?>
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
                                        <i class="fa fa-plus" style="cursor: pointer;" onclick="prepare_create();"></i>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                        <?php if(true && !empty($class)) { ?>
                        <button style="float: right;" onclick="$('#new-grade').css('display', 'table-row');">New</button>
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
