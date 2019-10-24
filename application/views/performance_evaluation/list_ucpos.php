<section class="secMainWidthFilter" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable margint-top-0">
    <section class="secIndexTable">
      <div class="col-lg-12">
        <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-8">
            <div class="tabelHeading">
              <h3>
                <?php if(empty($search_results)): ?>
                  list of UCPOs | <a href="javascript:history.go(-1);" class="btn btn-primary btn-xs">
                    <i class="fa fa-angle-double-left"></i> Back</a>
                    <a href="<?php echo base_url('export_excel/ucpos_report'); ?>" class="btn btn-success btn-xs">Export Excel</a>
                <?php elseif(!empty($search_results)): ?>
                  search results | <a href="javascript:history.go(-1);" class="btn btn-primary btn-xs">
                    <i class="fa fa-angle-double-left"></i> Back</a>
                <?php endif; ?>
              </h3>
            </div>
          </div>
          <div class="col-md-4">
            <form action="<?php echo base_url('admin_dashboard/search_ucpos'); ?>" method="get" style="margin-top: 14px; padding-right: 12px;">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by PEO / AC name" autocomplete="off" required="" name="search_record">
                  <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
              </div>
            </form>
          </div>
        </div>
        <?php if($success = $this->session->flashdata('success')): ?>
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="alert alert-success text-center">
                <?php echo $success; ?>
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
                      <th>name of UCPO</th>
                      <th>UCPO CNIC</th>
                      <th>province</th>
                      <th>name of PEO</th>
                      <th>PEO CNIC</th>
                      <th>name of AC</th>
                      <th>AC CNIC</th>
                      <th>status | Actions</th>
                    </tr>
                  </thead>
                  <?php if(empty($search_results)): ?>
                  <tbody>
                    <?php if(!empty($pending_ucpos)): foreach ($pending_ucpos as $pending): ?>
                      <tr>
                        <td><?php echo $pending->name; ?></td>
                        <td><?php echo $pending->cnic_name; ?></td>
                        <td><?php echo $pending->province; ?></td>
                        <td><?php echo $pending->peo_name; ?></td>
                        <td><?php echo $pending->cnic_peo; ?></td>
                        <td><?php echo $pending->ac_name; ?></td>
                        <td><?php echo $pending->cnic_ac; ?></td>
                        <td>
                          <button class="btn btn-info btn-xs">Pending...</button>
                          <a href="<?php echo base_url(); ?>admin_dashboard/edit_ucpo/<?php echo $pending->id; ?>" class="btn btn-primary btn-xs">Edit</a>
                          <a href="<?php echo base_url(); ?>admin_dashboard/delete_ucpo/<?php echo $pending->id; ?>" class="btn btn-danger btn-xs" onclick="javascript:return confirm('Are you sure to delete ?');">Delete</a>
                        </td>
                      </tr>
                    <?php endforeach; endif; ?>
                  </tbody>
                  <?php elseif(!empty($search_results)): ?>
                    <tbody>
                    <?php foreach ($search_results as $result): ?>
                      <tr>
                        <td><?php echo $result->name; ?></td>
                        <td><?php echo $result->cnic_name; ?></td>
                        <td><?php echo $result->province; ?></td>
                        <td><?php echo $result->peo_name; ?></td>
                        <td><?php echo $result->cnic_peo; ?></td>
                        <td><?php echo $result->ac_name; ?></td>
                        <td><?php echo $result->cnic_ac;
                         ?></td>
                        <td>
                           <button class="btn btn-info btn-xs">Pending...</button>
                          <a href="<?php echo base_url(); ?>admin_dashboard/edit_ucpo/<?php echo $result->id; ?>" class="btn btn-primary btn-xs">Edit</a>
                          <a href="<?php echo base_url(); ?>admin_dashboard/delete_ucpo/<?php echo $result->id; ?>" class="btn btn-danger btn-xs" onclick="javascript:return confirm('Are you sure to delete ?');">Delete</a>
                        </td>
                      </tr>
                    <?php endforeach; endif; ?>
                    <?php if(empty($search_results) AND empty($pending_ucpos)): ?>
                    <div class="alert alert-danger text-center col-md-10 col-md-offset-1">
                      <strong>Aww snap! </strong> We couldn't find what you need right now!
                    </div>
                  <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10 text-center">
            <?php if(empty($search_results) AND !empty($pending_ucpos)){ echo $this->pagination->create_links(); }?>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
      </div>
    </section>
  </section>
</section>