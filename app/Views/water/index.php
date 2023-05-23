<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<style>
    
    .watermark {
        background:url("<?= base_url("/uploads/logo.png")?>") 
        center center no-repeat;opacity:0.6;
        opacity: 0.6;
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: white;
    }
  </style>

<section class="content">
    
<div class="wrapper">
<div class="watermark" style="background-color: white;"></div>
    <div class="inner-container" style="background-color: white;">
        <br>
        <br>
        <br>
        <br>
        <div class="col-md-12">Something else</div>
        <div class="col-md-12">Something more..Something more..Something more..Something more..Something more..Something more..Something more..</div>
        <div class="col-md-12">Something at the end</div>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>

</section>
<?= $this->endsection(); ?>