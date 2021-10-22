<?php
require_once(VIEWS_PATH."checkLoggedStudent.php");
include_once('header.php');
include_once('nav-student.php');
?>

<main class="py-3">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-3 text-center text-muted">Student</h2>

            <div class="bg-light-alpha p-2 text-center">
                <div class="row">
                    <div class="col-lg-4">
                        <label class="text-muted text-strong" for="">First Name</label>
                        <input type="text" name="" class="form-control form-control-ml" disabled value="<?php echo $loggedUser->getFirstName()?>">
                    </div>

                    <div class="col-lg-3">
                        <label class="text-muted text-strong" for="">Last Name</label>
                        <input type="text" name="" class="form-control form-control-ml" disabled value="<?php echo $loggedUser->getLastName()?>">
                    </div>

                    <div class="col-lg-2">
                        <label class="text-muted text-strong"  for="">DNI</label>
                        <input type="text" name="" class="form-control form-control-ml" disabled value="<?php echo $loggedUser->getDni()?>">
                    </div>

                    <div class="col-lg-3">
                        <label class="text-muted text-strong" for="">Email</label>
                        <input type="text" name="" class="form-control form-control-ml" disabled value="<?php echo $loggedUser->getEmail()?>">
                    </div>
                </div>
            </div>
    </section>

    <section id="why-us" class="why-us section-bg justify-content-center align-items-center">
        <div class="container-fluid" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch">

                    <div class="content">
                        <h3>Eum ipsam laborum deleniti <strong>velit pariatur architecto aut nihil</strong></h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
                        </p>
                    </div>

                    <div class="accordion-list">
                        <ul>
                            <li>
                                <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                    <p>
                                        Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                    <p>
                                        Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                                <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                    <p>
                                        Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                                    </p>
                                </div>
                            </li>

                        </ul>
                    </div>

                </div>
                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("../Views/img/why-us.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
            </div>

        </div>
    </section>

</main>
<br>

<?php
include_once('footer.php');
?>


