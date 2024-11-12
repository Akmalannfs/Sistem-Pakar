<h2>Riwayat Diagnosa</h2>
<table class="table table-bordered">
    <thead>
    <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>No Regdiagnosa</th>
                <th>Tanggal Diagnosa</th>
                <th>Penyakit</th>
                <th>Nilai</th>
            </tr>
            
            <?php
                $data = mysqli_query($conn, "SELECT * FROM hasil h, pasien p WHERE h.id_pasien=p.id_pasien ORDER BY h.id_hasil");
                $no = 1;
                while ($a = mysqli_fetch_array($data)) { ?>
                    <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $a['nama_pasien'] ?></td>
                    <td><?= $a['no_regdiagnosa'] ?></td>
                    <td><?= $a['tgl_diagnosa'] ?></td>
                    <td><?= $a['penyakit_cf'] ?></td>
                    <td><?= $a['nilai_cf'] ?>%</td>
            <?php }    ?>
    </tbody>
</table>