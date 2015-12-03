<?php
/*
Template Name: Thank You Form
*/

get_header();
?>
<div class="thank-you-form">
    <div class="container">
        <img width="90%" src="<?= get_template_directory_uri() . '/images/thank-you.png' ?>">
        <label>
            Благодарим за оказанную помощь. Ваше пожертвование совершено, и квитанция на пожертвование отправлена вам по электронной почте.
            Вы можете войти в свою учетную запись по адресу <a href="http://www.paypal.com/ru">www.paypal.com/ru</a> и просмотреть данные этой операции.
        </label>
    </div>
</div>
<?php get_footer(); ?>
