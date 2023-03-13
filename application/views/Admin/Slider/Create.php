<?php $this->load->view('Admin/Header'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Slider</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo base_url() . 'Admin/Slider/index'; ?>">Slider</a>
                    </li>
                    <li class="breadcrumb-item active">Add new slider</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            Add New Slider
                        </div>
                    </div>
                    <form name="categoryForm" id="categoryForm" method="post" action="<?php echo base_url() . 'Admin/Slider/create' ?>" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Slider Name</label>
                                <input type="text" name="name" id="name" value="" class="form-control <?php echo (form_error('name') != "") ? 'is-invalid' : '' ?>">
                                <?php echo form_error('name') ?>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Slider Image</label><br>
                                <input type="file" class="form-control" name="image" id="image" class=" <?php echo (!empty($errorImageUpload)) ? 'is-invalid' : '' ?>">
                                <?php echo (!empty($errorImageUpload)) ? $errorImageUpload : '' ?>
                            </div>
                            <div class="custom-control custom-radio float-left">
                                <input class="custom-control-input" value="1" type="radio" id="statusActive" name="status" checked="">
                                <label for="statusActive" class="custom-control-label">Active</label>
                            </div>
                            <div class="custom-control custom-radio float-left ml-3">
                                <input class="custom-control-input" value="0" type="radio" id="statusBlock" name="status">
                                <label for="statusBlock" class="custom-control-label">Block</label>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <a class="btn btn-secondary" href="<?php echo base_url() . 'Admin/Slider/index' ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('Admin/Footer'); ?>