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
            <div class="col" style="padding-bottom: 50px;">
                <div class="d-flex flex-row justify-content-center">
                    <div class="card-deck">
                        <?php foreach ($generates as $generate):  ?>
                        <div class="card">
                            <img src="gambar4.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><b>Perihal Surat :</b> <?= $generate['perihal']; ?></h5>
                                <br>
                                <h5 class="card-title"><b>Kode Surat :</b> <?= $generate['nomor']; ?></h5>
                                <br>
                                <p class="card-text"><b>User yang menggenerate : </b><?= $user['name']; ?></p>
                                <p class="card-text"><small
                                        class="text-muted"><?= (new \CodeIgniter\I18n\Time($generate['tanggal']))->humanize(); ?></small>
                                </p>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>



<script>
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