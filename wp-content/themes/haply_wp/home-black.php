
<section class="about1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xl-6 col-md-12 col-sm-12">
                <div class="about_sec">
                    <div class="line "></div>
                    <h1 class="h1">
                        <?php echo get_field('home-section-black')['text-sec1-black']; ?>

                    </h1>

                    <div class="inline_btn">
                        <?php if (isset(get_field('home-section-black')['free_url1-sec1-black']['url'])) { ?>
                            <a href="<?php print_r(get_field('home-section-black')['free_url1-sec1-black']['url']); ?>" class="btn custom-btn"><?php esc_html_e(get_field('home-section-black')['free_url1-sec1-black']['title'], 'HaplyWP') ?></a>
                        <?php } ?>
                        <?php if (isset(get_field('home-section-black')['demo_url1-sec1-black']['url'])) { ?>
                            <a href="<?php echo get_field('home-section-black')['demo_url1-sec1-black']['url']; ?>" class="btn hover-btn "><?php esc_html_e(get_field('home-section-black')['demo_url1-sec1-black']['title'], 'HaplyWP') ?></a> <!--Prøv vores demo-->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$mid_section = get_field('home-sec-black');


?>

<section class="leftImg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="leftImg img ">
                    <div class="leftImg_style">
                        <img src="<?php echo $mid_section['image2-black']['url']; ?>" alt="<?php echo $mid_section['image2-black']['title']; ?>" class="img-fluid">
                        <!--<p class="digit">3:2</p>-->
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="leftImg content lg-pl-34  home-content-wrap">
                    <div class="text_content heading position-relative ">
                        <h2><?php echo  $mid_section['heading2-black']; ?></h2>
                        <?php echo $mid_section['content2-black'];?>
                        <?php //echo mb_strimwidth($mid_section['content2-black'], 0, 700, "...");?>
                    </div>
                    <?php if (isset(get_field('home-sec-black')['home_sec2_url']['url'])) { ?>
                        <a href="<?php echo get_field('home-sec-black')['home_sec2_url']['url']; ?>" class="btn custom-btn"><?php esc_html_e(get_field('home-sec-black')['home_sec2_url']['title'], 'HaplyWP') ?></a>
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
                    <h2 class="h2"><?php echo get_field('heading-black'); ?></h2>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
//echo "<pre>";
$third_section = get_field('home-third-black');
//print_r( get_field('home-section-black'));

?>
<section class="leftImg right-img">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="leftImg content pr-34  home-content-wrap">
                    <div class="text_content heading position-relative ">
                        <h2><?php echo $third_section['heading3-black']; ?></h2>
                        <?php echo $third_section['text3-black'];?>

                        <?php //echo mb_strimwidth($third_section['text3-black'], 0, 1300, "...");?>
                            
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="leftImg img">
                    <div class="leftImg_style">
                        <img src="<?php echo $third_section['image3-black']['url']; ?>" alt="" class="img-fluid">
                        <!--<p class="digit">3:2</p>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>