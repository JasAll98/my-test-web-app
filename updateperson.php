<?php
    include 'connection.php';

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM person_table WHERE person_id='$id'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $row = mysqli_fetch_assoc($res);
        }
    }


    if(isset($_POST['submit'])) {
        $pasport = $_POST['pasport'];
        $username = $_POST['username'];
        $fio = $_POST['fio'];
        $izoh = $_POST['izoh'];
        $perID = $_POST['personID'];
        $turi = $_POST['tur'];
    
        
        $sql = "UPDATE `person_table` SET `id`='$perID',`turi`='$turi',`kiritilgan_vaqti`=CURRENT_TIMESTAMP,`fio`='$fio',`pasport`='$pasport',`izoh`='$izoh',`username`='$username' WHERE `person_id`=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('location: dashboard.php');
        }else {
            die("Connection failed: " . $conn->connect_error);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
    .popup {
    background: #fff;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    display: flex;
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
    </style>
</head>
<body>
    
       
<div class="popup">
        <div class="popup-content">
            <form class="row g-3" method="POST" enctype="multipart/form-data">
            <div class="col-md-12">
                  <label for="PersonID" class="form-label" style="margin-top: 20px;">ID</label>
                  <input type="text" class="form-control" id="PersonID" name="personID" maxlength="50"
                  value="<?php echo $row['id'];   ?>">
                </div>
                <div class="col-md-12">
                  <label for="username" class="form-label" style="margin-top: 20px;">Username</label>
                  <input type="text" class="form-control" id="usernmae" name="username" maxlength="50"
                  value="<?php echo $row['username'];   ?>">
                </div>
                <div class="col-md-6" style="padding-top:20px;">
                    <input type="radio" id="tiktok" name="tur" value="tiktok">
                    <label for="tiktok">Tik Tok</label><br>
                    
                </div>
                <div class="col-md-6" style="padding-top:20px;">
                <input type="radio" id="insta" name="tur" value="instagram" >
                <label for="insta">Instagram</label><br>
                </div>
                
                <div class="col-12" style="margin-top:20px;">
                  <label for="inputFio" class="form-label">F.I.SH.</label>
                  <input type="text" class="form-control" id="inputFio" name="fio"
                  value="<?php echo $row['fio'];   ?>">
                </div>
                <div class="col-md-3" >
                  <label for="Pasport" class="form-label" style="margin-top: 20px;">Pasport</label>
                  <input type="text" class="form-control" id="Pasport" name="pasport" maxlength="9"
                  value="<?php echo $row['pasport'];   ?>">
                </div>
                             
                <div class="col-9" style="margin-top:20px;">
                  <label for="inputIzoh" class="form-label">Izoh</label>
                  <input type="text" class="form-control" id="inputIzoh" name="izoh"
                  value="<?php echo $row['izoh'];   ?>">
                </div>
                <div class="col-12">
                  <button type="submit" class="btn btn-primary" style="margin-top: 20px;" name="submit" id="submit">Yangilash</button>
                  
                </div>
              </form>
        </div>
    </div>
</body>
</html>