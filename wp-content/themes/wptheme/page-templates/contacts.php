<?php
/*
Template Name: Contacts Form
*/
    require_once(ABSPATH . WPINC . '/lib/utils/class-email-utils.php');
    require_once(ABSPATH . WPINC . '/lib/utils/class-recaptcha-utils.php');

    $emailSenderURL = "/email-sender.php";

    get_header();
?>
<div class="contacts-form">
    <div class="container">
        <div class="row">
            <div class="contact-info col-md-7">
                <div class="text-info">
                    <div class="main-text-info">
                        <div class="col-md-12 address-left">
                            <div class="address-left-content">
                                <span class="glyphicon glyphicon-map-marker"></span>
                                <p>Адрес: г. Йошкар-Ола, проспект Ленинский, д. 21, оф. 25</p>
                            </div>
                        </div>
                        <div class="col-md-12 address-left address-middle">
                            <div class="address-middle-content">
                                <span class="glyphicon glyphicon-earphone" style="color:#000"></span>
                                <p>Телефон: +7 8362 43 43 19</p>
                            </div>
                        </div>
                        <div class="col-md-12 address-left address-right">
                            <div class="address-right-content">
                                <span class="glyphicon glyphicon-envelope"></span>
                                <p>
                                    E-Mail:
                                    <script type="text/javascript">//
                                        // <![CDATA[
                                        function gtfef(pe){return pe.replace(/[a-zA-Z]/g, function (m){return String.fromCharCode((m <= "Z" ? 210 : 3) >= (m = m.charCodeAt(0) + 41) ? m : m-46);})}document.write ('<a class="mailto"  href="mailto:' + gtfef('CLhmnB.sfijQmiP@PfsijO.Iz') + '">' + gtfef('CLhmnB.sfijQmiP@PfsijO.Iz') + '</a>');//]]>
                                    </script>
                                </p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="full-text-info">
                        <h2>Контактная информация</h2>
                        <table>
                            <tr>
                                <td><label>Полное наименование: </label></td>
                                <td><span>Благотворительный фонд помощи детям "Лучик Надежды"</span></td>
                            </tr>
                            <tr>
                                <td><label>ИНН: </label></td>
                                <td><span>1215192745</span></td>
                            </tr>
                            <tr>
                                <td><label>Юридический адрес: </label></td>
                                <td><span>г. Йошкар-Ола, проспект Ленинский, дом 21</span></td>
                            </tr>
                            <tr>
                                <td><label>Почтовый адрес: </label></td>
                                <td><span>г. Йошкар-Ола, проспект Ленинский, дом 21, офис 25</span></td>
                            </tr>
                            <tr>
                                <td><label>Контактный телефон: </label></td>
                                <td><span>+7 8362 43-43-19</span></td>
                            </tr>
                            <tr>
                                <td><label>Контактный e-mail: </label></td>
                                <td><span><script type="text/javascript">//
                                            // <![CDATA[
                                            function gtfef(pe){return pe.replace(/[a-zA-Z]/g, function (m){return String.fromCharCode((m <= "Z" ? 210 : 3) >= (m = m.charCodeAt(0) + 41) ? m : m-46);})}document.write ('<a class="mailto"  href="mailto:' + gtfef('CLhmnB.sfijQmiP@PfsijO.Iz') + '">' + gtfef('CLhmnB.sfijQmiP@PfsijO.Iz') + '</a>');//]]>
                                </script></span></td>
                            </tr>
                        </table>
                        <h2>Банковские реквизиты</h2>
                        <table>
                            <tr>
                                <td><label>Наименование банка: </label></td>
                                <td><span>ПАО «Норвик Банк»</span></td>
                            </tr>
                            <tr>
                                <td><label>р/счет: </label></td>
                                <td><span>40703 810 8 0056 0146 114</span></td>
                            </tr>
                            <tr>
                                <td><label>БИК: </label></td>
                                <td><span>043304728</span></td>
                            </tr>
                            <tr>
                                <td><label>ИНН: </label></td>
                                <td><span>4346001485</span></td>
                            </tr>
                            <tr>
                                <td><label>КПП: </label></td>
                                <td><span>434501001</span></td>
                            </tr>
                            <tr>
                                <td><label>К/счет: </label></td>
                                <td><span>30101 810 3 0000 0000 728</span></td>
                            </tr>
                            <tr>
                                <td><label>ОГРН: </label></td>
                                <td><span>1024300004739</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="map">
                    <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=AjQJ-SA-CG5M72uIGoWAHliLyCgBm3Y4&width=100%&height=400&lang=ru_RU&sourceType=constructor"></script>
                </div>
            </div>
            <div class="col-md-offset-1 col-md-4">
                <div class="mail-form-container">
                    <form class="mail-form" role="form" action="<?= esc_url( home_url( $emailSenderURL ) ); ?>">
                        <div class="col col-md-12">
                            <h2>Спрашивайте, обращайтесь</h2>
                            <div class="alert alert-danger collapse" style="display: none;" id="wrong_email_error_block">
                                <span class="glyphicon glyphicon-remove"></span>
                                <p>Введите правильный email адрес</p>
                            </div>
                            <div class="alert alert-danger collapse" style="display: none;" id="no_email_error_block">
                                <span class="glyphicon glyphicon-remove"></span>
                                <p>Введите свой email адрес, чтобы мы смогли вам ответить</p>
                            </div>
                            <div class="alert alert-danger collapse" style="display: none;" id="no_message_error_block">
                                <span class="glyphicon glyphicon-remove"></span>
                                <p>Введите своё сообщение</p>
                            </div>
                            <div class="alert alert-danger collapse" style="display: none;" id="internal_failure_block">
                                <span class="glyphicon glyphicon-wrench"></span>
                                <p>Внутренняя ошибка сайта. Не удалось отправить сообщение. Попробуйте отправить своё сообщение через несколько минут.</p>
                            </div>
                            <div class="alert alert-success collapse" style="display: none;" id="captcha_check_error_block">
                                <span class="glyphicon glyphicon-user"></span>
                                <p>Чтобы завершить отправку сообщения, пожалуйста, подтвердите, что вы не робот</p>
                            </div>
                            <div class="alert alert-success collapse" style="display: none;" id="success_block">
                                <span class="glyphicon glyphicon-ok"></span>
                                <p>Ваше сообщение успешно отправлено</p>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Ваше имя</label>
                            <input type="text" class="form-control" name="user_name">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Ваш e-mail</label><span class="required-field-mark"> *</span>
                            <input type="text" class="form-control" name="user_email">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Ваше сообщение</label><span class="required-field-mark"> *</span>
                            <textarea class="form-control" rows="10" name="user_message"></textarea>
                        </div>
                        <div class="clearfix"></div>
                        <script src='https://www.google.com/recaptcha/api.js?render=explicit'></script>
                        <div class="recaptcha-container collapse"></div>
                        <div><button type="submit" class="btn btn-primary btn-send-email">Отправить сообщение</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(registerSubmitHandler());
        function registerSubmitHandler()
        {
            var $form = $(".mail-form");
            $form.submit(function(){
                var request = $.post($form.attr('action'), $form.serialize(), function(response){
                    showError(response);
                });
                return false;
            });
        }

        function showError(errorMessage)
        {
            showCaptcha(errorMessage);
            showErrorMessage(errorMessage);
        }

        var reCaptchaIsNeededToLoad = false;
        function showCaptcha(errorMessage)
        {
            reCaptchaIsNeededToLoad = (errorMessage == "<?= ReCaptchaUtils::ERR_BOT_CHECK_FAILED ?>");
            invalidateCaptchaPanel();
        }

        var firstAlert = true;
        function showErrorMessage(errorMessage)
        {
            var wrongEmailErrorMessageBlock      = $('#wrong_email_error_block');
            var noEmailErrorMessageBlock         = $('#no_email_error_block');
            var noMessageErrorMessageBlock       = $('#no_message_error_block');
            var internalFailureErrorMessageBlock = $('#internal_failure_block');
            var successMessageBlock              = $('#success_block');
            var captchaCheckErrorBlock           = $('#captcha_check_error_block');

            const FADE_DURATION = 400;

            $(".alert").each(function (){
                $(this).fadeOut(FADE_DURATION);
            });

            setTimeout(function() {
                switch (errorMessage)
                {
                    case "<?= EmailUtils::ERR_NO_EMAIL ?>":
                        SlideDownForFirst(noEmailErrorMessageBlock, FADE_DURATION);
                        noEmailErrorMessageBlock.fadeIn(FADE_DURATION);
                        break;
                    case "<?= EmailUtils::ERR_WRONG_EMAIL ?>":
                        SlideDownForFirst(wrongEmailErrorMessageBlock, FADE_DURATION);
                        wrongEmailErrorMessageBlock.fadeIn(FADE_DURATION);
                        break;
                    case "<?= EmailUtils::ERR_NO_MESSAGE ?>":
                        SlideDownForFirst(noMessageErrorMessageBlock, FADE_DURATION);
                        noMessageErrorMessageBlock.fadeIn(FADE_DURATION);
                        break;
                    case "<?= EmailUtils::ERR_UNABLE_TO_SEND ?>":
                        SlideDownForFirst(internalFailureErrorMessageBlock, FADE_DURATION);
                        internalFailureErrorMessageBlock.fadeIn(FADE_DURATION);
                        break;
                    case "<?= EmailUtils::ERR_SUCCESS ?>":
                        SlideDownForFirst(successMessageBlock, FADE_DURATION);
                        successMessageBlock.fadeIn(FADE_DURATION);
                        break;
                    case "<?= ReCaptchaUtils::ERR_BOT_CHECK_FAILED ?>":
                        SlideDownForFirst(captchaCheckErrorBlock, FADE_DURATION);
                        captchaCheckErrorBlock.fadeIn(FADE_DURATION);
                        break;
                }
            }, FADE_DURATION);
        }

        function SlideDownForFirst(alertBlock, slideDuration)
        {
            if (firstAlert)
            {
                firstAlert = false;
                alertBlock.slideDown(slideDuration);
            }
        }

        window.addEventListener("load", invalidate);
        window.addEventListener("resize", invalidate);

        function invalidate()
        {
            invalidateSendMessageErrorPanel();
            invalidateCaptchaPanel();
            //invalidateContactInfoPanel();
        }

        function invalidateSendMessageErrorPanel()
        {
            $(".alert").each(function (){
                var container = $(this);
                var icon = container.find("span");
                var text = container.find("p");

                icon.removeAttr("style");
                text.removeAttr("style");

                var prevVisibilityState = container.is(":visible");
                container.show();
                var deltaIcon = (container.height() - icon.height()) / 2;
                var deltaText = (container.height() - text.height()) / 2;
                prevVisibilityState ? container.show() : container.hide();

                if (samePositionFromTop(icon, text))
                {
                    text.css("padding-top", deltaText);
                    icon.css("padding-top", deltaIcon);
                }
            });
        }

        function invalidateCaptchaPanel()
        {
            if (!reCaptchaIsNeededToLoad)
            {
                var reCaptchaContainer = $(".recaptcha-container")
                reCaptchaContainer.slideUp("slow");
                deleteReCaptcha();
                return;
            }

            var newSize = "normal";
            var prevSize = getReCaptchaContainerSizeAttribute();
            if ($(window).width() < 350)
            {
                newSize = "compact";
            }

            if (newSize != prevSize)
            {
                invalidateReCaptcha(newSize);
                setReCaptchaContainerSizeAttribute(newSize);
            }
        }

        function getReCaptchaContainerSizeAttribute()
        {
            var captchaPanel = $(".g-recaptcha");
            return captchaPanel.attr("data-size");
        }

        function setReCaptchaContainerSizeAttribute(value)
        {
            var captchaPanel = $(".g-recaptcha");
            captchaPanel.attr("data-size", value);
        }

        function invalidateReCaptcha(size)
        {
            recreateReCaptcha();
            renderReCaptcha(size);
        }

        function renderReCaptcha(size)
        {
            var captchaPanel = document.getElementsByClassName("g-recaptcha")[0];
            grecaptcha.render(captchaPanel, {"sitekey": "<?= ReCaptcha::PUBLIC_KEY ?>", "size": size});
        }

        function recreateReCaptcha()
        {
            deleteReCaptcha();
            var reCaptchaContainer = $(".recaptcha-container");
            reCaptchaContainer.append('<div class="g-recaptcha form-group"></div>');

            reCaptchaContainer.slideDown("slow");
        }

        function deleteReCaptcha()
        {
            var reCaptchaContainer = $(".recaptcha-container");
            reCaptchaContainer.empty();
        }

        function invalidateContactInfoPanel()
        {
            var leftCell   = document.getElementsByClassName("address-left")[0];
            var middleCell = document.getElementsByClassName("address-middle")[0];
            var rightCell  = document.getElementsByClassName("address-right")[0];

            var leftCellContent   = document.getElementsByClassName("address-left-content")[0];
            var middleCellContent = document.getElementsByClassName("address-middle-content")[0];
            var rightCellContent  = document.getElementsByClassName("address-right-content")[0];

            removeStyle([leftCell, leftCellContent, middleCell, middleCellContent, rightCell, rightCellContent]);

            var leftCellHeight   = leftCell.offsetHeight;
            var middleCellHeight = middleCell.offsetHeight;
            var rightCellHeight  = rightCell.offsetHeight;

            var leftCellContentHeight   = leftCellContent.offsetHeight;
            var middleCellContentHeight = middleCellContent.offsetHeight;
            var rightCellContentHeight  = rightCellContent.offsetHeight;

            var maxHeight = getMax([leftCellHeight, middleCellHeight, rightCellHeight]);
            setHeight([leftCell, middleCell, rightCell], maxHeight);

            var deltaLeft = (maxHeight - leftCellContentHeight) / 2 - leftCellContent.offsetTop;
            var deltaMiddle = (maxHeight - middleCellContentHeight) / 2 - middleCellContent.offsetTop;
            var deltaRight = (maxHeight - rightCellContentHeight) / 2 - middleCellContent.offsetTop;

            setPaddingTop(leftCellContent, deltaLeft);
            setPaddingTop(middleCellContent, deltaMiddle);
            setPaddingTop(rightCellContent, deltaRight);
        }

        function samePositionFromTop(jqueryObject1, jqueryObject2)
        {
            var precision = 5;
            return Math.abs(jqueryObject1.position().top - jqueryObject2.position().top) < precision;
        }

        function removeStyle(domElArr)
        {
            for (var i = 0; i < domElArr.length; ++i)
            {
                domElArr[i].removeAttribute("style");
            }
        }

        function getMax(arr)
        {
            var max = arr[0];
            for (var i = 1; i < arr.length; ++i)
            {
                max = (arr[i] > max) ? arr[i] : max;
            }
            return max;
        }

        function setHeight(domElArr, height)
        {
            for (var i = 0; i < domElArr.length; ++i)
            {
                domElArr[i].style.height = height + "px";
            }
        }

        function setPaddingTop(domEl, value)
        {
            domEl.style.paddingTop = value + "px";
        }
    </script>
</div>
<?php get_footer(); ?>
