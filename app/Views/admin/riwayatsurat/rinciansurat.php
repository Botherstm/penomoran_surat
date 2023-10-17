<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper ">
  <!-- Content Header (Page header) -->

  <div class="container-fluid" style="padding-top: 50px;">
    <section class="content">
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-file mr-1"></i>
                File Pdf
              </h3>

            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Morris chart - Sales -->

              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->


          <!-- /.card -->
        </section>


        <section class="col-lg-5 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="fas fa-info"></i>
                Rincian
              </h3>

            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Kategori Surat</p>
                </div>
                <div>
                  <p class="mb-0">:</p>
                </div>
                <div class="col-sm-8">
                  <p class="text-muted mb-0"> 25/09/2023 </p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">No. Surat</p>
                </div>
                <div>
                  <p class="mb-0">:</p>
                </div>
                <div class="col-sm-8">
                  <p class="text-muted mb-0">11/2132/32122/X</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Nama User</p>
                </div>
                <div>
                  <p class="mb-0">:</p>
                </div>
                <div class="col-sm-8">
                  <p class="text-muted mb-0">Jonathan Joestar</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Dinas</p>
                </div>
                <div>
                  <p class="mb-0">:</p>
                </div>
                <div class="col-sm-8">
                  <p class="text-muted mb-0">Kominfosanti</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Bidang</p>
                </div>
                <div>
                  <p class="mb-0">:</p>
                </div>
                <div class="col-sm-8">
                  <p class="text-muted mb-0">Umum</p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">No. Telp</p>
                </div>
                <div>
                  <p class="mb-0">:</p>
                </div>
                <div class="col-sm-8">
                  <p class="text-muted mb-0">0883213093</p>
                </div>
              </div>


            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->


          <!-- /.card -->
        </section>
        <!-- /.Left col -->

        <!-- right col (We are only adding the ID to make the widgets sortable)-->

      </div>
    </section>
  </div>


  <?= $this->endSection('content'); ?>