<?php
include_once('header.php');
?>

<?php if ($student == null) { ?>
    <main class="py-5 m-3 "  >
            <header class="text-center">
                <h1 class=" text-muted text-center">SIGN UP</h1>
            </header>
        <br>
    <div class="container">
        <form action="<?php echo FRONT_ROOT . "Home/signUp" ?>" method="POST" class="text-center">
            <?php if (isset($message)) {echo $message;} ?>
            <div class="row justify-content-center align-items-center offset-sm-1 text-center bg-light-alpha border py-3">
                <div class=" col-md-4">
                    <label class="text-muted text-strong text">Email</label>
                    <input type="email" name="email" class="form-control-lg " placeholder="Enter your email" required>
                </div>
                <div class=" col-md-4">
                    <label class="text-muted text-strong text">DNI</label>
                    <input type="number" name="dni" class="form-control-lg " placeholder="Enter your DNI" required>
                </div>
                <div class="form-group">
                    <br>
                    <br>
                    <button class="btn btn-dark btn-block btn-lg" type="submit">SEND</button>
                </div>
            </div>
        </form>
        <form action="<?php echo FRONT_ROOT."Home/welcome" ?>" method="POST"
              class="py-3 text-center">
            <input type="submit" value="BACK" class="btn btn-dark ">
        </form>
    </div>
    </main>

    <section id="hero" class=" align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center align-items-center">

                <div class=" d-flex justify-content-center " data-aos="fade-up" data-aos-delay="200">
                </div>
                <div class=" hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="../Views/img/admini.png" width="500" height="400" class="img-fluid animated" alt="">

                </div>
            </div>
        </div>
    </section><!-- End Hero -->

    <?php
} else if ($student != null) { ?>
    <main class="py-3">
        <section id="listado">
            <h2 class="mb-4 text-muted text-center">SIGN UP <?php echo $student->getFirstName() ?></h2>
            <div class="container">
                <div class="row justify-content-center offset-sm-1 text-center bg-light-alpha p-5 border">
                    <strong><?php if (isset($message)) {
                            echo $message;
                        } ?></strong>

                    <div class="form-group col-3">
                        <label for="" class="text-muted text-strong text">First Name</label>
                        <input type="text" name="name" class="form-control text-center"
                               value="<?php echo $student->getFirstName() ?>" readonly>
                    </div>

                    <div class="form-group col-3">
                        <label class="text-muted text-strong text">Last Name</label>
                        <input type="text" name="lastname" id="contactNo" readonly class="form-control text-center"
                                value="<?php echo $student->getLastName() ?>">
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <form action="<?php echo FRONT_ROOT . "Home/signUpPassword" ?>" method="POST">
                    <div class="row justify-content-center align-items-center offset-sm-1 text-center bg-light-alpha border py-3">
                        <div class=" col-md-3">
                            <label class="text-muted text-strong text">Password</label>
                            <input type="password" name="password1" class="form-control" placeholder="Enter your password here" required>
                        </div>
                        <div class=" col-md-3">
                            <label class="text-muted text-strong text">Repeat Password</label>
                            <input type="password" name="password2" class="form-control" placeholder="Repeat your password here" required>
                        </div>
                        <input type="hidden" name="email" value="<?php echo $student->getEmail()?>">
                        <div class="form-group">
                            <br>
                            <button type="submit" name="button" class="btn btn-dark ml-auto d-block">SIGN UP</button>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </main>
<?php } ?>


<br><br><br><br><br>
    <br><br><br><br><br>
<?php
include_once('footer.php');
?>