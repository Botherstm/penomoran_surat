<?=$this->extend('admin/layouts/main');?>

<?=$this->section('content');?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title" style="font-weight: bold;">Buat Dinas</h3>
                </div>
                <div class="card-body">
                    <form action="<?=base_url('admin/dinas/save')?>" method="POST">
                        <?=csrf_field();?>

                        <?php if (session('errors')): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session('errors') as $error): ?>
                                <li><?=esc($error)?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <?php endif;?>

                        <div class="form-group">
                            <label for="name" class="form-label input-group justify-content-center">Nama Dinas</label>
                            <input type="text" class="form-control" required name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="kode" class="form-label input-group justify-content-center">Kode Dinas</label>
                            <input type="text" name="kode" required class="form-control" id="kode">
                        </div>
                        <div class="form-group">
                            <label for="urutan" class="form-label input-group justify-content-center">Urutan Surat
                                Sebelumnya</label>
                            <input type="number" name="urutan" required class="form-control" id="urutan">
                        </div>

                        <div class="row text-center" style="padding-bottom: 50px;">
                            <div class="col-md-6">
                                <a href="<?=base_url('admin/dinas');?>">
                                    <button class="btn btn-danger" type="button" style="width: 150px;"
                                        data-dismiss="modal">Batal</button>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success" style="width: 150px;">Tambah data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection('content');?>