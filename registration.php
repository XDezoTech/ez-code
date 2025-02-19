<?php  
// require('includes/header.php');
// require('includes/navbar.php');
include('functions/common_function.php');


?>
<?php
require('admin/config/config.php');
session_start();



if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $user_img = $_FILES['user_img']['name'];
    $user_img_tmp = $_FILES['user_img']['tmp_name'];
    $ip = getIPAddress();

    if ($name != "" && $email != "" && $user_img != "") {
        $select = "SELECT * FROM users WHERE email = '$email'";
        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user['user_id'];
        $result = mysqli_query($con, $select);

        if (mysqli_num_rows($result) > 0) {
            echo "This email already exists";
            header("Refresh:2; URL=register");
        } else {
          
            move_uploaded_file($user_img_tmp, "admin/uploads/user_img/$user_img");
            $_SESSION['user_img'] = $user_img;
            $insert = "INSERT INTO users(name, email, password, user_img, user_ip)
                       VALUES('$name', '$email', '$password', '$user_img', '$ip')";
            $result = mysqli_query($con, $insert);

            if ($result) {
                header("Refresh:0; URL=login.php");
            } else {
                header("Refresh:0; URL=registration.php");
            }
        }
    } else {
        header("Refresh:0; URL=registration.php");
    }
}
?>




<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form action="" method="post" enctype="multipart/form-data" class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <!-- <label class="form-label" for="form3Example1c">Your Name</label> -->
                      <input type="text" id="name" class="form-control" name="name"/>
                      
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <!-- <label class="form-label" for="form3Example3c">Your Email</label> -->
                      <input type="email" id="email" class="form-control" name="email" />
                     
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <!-- <label class="form-label" for="form3Example3c">Photo</label> -->
                      <input type="file" id="user_img" class="form-control" name="user_img" />
                     
                    </div>
                  </div>


                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <!-- <label class="form-label" for="form3Example4c">Password</label> -->
                      <input type="password" id="password" class="form-control" name="password" />
                      
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div data-mdb-input-init class="form-outline flex-fill mb-0">
                    <!-- <label class="form-label" for="form3Example4cd">Repeat your password</label> -->
                      <input type="password" id="form3Example4cd" class="form-control" name="password" />
                   
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>
                

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button  type="submit" name="submit"  data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg">Register</button>
                  </div>

                </form>
                <a href="login.php">Already have an account</a>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="https://static.vecteezy.com/system/resources/thumbnails/008/199/073/small_2x/people-hand-entering-password-code-on-virtual-login-form-cyber-internet-security-photo.jpg"
                  class="img-fluid" alt="Sample image">
                  

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php  
require('./includes/footer.php');
?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>


