<?= $this->extend('layout/dashboard-layout'); ?>

<?= $this->section('content'); ?>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card-body">
                    <p class="card-text viewdata"></p>
                    
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    function ajak() {
        $.ajax({
            url: "<?= site_url('ajak/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" +
                    xhr.responseText + "\n" +
                    thrownError);
            }

        });
    }
    /*  $document.ready(function() {
            $('#tabelku').DataTable();
        })*/
    $(document).ready(function() {
         ajak();
        //$('#tabelku').DataTable();
    });
</script>

<?= $this->endsection(); ?>