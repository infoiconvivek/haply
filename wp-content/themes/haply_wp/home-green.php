
<section class="about1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
                <div class="about_sec">
                    <div class="line "></div>
                    <h1 class="h1">
                        <?php echo get_field('home-section')['text']; ?>

                    </h1>

                    <div class="inline_btn">
                    <?php if (isset(get_field('home-section')['free_url1']['url'])) { ?>
                        <a href="<?php print_r(get_field('home-section')['free_url1']['url']); ?>" class="btn custom-btn"><?php esc_html_e(get_field('home-section')['free_url1']['title'], 'HaplyWP') ?></a>
                        <?php } ?>
                        <?php if (isset(get_field('home-section')['demo_url1']['url'])) { ?>
                        <a href="<?php echo get_field('home-section')['demo_url1']['url']; ?>" class="btn hover-btn "><?php esc_html_e(get_field('home-section')['demo_url1']['title'], 'HaplyWP') ?></a> <!--Prøv vores demo-->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$mid_section = get_field('home-sec');


?>

<section class="leftImg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="leftImg img ">
                    <div class="leftImg_style">
                        <img src="<?php echo $mid_section['image']['url']; ?>" alt="<?php echo $mid_section['image']['title']; ?>" class="img-fluid">
                        <!--<p class="digit">3:2</p>-->
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="leftImg content lg-pl-34 home-content-wrap">
                    <div class="text_content heading position-relative " id="home-content-wrap">

                        <h2><?php echo  $mid_section['heading']; ?></h2>
                        <?php //echo $mid_section['content'];?>
                        <?php echo mb_strimwidth($mid_section['content'], 0, 850, "...");?>


                    </div>
                    <?php if (isset(get_field('home-sec')['home_sec2_url']['url'])) { ?>
                    <a href="<?php echo get_field('home-sec')['home_sec2_url']['url']; ?>" class="btn custom-btn"><?php esc_html_e(get_field('home-sec')['home_sec2_url']['title'], 'HaplyWP') ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about heading-noly">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="about_sec">
                    <div class="line"></div>
                    <h2 class="h2"><?php echo get_field('heading'); ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
//echo "<pre>";
$third_section = get_field('home-third');
//print_r( get_field('home-section'));

?>
<section class="leftImg right-img">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="home-content-wrap  pr-34">
                         <div class="text_content heading position-relative"  id="home-content-wrap">
                 
                        		<h2><?php echo $third_section['heading']; ?></h2>
             
                       	 	  <?php //echo $third_section['text'];?>

                                  <?php echo mb_strimwidth($third_section['text'], 0, 1600, "...");?>
                   
                </div>
                   
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="leftImg img">
                    <div class="leftImg_style">
                        <img src="<?php echo $third_section['image']['url']; ?>" alt="" class="img-fluid">
                        <!--<p class="digit">3:2</p>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>