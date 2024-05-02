<?php /* Template Name: kontakt page */ get_header();?>
<section class="heading">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="about_sec">
                	<div class="line demo"></div>
                    <!-- <span class="line">kjcvklsdfjgkljsdfklgkldfjg</span> -->

                    <h1 class="h1"><?php the_title()?></h1>
                    <p class="wow slideInUp"><?php the_field('heading_sub_text')?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="main">
	<div class="container-fluid">
<?php echo the_content()?>
</div>
</section>
<?php /*
<section class="heading">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="about_sec">
                	<div class="line "></div>
                    <h1 class="h1">Kontakt</h1>
                    <p class="wow slideInUp">Lorem ipsum dolor sit amet, 								consetetur sadipscing elitr, sed diam nonumy eirmod tempor<br>  							invidunt ut labore et dolore.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="module-right">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="content-left">
                	<h2>Nysgerrig? Vi er lige her.</h2>
                    <div class="contact-sec">
                        <p class="fw-bold">Generelle henvendelser</p>
                        <a href="mailto:hello@haply.eu">hello@haply.eu</a>
                    </div>
                    <div class="contact-sec">
                        <p class="fw-bold">Økonomi</p>
                        <a href="mailto:accounts@haply.eu">accounts@haply.eu</a>
                    </div>
                    <div class="contact-sec">
                        <p class="fw-bold">Support</p>
                        <a href="mailto:support@haply.eu">support@haply.eu</a>
                        <p>+45 7733 2240</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="img-wrap">
                	<img src="http://devdocs.haply.eu/wp-content/uploads/2024/03/contact-1.png" alt="contact-image" >
                </div>
            </div>
        </div>
    </div>
</section>

<section class="module-supporters">
	<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-left">
                	<h2>Vores supportere tager hånd om dig.<br> Fordi vi er bedre sammen.</h2>
                 </div>
            </div>
            
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="supporters">
                	<div class="img-wrap">
                		<img src="http://devdocs.haply.eu/wp-content/uploads/2024/03/contact-1.png" alt="contact-image" >
                	</div>
                    <div class="user-info">
                        <p class="fw-bold">Klaes Møller</p>
                        <p>Head of Development</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="supporters">
                	<div class="img-wrap">
                		<img src="http://devdocs.haply.eu/wp-content/uploads/2024/03/contact-1.png" alt="contact-image" >
                	</div>
                    <div class="user-info">
                        <p class="fw-bold">Jack Andersen</p>
                        <p>IT-procesoptimerings- konsulent</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="supporters">
                	<div class="img-wrap">
                		<img src="http://devdocs.haply.eu/wp-content/uploads/2024/03/contact-1.png" alt="contact-image" >
                	</div>
                    <div class="user-info">
                        <p class="fw-bold">Astrid Hørby</p>
                        <p> Aller GIS-konsulent</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="supporters">
                	<div class="img-wrap no-image">
                		<span>a</span>
                	</div>
                    <div class="user-info">
                        <p class="fw-bold">Kristina Daniliauskaite </p>
                        <p>IT-produktejer og UX-specialist</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="supporters">
                	<div class="img-wrap">
                		<img src="http://devdocs.haply.eu/wp-content/uploads/2024/03/contact-1.png" alt="contact-image" >
                	</div>
                    <div class="user-info">
                        <p class="fw-bold">Klaes Møller</p>
                        <p>Head of Development</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="supporters">
                	<div class="img-wrap no-image">
                		<span>m</span>
                	</div>
                    <div class="user-info">
                        <p class="fw-bold">Kristina Daniliauskaite </p>
                        <p>IT-produktejer og UX-specialist</p>
                    </div>
                </div>
            </div>
             
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="supporters">
                	<div class="img-wrap">
                		<img src="http://devdocs.haply.eu/wp-content/uploads/2024/03/contact-1.png" alt="contact-image" >
                	</div>
                    <div class="user-info">
                        <p class="fw-bold">Astrid Hørby</p>
                        <p> Aller GIS-konsulent</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="supporters">
                	<div class="img-wrap no-image">
                		<span>j</span>
                	</div>
                    <div class="user-info">
                        <p class="fw-bold">Kristina Daniliauskaite </p>
                        <p>IT-produktejer og UX-specialist</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<section class="module-right">
	<div class="container-fluid">
        <div class="row">
        
            <div class="col-lg-6">
                <div class="img-wrap">
                	<img src="http://devdocs.haply.eu/wp-content/uploads/2024/03/contact-1.png" alt="contact-image" >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="content-left">
                	<h2>Bee haply</h2>
                    <p>haply together Pa nos nonserc imagnias ea dolupietur mag-nisFuga. Nam et optio. Nam intibus ad quam animaxi minus, iuntoriandam sumendus aperum nia cum hiliquos molo etusdae sequam nates estior rerisci litate veri di ipici dolupti tem sit vel il magnist officti occab iderum ne adis doluptasitis ut que nus.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php */?>
<?php get_footer();?>