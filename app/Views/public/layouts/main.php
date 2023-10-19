<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Nomor Singaraja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="<?php echo base_url()?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo base_url()?>adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url()?>adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url()?>adminlte/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url()?>adminlte/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?php echo base_url()?>adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url()?>adminlte/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url()?>adminlte/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="<?php echo base_url() ?>adminlte/plugins/fontawesome-free/css/all.min.css">

<link rel="stylesheet" href="<?php echo base_url() ?>adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url() ?>adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<link rel="stylesheet" href="<?php echo base_url() ?>adminlte/dist/css/adminlte.min.css?v=3.2.0">
<script nonce="2e636a55-dcda-4b1e-ae49-d89e64644cb6">(function(w,d){!function(t,u,v,w){t[v]=t[v]||{};t[v].executed=[];t.zaraz={deferred:[],listeners:[]};t.zaraz.q=[];t.zaraz._f=function(x){return async function(){var y=Array.prototype.slice.call(arguments);t.zaraz.q.push({m:x,a:y})}};for(const z of["track","set","debug"])t.zaraz[z]=t.zaraz._f(z);t.zaraz.init=()=>{var A=u.getElementsByTagName(w)[0],B=u.createElement(w),C=u.getElementsByTagName("title")[0];C&&(t[v].t=u.getElementsByTagName("title")[0].text);t[v].x=Math.random();t[v].w=t.screen.width;t[v].h=t.screen.height;t[v].j=t.innerHeight;t[v].e=t.innerWidth;t[v].l=t.location.href;t[v].r=u.referrer;t[v].k=t.screen.colorDepth;t[v].n=u.characterSet;t[v].o=(new Date).getTimezoneOffset();if(t.dataLayer)for(const G of Object.entries(Object.entries(dataLayer).reduce(((H,I)=>({...H[1],...I[1]})),{})))zaraz.set(G[0],G[1],{scope:"page"});t[v].q=[];for(;t.zaraz.q.length;){const J=t.zaraz.q.shift();t[v].q.push(J)}B.defer=!0;for(const K of[localStorage,sessionStorage])Object.keys(K||{}).filter((M=>M.startsWith("_zaraz_"))).forEach((L=>{try{t[v]["z_"+L.slice(7)]=JSON.parse(K.getItem(L))}catch{t[v]["z_"+L.slice(7)]=K.getItem(L)}}));B.referrerPolicy="origin";B.src="/cdn-cgi/zaraz/s.js?z="+btoa(encodeURIComponent(JSON.stringify(t[v])));A.parentNode.insertBefore(B,A)};["complete","interactive"].includes(u.readyState)?zaraz.init():t.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,"zarazData","script");})(window,document);</script>

</head>

<body class="sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <?= $this->include('public/layouts/navbar'); ?>
        <?= $this->include('public/layouts/sidebar'); ?>
        <!-- Main content -->
        <section class="content">
            <?= $this->renderSection('content'); ?>
        </section>
        <?= $this->include('public/layouts/footer'); ?>
    </div>
    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script src="<?php echo base_url()?>adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url()?>adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url()?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url()?>adminlte/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url()?>adminlte/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url()?>adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url()?>adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url()?>adminlte/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url()?>adminlte/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url()?>adminlte/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo base_url()?>adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="<?php echo base_url()?>adminlte/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url()?>adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>


    <script src="<?php echo base_url() ?>adminlte/plugins/jquery/jquery.min.js"></script>

<script src="<?php echo base_url() ?>adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url() ?>adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>/
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url() ?>adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="<?php echo base_url() ?>adminlte/dist/js/adminlte.min.js?v=3.2.0"></script>

<script src="<?php echo base_url() ?>adminlte/dist/js/demo.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>

</html>