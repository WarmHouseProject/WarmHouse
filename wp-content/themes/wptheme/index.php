<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<div class="services">
    <div class="container">
        <div class="services-top heading">
            <h2>им нужна ваша помощь</h2>
        </div>
        <div class="services-bottom">
            <div class="add_button">
                <a href="../child_form"><span class="label label-primary">Добавить запись</span></a>
            </div>
            <div class="services-one">
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="<?php echo get_template_directory_uri(); ?>/images/s-1.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="<?php echo get_template_directory_uri(); ?>/images/s-2.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="<?php echo get_template_directory_uri(); ?>/images/s-3.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="<?php echo get_template_directory_uri(); ?>/images/s-4.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="services-two">
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="<?php echo get_template_directory_uri(); ?>/images/s-5.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="<?php echo get_template_directory_uri(); ?>/images/s-6.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="<?php echo get_template_directory_uri(); ?>/images/s-7.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="<?php echo get_template_directory_uri(); ?>/images/s-8.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<!--services-end-->

<?php get_footer(); ?>
