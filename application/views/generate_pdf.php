<!DOCTYPE html>
<html>
<head>
	<title>Generate PDF</title>
	<style type="text/css">
		table#skills{
			text-align: center;
		}
		table#attributes{
			text-align: center;
		}
	</style>
</head>
<body>
	<p align="center"><strong>Performance Evaluation Form</strong></p>
	<strong>I. General</strong><br>
	<table border="1">
		<tbody>
			<tr>
				<td>Name</td>
				<td><?php echo $emp->name; ?></td>
			</tr>
			<tr>
				<td>Position</td>
				<td><?php echo $emp->position; ?></td>
			</tr>
			<tr>
				<td>CNIC</td>
				<td><?php echo $emp->cnic_name; ?></td>
			</tr>
			<tr>
				<td>Duty station (UC / District / Province)</td>
				<td><?php echo $emp->uc.', '.$emp->district.', '.$emp->province; ?></td>
			</tr>
			<tr>
				<td>Evaluation Period</td>
				<td>
					<?php echo date('M d, Y', strtotime($emp->start_date)); ?> <strong>Till</strong>
					<?php echo date('M d, Y', strtotime($emp->end_date)); ?>
				</td>
			</tr>
		</tbody>
	</table><br><br>
	<strong>II. PTPP Technical Skills:-</strong><br>
	<table border="1" id="skills">
		<thead>
			<tr>
				<th>S No.</th>
				<th>Description</th>
				<th>Job being done to the best of ability; desired results obtained</th>
				<th>Job being done to the best/good of ability; with mixed results (needs improvement)</th>
				<th>Work inadequately done; results unsatisfactory</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1)</td>
				<td>UC/Area level Micro-plans development and desk revision</td>
				<td><?php if($emp->que_one == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_one == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_one == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td>2)</td>
				<td>UC / Area level Micro-plans field validation</td>
				<td><?php if($emp->que_two == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_two == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_two == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td>3)</td>
				<td>Status of selection of the house to house vaccination teams</td>
				<td><?php if($emp->que_three == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_three == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_three == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td>4)</td>
				<td>Training of the vaccination teams</td>
				<td><?php if($emp->que_four == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_four == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_four == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td>5)</td>
				<td>Training of the UC supervisors (Area In-charges)</td>
				<td><?php if($emp->que_five == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_five == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_five == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td>6)</td>
				<td>Pre campaign data collection, collation and timely transmission to the next level</td>
				<td><?php if($emp->que_six == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_six == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_six == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td>7)</td>
				<td>Data collection, collation and timely transmission to the next level during the campaign</td>
				<td><?php if($emp->que_seven == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_seven == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_seven == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td>8)</td>
				<td>Corrective measures following the identification of the gaps</td>
				<td><?php if($emp->que_eight == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_eight == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->que_eight == '1'){ echo "Yes"; } ?></td>
			</tr>
		</tbody>
	</table><br><br><br><br><br><br><br><br>
	<strong>III. PTPP Holder's Attributes</strong><br>
	<table border="1" id="attributes">
		<thead>
			<tr>
				<th></th>
				<th>Satisfactory</th>
				<th>Needs Improvement</th>
				<th>Unsatisfactory</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td align="left">Reliability</td>
				<td><?php if($emp->attrib_1 == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_1 == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_1 == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td align="left">Work independently with minimal supervision</td>
				<td><?php if($emp->attrib_2 == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_2 == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_2 == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td align="left">Punctuality</td>
				<td><?php if($emp->attrib_3 == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_3 == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_3 == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td align="left">Initiative</td>
				<td><?php if($emp->attrib_4 == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_4 == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_4 == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td align="left">Good team player</td>
				<td><?php if($emp->attrib_5 == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_5 == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_5 == '1'){ echo "Yes"; } ?></td>
			</tr>
			<tr>
				<td align="left">Familiarity with WHO required procedures</td>
				<td><?php if($emp->attrib_6 == '3'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_6 == '2'){ echo "Yes"; } ?></td>
				<td><?php if($emp->attrib_6 == '1'){ echo "Yes"; } ?></td>
			</tr>
		</tbody>
	</table><br><br><hr>
	<strong>IV. Others</strong><br>
	<p>Exceptional accomplishment: <br><?php echo $emp->comment_1; ?></p><br>
	<p>Overall assessment: <br><?php echo $emp->comment_2; ?></p><hr>
	<?php if(!empty($ptpp_remarks = $this->Performance_appraisal_model->get_ptpp_remarks($emp->employee_id))): ?>
	<strong>PTPP Remarks</strong>
	<p><?php echo $ptpp_remarks->remarks; ?></p>
	<strong>PTPP Comments</strong>
	<p><?php echo $ptpp_remarks->comment.'</p>'; endif; ?><hr>
	<?php if(!empty($sup_remarks = $this->Performance_appraisal_model->get_sec_level_remarks($emp->employee_id))): ?>
	<strong>Second Level Supervisor Remarks</strong>
	<p><?php echo $sup_remarks->assessment_result; endif; ?></p>

</body>
</html>