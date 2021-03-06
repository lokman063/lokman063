<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/phpcrud/bootstrap.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/phpcrud/security.php");
use Bitm\Utility\Message;
use Bitm\Utility\Utility;
use Bitm\Banner\Banner;
//selection query

$banner = new Banner();
$banners = $banner->show($_GET['id']);




if(empty($banners)){
    Message::set(' Banner is not Found');
    header("location:index.php");
    return $banners;
}


?>

<?php
ob_start();
?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?php
            if($message = Message::get()){
                ?>
                <div class="alert alert-success">
                    <?php echo $message;?>
                </div>
                <?php
            }
            ?>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 >banner</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-secondary">
                        <span data-feather="calendar"></span>
                        <a href="<?=VIEW;?>banner/index.php" style="color: black">Go to list</a>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <section >
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm  ">
                                    <div class="banner">
                                        <a href="#" class="img-prod"><div class="img"><img src="<?=UPLOADS;?><?php echo $banners['picture']?>" width="750px" height="350px"></div>

                                        </a>
                                        <div class="text ">
                       &nbsp;
                                            <h3><a href="#"><?php echo $banners['title']?></a></h3><br>
                                            <div class="d-flex">

                                                    <p class="col-lg-4"><?php echo $banners['link']?>&nbsp;
                                                        </p><br>
                                                    <div class="col-lg-6">
                                                        <?php echo $banners['promotional_message']?>
                                                        <?php echo $banners['html_banner']?>
                                                        <?php  if($banners['is_active']){
                                                            echo 'the product is active';
                                                        }else{
                                                            echo 'the product is not active';
                                                        }
                                                        ?>
                                                    </div>

                                                &nbsp;

                                                </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            </div>



        </main>
<?php
$pagecontent = ob_get_contents();
ob_end_clean();
echo str_replace("##MAIN_CONTENT##",$pagecontent,$layout);
?>