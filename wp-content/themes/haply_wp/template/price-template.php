<?php /*Template Name: Price Page */
get_header(); get_header();?>


    <section class="price">
        <div class="container-fluid">
        <div class="row">
                <div class="col-lg-8">
                    <div class="about_sec">
                        <div class="line">&nbsp;</div>
                        <h1 class="h1"><?php echo the_title();?></h1>
                        <?php the_content();?>
                        <!--<h4><?php echo the_field('text');?></h4>-->
                    </div>
                </div>
            </div>
            <div class="row">
            <?php
                // Check rows existexists.
                if( have_rows('price') ):
                    // Loop through rows.
                while( have_rows('price') ) : the_row();
                $color = get_sub_field('color');
                $ptitle=get_sub_field('price_url');
                $pstitl=get_sub_field('price_url_sec');
                 
                
                ?>
                <div class="col-xl-3 col-lg-6 col-md-6 mb-32">
                    <div class="price-bx">
						<div class="top-border" style="border-radius: 6px 6px 0 0; border: 7px solid <?php echo $color; ?> "></div>
                        <div class="price-pd">
                            <div class="line"></div>
                            <h3><?php echo get_sub_field('heading');?></h3>
                            <h4><?php echo get_sub_field('sub_heading');?></h4>
                            <p><?php echo get_sub_field('text');?></p>  
                        </div>

                        <div class="price-pd pt-0 buttons-price">
                            <div class="price-button">
                                <?php if(isset($ptitle['title']) && !empty($ptitle['title'])){?>
                                    <a href="<?php echo isset($ptitle['url'])?$ptitle['url']:'#';?>" class="btn hover-btn"><?php echo isset($ptitle['title'])?$ptitle['title']:'Gratis prøveperiode';?></a><!--Gratis prøveperiode-->
                                <?php }?>
                            </div>
                            <div class="price-button">
                                <?php if(isset($pstitl['title']) && !empty($pstitl['title'])){?>
                                    <a href="<?php if(isset($pstitl['url'])){ echo $pstitl['url']; }else{ echo '#';}?>" class="btn custom-btn"><?php echo isset($pstitl['title'])?$pstitl['title']:'Bestil haply together';?></a><!-- Bestil haply together-->
                                <?php }?>
                            </div>
                        </div>

                        <div class="price-bx-info">
                            <p><?php echo get_sub_field('textarea');?> </p>
                            <!-- <span class="slide-accordian"><i class="fa-solid fa-magnifying-glass"></i></span> -->
                        </div>

                        <ul>
                          <?php
                            if( have_rows('tool') ):
                                // Loop through rows.
                            while( have_rows('tool') ) : the_row();
                            ?>
                            <li><?php $list_url= get_sub_field('url');?>
                            
                                <a href="javascript:void(0)">
                                <?php echo get_sub_field('heading');?>
                                <?php  $tooltip = get_sub_field('message');
                                    if($tooltip){?>
                                	<span class="toltip">  
                                   
                                    <?php $baseurlup=wp_upload_dir()?>
                                    
                                    <img src="<?php echo get_template_directory_uri()?>/assets/img/<?php echo THEME_NAME == 'black' ? 'info1.svg' : 'info.svg' ?>" alt="i" class="img-fluid img-info">

                                         </span>
                                    
                                        <?php  }?>
                                        </a>
                                        <?php 
                                    if($tooltip !== ''):?>
                                   
                                    <span class="toltipBx">
                                        <?php echo $tooltip?>
                                    </span>
                                <?php endif;?> 
                                    
                                    
                                
                              
                                    
                                                      
                            </li>
                            <?php endwhile; endif;?>              
                        </ul>
                    </div>
                </div>
                <?php          
                    endwhile; endif;?>
                <div class="custom-hideShow">
                    <a href="javascript:;" class="btn custom-btn" id="toggleButton">Vis flere funktioner</a>
                </div>

                
            </div>
        </div>
    </section>

    <?php get_footer();?>