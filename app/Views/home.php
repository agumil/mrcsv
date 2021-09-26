<?php $this->extend('layout/master'); ?>

<?php $this->section('title'); ?>
<title>Home | CSV Extractor</title>
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>
<div class="container">
    <div class="d-flex justify-content-around h-100">
        <div class="row">
          <div class="card special-card col">
            <?php if (isset($_SESSION['notif'])): ?>
            <div class="alert alert-warning alert-dismissible fade show mt-2 mb-2" role="alert">
                <strong>Validasi error !</strong> <?php echo $_SESSION['notif']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php endif ?>
            <img src="<?php echo base_url('assets/images/upload.png'); ?>" class="img-fluid mx-auto mt-4" style="max-width: 20%; max-height: 20%;" alt="Responsive image">
              <div class="card-body">
                <form action="<?php echo site_url('file/upload'); ?>" method="post" enctype="multipart/form-data">
              <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFileInput" name="file-upload" aria-describedby="customFileInput">
                    <label class="custom-file-label" for="customFileInput">Select file</label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="customFileInput">Upload</button>
                </div>
              </div>
              </form>
              <small id="customFileInput" class="form-text text-muted">Hanya support format (.csv) dengan ukuran maksimal 5 MB.</small>
              </div>
          </div>
        </div>
    </div>
</div>
<?php $this->endSection(); ?>

<?php $this->section('body-scripts'); ?>
  <script>
    document.querySelector('.custom-file-input').addEventListener('change', function (e) {
      var name = document.getElementById("customFileInput").files[0].name;
      var nextSibling = e.target.nextElementSibling
      nextSibling.innerText = name
    })
  </script>
<?php $this->endSection(); ?>
