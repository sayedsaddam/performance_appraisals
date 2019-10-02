<?php 
/*
* Filename: add_tcsps.php
* Author: Saddam
*/
?>
<style type="text/css">
  .para p{
    padding-top: 12px;
    color: #ff8d00;
  }
  .para{
    background: #d6dad282;
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
          <h3>Add TCSP's | Assign PEO's and AC's</h3>
          <?php if($success = $this->session->flashdata('success')): ?>
            <div class="alert alert-success text-center">
              <?php echo $success; ?>
            </div>
          <?php endif; ?>
          <form action="<?php echo base_url('appraisals/save_competence'); ?>" method="post">
            <input type="hidden" name="position" value="tcsp">
            <div class="row">
              <div class="col-lg-12">
                <table class="table table-responsive">
                  <tbody>
                    <tr>
                      <td>
                        <label>TCSP Name</label>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md-offset-3">
                            <input type="text" name="tcsp_name" class="form-control" placeholder="tcsp name here...">
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>TCSP CNIC</label>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md-offset-3">
                            <input type="text" name="tcsp_cnic" class="form-control" placeholder="tcsp cnic here...">
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>Province</label>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md-offset-3">
                            <select name="tcsp_prov" class="form-control select2">
                              <option value="">Select Province...</option>
                              <option value="KP">KP</option>
                              <option value="KP-TD">KP-TD</option>
                              <option value="AJK">AJK</option>
                              <option value="Islamabad">Islamabad</option>
                              <option value="Punjab">Punjab</option>
                              <option value="Balochistan">Balochistan</option>
                              <option value="Sindh">Sindh</option>
                              <option value="Gilgit Baltistan">GBaltistan</option>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>District</label>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md-offset-3">
                            <input type="text" name="tcsp_distt" class="form-control" placeholder="tcsp district here...">
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>Tehsil</label>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md-offset-3">
                            <input type="text" name="tcsp_tehsil" class="form-control" placeholder="tcsp tehsil here...">
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>UC</label>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md-offset-3">
                            <input type="text" name="tcsp_uc" class="form-control" placeholder="tcsp cnic here...">
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>Assign PEO</label>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md-offset-3">
                            <select name="tcsp_peo" class="form-control select2">
                              <option value="">Select PEO...</option>
                              <?php foreach ($peos as $peo): ?>
                                <option value="<?php echo $peo->peo_cnic; ?>"><?php echo $peo->peo_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <label>Assign AC</label>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-md-offset-3">
                            <select name="tcsp_ac" class="form-control select2">
                              <option value="">Select AC...</option>
                               <?php foreach ($acs as $ac): ?>
                                <option value="<?php echo $ac->ac_cnic; ?>"><?php echo $ac->ac_name; ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 text-right">
                <a href="javascript:history.go(-1);" class="btn btn-default">Back</a>
                <button type="submit" class="btn btn-default">Next</button>
              </div>
            </div>
          </form>
        </div>
      </div>  
    </div>
  </section>
</section>