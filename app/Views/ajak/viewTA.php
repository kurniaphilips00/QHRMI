
<table class="table table-sm table-striped" id="tabelku">
    <thead>
        <tr>
            <th><button type="submit" name="intmt" value="Intermitten diklik" style="width: 10; height: 20px; padding: 0px 0px 0px 0px; text-align: center; font-weight: bold;" class="tombol" title="Cetak intermitten"><i class="fa-solid fa-diagram-project"></i></button>
            </th>
            <th style="text-align:center; width:10%">Kode</th>
            <th style="text-align:center; width:50%">Nama</th>
            <th style="text-align:center; width:10%">KTP</th>
            <th style="text-align:center; width:20%">NPWP</th>
            <th style="text-align:center; width:5%">CV</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($rh) {

            $no = 1;
            foreach ($rh as $v) {
                $id = isset($v['id']) ? $v['id'] : '';
                $kode = isset($v['kode_ta']) ? $v['kode_ta'] : '';
                $nama = isset($v['nama']) ? $v['nama'] : '';
                $no_ktp = isset($v['no_ktp']) ? $v['no_ktp'] : '';
                $no_npwp = isset($v['no_npwp']) ? $v['no_npwp'] : '';
        ?>
                <tr>
                    <td>
                        <input type="checkbox" name="ckval[]" value="<?= $kode ?>">
                    </td>
                    <td style="width:10%"><?= $kode ?></td>
                    <td id="#name" style="width:50%"><?= $nama ?></td>
                    <td style="width:10%;"><?= $no_ktp ?></td>
                    <td style="width:20%;"><?= $no_npwp ?></td>
                    <!---------------------------------------------Tombol-tombol editing--------------------------------------------------->
                    <td style="width:5%; text-align:center">
                        <a target="_blank" href="/cv/cetak/<?= $kode; ?>">
                            <i class="fa-solid fa-print" title="Cetak Riwayat Hidup"></i>
                    </td>

                </tr>
            <?php
                $no++;
            }
        } else { ?>
            <tr>
                <td colspan="5">Tidak ada data(kosong)..........................!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!</td>
            </tr>
        <?php
        } ?>
    </tbody>

</table>


<script>
    
    $document.ready(function() {
        $('#tabelku').DataTable();
    })
</script>