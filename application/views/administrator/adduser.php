  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/dashboard">Home</a></li>
              <li class="breadcrumb-item active">User Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            
            <div class="card-body">
            
            <div class="row">
             <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Cover Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="cover_image" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
              </div>
              
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Portfolio Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="portfolio_name" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
              </div>
             </div>
             
             <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputClientCompany">User Name</label>
                    <input type="text" id="inputClientCompany" name="username" class="form-control">
                  </div>
               </div>
               
               <div class="col-md-6">
                 <div class="form-group">
                    <label for="inputClientCompany">Display Name</label>
                    <input type="text" id="inputClientCompany" name="display_name" class="form-control">
                  </div>
               </div>
             </div>
             
             <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputClientCompany">Password</label>
                    <input type="text" id="inputClientCompany" name="password" class="form-control">
                  </div>
               </div>
               
               <div class="col-md-6">
                 <div class="form-group">
                    <label for="inputClientCompany">Confirm Password</label>
                    <input type="text" id="inputClientCompany" name="confirm" class="form-control">
                  </div>
               </div>
             </div>
             
             <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputClientCompany">Email</label>
                    <input type="text" id="inputClientCompany" name="email" class="form-control">
                  </div>
               </div>
               
               <div class="col-md-6">
                 <div class="form-group">
                    <label for="inputClientCompany">Phone</label>
                    <input type="text" id="inputClientCompany" name="phone" class="form-control">
                  </div>
               </div>
             </div>
             
              <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                    <label for="inputClientCompany">Location</label>
                    <input type="text" id="inputClientCompany" name="location" class="form-control">
                  </div>
               </div>
               
               <div class="col-md-6">
                 <div class="form-group">
                    <label for="inputClientCompany">Website</label>
                    <input type="text" id="inputClientCompany" name="website" class="form-control">
                  </div>
               </div>
             </div>
              
              <div class="form-group">
                <label for="inputStatus">About</label>
                <textarea name="about" class="form-control" ></textarea>
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        
      </div>
      <div class="row">
        <div class="col-12">
          <input type="submit" value="Create new User" class="btn btn-success float-right">&nbsp;
          <input type="button" value="Cancel" class="btn btn-danger">
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
