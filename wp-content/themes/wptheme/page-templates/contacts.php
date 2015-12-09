<?php
/*
Template Name: Contacts Form
*/

    get_header();
?>
<div class="contacts-form">
    <div class="container">
        <div class="mail-form-container">
        <form class="mail-form" role="form">
            <div class="col">
                <div class="col-md-6 form-group">
                        <label>Ваше имя</label>
                        <input type="text" class="form-control">
                </div>
                <div class="col-md-6 form-group">
                        <label>Ваш e-mail</label>
                        <input type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-12 form-group">
                <label>Ваше сообщение</label>
                <textarea class="form-control" rows="10"></textarea>
            </div>
            <button type="submit" class="btn btn-default send-email">Послать сообщение</button>
            <div class="clearfix"></div>
        </form>
        </div>
        <div class="contact-info" style="width:100%;">
            <div class="text-info">
                <div class="main-text-info">
                    <div class="col-md-4 address-left">
                        <div class="address-left-content">
                            <span class="glyphicon glyphicon-map-marker"></span>
                            <p>Адрес: г. Йошкар-Ола, проспект Ленинский, д. 21, оф. 25</p>
                        </div>
                    </div>
                    <div class="col-md-4 address-left address-middle">
                        <div class="address-middle-content">
                            <span class="glyphicon glyphicon-earphone" style="color:#000"></span>
                            <p>Телефон: +7 8362 43 43 19</p>
                        </div>
                    </div>
                    <div class="col-md-4 address-left address-right">
                        <div class="address-right-content">
                            <span class="glyphicon glyphicon-envelope"></span>
                            <p>E-Mail: samle@luchik.com</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="full-text-info">
                    <button class="btn btn-default btn-xs btn-full-info" id="showFullInfoButton">Подробнее</button>
                    <div class="collapse" id="fullInfo">
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
                                <td><span>sample@luchik.com</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="map">
                <script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=jvLHUi_7jPxGA7lLGvNI4TqFpFtANSYb&width=100%&height=399&lang=ru_RU&sourceType=constructor"></script>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            $('#showFullInfoButton').click(function(){
                $('#fullInfo').slideToggle("slow");
            });
        });
    </script>
    <script>
        window.addEventListener("load", invalidateContactInfoPanel);
        window.addEventListener("resize", invalidateContactInfoPanel);

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
