<?php
use Models\SessionHelper;
SessionHelper::checkStudentSession();
//require_once(VIEWS_PATH."checkLoggedStudent.php");
include_once('header.php');
include_once('nav.php');
?>

<div class="ml-auto col-auto">
    <!-- Start callto-action Area -->
    <section class="bg-light-alpha section-gap"  id="join">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="menu-content col-lg-9">
                    <div class="title text-center">
                        <h1 class="mb-10 text-muted">Companies List</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br>

<div class="ml-auto col-auto">


            <div class="scrollable container-fluid">
                <div class="form-group">
                     <table>
                        <thead>
                        <tr>
                            <th>
                                <form action="<?php echo FRONT_ROOT . "Company/showCompanyManagement" ?>" method="post"  enctype="multipart/form-data">
                                <input type="text" name="valueToSearch" placeholder="Company name to search" class="bg-light" required>
                                    <input type="submit" class="btn btn-dark ml-auto" name="search" value="Filter">
                                </form>
                            </th>
                            <th>
                                <form action="<?php echo FRONT_ROOT . "Company/showCompanyManagement" ?>" method="post"  enctype="multipart/form-data">
                                <input type="submit" class="btn btn-dark ml-auto" name="all" value="Show all companies" >
                                </form>
                            </th>
                        </tr>
                        </thead>
                     </table>
                </div>
                    <table class="table bg-light-alpha" style="text-align:center; ">
                        <thead>
                        <tr>
                            <th class="text-muted text-strong" style="width: 25%;">Name</th>
                            <th class="text-muted text-strong" style="width: 25%;">Industry</th>
                            <th class="text-muted text-strong" style="width: 30%;">Logo</th>
                            <th class="text-muted text-strong" style="width: 30%;">View More</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($searchedCompany) && $searchedCompany!=null){
                           foreach ($searchedCompany as $valueCompany)
                            {
                                ?>
                            <tr>
                                <td><?php echo $valueCompany->getName() ?></td>
                                <td><?php echo $valueCompany->getIndustry()->getType() ?></td>
                                <td><?php echo '<img src="../uploads/' .$valueCompany->getLogo()->getFile() . '" height="50" width="50"/>'; ?></td>
                                <td>
                                    <form action="<?php echo FRONT_ROOT . "Company/showCompanyViewMore" ?>" method="POST">
                                        <button type="submit" name="id" class="btn btn-dark ml-auto"
                                                value="<?php echo $valueCompany->getCompanyId() ?>"> View More
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            }}else{?> <h6 class="py-3 text-muted text-center text-strong"><?php echo "We couldn't find any company"?></h6>  <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>

<br><br><br><br><br><br><br><br><br><br><br><br>
<?php
include_once('footer.php');
?>
