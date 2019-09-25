<?php $rolnumberFormat = 'CTC-ORG-PK'; ?>
<section class="secMainWidthFilter" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable margint-top-0">
    <section class="secIndexTable">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-8">
            <div class="tabelHeading">
              <h3>summary dashboard</h3>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tabelTopBtn">
              <div class="input-group-btn">
                <a data-toggle="tooltip" title="Go Back" data-placement="left" class="btn btn-defaul" href="javascript:history.go(-1);"><i class="fa fa-arrow-left"></i></a>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="tableMain">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Total Number of UCPO's</th>
                      <th>Pending UCPO's</th>
                      <th>total number of TCSP's</th>
                      <th>pending TCSP's</th>
                      <th>UCPO's pending for AC</th>
                      <th>TCSP's pending for AC</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $count_ucpos = $this->Performance_appraisal_model->all_ucpos(); ?>
                    <?php $count_ucpos_pending = $this->Performance_appraisal_model->count_ucpos_pending(); ?>
                    <?php $count_tcsps = $this->Performance_appraisal_model->count_tcsps_pending(); ?>
                    <?php $count_tcsps_pending = $this->Performance_appraisal_model->all_tcsps(); ?>
                    <?php $count_ac_ucpos = $this->Performance_appraisal_model->count_ac_ucpos_pending(); ?>
                    <?php $count_ac_tcsps = $this->Performance_appraisal_model->count_ac_tcsps_pending(); ?>
                    <tr>
                      <td><?php echo $count_ucpos; ?></td>
                      <td><?php echo $count_ucpos_pending; ?></td>
                      <td><?php echo $count_tcsps; ?></td>
                      <td><?php echo $count_tcsps_pending; ?></td>
                      <td><?php echo $count_ac_ucpos; ?></td>
                      <td><?php echo $count_ac_tcsps; ?></td>
                    </tr>
                  <?php //endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
  </section>
</section>