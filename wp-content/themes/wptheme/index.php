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
            <h2>Our Services</h2>
        </div>
        <div class="services-bottom">
            <div class="services-one">
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="images/s-1.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="images/s-2.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="images/s-3.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="images/s-4.jpg" alt=""/></a>
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
                        <a href="#" title="Full Image"><img src="images/s-5.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="images/s-6.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="images/s-7.jpg" alt=""/></a>
                        <div class="mask"></div>
                    </div>
                    <div class="s-btm">
                        <h4>Nulla egestas</h4>
                        <p>Donec convallis vitae mi sodales varius</p>
                    </div>
                </div>
                <div class="col-md-3 services-left">
                    <div class="view fifth-effect">
                        <a href="#" title="Full Image"><img src="images/s-8.jpg" alt=""/></a>
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
<!--best-starts-->
<div class="service-top-in">
    <div class="container">
        <h5 class="best">Aenean imperdiet enim sed</h5>
        <div class="ser-at">
            <p>Labore et dolore magnam aliquam quaerat voluptatem. ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quis autem vel eum iure.</p>
            <a href="#" class="more">MORE</a>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!--best-end-->
<!--more-starts-->
<div class="service-bottom">
    <div class="container">
        <div class="s-top heading">
            <h3>Quisque faucibus eros</h3>
        </div>
        <div class="ser-bottom">
            <div class="col-md-4 flex-in">
                <h4>Flexible</h4>
                <p>Magnam aliquam quaerat voluptatemut enim ad minima veniam, quis nostrum exercitation em ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quis autem vel.</p>
                <a href="#" class="more">MORE</a>
            </div>
            <div class="col-md-4 flex-in">
                <h4>Convenient</h4>
                <p>Magnam aliquam quaerat voluptatemut enim ad minima veniam, quis nostrum exercitation em ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quis autem vel.</p>
                <a href="#" class="more">MORE</a>
            </div>
            <div class="col-md-4 flex-in">
                <h4>Local</h4>
                <p>Magnam aliquam quaerat voluptatemut enim ad minima veniam, quis nostrum exercitation em ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur quis autem vel.</p>
                <a href="#" class="more">MORE</a>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!--more-end-->

<?php get_footer(); ?>
