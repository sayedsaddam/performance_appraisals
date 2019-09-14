<style type="text/css">
	table th{
		text-align: center;
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$('.select2').select2(); // Searchable dropdown lists/select boxes.
	});
</script>
<section class="secMainWidth">
	<section class="secFormLayout">
		<div class="mainInputBg">
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-8">
									<strong>Performance Evaluation Form [UCPO]</strong> | 
									<small>Currently Logged in:
										<strong><?php echo $this->session->userdata('peo_name').' [ '. $this->session->userdata('peo_cnic').' ]'; ?></strong> |
									</small>
									<a href="<?php echo base_url('Perf_login/logout'); ?>" class="btn btn-warning btn-xs">Logout</a>
								</div>
								<div class="col-md-4 text-right">
									<strong><a href="<?= base_url('Performance_evaluation/get_previous'); ?>">Recently Added <i class="fa fa-angle-double-right"></i></a></strong>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<!-- General and PTPP holder's different skills, starts here... -->
							<form action="<?= base_url('performance_evaluation/save_evaluation'); ?>" method="post">
								<strong>I. General</strong>
								<table class="table table-condensed">
									<tbody>
										<tr>
											<td>1.</td>
											<td>Name</td>
											<td colspan="2">
												<div class="inputFormMain">
													<select name="emp_name" class="form-control select2">
														<option value="">Select an Employee</option>
														<?php foreach($ucpos as $emp): ?>
														<option value="<?= $emp->id; ?>"><?= $emp->position .' - '.$emp->id .' - '. $emp->name; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</td>
										</tr>
										<tr>
											<td>2.</td>
											<td>Title</td>
											<td colspan="2"><strong>Union Council Polio Officer (UCPO)</strong></td>
										</tr>
										<tr>
											<td>3.</td>
											<td>Contract Type/Position</td>
											<td colspan="2"><strong>PTPP</strong></td>
										</tr>
										<tr>
											<td>4.</td>
											<td>Duty Station <br> (UC/District/Province)</td>
											<td colspan="2">
												<div class="row">
													<div class="col-sm-4">
														<div class="inputFormMain">
															<select name="duty_province" class="form-control select2">
																<option value="">Select Province</option>
																<option value="Khyber Pakhtoonkhwa">Khyber Pakhtoonkhwa</option>
																<option value="Punjab">Punjab</option>
																<option value="Balochistan">Balochistan</option>
																<option value="Sindh">Sindh</option>
															</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="inputFormMain">
															<select name="duty_distt" class="form-control select2">
																<option value="">Select District</option>
																<option value="Peshawar">Peshawar</option>
															</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="inputFormMain">
															<select name="duty_uc" class="form-control select2">
																<option value="">Select UC</option>
																<option value="Town One">Town One</option>
															</select>
														</div>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>5.</td>
											<td>Evaluation Period</td>
											<td>
												<div class="inputFormMain">
													<input type="text" name="app_start_date" class="form-control date" placeholder="Start date..." autocomplete="off">
												</div>
											</td>
											<td>
												<div class="inputFormMain">
													<input type="text" name="app_end_date" class="form-control date" placeholder="End date..." autocomplete="off">
												</div>
											</td>
										</tr>
									</tbody>
								</table>
								<strong>II. Rate PTPP holder's Technical Skills:- </strong><hr>
								<div class="table">
									<table class="table table-condensed">
										<thead>
											<tr>
												<th></th>
												<th></th>
												<th>Job being done to the best of ability; desired results obtained</th>
												<th>Job being done to the best / good of ability; with mixed results (needs improvement)</th>
												<th>Work inadequately done; results unsatisfactory</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1)</td>
												<td>UC / Area level Micro-plans development and desk revision</td>
												<td align="center"><input type="radio" name="remark" value="1"></td>
												<td align="center"><input type="radio" name="remark" value="2"></td>
												<td align="center"><input type="radio" name="remark" value="3"></td>
											</tr>
											<tr>
												<td>2)</td>
												<td>UC / Area level Micro-plans field validation</td>
												<td align="center"><input type="radio" name="remark1" value="1"></td>
												<td align="center"><input type="radio" name="remark1" value="2"></td>
												<td align="center"><input type="radio" name="remark1" value="3"></td>
											</tr>
											<tr>
												<td>3)</td>
												<td>Status of selection of the house to house vaccination teams</td>
												<td align="center"><input type="radio" name="remark2" value="1"></td>
												<td align="center"><input type="radio" name="remark2" value="2"></td>
												<td align="center"><input type="radio" name="remark2" value="3"></td>
											</tr>
											<tr>
												<td>4)</td>
												<td>Training of the vaccination teams</td>
												<td align="center"><input type="radio" name="remark3" value="1"></td>
												<td align="center"><input type="radio" name="remark3" value="2"></td>
												<td align="center"><input type="radio" name="remark3" value="3"></td>
											</tr>
											<tr>
												<td>5)</td>
												<td>Training of the UC supervisors (Area In-charges)</td>
												<td align="center"><input type="radio" name="remark4" value="1"></td>
												<td align="center"><input type="radio" name="remark4" value="2"></td>
												<td align="center"><input type="radio" name="remark4" value="3"></td>
											</tr>
											<tr>
												<td>6)</td>
												<td>Pre campaign data collection, collation and timely transmission to the next level</td>
												<td align="center"><input type="radio" name="remark5" value="1"></td>
												<td align="center"><input type="radio" name="remark5" value="2"></td>
												<td align="center"><input type="radio" name="remark5" value="3"></td>
											</tr>
											<tr>
												<td>7)</td>
												<td>Data collection, collation and timely transmission to the next level during the campaign</td>
												<td align="center"><input type="radio" name="remark6" value="1"></td>
												<td align="center"><input type="radio" name="remark6" value="2"></td>
												<td align="center"><input type="radio" name="remark6" value="3"></td>
											</tr>
											<tr>
												<td>8)</td>
												<td>Corrective measures following the identification of the gaps</td>
												<td align="center"><input type="radio" name="remark7" value="1"></td>
												<td align="center"><input type="radio" name="remark7" value="2"></td>
												<td align="center"><input type="radio" name="remark7" value="3"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<strong>III. Rate PTPP holder's Following Attributes:- </strong><hr>
								<div class="table">
									<table class="table table-condensed">
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
												<td>Reliability</td>
												<td align="center"><input type="radio" name="attribute" value="Satisfactory"></td>
												<td align="center"><input type="radio" name="attribute" value="Needs Improvement"></td>
												<td align="center"><input type="radio" name="attribute" value="Unsatisfactory"></td>
											</tr>
											<tr>
												<td>Work independently with minimal supervision</td>
												<td align="center"><input type="radio" name="attribute1" value="Satisfactory"></td>
												<td align="center"><input type="radio" name="attribute1" value="Needs Improvement"></td>
												<td align="center"><input type="radio" name="attribute1" value="Unsatisfactory"></td>
											</tr>
											<tr>
												<td>Punctuality</td>
												<td align="center"><input type="radio" name="attribute2" value="Satisfactory"></td>
												<td align="center"><input type="radio" name="attribute2" value="Needs Improvement"></td>
												<td align="center"><input type="radio" name="attribute2" value="Unsatisfactory"></td>
											</tr>
											<tr>
												<td>Initiative</td>
												<td align="center"><input type="radio" name="attribute3" value="Satisfactory"></td>
												<td align="center"><input type="radio" name="attribute3" value="Needs Improvement"></td>
												<td align="center"><input type="radio" name="attribute3" value="Unsatisfactory"></td>
											</tr>
											<tr>
												<td>Good team player</td>
												<td align="center"><input type="radio" name="attribute4" value="Satisfactory"></td>
												<td align="center"><input type="radio" name="attribute4" value="Needs Improvement"></td>
												<td align="center"><input type="radio" name="attribute4" value="Unsatisfactory"></td>
											</tr>
											<tr>
												<td>Fimiliarity with WHO required procedures</td>
												<td align="center"><input type="radio" name="attribute5" value="Satisfactory"></td>
												<td align="center"><input type="radio" name="attribute5" value="Needs Improvement"></td>
												<td align="center"><input type="radio" name="attribute5" value="Unsatisfactory"></td>
											</tr>
										</tbody>
									</table>
								</div>
								<strong>IV. Others:-</strong><br><br>
								a)&nbsp; &nbsp;Describe any exceptional accoplishment for which the PTPP staff deserves a special recommendation or recognition <br><br>
								<div class="inputFormMain">
									<textarea name="others_a" class="form-control" rows="5" placeholder="Start typing here..."></textarea>
								</div><br>
								b)&nbsp; &nbsp; Overall Assessment <br><br>
								<div class="inputFormMain">
									<textarea name="others_b" class="form-control" rows="5" placeholder="Start typing here..."></textarea>
								</div>
								<br><br><br>
								<div class="row">
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="name" class="form-control" placeholder="Name...">1<sup>st</sup> level spervisor (Name)
										</div>
										
									</div>
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="title" class="form-control" placeholder="Title...">1<sup>st</sup> level supervisor (Title: PEO)
										</div>
										
									</div>
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="1st_signature" class="form-control" placeholder="Write your name as a signature...">1<sup>st</sup> level supervisor (Signature)
										</div>
										
									</div>
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="1st_date" class="form-control date" placeholder="Date" autocomplete="off">Date
										</div>
										
									</div>
								</div><br>
								<div class="submitBtn">
									<button type="submit" class="btn btnSubmit">Forward to UCPO</button>
									<button type="reset" class="btn btnSubmit">Reset</button>
								</div>
							</form>
							<!-- General and PTPP holder's different skills, ends here... -->
							<hr>
							<!-- Remarks by the PTPP holder, 2nd form starts here... -->
							<form action="<?= base_url('Performance_evaluation/remarks_by_ptpp'); ?>" method="post">
								Remarks by the PTPP holder at the end of evaluation <br><br>
								<div class="row">
									<div class="col-md-4">
										<div class="inputFormMain">
											<?php if($this->session->userdata('peo_cnic')): ?>
											<select name="ptpp_employee" class="form-control select2" disabled="">
												<option value="">Select an Employee</option>
												<?php foreach($ptpp_employees as $employee): ?>
													<option value="<?= $employee->emp_id; ?>">
														<?= ucfirst($employee->first_name).' '.ucfirst($employee->last_name); ?>
													</option>
												<?php endforeach; ?>
											</select>
											<small>Here's the list of employees forwarded to you, and you're requested to evaluate them one by one!</small>
										</div>
									</div>
									<div class="col-md-8">
										<div class="inputFormMain">
											<textarea name="ptpp_remarks" class="form-control" rows="5" placeholder="Start typing here... There's no returning back, once you save your data can't be changed, so be careful while filling the form. We didn't add an option to edit." disabled=""></textarea>
										</div><br>
									</div>
								</div>
								I have discussed and reviewed the performance evaluation with my supervisor:
								<br><br><br>
								<div class="row">
									<div class="col-md-4">
										<div class="inputFormMain">
											<input type="text" name="ptpp_holder_name" class="form-control" placeholder="Name..." disabled="">PTPP holder (Name)
										</div>
									</div>
									<div class="col-md-4">
										<div class="inputFormMain">
											<input type="text" name="ptpp_holder_sign" class="form-control" placeholder="Write your names as a signature..." disabled="">PTPP holder (Signature)
										</div>
									</div>
									<div class="col-md-4">
										<div class="inputFormMain">
											<input type="text" name="ptpp_date" class="form-control date" placeholder="Date" autocomplete="off" disabled="">Date
										</div>
									</div>
								</div><br>
								<div class="submitBtn">
									<button type="submit" class="btn btnSubmit">Forward to AC</button>
									<button type="reset" class="btn btnSubmit">Reset</button>
								</div>
							</form><hr><?php endif; ?>
							<!-- PTPP holder's form ends here... -->
							<center><strong>For Second level Supervisor</strong></center><br>
							&nbsp; &nbsp;&nbsp;Overall assessment by Second level supervisor according to CTC staff accountability framework:- <br><br>
							<!-- Second level supervisor's assessment. -->
							<form action="<?= base_url('Performance_evaluation/remarks_by_sec_level_sup'); ?>" method="post">
								<div class="row">
									<div class="col-md-5">
										<div class="inputFormMain">
											<select name="sec_level" class="form-control select2">
												<option value="">Select an Employee</option>
												<?php foreach($ptpp_employees as $sec_level): ?>
													<option value="<?= $sec_level->employee_id; ?>">
														<?= ucfirst($sec_level->first_name).' '.ucfirst($sec_level->last_name); ?>
													</option>
												<?php endforeach; ?>
											</select>
											<small>Here's the list of employees forwarded to you by <strong>UCPO</strong>, and you're requested to evaluate them one by one!</small>
										</div>
									</div>
								</div><br>
								<div class="row">
									<div class="col-md-6">
										<input type="radio" name="sec_level_remarks" value="Satisfactory"> a. Satisfactory <br>
										<input type="radio" name="sec_level_remarks" value="Needs Improvement"> b.  Needs improvement <br>
										<input type="radio" name="sec_level_remarks" value="Work performed inadequately"> c.  Work performed inadequately <br>
										<input type="radio" name="sec_level_remarks" value="Unsatisfactory"> d. Unsatisfactory <i>(no improvement in quality after receiving 3 warning/advice for previous inadequate performance).</i>
									</div>
									<div class="col-md-6">
										- contract recommended of extension <br>
										- contract to be re-evaluated after 3 months <br>
										- PTPP holder to be issued a warning/advice <br><br>
										- contract to be terminated
									</div>
								</div><br><br><br>
								<div class="row">
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="sec_level_name" class="form-control" placeholder="Name"> 2<sup>nd</sup> level supervisor (Name)
										</div>
									</div>
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="sec_level_title" class="form-control" placeholder="Title: Area Coordinator">2<sup>nd</sup> level supervisor (Title: AC)
										</div>
									</div>
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="sec_level_sign" class="form-control" placeholder="Write your name as a signature">2<sup>nd</sup> level supervisor (Signature)
										</div>
									</div>
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="sec_level_date" class="form-control date" placeholder="Date" autocomplete="off"> Date
										</div>
									</div>
								</div><br>
								<div class="submitBtn">
									<button type="submit" class="btn btnSubmit">Finalise</button>
									<button type="submit" class="btn btnSubmit">Roll Back</button>
								</div>
							</form>
							<!-- Second level supervisor's form ends here... -->
							<hr>
						</div>
						<!-- <div class="panel-footer"></div> -->
					</div>
				</div>
			</div>	
		</div>
	</section>
</section>