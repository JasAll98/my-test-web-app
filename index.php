<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Project.jas</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="wrapper">
      <div class="title"><span>KIRISH</span></div>
      <form action="auth.php" method="post">
        <div class="row">
          <i class="fas fa-user"></i>
          <input type="text" placeholder="Login" name="login" required />
        </div>
        <div class="row">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Password" name="password" required />
        </div>
        
        <div style="margin-bottom:20px;" class="row button">
          <input  type="submit" value="Login" />
        </div>
        
      </form>
    </div>
  </body>
</html>
