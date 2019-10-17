<?php 
/*
* Filename: recent_tcsp.php
* Filepath: views / performance_evaluation / recent_tcsp.php
* Author: Saddam
*/
?>
<style type="text/css">
.ui-datepicker {
    display: none !important;
}

.form-control.ddfield {
    height: 36px !important;
    width: 300px;
    border: 1px solid #ccc;
}

.inputfield {
    width: 300px;
    margin-top: -6px;
    padding: 10px;
    line-height: 1rem;
    background-color: #f6f7f8;
    border: 1px solid #e1e4e7;
}

.datefldset {
    background: none !important;
    border: 0px !important;
}

.lablewidth {
    width: 180px;
    text-align: right;
    font-size: 15px;
}
</style>
<style type="text/css">
.breadcrumb.no-bg {
    display: none;
}

h4 {
    display: none;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $('#contact_list1').DataTable();
});
$(document).ready(function() {
    $('#contact_list2').DataTable();
});
</script>
<br><br>
<div class="container-fluid">
  <section class="secMainWidth" style="padding: 0px;margin-top: -40px;">
    <section class="secIndexTable">
      <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-10">
            <div class="tabelHeading">
              <?php 
              $peo_session = $this->session->userdata('peo_cnic');
              $ac_session = $this->session->userdata('ac_cnic');
              $ucpo_session = $this->session->userdata('ucpo_cnic');
              $tcsp_session = $this->session->userdata('tcsp_cnic');
              $admin_session = $this->session->userdata('admin_cnic');
              ?>
              <h3>performance evaluation by first supervisor - PEO</small> | 
                <small>Now Logged in:
                  <strong>
                    <?php if($peo_session){ echo $peo_session .' | PEO'; } ?>
                    <?php if($ac_session){ echo $ac_session .' | AC'; } ?>
                    <?php if($ucpo_session){ echo $ucpo_session .' | UCPO'; } ?>
                    <?php if($tcsp_session){ echo $tcsp_session .' | TCSP'; } ?>
                    <?php if($admin_session){ echo $admin_session .' | Admin'; } ?>
                  </strong>
                </small> |
                <small>
                  <a href="javascript:history.go(-1);">
                    <div class="label label-warning">
                      <i class="fa fa-angle-double-left"></i> back
                    </div>
                  </a>&nbsp;
                  <a href="<?= base_url('Performance_evaluation/tcsp_evaluation'); ?>">
                    <div class="label label-primary">
                      <i class="fa fa-plus"></i> add new evaluation
                    </div>
                  </a>&nbsp;
                  <a href="<?php echo base_url('Export_excel/createExcel'); ?>">
                    <div class="label label-success">Export to Excel</div>
                  </a>
                </small>
              </h3>
            </div>
          </div>
          <div class="col-md-1">
            <div class="tabelHeading">
              
            </div>
          </div>
        </div>
         <?php if($success = $this->session->flashdata('success')): ?>
             <div class="row">
               <div class="col-md-10 col-md-offset-1">
                 <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" aria-lable="close" data-dismiss="alert">&times;</a>
                  <p class="text-center"><?php echo $success; ?></p>
                </div>
               </div>
             </div> 
          <?php endif; ?>
        <div class="row">
          <div class="col-md-12">
            <div class="tableMain">
              <div class="table-responsive">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>emp iD</th>
                      <th>name</th>
                      <th>position</th>
                      <th>province</th>
                      <th>district</th>
                      <th>tehsil</th>
                      <th>union council</th>
                      <th>CNIC</th>
                      <th>Joining date</th>
                      <th>PEO</th>
                      <th>AC</th>
                      <th>evaluation date</th>
                      <th>status</th>
                    </tr>
                  </thead>
                  <tbody id="filter_results">
                    <?php foreach($recent_tcsp as $rec_evals): ?>
                    <?php $rollback_comment = $this->Performance_appraisal_model->get_tcsp_by_id($rec_evals->evalu_id); ?>
                    <tr>
                      <td>
                        <a href="<?php if($rec_evals->status == 3 AND $peo_session){ echo base_url("performance_evaluation/tcsp_evaluation/{$rec_evals->employee_id}"); } ?>">CTC-0<?php echo $rec_evals->employee_id; ?></a>
                      </td>
                      <td>
                        <a href="#" data-toggle="modal" data-target="#evaluationDetail<?= $rec_evals->evalu_id; ?>">
                          <?php echo $rec_evals->name; ?>
                        </a>
                        <div class="modal fade" id="evaluationDetail<?= $rec_evals->evalu_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <!--Header-->
                              <div class="modal-header">
                                <h4 style="display: inline-block;" class="modal-title" id="myModalLabel">Evaluation Form made for <strong><?php echo $rec_evals->name; ?></strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                                </button>
                              </div>
                              <!--Body-->
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-7">
                                    <strong>PTPP holder's Technical Skills</strong><hr>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <strong>Questions provided.</strong>
                                      </div>
                                      <div class="col-md-2">
                                        <strong>Remarks</strong>
                                      </div>
                                    </div><br>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>1. UC/Area level Micro-plans development and desk revision</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_one == 3){ echo 'Best'; }elseif($rec_evals->que_one == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>2. UC / Area level Micro-plans field validation</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_two == 3){ echo 'Best'; }elseif($rec_evals->que_two == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>3. Status of selection of the house to house vaccination teams</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_three == 3){ echo 'Best'; }elseif($rec_evals->que_three == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>4. % of teams training attended</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_four == 3){ echo 'Best'; }elseif($rec_evals->que_four == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>5. Training of the UC supervisors (Area In-charges)</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_five == 3){ echo 'Best'; }elseif($rec_evals->que_five == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>6. Pre campaign data collection, collation and timely transmission to the next level % timeliness and % completeness</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_six == 3){ echo 'Best'; }elseif($rec_evals->que_six == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>7. Data collection, collation and timely transmission to the next level during the campaign % timeliness and % completeness</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_seven == 3){ echo 'Best'; }elseif($rec_evals->que_seven == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>8. Corrective measures following the identification of the gaps. Number of critical situations handled</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_eight == 3){ echo 'Best'; }elseif($rec_evals->que_eight == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>9. Ensure data collection from the field with more than 95% Post Campaign coverages through extensive monitoring in the field by doing LQAS & Market Surveys</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_nine == 3){ echo 'Best'; }elseif($rec_evals->que_nine == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-10">
                                        <small>10. To establish the community AFP Surveillance in his area of assignment through regular health facility visits and ensure that the zero reports are timely been submitted</small>
                                      </div>
                                      <div class="col-md-2">
                                        <?php if($rec_evals->que_ten == 3){ echo 'Best'; }elseif($rec_evals->que_ten == 2){ echo 'Fair'; }else{ echo 'Bad'; } ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-5">
                                    <strong>PTPP holder's Attributes</strong><hr>
                                    <div class="row">
                                      <div class="col-md-8">
                                        <strong>Attributes provided</strong>
                                      </div>
                                      <div class="col-md-4">
                                        <strong>Remarks</strong>
                                      </div>
                                    </div><br>
                                    <div class="row">
                                      <div class="col-md-8">
                                        <small>Reliability</small>
                                      </div>
                                      <div class="col-md-4">
                                        <?php if($rec_evals->attrib_1 == '3'){ echo 'Satisfactory'; }elseif($rec_evals->attrib_1 == '2'){ echo 'Needs Improvement'; }else{ echo 'Unsatisfactory'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-8">
                                        <small>Work independently with minimal supervision</small>
                                      </div>
                                      <div class="col-md-4">
                                        <?php if($rec_evals->attrib_2 == '3'){ echo 'Satisfactory'; }elseif($rec_evals->attrib_2 == '2'){ echo 'Needs Improvement'; }else{ echo 'Unsatisfactory'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-8">
                                        <small>Punctuality</small>
                                      </div>
                                      <div class="col-md-4">
                                        <?php if($rec_evals->attrib_3 == '3'){ echo 'Satisfactory'; }elseif($rec_evals->attrib_3 == '2'){ echo 'Needs Improvement'; }else{ echo 'Unsatisfactory'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-8">
                                        <small>Initiative</small>
                                      </div>
                                      <div class="col-md-4">
                                        <?php if($rec_evals->attrib_4 == '3'){ echo 'Satisfactory'; }elseif($rec_evals->attrib_4 == '2'){ echo 'Needs Improvement'; }else{ echo 'Unsatisfactory'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-8">
                                        <small>Good team player</small>
                                      </div>
                                      <div class="col-md-4">
                                        <?php if($rec_evals->attrib_5 == '3'){ echo 'Satisfactory'; }elseif($rec_evals->attrib_5 == '2'){ echo 'Needs Improvement'; }else{ echo 'Unsatisfactory'; } ?>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-8">
                                        <small>Familiarity with WHO required procedures</small>
                                      </div>
                                      <div class="col-md-4">
                                        <?php if($rec_evals->attrib_6 == '3'){ echo 'Satisfactory'; }elseif($rec_evals->attrib_6 == '2'){ echo 'Needs Improvement'; }else{ echo 'Unsatisfactory'; } ?>
                                      </div>
                                    </div>
                                  </div>
                                </div><hr>
                                <div class="row">
                                  <div class="col-md-12">
                                    <h3>Others</h3>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-6">
                                    <strong>Exceptional Accomplishment</strong>
                                    <p><?php echo $rec_evals->comment_1; ?></p>
                                    <strong>Overall Assessment</strong>
                                    <p><?php echo $rec_evals->comment_2; ?></p>
                                  </div>
                                  <div class="col-md-6 text-right">
                                    <strong>Supervisor's Detail</strong><br><br>
                                    <strong>Name: </strong><?= $rec_evals->signature; ?><br>
                                    <strong>Title: </strong> Polio Eradication Officer <br>
                                    <strong>Signature: </strong><?= $rec_evals->signature; ?><br>
                                    <strong>Date: </strong><?= date('M d, Y', strtotime($rec_evals->created_at)); ?>
                                  </div>
                                </div><hr>
                                <div class="row">
                                  <div class="col-md-6">
                                    <?php if(!empty($recent_tcsp = $this->Performance_appraisal_model->get_tcsp_remarks($rec_evals->employee_id))): ?>
                                    <strong>APW Remarks</strong><br><br>
                                    <?= $recent_tcsp->remarks; ?><br>
                                    <strong>Comment: </strong><?= $recent_tcsp->comment; ?>
                                  </div>
                                  <div class="col-md-6 text-right">
                                    <strong>APW Holder's Detail</strong><br><br>
                                    <strong>Name: </strong><?= $recent_tcsp->signature; ?><br>
                                    <strong>Signature: </strong><?= $recent_tcsp->signature; ?><br>
                                    <strong>Date: </strong><?= date('M d, Y', strtotime($recent_tcsp->created_at)); else:  ?>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="alert alert-danger">
                                      <p class="text-center"><strong>Oops! </strong>
                                        APW Holder haven't evaluated the employee "<strong><?= $rec_evals->name; ?></strong>" yet.
                                      </p>
                                    </div>
                                  <?php endif; ?>
                                  </div>
                                </div><hr>
                                <div class="row">
                                  <div class="col-md-6">
                                    <?php if(!empty($recent_sec_level = $this->Performance_appraisal_model->get_sec_level_tcsp($rec_evals->employee_id))): ?>
                                    <strong>Remarks by Second Level Supervisor</strong><br><br>
                                    <?= $recent_sec_level->assessment_result; ?>
                                    <?php if($recent_sec_level->assessment_result == 'Satisfactory'): ?> - Contract recommended for extension.
                                    <?php elseif($recent_sec_level->assessment_result == 'Unsatisfactory'): ?> - Contract to be terminated.
                                    <?php elseif($recent_sec_level->assessment_result == 'Needs Improvement'): ?> - Contract to be re-evaluated after 3 months.
                                    <?php elseif($recent_sec_level->assessment_result == 'Work performed inadequately'): ?> - PTPP holder to be issued a warning/advice. <?php endif; ?>
                                  </div>
                                  <div class="col-md-6 text-right">
                                    <strong>Second level supervisor detail</strong><br><br>
                                    <strong>Name: </strong><?= $recent_sec_level->signature; ?><br>
                                    <strong>Title: </strong>Area Coordinator<br>
                                    <strong>Signature: </strong> <?= $recent_sec_level->signature; ?><br>
                                    <strong>Date: </strong><?= date('M d, Y', strtotime($recent_sec_level->created_at)).'<br><br>'; else: ?>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="alert alert-danger">
                                      <p class="text-center"><strong>Oops! </strong>
                                        Second level supervisor haven't evaluated the employee "<strong><?= $rec_evals->name; ?></strong>" yet.
                                      </p>
                                    </div>
                                  </div>
                                <?php endif; ?>
                                </div><br>
                              </div>
                              <!--Footer-->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php echo $rec_evals->position; ?>
                      </td>
                      <td>
                        <?php echo $rec_evals->province; ?>
                      </td>
                      <td>
                        <?php echo $rec_evals->district; ?>
                      </td>
                      <td>
                        <?php echo $rec_evals->tehsil; ?>
                      </td>
                      <td>
                        <?php echo $rec_evals->uc; ?>
                      </td>
                      <td>
                        <?php echo $rec_evals->cnic_name; ?>
                      </td>
                      <td>
                        <?php echo date('M d, Y', strtotime($rec_evals->join_date)); ?>
                      </td>
                      <td>
                        <?php echo $rec_evals->peo_name; ?>
                      </td>
                      <td>
                        <?php echo $rec_evals->ac_name; ?>
                      </td>
                      <td>
                        <?php echo date('M d, Y', strtotime($rec_evals->created_at)); ?>
                      </td>
                      <td>
                        <?php if($rec_evals->status == 0){ ?>
                          <div class="label label-primary">TCSP pending</div>
                        <?php }elseif($rec_evals->status == 1){ ?>
                          <div class="label label-primary">AC pending</div>
                        <?php }elseif($rec_evals->status == 2){ ?>
                          <div class="label label-success">Completed</div>
                       <?php }else{ ?>
                          <a href="#" data-toggle="modal" data-target="#commentModal<?php echo $rec_evals->evalu_id; ?>">
                            <div class="label label-danger">Rolled Back</div>
                          </a>
                          <div id="commentModal<?php echo $rec_evals->evalu_id; ?>" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                  <strong>Roll Back comment...</strong>
                                  <p><?php echo $rollback_comment->rollback_comment; ?></p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8 text-center">
            <?php echo $this->pagination->create_links(); ?>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </section>
  </section>
</div>

