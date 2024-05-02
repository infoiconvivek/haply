<?php $host = $_SERVER['HTTP_HOST'];
$uploads = wp_upload_dir();
$upload_path = $uploads['baseurl'];

?>
<footer class="footer">
    <div class="container-fluid">
        <div class="row align-items-center">
			<div class="text-start col-xl-1 col-lg-1">
                    <div class="text-lg-start text-center footer-logo">
                        <?php
                            if ($host == 'devhaplywp.it34.com') {?>
                                <a href="<?php if(ICL_LANGUAGE_CODE=='en'){ echo WP_HOME; }else if(ICL_LANGUAGE_CODE=='da'){ echo WP_HOME;}?>" class="logo-text">
                                    <img src="<?php echo get_theme_mod( 'footer_logo' ) ;?>" alt="footer_logo">
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo site_url(); ?>" class="logo-text"><img src="<?php echo $upload_path . FOOTER_LOGO; //get_theme_mod('second_logo');?>" ></a>
                        <?php } ?>
                            </div>
                </div>

                <div class="col-xl-10 col-lg-10 m-lg-0 mt-md-3 mb-md-3 col-md-12">
                    <div class="footer-logo">
                            
                        <?php if(THEME_NAME=='green'){?>
                            <ul>
                                <li><a href="#"><?php echo get_theme_mod( 'footer_address' ) ;?></a></li>
                                <li><a href="#"><?php esc_html_e( 'CVR-no', 'HaplyWP' )?>: <?php echo get_theme_mod( 'footer_cvr' ) ;?></a></li>
                                <li><a href="tel:<?php echo get_theme_mod( 'footer_tlf' ) ;?>"><?php esc_html_e( 'Tel', 'HaplyWP' )?>: <?php echo get_theme_mod( 'footer_tlf' ) ;?></a></li>
                                <li><a href="mailto:<?php echo get_theme_mod( 'footer_email' ) ;?>"><?php esc_html_e( 'E-mail', 'HaplyWP' )?>: <?php echo get_theme_mod( 'footer_email' ) ;?></a></li>
                                <li><a href="mailto:<?php echo get_theme_mod( 'footer_faktura' ) ;?>"><?php esc_html_e( 'Invoice', 'HaplyWP' )?>: <?php echo get_theme_mod( 'footer_faktura' ) ;?></a></li>
                            </ul>
                            <?php }else{?>
                            
                            <ul>
                                <li><a href="#"><?php echo get_theme_mod( 'geonote_footer_address' ) ;?></a></li>
                                <li><a href="#"><?php esc_html_e( 'CVR-no', 'HaplyWP' )?>: <?php echo get_theme_mod( 'geonote_footer_cvr' ) ;?></a></li>
                                <li><a href="tel:<?php echo get_theme_mod( 'geonote_footer_tlf' ) ;?>"><?php esc_html_e( 'Tel', 'HaplyWP' )?>: <?php echo get_theme_mod( 'geonote_footer_tlf' ) ;?></a></li>
                                <li><a href="mailto:<?php echo get_theme_mod( 'geonote_footer_email' ) ;?>"><?php esc_html_e( 'E-mail', 'HaplyWP' )?>: <?php echo get_theme_mod( 'geonote_footer_email' ) ;?></a></li>
                                <li><a href="mailto:<?php echo get_theme_mod( 'geonote_footer_faktura' ) ;?>"><?php esc_html_e( 'Invoice', 'HaplyWP' )?>: <?php echo get_theme_mod( 'geonote_footer_faktura' ) ;?></a></li>
                            </ul>
                        
                        <?php }?>
                    </div>
                    <div class="footer-menu">
                        <?php 
                            if(THEME_NAME=='green'){
                                $consult_menu = wp_nav_menu(array(
                                                'theme_location' => 'footer-menu',
                                                'menu_id' => '1',
                                                'menu_class' => '',
                                                'echo' => false
                                            )
                                        );
                                        $consult_menu = str_replace('menu-item', 'nav-item', $consult_menu);
                                        echo $consult_menu;
                            }else{
                                $consult_menu = wp_nav_menu(array(
                                                'theme_location' => 'footer-menu-geonote',
                                                'menu_id' => '1',
                                                'menu_class' => '',
                                                'echo' => false
                                            )
                                        );
                                        $consult_menu = str_replace('menu-item', 'nav-item', $consult_menu);
                                        echo $consult_menu;
                            
                            }
                        ?>
                    </div>
                </div>
                
                <div class="col-xl-1 col-lg-1 text-lg-end text-center mt-2">
                    <a class="linkedin" href="<?php echo get_theme_mod( 'social_linkedin' ) ;?>" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>



        </div>
    </div>
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://johannburkard.de/resources/Johann/jquery.highlight-4.js"></script>
    <script src="https://unpkg.com/sectionloaded@5/imagesloaded.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="<?php echo bloginfo('template_url');?>/assets/js/custom.js"></script>

   
    <?php wp_footer();?>

    <script type = "text/javascript" language = "javascript">

        /* catogery filter */
        $(function () {

            $("#how_keyword").on("click", function (a) {
                $("#how_to_datafetch").addClass("on");
                 $(".custom_search_dropdown").addClass("on");
                a.stopPropagation()
            });
            $(document).on("click", function (a) {
                if ($(a.target).is("#how_to_datafetch") === false) {
                    $("#how_to_datafetch").removeClass("on");
                }
                $(".custom_search_dropdown").removeClass("on");
            });
        });

        $('#header_search form').addClass('search-form');

         /* gt select lang text replace */
        $(document).ready(function(){
            $("body.search-no-results, body.search-results").removeClass("search");

            var i =1;
            $('#detail-wrap1>p').each(function(){
                $(this).attr('id',`paragraph${i}`);
                i++;
            });
        });

        $(document).ready(function(){
            var i=1;
            $('div#home-content-wrap1 p').each(function(){
                $(this).attr('id',`paragraph${i}`);
                i++;
            });

            $('.show-more-button').click(function(){
                $('.text_content').toggleClass('show');
            });
        });
         /* Hide clear button (if present) and adjust the search input field */        
        jQuery(document).ready(function($) {
            if ($('.search-results').length) {
                $('input.is-search-input').val('');
            }
        });


        document.addEventListener("DOMContentLoaded", function() {
            const leftImgSections = document.querySelectorAll('section.leftImg');

            leftImgSections.forEach(function(leftImgSection) {
                const image = leftImgSection.querySelector('img');
                console.log(image);
                const imageHeight = image.clientHeight;
                console.log("Image-Height : " + imageHeight);
                const textContent = leftImgSection.querySelector('.text_content');
                console.log("Text content : " + textContent);

                const truncateText = function() {
                    const computedStyle = window.getComputedStyle(textContent);
                    console.log("computedStyle : " + computedStyle);
                    const lineHeight = parseInt(computedStyle.getPropertyValue('line-height'));
                    console.log("lineheight : " + lineHeight);
                    const maxLines = Math.max(0, Math.floor(imageHeight / lineHeight) - 5);
                    console.log("maxlines : " + maxLines);
                    textContent.style.webkitLineClamp = maxLines;
                   textContent.style.overflow = 'hidden';
                    textContent.style.display = '-webkit-box';
                    textContent.style.webkitBoxOrient = 'vertical';
                };

                truncateText();
                window.addEventListener('resize', truncateText);
            });
        });

       
        
    </script>

    <?php if(ICL_LANGUAGE_CODE=='en'){?>
        <script>
            $('.is-search-input').attr('placeholder', 'What are you looking for?');
        </script>
    <?php }?>

</body>

</html>