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

    get_header();
?>

<div class="information_block grey_block">
    <div class="main_header">
        <div class="col-md-2 logo_container">
            <img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="" />
        </div>
        <div class="col-md-10">
            <h2 class="head blue_text logo_header">Благотворительный фонд помощи детям «Лучик Надежды»</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="text_block">
        <span class="line_begin">Фонд</span> — это наша искренняя попытка оказать помощь тяжело больным детям, детям-сиротам, детям-инвалидам, малообеспеченным семьям и многодетным семьям, попавшим в трудную жизненную ситуацию. Фонд создан специально для того, чтобы тяжелобольные дети получили шанс на выздоровление - шанс, который поможет им обрести полноценно жить, получить возможность расти, развиваться, жить среди нас, радуя своих родных и принося пользу обществу. Мы хотим подарить прекрасное и здоровое детство. Мы пытаемся сделать все, чтобы эти маленькие люди не понесли дальше по жизни обиду на большой мир, выбросивший их на обочину в самом начале жизненного пути.
        <span class="line_begin">Благотворительная</span> деятельность - возможность для детей получить материальную поддержку в оплате дорогостоящего лечения; это - возможность для взрослых людей выразить делом свою готовность к сопереживанию; это шанс для сильных духом семей в преодолении детского недуга; это шанс для всех нас в реализации себя, как благотворителей.
    </div>
</div>
<div class="information_block white_block">
    <h2 class="head orange_text">Наша миссия</h2>
    <div class="col-md-4">
        <div class="marker_block">
            <div class="marker_image blue_orange">
                <img src="<?php echo get_template_directory_uri(); ?>/images/sev-icons-1-1.png" alt="" />
            </div>
        </div>
        <div class="text_block">
            <span class="line_begin_middle">Россия</span> занимает одно из первых мест в мире по количеству брошенных детей. Мы не можем стоять в стороне. Мы будем делать все, что в наших силах, чтобы подарить детям радость, заботу и тепло.
        </div>
    </div>
    <div class="col-md-4">
        <div class="marker_block">
            <div class="marker_image second blue_orange">
                <img src="<?php echo get_template_directory_uri(); ?>/images/sev-icons-2-1.png" alt="" />
            </div>
        </div>
        <div class="text_block">
            <span class="line_begin_middle">Будем</span> содействовать, чтобы как можно больше детей обрели право на жизнь в любящей семье, право на образование и всестороннее развитие, право на полноценное участие в жизни общества.
        </div>
    </div>
    <div class="col-md-4">
        <div class="marker_block">
            <div class="marker_image third blue_orange">
                <img src="<?php echo get_template_directory_uri(); ?>/images/sev-icons-3-1.png" alt="" />
            </div>
        </div>
        <div class="text_block">
            <span class="line_begin_middle">Мы</span> будем реализовывать общественные интересы в сфере защиты прав детей, вносить вклад в построение гражданского общества путем предоставления каждому человеку возможности проявить свою гражданскую позицию через участие в деятельности фонда.
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="information_block grey_block">
    <h2 class="head blue_text">Основные задачи Фонда</h2>
    <div class="col-md-6">
        <ul class="text_block">
            <li><span class="marker_middle list orange">1</span>привлечение спонсорской и благотворительной помощи от организаций и частных лиц</li>
            <li><span class="marker_middle list orange">2</span>содействие разработке и реализации некоммерческих проектов, программ в области здравоохранения</li>
            <li><span class="marker_middle list orange">3</span>оказание благотворительной помощи в области здравоохранения в соответствии с основной целью фонда</li>
            <li><span class="marker_middle list orange">4</span>содействие организации лечебно-диагностической помощи тяжело больным детям, детям-инвалидам и членам их семей</li>
        </ul>
    </div>
    <div class="col-md-6">
        <ul class="text_block">
            <li><span class="marker_middle list orange">5</span>проведение благотворительных мероприятий</li>
            <li><span class="marker_middle list orange">6</span>содействие профилактике, охране, восстановлению здоровья детей, пропаганда здорового образа жизни и улучшения морально-психологического климата в обществе</li>
            <li><span class="marker_middle list orange">7</span>улучшение имиджа бизнес структур, оказывающих благотворительную помощь</li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>

<?php get_footer(); ?>
