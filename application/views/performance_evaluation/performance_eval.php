<?php 
/*
* Filename: performance_eval.php
* Filepath: views / performance_evaluation / performance_eval.php
* Author: Saddam
*/
?>
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
									<small>Welcome :
										<?php $peo_session = $this->session->userdata('peo_cnic'); ?>
										<?php $ac_session = $this->session->userdata('ac_cnic'); ?>
										<?php $ucpo_session = $this->session->userdata('ucpo_cnic'); ?>
										<?php $tcsp_session = $this->session->userdata('tcsp_cnic'); ?>
										<?php $admin_session = $this->session->userdata('admin_cnic'); ?>
										<strong>
											<?php if($peo_session){ echo $peo_session; }
													elseif($ac_session){ echo $ac_session; }
													elseif($ucpo_session){ echo $ucpo_session; }
													elseif($tcsp_session){ echo $tcsp_session; }
													elseif($admin_session){ echo $admin_session; }
												?>
										</strong> |
									</small>
									<a href="<?php echo base_url('Perf_login/logout'); ?>" class="btn btn-warning btn-xs">Logout</a>
								</div>
								<div class="col-md-4 text-right">
									<strong><a href="<?= base_url('Performance_evaluation/get_previous'); ?>">Recently Added <i class="fa fa-angle-double-right"></i></a></strong>
								</div>
							</div>
						</div>
						<div class="panel-body">
							<?php //if(!empty($this->uri->segment(3))): ?>
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
														<?php if($peo_session):
														foreach($ucpos as $emp): ?>
														<option value="<?= $emp->id; ?>"><?= $emp->position.' - '. $emp->name; ?></option>
														<?php endforeach; endif; ?>
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
															</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="inputFormMain">
															<select name="duty_distt" class="form-control select2">
															</select>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="inputFormMain">
															<select name="duty_tehsil" class="form-control select2" id="tehsil">
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
													<input type="text" name="app_start_date" class="form-control date" placeholder="Start date..." autocomplete="off" value="08-01-2019">
												</div>
											</td>
											<td>
												<div class="inputFormMain">
													<input type="text" name="app_end_date" class="form-control date" placeholder="End date..." autocomplete="off" value="31-10-2019">
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
												<td align="center"><input type="radio" name="remark" value="1" <?php if(@$previously_added->que_one == '1'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark" value="2" <?php if(@$previously_added->que_one == '2'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark" value="3" <?php if(@$previously_added->que_one == '3'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>2)</td>
												<td>UC / Area level Micro-plans field validation</td>
												<td align="center"><input type="radio" name="remark1" value="1" <?php if(@$previously_added->que_two == '1'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark1" value="2" <?php if(@$previously_added->que_two == '2'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark1" value="3" <?php if(@$previously_added->que_two == '3'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>3)</td>
												<td>Status of selection of the house to house vaccination teams</td>
												<td align="center"><input type="radio" name="remark2" value="1" <?php if(@$previously_added->que_three == '1'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark2" value="2" <?php if(@$previously_added->que_three == '2'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark2" value="3" <?php if(@$previously_added->que_three == '3'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>4)</td>
												<td>Training of the vaccination teams</td>
												<td align="center"><input type="radio" name="remark3" value="1" <?php if(@$previously_added->que_four == '1'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark3" value="2" <?php if(@$previously_added->que_four == '2'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark3" value="3" <?php if(@$previously_added->que_four == '3'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>5)</td>
												<td>Training of the UC supervisors (Area In-charges)</td>
												<td align="center"><input type="radio" name="remark4" value="1" <?php if(@$previously_added->que_five == '1'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark4" value="2" <?php if(@$previously_added->que_five == '2'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark4" value="3" <?php if(@$previously_added->que_five == '3'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>6)</td>
												<td>Pre campaign data collection, collation and timely transmission to the next level</td>
												<td align="center"><input type="radio" name="remark5" value="1" <?php if(@$previously_added->que_six == '1'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark5" value="2" <?php if(@$previously_added->que_six == '2'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark5" value="3" <?php if(@$previously_added->que_six == '3'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>7)</td>
												<td>Data collection, collation and timely transmission to the next level during the campaign</td>
												<td align="center"><input type="radio" name="remark6" value="1" <?php if(@$previously_added->que_seven == '1'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark6" value="2" <?php if(@$previously_added->que_seven == '2'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark6" value="3" <?php if(@$previously_added->que_seven == '3'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>8)</td>
												<td>Corrective measures following the identification of the gaps</td>
												<td align="center"><input type="radio" name="remark7" value="1" <?php if(@$previously_added->que_eight == '1'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark7" value="2" <?php if(@$previously_added->que_eight == '2'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="remark7" value="3" <?php if(@$previously_added->que_eight == '3'){ ?> checked <?php } ?>></td>
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
												<td align="center"><input type="radio" name="attribute" value="Satisfactory" <?php if(@$previously_added->attrib_1 == 'Satisfactory'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute" value="Needs Improvement" <?php if(@$previously_added->attrib_1 == 'Needs Improvement'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute" value="Unsatisfactory" <?php if(@$previously_added->attrib_1 == 'Unsatisfactory'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>Work independently with minimal supervision</td>
												<td align="center"><input type="radio" name="attribute1" value="Satisfactory" <?php if(@$previously_added->attrib_2 == 'Satisfactory'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute1" value="Needs Improvement" <?php if(@$previously_added->attrib_2 == 'Needs Improvement'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute1" value="Unsatisfactory" <?php if(@$previously_added->attrib_2 == 'Unsatisfactory'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>Punctuality</td>
												<td align="center"><input type="radio" name="attribute2" value="Satisfactory" <?php if(@$previously_added->attrib_3 == 'Satisfactory'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute2" value="Needs Improvement" <?php if(@$previously_added->attrib_3 == 'Needs Improvement'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute2" value="Unsatisfactory" <?php if(@$previously_added->attrib_3 == 'Unsatisfactory'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>Initiative</td>
												<td align="center"><input type="radio" name="attribute3" value="Satisfactory" <?php if(@$previously_added->attrib_4 == 'Satisfactory'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute3" value="Needs Improvement" <?php if(@$previously_added->attrib_4 == 'Needs Improvement'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute3" value="Unsatisfactory" <?php if(@$previously_added->attrib_4 == 'Unsatisfactory'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>Good team player</td>
												<td align="center"><input type="radio" name="attribute4" value="Satisfactory" <?php if(@$previously_added->attrib_5 == 'Satisfactory'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute4" value="Needs Improvement" <?php if(@$previously_added->attrib_5 == 'Needs Improvement'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute4" value="Unsatisfactory" <?php if(@$previously_added->attrib_5 == 'Unsatisfactory'){ ?> checked <?php } ?>></td>
											</tr>
											<tr>
												<td>Fimiliarity with WHO required procedures</td>
												<td align="center"><input type="radio" name="attribute5" value="Satisfactory" <?php if(@$previously_added->attrib_6 == 'Satisfactory'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute5" value="Needs Improvement" <?php if(@$previously_added->attrib_6 == 'Needs Improvement'){ ?> checked <?php } ?>></td>
												<td align="center"><input type="radio" name="attribute5" value="Unsatisfactory" <?php if(@$previously_added->attrib_6 == 'Unsatisfactory'){ ?> checked <?php } ?>></td>
											</tr>
										</tbody>
									</table>
								</div>
								<strong>IV. Others:-</strong><br><br>
								a)&nbsp; &nbsp;Describe any exceptional accoplishment for which the PTPP staff deserves a special recommendation or recognition <br><br>
								<div class="inputFormMain">
									<textarea name="others_a" class="form-control" rows="5" placeholder="Start typing here..."><?php if(!empty($previously_added)){ echo $previously_added->comment_1; } ?></textarea>
								</div><br>
								b)&nbsp; &nbsp; Overall Assessment <br><br>
								<div class="inputFormMain">
									<textarea name="others_b" class="form-control" rows="5" placeholder="Start typing here..."><?php if(!empty($previously_added)){ echo $previously_added->comment_2; } ?></textarea>
								</div>
								<br><br><br>
								<div class="row">
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="name" class="form-control" placeholder="Name..." value="<?php if(!empty($previously_added)){ echo $previously_added->signature; } ?>">1<sup>st</sup> level spervisor (Name)
										</div>
										
									</div>
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="title" class="form-control" placeholder="Title..." value="<?php if(!empty($previously_added)){ echo "PEO"; } ?>">1<sup>st</sup> level supervisor (Title: PEO)
										</div>
										
									</div>
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="1st_signature" class="form-control" placeholder="Write your name as a signature..." value="<?php if(!empty($previously_added)){ echo $previously_added->signature; } ?>">1<sup>st</sup> level supervisor (Signature)
										</div>
										
									</div>
									<div class="col-md-3">
										<div class="inputFormMain">
											<input type="text" name="1st_date" class="form-control date" placeholder="Date" autocomplete="off"value="<?php if(!empty($previously_added)){ echo date('m-d-Y', strtotime($previously_added->created_at)); } ?>">Date
										</div>
										
									</div>
								</div><br>
								<div class="submitBtn">
									<?php $ucpo_session = $this->session->userdata('ucpo_cnic'); ?>
									<?php $ac_session = $this->session->userdata('ac_cnic'); ?>
									<button type="submit" class="btn btn-primary" <?php if($ucpo_session OR $ac_session): ?> disabled="" <?php endif; ?>>Forward to UCPO</button>
									<button type="reset" class="btn btn-default" <?php if($ucpo_session OR $ac_session): ?> disabled="" <?php endif; ?>>Reset</button>
								</div>
							</form>
							<!-- General and PTPP holder's different skills, ends here... -->	
							<?php //endif; ?>
							<hr>
							<!-- Remarks by the PTPP holder, 2nd form starts here... -->
							<form action="<?= base_url('Performance_evaluation/remarks_by_ptpp'); ?>" method="post">
								Remarks by the PTPP holder at the end of evaluation <br><br>
								<div class="row">
									<div class="col-md-4">
										<div class="inputFormMain">
											<?php $peo_session = $this->session->userdata('peo_cnic'); ?>
											<?php $ac_session = $this->session->userdata('ac_cnic'); ?>
											<select name="ptpp_employee" class="form-control select2" <?php if($peo_session OR $ac_session): ?> disabled <?php endif; ?>>
												<option value="">Select an Employee</option>
												<?php foreach($ptpp_employees as $employee): ?>
													<option value="<?= $employee->emp_id; ?>" <?php if($this->session->userdata('ucpo_cnic')): ?> selected="selected" <?php endif; ?>>
														<?= $employee->name; ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div class="col-md-8">
										<div class="inputFormMain">
											<textarea name="ptpp_remarks" class="form-control" rows="5" placeholder="Start typing here... There's no returning back, once you save your data can't be changed, so be careful while filling the form. We didn't add an option to edit." <?php if($peo_session OR $ac_session): ?> disabled <?php endif; ?>></textarea>
										</div><br>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
										I have discussed and reviewed the performance evaluation with my supervisor:
									</div>
									<div class="col-md-2">
										<input type="radio" name="remarks_by_ucpo" value="Agree"> <strong>Agree</strong>
									</div>
									<div class="col-md-2">
										<input type="radio" name="remarks_by_ucpo" value="Disagree"> <strong>Disagree</strong>
									</div>
								</div>
								<br><br><br>
								<div class="row">
									<div class="col-md-4">
										<div class="inputFormMain">
											<input type="text" name="ptpp_holder_name" class="form-control" placeholder="Name..." <?php if($peo_session OR $ac_session): ?> disabled <?php endif; ?>>PTPP holder (Name)
										</div>
									</div>
									<div class="col-md-4">
										<div class="inputFormMain">
											<input type="text" name="ptpp_holder_sign" class="form-control" placeholder="Write your names as a signature..." <?php if($peo_session OR $ac_session): ?> disabled <?php endif; ?>>PTPP holder (Signature)
										</div>
									</div>
									<div class="col-md-4">
										<div class="inputFormMain">
											<input type="text" name="ptpp_date" class="form-control date" placeholder="Date" autocomplete="off" value="<?php echo date('Y-m-d'); ?>"> <?php if($peo_session OR $ac_session): ?> disabled <?php endif; ?>Date
										</div>
									</div>
								</div><br>
								<div class="submitBtn">
									<?php $peo_session = $this->session->userdata('peo_cnic'); ?>
									<?php $ac_session = $this->session->userdata('ac_cnic'); ?>
									<button type="submit" class="btn btn-primary" <?php if($peo_session OR $ac_session): ?> disabled <?php endif; ?>>Forward to AC</button>
									<button type="reset" class="btn btn-default" <?php if($peo_session OR $ac_session): ?> disabled <?php endif; ?>>Reset</button>
								</div>
							</form><hr>
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
												<?php if($ac_session): foreach($ac_employees as $ac): ?>
													<option value="<?php echo $ac->employee_id; ?>">
														<?php  echo $ac->name; ?>
													</option>
												<?php endforeach; endif; ?>
											</select>
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
											<input type="date" name="sec_level_date" class="form-control date" placeholder="Date" autocomplete="off"> Date
										</div>
									</div>
								</div><br>
								<div class="submitBtn">
									<?php $ucpo_session = $this->session->userdata('ucpo_cnic'); ?>
										<button type="submit" name="submit" class="btn btn-primary" <?php if($ucpo_session OR $peo_session): ?> disabled="disabled" <?php endif; ?>>Finalise</button>
										<button type="button" data-toggle="modal" data-target="#rollback" class="btn btn-default" <?php if($ucpo_session OR $peo_session): ?> disabled="disabled" <?php endif; ?>>Roll Back</button>
											<div id="rollback" class="modal fade" role="dialog">
											  <div class="modal-dialog">
											    <!-- Modal content-->
											    <div class="modal-content">
											      <div class="modal-header">
											        <button type="button" class="close" data-dismiss="modal">&times;</button>
											        <h4 class="modal-title">Roll Back Comment...</h4>
											      </div>
											      <div class="modal-body">
											        <textarea name="rollback_comment" class="form-control" placeholder="Type some words why do you want to Roll back ?"></textarea><br>
											        <input type="submit" name="submit_1" class="btn btn-primary" value="Roll Back">
											      </div>
											      <div class="modal-footer">
											        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											      </div>
											    </div>
											  </div>
											</div>
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
<!-- Select employee and his/her address will populate itself in the dropdown list. -->
<script type="text/javascript">
	$(document).ready(function(){
		$('select[name="emp_name"]').on('change', function(){
			var empID = $(this).val();
			if(empID){
				$.ajax({
					url: '<?php echo base_url("Performance_evaluation/get_address_ucpos/"); ?>'+empID,
					type: 'post',
					dataType: 'json',
					success: function(data){
						console.log(data); // Log data to the console.
						$('select[name="duty_province"]').empty();
						$('select[name="duty_distt"]').empty();
						$('select[name="duty_tehsil"]').empty();
						$('select[name="duty_province"]').append('<option value="'+ data.province +'">'+ data.province +'</option>');
						$('select[name="duty_distt"]').append('<option value="'+ data.district +'" selected>'+ data.district +'</option>');
						$('select[name="duty_tehsil"]').append('<option value="'+ data.tehsil +'" selected>'+ data.tehsil +'</option>');
					}
				});
			}else{
				$('select[name="duty_province"]').empty();
				$('select[name="duty_distt"]').empty();
				$('select[name="duty_tehsil"]').empty();
			}
		});
	});
</script>