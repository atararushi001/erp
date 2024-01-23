<?php
// session_start();



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    body {
      background: url('../assets/img/login_bg.png') center/cover no-repeat;
    }
  </style>

</head>

<body>

  <div class="h-screen grid place-items-center">
    <div class="bg-white px-14 py-6">
      <form class="w-[350px] flex flex-col gap-4" action="../include/function.php" name="logindata" method="post" enctype="multipart/form-data">
        <div>
          <a href="../index.php">
            <img src="../assets/img/logo1.svg" alt="" class="w-[150px] h-auto mx-auto mb-6">
          </a>
        </div>

        <h2 class="text-lg font-semibold">Sign in to start your session</h2>

        <div class="flex flex-col gap-2">
          <label class="text-md" for="user_email">email address</label>
          <input type="user_email" onchange="getcompnay_name()" id="user_email" placeholder="Enter email" class="w-full px-4 py-2 focus:outline-none border border-[#042893] bg-[#F9FAFF]" name="user_email" />
        </div>

        <div>
          <input type="text" name="company_name" id="company_name" disabled placeholder="company name" class="w-full px-4 py-2 focus:outline-none border border-[#042893] bg-[#F9FAFF]" />
        </div>

        <div class="flex flex-col gap-2">
          <label class="text-md" for="user_password">password</label>
          <input type="user_password" id="user_password" class="w-full px-4 py-2 focus:outline-none border border-[#042893] bg-[#F9FAFF]" name="user_password" />
        </div>

        <div class="flex items-center gap-2 mb-3">
          <input type="checkbox" name="remember" id="remember" class="h-3.5 w-3.5">
          <label for="remember" class="text-md">Remember me</label>
        </div>

        <button type="submit" class="w-full px-4 py-2 text-white bg-[#042893]" name="login">Login</button>

        <p class="text-center text-md">Powered by Aarvi Technolabs</p>

      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <script>
    function getcompnay_name() {
      email = $("#user_email").val();

      $.ajax({
        url: '../include/function.php',
        method: 'GET',
        data: {
          user_emaildata: email
        },
        success: function(response) {
          console.log(response);
          $('#company_name').val(response.trim());
        },
        error: function(error) {
          console.error('AJAX request failed: ' + error);
        }
      });
    }
  </script>



</body>

</html>