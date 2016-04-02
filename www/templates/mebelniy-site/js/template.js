/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @since       3.2
 */

if (window.MooTools) {
	Element.prototype.hide = function() {
		return;
	};
}


(function($)
{
	$(document).ready(function()
	{
		if($('.showFeedback').length){
			$('.showFeedback').bind('click', function(){
				$('.gm_overlay').fadeIn(400);
				$('#myModal').animate({opacity: 1, top: '25%'}, 200);
				$('#myModal').modal({
					backdrop: false
				});
				return false;
			})
		}
		$('.close, .gm_overlay').click( function(){
			$('#myModal').animate({opacity: 0, top: '-100%'}, 200,
				function(){
					$('#myModal').hide();
					$('.gm_overlay').fadeOut(400);
				}
			);
		});

		$("#phone").mask("(999) 999-9999");
		$("#phone-f2").mask("(999) 999-9999");
		$("#phone-f3").mask("(999) 999-9999");
		$("#phone-f4").mask("(999) 999-9999");

		$(".rsform-select-box ").select2({
			minimumResultsForSearch: -1
		});
	/*	$(function () {
			$("#calc").change(function () {
				chek_option(this,'.select-arrow');
			}).change();
		});
		function chek_option(item,name) {
			var str = "";
			$(item.children).each(function () {
				if(this.selected) str += $(this).val() + " ";
			});
			$(name).html(str);
		} */



	$('*[rel=tooltip]').tooltip()

		// Turn radios into btn-group
		$('.radio.btn-group label').addClass('btn');
		$(".btn-group label:not(.active)").click(function()
		{
			var label = $(this);
			var input = $('#' + label.attr('for'));

			if (!input.prop('checked')) {
				label.closest('.btn-group').find("label").removeClass('active btn-success btn-danger btn-primary');
				if (input.val() == '') {
					label.addClass('active btn-primary');
				} else if (input.val() == 0) {
					label.addClass('active btn-danger');
				} else {
					label.addClass('active btn-success');
				}
				input.prop('checked', true);
			}
		});
		$(".btn-group input[checked=checked]").each(function()
		{
			if ($(this).val() == '') {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-primary');
			} else if ($(this).val() == 0) {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-danger');
			} else {
				$("label[for=" + $(this).attr('id') + "]").addClass('active btn-success');
			}
		});
	})
})(jQuery);