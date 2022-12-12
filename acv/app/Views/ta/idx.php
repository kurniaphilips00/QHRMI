<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Table Demo</title>

    <!-----------------------Fontawesome------------------------------------------------------------------>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-----------------------Fontawesome------------------------------------------------------------------>

    <!--Datatables--------------------->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <!--Datatables--------------------->

    <!--Online Bootstrap 5---------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--Online Bootstrap 5---------------->
</head>

<body>
    <header>

    </header>

    <section>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th scope="col" style="text-align:center; width:5%">No</th>
                    <th scope="col" style="text-align:center; width:25%">Nama</th>
                    <th scope="col" style="text-align:center; width:10%">SIPP</th>
                    <th scope="col" style="text-align:center; width:10%">Tgl. Kadaluarsa</th>
                    <th scope="col" style="text-align:center; width:10%">STR</th>
                    <th scope="col" style="text-align:center; width:10%">Usia</th>
                </tr>
            </thead>

        </table>

    </section>

    <footer>


    </footer>
    <!--JQuaery--->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!--JQuaery--->

    <!--Datatables------------->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!--Datatables------------->

    <!--Datatables------------->


    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?= site_url('ta/indexAjax') ?>',
                  // url: 'indexAjax',
                    type: 'POST',
                },
                columns: [
                    {data:'null',
                    render:function(data, type, row, meta){
                        return meta.row + meta.settings._iDisplayStart+1;
                    }},
                    {data: 'nama'},
                    {data: 'sipp'},
                    {data: 'sipp_ed'},
                    {data: 'str'},
                    {data: 'usia'},
                ],
            });
        });

        /*       $(document).ready(function() {-->
                    $('#example').DataTable();
                });*/
    </script>
    <!--Datatables------------->

    <!--Online Bootstrap 5---------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!--Online Bootstrap 5---------------->

    <!--Online dropdowns, popovers, or tooltips of Bootstrap 5----------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <!--Online dropdowns, popovers, or tooltips of Bootstrap 5----------------------------------->

</body>

</html>