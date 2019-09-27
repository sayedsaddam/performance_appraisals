<?php $count_ucpos = $this->Performance_appraisal_model->all_ucpos(); ?>
 <?php $count_ucpos_pending = $this->Performance_appraisal_model->count_ucpos_pending(); ?>
<?php $count_tcsps = $this->Performance_appraisal_model->count_tcsps_pending(); ?>
<?php $count_tcsps_pending = $this->Performance_appraisal_model->all_tcsps(); ?>
<?php $count_ac_ucpos = $this->Performance_appraisal_model->count_ac_ucpos_pending(); ?>
<?php $count_ac_tcsps = $this->Performance_appraisal_model->count_ac_tcsps_pending(); ?>
<?php $completed_ucpos = $this->Performance_appraisal_model->completed_ucpos(); ?>
<?php $completed_tcsps = $this->Performance_appraisal_model->completed_tcsps(); ?>
<?php $pen_from_ucpos = $this->Performance_appraisal_model->count_pending_from_ucpos(); ?>
<?php $pen_from_tcsps = $this->Performance_appraisal_model->count_pending_from_tcsps(); ?>
<section class="secMainWidthFilter" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable margint-top-0">
    <section class="secIndexTable">
      <div class="col-lg-6">
        <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-8">
            <div class="tabelHeading">
              <h3>statistics for UCPO's</h3>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tabelTopBtn">
              <div class="input-group-btn">
                <a class="btn btn-defaul" href="javascript:void(0);"><<< <i class="fa fa-refresh"></i> >>></a>
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
                      <th>Total no. of UCPO's</th>
                      <th>pending from UCPO</th>
                      <th>Pending from PEO</th>
                      <th>pending from AC</th>
                      <th>Completed</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $count_ucpos; ?></td>
                      <td><?php echo $pen_from_ucpos; ?></td>
                      <td><?php echo $count_ucpos_pending; ?></td>
                      <td><?php echo $count_ac_ucpos; ?></td>
                      <td><?php echo $completed_ucpos; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-lg-6">
        <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-8">
            <div class="tabelHeading">
              <h3>statistics for TCSP's</h3>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tabelTopBtn">
              <div class="input-group-btn">
                <a class="btn btn-defaul" href="javascript:void(0);"><<< <i class="fa fa-refresh"></i> >>></a>
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
                      <th>total no. of TCSP's</th>
                      <th>pending from TCSP</th>
                      <th>pending TCSP's</th>
                      <th>pending from AC</th>
                      <th>completed</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $count_tcsps; ?></td>
                      <td><?php echo $pen_from_tcsps; ?></td>
                      <td><?php echo $count_tcsps_pending; ?></td>
                      <td><?php echo $count_ac_tcsps; ?></td>
                      <td><?php echo $completed_tcsps; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-lg-6">
        <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-8">
            <div class="tabelHeading">
              <h3>UCPO's pending from PEO</h3>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tabelTopBtn">
              <div class="input-group-btn">
                <a class="btn btn-defaul" href="<?= base_url('admin_dashboard/all_ucpos'); ?>">view all</a>
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
                      <th>UCPO name</th>
                      <th>PEO name</th>
                      <th>AC name</th>
                      <th>status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($pen_ucpos as $pending): ?>
                      <tr>
                        <td><?php echo $pending->name; ?></td>
                        <td><?php echo $pending->peo_name; ?></td>
                        <td><?php echo $pending->ac_name; ?></td>
                        <td><div class="label label-info">Pending...</div></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-lg-6">
        <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-8">
            <div class="tabelHeading">
              <h3>TCSP's pending from PEO</h3>
            </div>
          </div>
          <div class="col-md-4">
            <div class="tabelTopBtn">
              <div class="input-group-btn">
                <a class="btn btn-defaul" href="<?= base_url('admin_dashboard/all_tcsps'); ?>">view all</a>
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
                      <th>TCSP name</th>
                      <th>PEO name</th>
                      <th>AC name</th>
                      <th>status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($pen_tcsps as $pending): ?>
                      <tr>
                        <td><?php echo $pending->name; ?></td>
                        <td><?php echo $pending->peo_name; ?></td>
                        <td><?php echo $pending->ac_name; ?></td>
                        <td><div class="label label-info">Pending...</div></td>
                      </tr>
                    <?php endforeach; ?>
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