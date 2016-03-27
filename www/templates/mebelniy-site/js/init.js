// ======= Ajax Submit Form Plugin =======
(function($) {
    jQuery.fn.sendForm = function(options) {
        options = $.extend({
            successTitle: "Ваше сообщение успешно отправлено!",
            successText: "Мы свяжемся с Вами в самое ближайшее время"
        }, options);

        var make = function() {
            var optionsForm = {
                beforeSubmit: showRequest,
                success: showResponseAll,
                //clearForm: true,
                //resetForm: true
            };
            // bind to the form's submit event 
            $(this).submit(function() {
                $(this).ajaxSubmit(optionsForm);
                return false;
            });
            var $this = $(this);
            // pre-submit callback 
            function showRequest(formData, jqForm, options) {
                $this.find('.rsform-submit-button').addClass('sending').text("Отправка....");
            }
            // post-submit callback
            function showResponseAll(responseText, statusText, xhr, $form) {
                if ($this.find('.formError').is(":visible")) {
                    $this.find('.rsform-submit-button').removeClass('sending').text("Отправить");
                } else {
					$this[0].reset();
                    $this.find('.hide-form-success').slideUp();//.delay(4000).slideDown();
                    $this.find('.rsform-submit-button').removeClass('sending').text("Отправить");
                    $this.find('.hide-form-success').after('<div class="sys-messages"></div>');
                    $this.find('.sys-messages').html('<h4 class="success-title">' + options.successTitle + '</h4><p class = "success-text" >' + options.successText + '</p>');
//                    setTimeout(function() {
//                        $this.find('.sys-messages').fadeOut().delay(2000).remove();
 //                   }, 4000);
                }
            }
        }
        return this.each(make);
    };
})(jQuery);

jQuery(document).ready(function($) {
    $('#zamer').sendForm({
        successTitle: "", // Переопределяет стандартный вывод заголовка после отправки формы
//        successText: "Спасибо за ваше обращение." // Переопределяет стандартный вывод текста после отправки формы
    });
    $('#form-calc').sendForm({
        successTitle: "", // Переопределяет стандартный вывод заголовка после отправки формы
//        successText: "Спасибо за ваше обращение." // Переопределяет стандартный вывод текста после отправки формы
    });
    $('#zakaz-zamera').sendForm({
        successTitle: "", // Переопределяет стандартный вывод заголовка после отправки формы
//        successText: "Спасибо за ваше обращение." // Переопределяет стандартный вывод текста после отправки формы
    });
    $('#form-feedback').sendForm({
        successTitle: "", // Переопределяет стандартный вывод заголовка после отправки формы
//        successText: "Спасибо за ваше обращение." // Переопределяет стандартный вывод текста после отправки формы
    });
}); // end ready

/** =====================

Для того, чтобы форма работала нужно обрамить поля формы тегом с классом - hide-form-success:

Пример формы:

<h2 class="zayavka-service-title">{global:formtitle}</h2>
    {error}
    <div class="hide-form-success">

        <div class="form-row">
            <input value="" size="20" name="form[fio]" id="fio" placeholder="Ф.И.О*" class="inputbox rsform-input-box" type="text">
            <span id="component28" class="formNoError">Введите ваше Ф.И.О</span>
        </div>

        <div class="form-row">
            <input value="" size="20" name="form[email]" id="email" placeholder="E-mail*" class="inputbox rsform-input-box" type="text">
            <span id="component29" class="formNoError">Введите ваш e-mail</span>
        </div>

        .....   
        
    </div>
    
===================================== **/
