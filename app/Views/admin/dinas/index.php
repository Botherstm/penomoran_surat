<?= $this->extend('admin/layouts/index'); ?>

<?= $this->section('content'); ?>
<style>
.table-container {
    animation: fadeInUp 1s ease;
}

.table>tbody>tr>* {
    vertical-align: middle;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(50px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<div class="col-sm-6">
    <h1 class="m-0">Data Dinas</h1>
</div>
<div class="table-container">
    <?php if (!empty($dinass)) : ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1 ?>
            <?php foreach ($dinass->data as $dinas) : ?>
            <tr class="text-center">
                <td><?= $i++; ?></td>
                <td><?= $dinas->ket_ukerja ?></td>
                <td>
                    <div class="py-2 px-2">
                        <a href="<?php echo base_url() ?>admin/bidang/<?=  $dinas->id_instansi ?>">
                            <div class="btn btn-dark">Lihat Data Bidang</div>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else : ?>
    <h3>belum ada data</h3>
    <?php endif ?>
</div>

<?= $this->endSection('content'); ?>