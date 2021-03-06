<?php
use Models\User;
use Models\SessionHelper;
SessionHelper::checkUserSession();
//require_once(VIEWS_PATH . "checkLoggedUser.php");
include_once('header.php');
include_once('nav.php');
?>

		<!-- CSS here -->
            <link rel="stylesheet" href="../Views/assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../Views/assets/css/style.css">
           <link rel="stylesheet" href="../Views/css/bootstrap.css">
           <link rel="stylesheet" href="../Views/css/main.css">

<style>
    .feature {
        background: none no-repeat scroll 0 0 #fff;
        position: relative;
    }</style>



    <main>
        <!-- Hero Area Start-->
        <section class="download-area section-gap" id="app">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 download-left">
                        <img class="img-fluid" src="../Views/img/offerMore.png" alt="">
                    </div>
                    <div class="col-lg-6 download-right">
                        <h1>Do not miss  <br>
                            this incredible opportunity!</h1>
                        <p class="subs">
                            We offer you a wide variety of job offers from the best companies so that you can find your dream job. Do not wait any longer and expand your work horizons.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero Area End -->

        <br><br>
        <h6 class="py-3  text-muted text-center text-strong"><?php if (isset($message)) {echo $message;} ?></h6>
        <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120 ">
            <div class="container bg-light-alpha p-5 border bx-border-radius">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-7 col-lg-8 post-list ">
                        <!-- job single -->
                        <div class="single-job-items mb-50 border ">
                            <div class="job-items ">
                                <div class="company-img company-img-details">
                                    <img><?php echo '<img src="../uploads/' . $company->getLogo()->getFile() . '" height="150" width="180"/>'; ?>
                                </div>
                                <div class="job-tittle">
                                    <a href="#">
                                        <h4>  <a href="single.html"><h4><?php echo $jobOffer->getTitle() ?></h4></a></h4>
                                    </a>
                                    <ul>
                                        <li><?php echo $company->getName() ?></li>
                                        <li><i class="fas fa-map-marker-alt"></i><?php echo $company->getCountry()->getName().", ".$company->getCity()->getName()  ?></li>
                                        <li>Salary: <?php if($jobOffer->getSalary()==0){ echo "Undefined";}else{echo "$ ". $jobOffer->getSalary();} ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                          <!-- job single End -->

                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4> <img src="../Views/img/check.png" alt=""> Job Description</h4>
                                </div>
                                <p><?php echo $jobOffer->getDescription() ?></p>
                            </div>
                            <div class="post-details2  mb-50">
                                 <!-- Small Section Tittle -->
                                <div class="small-section-tittle">

                                   <h4>  <img src="../Views/img/check.png" alt="">  Job Position</h4>
                                </div>
                               <ul>
                                   <?php foreach ($jobOffer->getJobPosition() as $value){?>
                                   <li><?php echo $value->getDescription()?></li>
                                   <?php }?>
                               </ul>
                            </div>
                            <div class="post-details2  mb-50">
                                 <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4> <img src="../Views/img/check.png" alt=""> Career</h4>
                                </div>
                               <ul>
                                   <li><?php echo $jobOffer->getCareer()->getDescription() ?></li>
                               </ul>
                            </div>
                            <div class="post-details2  mb-50">
                                <ul>
                                    <form action="<?php echo FRONT_ROOT . "Job/showJobOfferManagementView" ?>"
                                          method="POST">
                                        <button type="submit" name="id" class="btn buttonPer  d-block">Return
                                        </button>
                                    </form>
                                </ul>

                            </div>
                        </div>

                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3  mb-50 feature border">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Job Overview</h4>
                           </div>
                          <ul>
                              <li>Publish date : <span><?php echo $jobOffer->getPublishDate()?></span></li>
                              <li>End date : <span><?php echo $jobOffer->getEndDate()?></span></li>
                              <li>Location : <span><?php echo $company->getCountry()->getName().", ".$company->getCity()->getName()?></span></li>
                              <li>Job nature : <span><?php echo $jobOffer->getDedication()?></span></li>
                              <li>Work Type: <span><?php echo $jobOffer->getRemote()?></span></li>
                              <li>Salary :  <span><?php if($jobOffer->getSalary()==0){ echo "Undefined";}else{echo "$ ". $jobOffer->getSalary();} ?> </span></li>
                          </ul>
                         <div class="apply-btn2">
                             <?php if($loggedUser->getRol()->getUserRolId()==1 || $loggedUser->getRol()->getUserRolId() == 3){?>

                                 <form action="<?php echo FRONT_ROOT . "Appointment/showAppointmentList" ?>"
                                       method="POST">
                                     <button type="submit" name="id" class="btn buttonPer ml-auto d-block"
                                             value="<?php echo $jobOffer->getJobOfferId() ?>"> View Appointments
                                     </button>
                                 </form>

                             <?php } else{?>
                                     <td>
                                     <?php if ($jobOffer->getCareer()->getCareerId() == $loggedUser->getCareer()->getCareerId()) { ?>
                                         <form action="<?php echo FRONT_ROOT ."Appointment/showApplyView" ?>"
                                               method="POST">
                                             <input type="hidden" name="studentId" value="<?php echo $loggedUser->getEmail() ?>">
                                             <button type="submit" name="id" class="btn buttonPer ml-auto d-block"
                                                     value="<?php echo $jobOffer->getJobOfferId() ?>">Apply
                                             </button>
                                         </form>
                                         <br>
                                         </td>
                                     <?php }} ?>
                         </div>
                       </div>
                        <div class="post-details4  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4><img src="../Views/img/radio.png" alt=""> Company Information</h4>
                           </div>
                              <span><?php echo $company->getName() ?></span>
                              <p><?php echo $company->getAboutUs() ?></p>
                            <ul>
                                <li>Name: <span><?php echo $company->getName() ?> </span></li>
                                <li>Industry: <span><?php echo $company->getIndustry()->getType() ?></span></li>
                                <li>Web:<span><a href="#" target="_blank" rel="noopener noreferrer"><?php echo $company->getCompanyLink() ?></a></span></li>
                                <li>Email: <span><?php echo $company->getEmail() ?></span></li>
                                <li>Foundation Date: <span><?php echo $company->getFoundationDate() ?></span></li>

                            </ul>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->

    </main>
<?php
include_once('footer.php');
?>

