<section class="secMainWidthFilter" style="padding: 0px;margin-top: -40px;">
  <section class="secIndexTable margint-top-0">
    <section class="secIndexTable">
      <div class="col-lg-6">
        <div class="mainTableWhite">
        <div class="row">
          <div class="col-md-12">
            <div class="tabelHeading">
              <h3>add PEO's | <small>Enter the detail and press the "SAVE" button.</small></h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <?php if($success_peo = $this->session->flashdata('success_peo')): ?>
              <div class="alert alert-success"><?php echo $success_peo; ?></div>
            <?php endif; ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-10">
            <div class="tableMain">
              <div class="table-responsive">
                <form action="<?php echo base_url('admin_dashboard/save_peos'); ?>" method="post">
                  <table class="table table-responsive">
                   <tbody>
                     <tr>
                      <td>
                        <label>Name</label>
                      </td>
                      <td>
                        <input type="text" name="peo_name" class="form-control" placeholder="PEO name..." required>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>CNIC</label>
                      </td>
                      <td>
                        <input type="text" name="peo_cnic" class="form-control" placeholder="PEO cnic..." required="">
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>Password</label>
                      </td>
                      <td>
                        <input type="password" name="peo_pass" class="form-control" placeholder="PEO password..." required="">
                        <small>The default password would be "12345", then the PEO can change it anytime.</small>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Save">
                      </td>
                      <td>
                        <input type="reset" name="reset" class="btn btn-warning btn-block" value="Reset">
                      </td>
                    </tr>
                   </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <div class="col-lg-6">
        <div class="mainTableWhite">
          <div class="row">
            <div class="col-md-12">
              <div class="tabelHeading">
                <h3>add AC's | <small>Enter the detail and press the "SAVE" button.</small></h3>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <?php if($success_ac = $this->session->flashdata('success_ac')): ?>
                <div class="alert alert-success"><?php echo $success_ac; ?></div>
              <?php endif; ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-10">
              <div class="tableMain">
                <div class="table-responsive">
                  <form action="<?php echo base_url('admin_dashboard/save_acs'); ?>" method="post">
                    <table class="table table-responsive">
                      <tbody>
                        <tr>
                          <td>
                            <label>Name</label>
                          </td>
                          <td>
                            <input type="text" name="ac_name" class="form-control" placeholder="AC name..." required="">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label>CNIC</label>
                          </td>
                          <td>
                            <input type="text" name="ac_cnic" class="form-control" placeholder="AC cnic..." required="">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label>Password</label>
                          </td>
                          <td>
                            <input type="password" name="ac_pass" class="form-control" placeholder="AC password..." required="">
                            <small>The default password would be "12345", then the PEO can change it anytime.</small>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Save">
                          </td>
                          <td>
                            <input type="reset" name="reset" class="btn btn-warning btn-block" value="Reset">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
</section>