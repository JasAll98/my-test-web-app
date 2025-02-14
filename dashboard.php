<?php
include 'connection.php';
if(isset($_POST['submit'])) {
    $perID = $_POST['personID'];
    $turi = $_POST['tur'];
    $fio = $_POST['fio'];
    $pasport = $_POST['pasport'];
    $izoh = $_POST['izoh'];
    $username = $_POST['username'];

    $file = $_FILES['file'];
    $new_file_name = $pasport.$file['name'];

    
    if (move_uploaded_file($file['tmp_name'],'foto/'.$new_file_name)) {
        $sql = "INSERT INTO `person_table`(`id`, `turi`, `foto`, `fio`, `pasport`, `izoh`, `username`) 
VALUES ('$perID','$turi','foto/$new_file_name',' $fio','$pasport','$izoh',' $username');";
    } else {
        $sql = "INSERT INTO `person_table`(`id`, `turi`, `foto`, `fio`, `pasport`, `izoh`, `username`) 
VALUES ('$perID','$turi','no foto',' $fio','$pasport','$izoh',' $username');";
    }

    
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Ma`lumotlar saqlandi!</strong>
        </div>';
    }else {
        die("Connection failed: " . $conn->connect_error);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Project.jas</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
    color: #566787;
    background: #f7f5f2;
    font-family: 'Roboto', sans-serif;
}

.popup {
    background: rgba(0, 0, 0, 0.7);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    display: none;
    justify-content: center;
    align-items: center;
}   
.popup-content{
    width: 800px;
    height: 600px;
    background: #fff;
    padding: 24px;
    border-radius: 5px;
    position: relative;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
  	min-width: 1000px;
    background: #fff;
    padding: 20px 25px;
    border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    color: #fff;
    background: #40b2cd;		
    padding: 16px 25px;
    margin: -20px -25px 10px;
    border-radius: 3px 3px 0 0;
}
.table-title h2 {
    margin: 5px 0 0;
    font-size: 24px;
}
.search-box {
    position: relative;
    float: right;
}
.search-box .input-group {
    min-width: 250px;
    position: absolute;
    right: 0;
}
.search-box .input-group-addon, .search-box input {
    border-color: #ddd;
    border-radius: 0;
}	
.search-box input {
    height: 34px;
    padding-right: 35px;
    background: #f4fcfd;
    border: none;
    border-radius: 2px !important;
}
.search-box input:focus {
    background: #fff;
}
.search-box input::placeholder {
    font-style: italic;
}
.search-box .input-group-addon {
    min-width: 35px;
    border: none;
    background: transparent;
    position: absolute;
    right: 0;
    z-index: 9;
    padding: 6px 0;
}
.search-box i {
    color: #a0a5b1;
    font-size: 19px;
    position: relative;
    top: 2px;
}
table.table {
    table-layout: fixed;
    margin-top: 15px;
    
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table th:first-child {
    width: 60px;
}
table.table th:last-child {
    width: 120px;
}
table.table td a {
    color: #a0a5b1;
    display: inline-block;
    margin: 0 5px;
}
table.table td a.view {
    color: #03A9F4;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;
}
table.table td i {
    font-size: 19px;
} 


.card {
    <?php if($_COOKIE['user'] != "admin") 
            echo 'display: none;';

        ?>
    
}



</style>
<script>
$(document).ready(function(){
	
	$('[data-toggle="tooltip"]').tooltip();
    
	// Filterlash funksiyani yaratish
    $("#search").on("keyup", function() {
        var term = $(this).val().toLowerCase();
        $("table tbody tr").each(function(){
            $row = $(this);
            var name = $row.find("td:nth-child(6)").text().toLowerCase();
            console.log(name);
            if(name.search(term) < 0){                
                $row.hide();
            } else{
                $row.show();
            }
        });
    });

    $("#searchbypass").on("keyup", function() {
        var term = $(this).val().toLowerCase();
        $("table tbody tr").each(function(){
            $row = $(this);
            var name = $row.find("td:nth-child(7)").text().toLowerCase();
            console.log(name);
            if(name.search(term) < 0){                
                $row.hide();
            } else{
                $row.show();
            }
        });
    });

    $("#searchbyID").on("keyup", function() {
        var term = $(this).val().toLowerCase();
        $("table tbody tr").each(function(){
            $row = $(this);
            var name = $row.find("td:nth-child(2)").text().toLowerCase();
            console.log(name);
            if(name.search(term) < 0){                
                $row.hide();
            } else{
                $row.show();
            }
        });
    });
});


</script>
</head>
<body>

    
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <p align="end" style="margin-top:20px;margin-right:20px;">
                <?php echo '<b>'.$_COOKIE['user'] ?></b> <br> <a href="exit.php">chiqish</a>
                </p>
            </div>
        </div>
    
        
 
    
        

    <div class="row" style="margin: 20px;">
  <div class="col-sm-6">
  <div class="card">
    <div class="card-header">
            Bazada ma'lumotlar soni: 
            <?php  
                $SQL = "SELECT COUNT(person_id) as allson FROM `person_table`;";
                $res = mysqli_query($conn, $SQL);
                $DATA = mysqli_fetch_assoc($res);

                echo '<b>'.$DATA['allson'].'</b>';
            ?>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p>Tik Tok: 
                <?php  
                    $SQL = "SELECT COUNT(person_id) as tikson FROM `person_table` WHERE turi = 'tiktok';";
                    $res = mysqli_query($conn, $SQL);
                    $DATA = mysqli_fetch_assoc($res);

                     echo '<b>'.$DATA['tikson'].'</b>';
                ?> <br>Instagram: 
                <?php  
                    $SQL = "SELECT COUNT(person_id) as instason FROM `person_table` WHERE turi = 'instagram';";
                    $res = mysqli_query($conn, $SQL);
                    $DATA = mysqli_fetch_assoc($res);

                    echo '<b>'.$DATA['instason'].'</b>';
                    
                ?>
            
            <br>Twitter: 
                <?php  
                    $SQL = "SELECT COUNT(person_id) as twitson FROM `person_table` WHERE turi = 'Twitter';";
                    $res = mysqli_query($conn, $SQL);
                    $DATA = mysqli_fetch_assoc($res);

                    echo '<b>'.$DATA['twitson'].'</b>';
                    
                ?>
            
            </p>
            <footer class="blockquote-footer">EXPORT <a href="export.php?tur=all" class="btn btn-primary" id="exportall" name="exportall">.xlsx</a> hammasi</footer>
        </blockquote>
  </div>
</div>
  </div>
  <div class="col-sm-6">
  <div class="card">
  <div class="card-header">
    Bugungi ma'lumotlar soni: <?php  
     $SQL = "SELECT COUNT(person_id) as son FROM `person_table` WHERE date(`kiritilgan_vaqti`) = CURRENT_DATE;";
     $res = mysqli_query($conn, $SQL);
     $DATA = mysqli_fetch_assoc($res);

     echo '<b>'.$DATA['son'].'</b>';
     ?>
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>Tik Tok: <?php  
     $SQL = "SELECT COUNT(person_id) as tikson FROM `person_table` WHERE turi = 'tiktok' AND date(`kiritilgan_vaqti`) = CURRENT_DATE;";
     $res = mysqli_query($conn, $SQL);
     $DATA = mysqli_fetch_assoc($res);

     echo '<b>'.$DATA['tikson'].'</b>';
     ?> <br>Instagram: <?php  
     $SQL = "SELECT COUNT(person_id) as instason FROM `person_table` WHERE turi = 'instagram' AND date(`kiritilgan_vaqti`) = CURRENT_DATE;";
     $res = mysqli_query($conn, $SQL);
     $DATA = mysqli_fetch_assoc($res);

     echo '<b>'.$DATA['instason'].'</b>';
     ?>
     
     <br>Twitter: <?php  
     $SQL = "SELECT COUNT(person_id) as twitson FROM `person_table` WHERE turi = 'Twitter' AND date(`kiritilgan_vaqti`) = CURRENT_DATE;";
     $res = mysqli_query($conn, $SQL);
     $DATA = mysqli_fetch_assoc($res);

     echo '<b>'.$DATA['twitson'].'</b>';
     ?>

    </p>
      <footer class="blockquote-footer">EXPORT <a href="export.php?tur=curre" class="btn btn-primary" id="exportall" name="export">.xlsx</a> bugungi</footer>
    </blockquote>
  </div>
</div>
  </div>
</div>
    
    <div class="container-xxl">
        <div class="table-responsive" >
            <div class="table-wrapper" style="margin-right:20px; margin-left:20px;">			
                <div class="table-title" >
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-primary" id="qoshish">+ Qo‘shish</button>
                        </div>
                    </div>
                </div>
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Fuqarolar <b>RO‘YXATI</b></h2>
                        </div>
                        <div class="col-sm-2">
                            <div class="search-box">
                                <div class="input-group">								
                                    <input type="text" id="search" class="form-control" placeholder="Ism bo‘yicha qidiruv..">
                                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="search-box">
                                <div class="input-group">								
                                    <input type="text" id="searchbypass" class="form-control" placeholder="Pasport bo‘yicha qidiruv..">
                                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="search-box">
                                <div class="input-group">								
                                    <input type="text" id="searchbyID" class="form-control" placeholder="ID bo‘yicha qidiruv..">
                                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th style="width: 20%;">ID</th>
                            <th style="width: 20%;">Turi</th>
                            <th style="width: 20%;">Kiritilgan vaqti</th>
                            <th style="width: 20%;">Foto</th>
                            <th style="width: 20%;">F.I.SH.</th>
                            <th style="width: 10%;">Pasport</th>
                            <th style="width: 15%;">Izoh</th>
                            <th style="width: 15%;">username</th>
                            <?php if($_COOKIE['user'] == "admin") 
                                echo '<th></th>';

                            ?>
                            
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                        $dispSQL = "SELECT * FROM `person_table` ORDER BY `id`;";
                        $res = mysqli_query($conn, $dispSQL);
                       
                        if ($_COOKIE['user'] != "admin") {
                            if ($res) {
                                while($row = mysqli_fetch_assoc($res)){
                                    $no = $row['person_id'];
                                    $perid = $row['id'];
                                    $turi = $row['turi'];
                                    $kir_sana = $row['kiritilgan_vaqti'];
                                    $foto = $row['foto'];
                                    $fio = $row['fio'];
                                    $passport = $row['pasport'];
                                    $comment = $row['izoh'];
                                    $username = $row['username'];
    
                                    echo '
                                    <tr>
                                        <td>'.$no.'</td>
                                        <td style="width: 50px; 
      overflow: hidden;
      text-overflow: ellipsis;">'.$perid.'</td>
                                        <td>'.$turi.'</td>
                                        <td>'.$kir_sana.'</td>
                                        <td><img src="'.$foto.'" alt="foto" width="150"></td>
                                        <td>'.$fio.'</td>
                                        <td>'.$passport.'</td>
                                        <td>'.$comment.'</td>
                                        <td>'.$username.'</td>
                                       
                                    </tr>
                                    ';
                                }   
                            }
                        } else {
                            if ($res) {
                                while($row = mysqli_fetch_assoc($res)){
                                    $no = $row['person_id'];
                                    $perid = $row['id'];
                                    $turi = $row['turi'];
                                    $kir_sana = $row['kiritilgan_vaqti'];
                                    $foto = $row['foto'];
                                    $fio = $row['fio'];
                                    $passport = $row['pasport'];
                                    $comment = $row['izoh'];
                                    $username = $row['username'];
    
                                    echo '
                                    <tr>
                                        <td>'.$no.'</td>
                                        <td style="width: 50px; 
      overflow: hidden;
      text-overflow: ellipsis;">'.$perid.'</td>
                                        <td>'.$turi.'</td>
                                        <td>'.$kir_sana.'</td>
                                        <td><img src="'.$foto.'" alt="foto" width="150"></td>
                                        <td>'.$fio.'</td>
                                        <td>'.$passport.'</td>
                                        <td>'.$comment.'</td>
                                        <td>'.$username.'</td>
                                        <td>
                                            <a href="updateperson.php?id='.$no.'" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                            <a href="deleteperson.php?id='.$no.'" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                                        </td>
                                    </tr>
                                    ';
                                }   
                            }
                        }

                        

                    ?>
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
    <div class="popup">
        <div class="popup-content">
            <a href="#" class="close" title="Yopish" id="yopish" data-toggle="tooltip"><i class="material-icons">close</i></a>
            <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-12">
                  <label for="PersonID" class="form-label" style="margin-top: 20px;">ID</label>
                  <input type="text" class="form-control" id="PersonID" name="personID" maxlength="50">
                </div>
                <div class="col-md-12">
                  <label for="username" class="form-label" style="margin-top: 20px;">Username</label>
                  <input type="text" class="form-control" id="usernmae" name="username" maxlength="50">
                </div>
                <div class="col-md-4" style="padding-top:20px;">
                    <input type="radio" id="tiktok" name="tur" value="TikTok">
                    <label for="tiktok">Tik Tok</label><br>
                    
                </div>
                <div class="col-md-4" style="padding-top:20px;">
                <input type="radio" id="insta" name="tur" value="Instagram" >
                <label for="insta">Instagram</label><br>
                </div>
                <div class="col-md-4" style="padding-top:20px;">
                    <input type="radio" id="twitter" name="tur" value="Twitter">
                    <label for="twitter">Twitter</label><br>
                    
                </div>
                <div class="col-md-12" >
                  <label for="foto" class="form-label" style="margin-top: 20px;">Foto</label>
                  <input type="file" class="form-control" id="foto" name="file">
                </div>
                <div class="col-12" style="margin-top:20px;">
                  <label for="inputFio" class="form-label">F.I.SH.</label>
                  <input type="text" class="form-control" id="inputFio" name="fio">
                </div>
                <div class="col-md-3" >
                  <label for="Pasport" class="form-label" style="margin-top: 20px;">Pasport</label>
                  <input type="text" class="form-control" id="Pasport" name="pasport" maxlength="9">
                </div>
                             
                <div class="col-9" style="margin-top:20px;">
                  <label for="inputIzoh" class="form-label">Izoh</label>
                  <input type="text" class="form-control" id="inputIzoh" name="izoh">
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary" style="margin-top: 20px;" name="submit" id="submit">+ Qo‘shish</button>
                  
                </div>
              </form>
        </div>
    </div>
    
</body>
<script>
    document.getElementById("qoshish").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "flex";
});

document.getElementById("yopish").addEventListener("click", function(){
    document.querySelector(".popup").style.display = "none";
});


</script>
</html>