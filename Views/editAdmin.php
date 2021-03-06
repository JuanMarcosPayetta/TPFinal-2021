<?php
use Models\SessionHelper;
SessionHelper::checkAdminSession();
//require_once(VIEWS_PATH . "checkLoggedAdmin.php");
include_once('header.php');
include_once('nav.php');

if( $confirmAccess == null ) {?>
<main class="py-5">
    <section id="listado">
        <div class="container">
            <h2 class="mb-4 text-muted text-center">Confirm Password</h2>
            <div class="row justify-content-center">
                <form action="<?php echo FRONT_ROOT . "User/showAdminEditView" ?>" method="POST"
                      class="bg-light-alpha p-5 border" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $admin->getUserId() ?>">
                    <div class="col-sm-12  text-center">
                        <strong><?php if (isset($message)) {
                                echo $message;
                            } ?></strong>
                        <div class="col-lg-15">
                            <div class="form-group">
                                <label class="text-muted text-strong text" for="">Enter Password</label>
                                <input type="password" name="confirmPassword" class="form-control" required>
                            </div>
                        </div>
                        <div>
                            <button type="submit"
                                    class="btn btn-dark  ml-d-block my-3 justify-content-center">Confirm
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
</main>
<?php }else{?>


<main class="py-5">
    <section id="listado">
        <div class="container">
            <h2 class="mb-4 text-muted text-center">Edit Admin</h2>
            <div class="row justify-content-center">
                <form action="<?php echo FRONT_ROOT . "User/UpdateAdmin" ?>" method="POST"
                      class="bg-light-alpha p-5 border" enctype="multipart/form-data">
                    <div class="col-sm-12  text-center">
                        <strong><?php if (isset($message)) {
                                echo $message;
                            } ?></strong>
                        <div class="form-group">
                            <label for="" class="text-muted text-strong text">ID</label>
                            <input type="text" name="id" class="form-control"
                                   value="<?php echo $admin->getUserId() ?>" readonly>
                        </div>
                        <div class="col-lg-15">
                            <div class="form-group">
                                <label class="text-muted text-strong text" for="">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="<?php echo $admin->getEmail() ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-15">
                            <div class="form-group">
                                <label class="text-muted text-strong text" for="">New Password</label>
                                <input type="password" name="newPassword" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-15">
                            <div class="form-group">
                                <label class="text-muted text-strong text" for="">Confirm Password</label>
                                <input type="password" name="confirmPassword" class="form-control">

                        </div>
                        <div>
                            <button type="submit"
                                    class="btn btn-dark  ml-d-block my-3 justify-content-center">Finish Edition
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
</main>


<?php }
include_once('footer.php');
?>
