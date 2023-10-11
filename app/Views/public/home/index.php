<?= $this->extend('admin/layouts/main'); ?>

<?= $this->section('content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header " style="padding-bottom: 40px; padding-top: 30px;" >
        <div class="container-fluid ">
        <div class="col">
        <div class="card" style="width: 60%; height: 75%; background: #0BDBB6; border-radius: 27px; margin: 0 auto; ">
        
                        <div class="card-header border-0" style="color: white;" >
                            <h3 class="card-title font-weight-bold">
                                <i class="fas fa-file mr-1"></i>
                                Generate Surat
                            </h3>
                            
                        </div>

                        <div style="margin: 0 auto; padding-bottom: 20px; " >
                        <i style="font-size: 5em; color: white;  " class="fas fa-file-pdf"> </i>
                      
                    </div>
                    <div style="margin: 0 auto; padding-bottom: 20px;" >

                    <input class="form-control" id="formFileLg" type="file" />

                </div>        
                
                    </div>
                    </div>
      
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <section class="content">
        <div  style="width: 100%; background: #0BDBB6; padding-top: 10px; padding-bottom: 10px; ">
        
        <div class="row">
<div class="col-md-8 offset-md-2">
<form action="simple-results.html">
<div class="input-group">
<input type="search" class="form-control form-control-lg" placeholder="Type your keywords here">
<div class="input-group-append">
<button type="submit" class="btn btn-lg btn-default">
<i class="fa fa-search"></i>
</button>
</div>
</div>
</form>
</div>
</div>   
                
                    </div>
        </section>
    </div>

    <div class="container-fluid" style="padding-top: 50px;" >
        <section class="content" >
        <div class="d-flex flex-row justify-content-center"  >

        <div class="card-deck">
  <div class="card">
    <img src="gambar4.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Belajar Bootstrap 4</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
    </div>
  </div>
  <div class="card">
    <img src="gambar4.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Belajar Bootstrap 4</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
    </div>
  </div>
  <div class="card">
    <img src="gambar4.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Belajar Bootstrap 4</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Diposting 2 Menit Lalu</small></p>
    </div>
  </div>
</div>

        </section>
    </div>


    <?= $this->endSection('content'); ?>