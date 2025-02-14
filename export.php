<?php
include 'connection.php';

$output = "";
if(isset($_GET['tur'])) {
    $tur = $_GET['tur'];

    $res = false;
    if (!strcmp($tur,"all")) {
        $filename = "hammasi.xls";
        $all = "SELECT * FROM person_table";
        $res = mysqli_query($conn, $all);
       
    } else {
        $filename = "bugungi.xls";
        $currentdata = "SELECT * FROM `person_table` WHERE date(`kiritilgan_vaqti`) = CURRENT_DATE;";
        $res = mysqli_query($conn, $currentdata);
      
    }


    if ($res) {
        $output = '<table border=1>
                    <thead>
                        <tr>
                            <th>№</th>
                            <th style="width: 20%;">ID</th>
                            <th style="width: 20%;">Turi</th>
                            <th style="width: 20%;">Kiritilgan vaqti</th>
                            <th style="width: 25%;">Foto</th>
                            <th style="width: 20%;">F.I.SH.</th>
                            <th style="width: 10%;">Pasport</th>
                            <th style="width: 15%;">Izoh</th>
                            <th style="width: 15%;">username</th>
                        </tr>
                    </thead>
                    <tbody>';

                    while($row = mysqli_fetch_assoc($res)){
                        $no = $row['person_id'];
                        $perid = $row['id'];
                        $turi = $row['turi'];
                        $kir_sana = $row['kiritilgan_vaqti'];
                        @$foto = $row['foto'];
                        $fio = $row['fio'];
                        $passport = $row['pasport'];
                        $comment = $row['izoh'];
                        $username = $row['username'];

                        $output .= '
                        <tr>
                                    <td>'.$no.'</td>
                                    <td>'.$perid.'</td>
                                    <td>'.$turi.'</td>
                                    <td>'.$kir_sana.'</td>
                                    <td width="150" height="200"><img src="http://192.168.1.236/'.$foto.'" width="150"></td>
                                    <td>'.$fio.'</td>
                                    <td>'.$passport.'</td>
                                    <td>'.$comment.'</td>
                                    <td>'.$username.'</td>
                                    </tr>
                        ';
                    }
                    $output .= '
                        </tbody></table>
                    ';
                    header("Content-Type: application/xls");
                    header("Content-Disposition: attachment; Filename = $filename");
    
                    echo $output;
    
    
    }else {
                    echo '<script type="text/javascript"> alert("Jadvalda malumot yoq");
                    window.location.href="dashboard.php"; </script>';
   }
    
 }
            
?>