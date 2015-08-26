<?php
    
//reference=https://www.youtube.com/watch?v=v8HoVdenZFM
    $username=$_SESSION ['username'];
    $userid=$_SESSION ['userid'];
?>

<!-- Main Wrapper -->
<div id="main-wrapper">
    <div class="wrapper style2">
        <div class="inner">
            <div class="container">
                <div style="height: 600px; position: relative; color: rgb(64, 66, 72);">
                    <div style="width:30%; height:100%; padding: 10px 20px; float: left; border-right: 1px solid #aaa;">
                        <h2 style="text-align: center;">My Grades</h2>
                        <div style="background-color: #eee; border-radius: 5px; border: 1px solid #aaa; padding: 10px 20px; margin-bottom: 5px;" onclick="">
                            <span>CSCE 436-500</span>
                            <h4 style="width: 50%; text-align: right; float: right;">89.50%</h4>
                        </div>
                        <div style="background-color: #eee; border-radius: 5px; border: 1px solid #aaa; padding: 10px 20px;" onclick="">
                            <span>ECEN 454-508</span>
                            <h4 style="width: 50%; text-align: right; float: right;">91.26%</h4>
                        </div>
                    </div>
                    <div style="width:70%; height:100%; padding: 10px 20px; float: right; border-left: 1px solid #aaa;">
                        <h2 style="text-align: center;">CSCE 436-500</h2>
                        <table>
                            <colgroup>
                                <col style="width: 45%;"></col>
                                <col style="width: 20%;"></col>
                                <col style="width: 35%;"></col>
                            </colgroup>
                            <tr style="background-color: #ddd;">
                                <td style="padding: 5px 20px;" colspan="1">
                                    Type:
                                    <select>
                                        <option>All</option>
                                        <option>Quizzes (20%)</option>
                                        <option>Tests (30%)</option>
                                        <option>Projects (30%)</option>
                                        <option>Homework (20%)</option>
                                    </select>
                                </td>
                                <td style="padding: 5px 20px; text-align: right;" colspan="2">
                                    Order by:
                                    <select>
                                        <option>Assignment Name</option>
                                        <option selected>Last Updated</option>
                                        <option>Grade</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="background-color: #eee; border-bottom: 1px solid #999; height: 15px; line-height: 15px;">
                                <td style="padding: 5px 20px; font-size: 8pt;">ASSIGNMENT NAME</td>
                                <td style="padding: 5px 20px; font-size: 8pt;">LAST UPDATED</td>
                                <td style="padding: 5px 20px; text-align: right; font-size: 8pt;">GRADE</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #ccc; height: 20px; line-height: 20px;">
                                <td style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold;">HW1</td>
                                <td style="padding: 10px 20px 5px 20px; font-size: 8pt;">8-25-2015 14:37</td>
                                <td style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold; text-align: right;">80%</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #ccc; height: 20px; line-height: 20px;">
                                <td style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold;">HW2</td>
                                <td style="padding: 10px 20px 5px 20px; font-size: 8pt;">8-25-2015 14:37</td>
                                <td style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold; text-align: right;">80%</td>
                            </tr>
                            <tr style="height: 20px; line-height: 20px;">
                                <td style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold;">HW3</td>
                                <td style="padding: 10px 20px 5px 20px; font-size: 8pt;">8-25-2015 14:37</td>
                                <td style="padding: 10px 20px 5px 20px; font-size: 8pt; font-weight: bold; text-align: right;">80%</td>
                            </tr>
                        </table>
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
