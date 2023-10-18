<?= $this->extend('public/layouts/main'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!--  -->
    <div>
        <section class="content">
            <div style="width: 100%; background: #048C7F; padding-top: 10px; padding-bottom: 10px; ">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="simple-results.html">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" id="searchInput" class="form-control float-right"
                                    placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" id="searchButton" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <div class="container-fluid" style="padding-top: 50px; padding-bottom: 50px;">
        <section class="content">
            <div class="row">
                <?php foreach ($generates as $key => $generate): ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card" style="margin-bottom: 20px;">
                        <div class="card-body">
                            <a href="<?php echo base_url('public/riwayat/detail/')?><?= $generate['slug']; ?>"
                                class="text-dark text-decoration-none" style="text-decoration:none; ">
                                <h5 class="card-title">

                                    <b class="">Perihal Surat:</b>

                                    <?= $generate['perihal']; ?>

                                </h5>
                                <br>
                                <h5 class="card-title"><b>Kode Surat :</b> <?= $generate['nomor']; ?></h5>
                                <br>
                                <h5 class="card-title"><b>Tanggal Surat :</b>
                                    <?= date('d F Y', strtotime($generate['tanggal'])); ?></h5>
                                <br>
                                <p class="card-text"><b>User yang menggenerate : </b><?= $user['name']; ?></p>
                                <br>
                            </a>
                            <a target="_blank" href="<?= base_url('pdf/'); ?><?= $generate['pdf']; ?>">
                                <button class="btn btn-dark">Download PDF</button>
                            </a>
                            <p class="card-text"><small
                                    class="text-muted"><?= (new \CodeIgniter\I18n\Time($generate['created_at']))->humanize(); ?></small>
                            </p>

                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </section>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>


<script>
<?php if (session()->getFlashdata('success')) : ?>
Swal.fire({
    title: 'Success',
    text: '<?= session()->getFlashdata('success') ?>',
    icon: 'success',
    timer: 3000,
    showConfirmButton: false
});
<?php endif; ?>

function performSearch() {
    var searchText = document.getElementById('searchInput').value.toLowerCase();
    var cardDeck = document.getElementById('cardDeck');
    var cards = cardDeck.getElementsByClassName('card');

    for (var i = 0; i < cards.length; i++) {
        var card = cards[i];
        var cardText = card.innerText.toLowerCase();
        if (cardText.includes(searchText)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    }
}

document.getElementById('searchButton').addEventListener('click', performSearch);

document.getElementById('searchInput').addEventListener('input', performSearch);
</script>

<?= $this->endSection('content'); ?>