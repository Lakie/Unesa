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
                $this.find('.hide-form-success').append('<div class="sending"></div>');
            }
            // post-submit callback
            function showResponseAll(responseText, statusText, xhr, $form) {
                if ($this.find('.formError').is(":visible")) {
                    $this.find('.sending').remove();
                } else {
					$this[0].reset();
                    $this.find('.hide-form-success').slideUp();//.delay(4000).slideDown();
                    $this.find('.sending').remove();
                    var response=$(responseText);
                    $this.find('.hide-form-success').after('<div class="sys-messages"></div>');
                    $this.find('.sys-messages').html(response.find('.response-form').parent().html());
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
    $('#contact-msg').sendForm({
        successTitle: "", // Переопределяет стандартный вывод заголовка после отправки формы
        successText: "Спасибо за ваше обращение." // Переопределяет стандартный вывод текста после отправки формы
    });
}); // end ready

