<?php
/*******************************************************************************************/
/*
/*        Web: http://www.asdesigning.com
/*        Web: http://www.astemplates.com
/*        License: GNU General Public License
/*
/*******************************************************************************************/

defined('_JEXEC') or die;

$labels_pos = $params->get('labels_pos');

?>

<script>
	<?php if( $params->get('captcha_req')==1 ) { ?>
	var RecaptchaOptions = { theme : "<?php echo $params->get('captcha_theme');?>"};
	<?php } ?>
	
	jQuery(function($)
	{
		var success = "<?php echo $params->get('success_notify'); ?>",
		error = "<?php echo $params->get('failure_notify'); ?>",
		recaptcha_error = "<?php echo $params->get('captcha_failure_notify'); ?>",
		id = "<?php echo $module->id; ?>",
		validator = $('#contact-form_<?php echo $module->id; ?>').validate({
			wrapper: "span",
			rules: {
				phone: {number: true},
				message: {minlength: "0"}
				<?php if( $params->get('captcha_req')==1 ): ?>,
				recaptcha_response_field : {required : true}
				<?php endif; ?>
			},
			submitHandler: function(form) {
				$("#message_<?php echo $module->id; ?>")
				.removeClass("success")
				.removeClass("error")
				.addClass("loader")
				.html("Sending message")
				.fadeIn("slow");
				<?php if( $params->get('captcha_req')==1 ): ?>
				$(form).ajaxcaptcha(validator, success, error, recaptcha_error, id);
				<?php else: ?>
				$(form).ajaxsendmail(validator, success, id);
				<?php endif; ?>
				return false;
			}
		});
		<?php if($labels_pos): ?>
		$.support.placeholder = ('placeholder' in document.createElement('input'));
		<?php endif; ?>
		
		$('#clear_<?php echo $module->id; ?>').click(function(){
			$('#contact-form_<?php echo $module->id; ?>').trigger('reset');
			validator.resetForm();
			<?php if($labels_pos): ?>
			if (!$.support.placeholder) 
			{
				$('.mod_as_contact_form *[placeholder]').each(function(n){
				$(this)
				.parent('.controls')
				.find('>.mod_as_contact_form_placeholder')
				.show();
				})
			}
			<?php endif; ?>
			<?php if( $params->get('captcha_req')==1 ): ?>
			Recaptcha.reload();
			<?php endif; ?>
			
			return false;
		})
		
		<?php if($labels_pos): ?>
		if (!$.support.placeholder) 
		{
			$('.mod_as_contact_form *[placeholder]').each(function(n){
				$(this)
				.attr('autocomplete','off')
				.addClass('ie_placeholder')
				.bind('keydown keyup click blur focus change paste cut', function(e){
					$(this).delay(10)
					.queue(function(n){
						if($(this).val() != ''){
							$(this)
							.parent('.controls')
							.find('>.mod_as_contact_form_placeholder')
							.hide();
						}
						else{
							$(this)
							.parent('.controls')
							.find('>.mod_as_contact_form_placeholder')
							.show();
						}
						n();
					});
				})

				.before('<label class="mod_as_contact_form_placeholder"/>')
				.parent('.controls')
				.addClass('ie_placeholder_controls')
				.find('>.mod_as_contact_form_placeholder')
				.attr('for',$(this).parent('.controls').find('>*[placeholder]').attr('id'))
				.text($(this).parent('.controls').find('>*[placeholder]').attr('placeholder'))
				.css({
					paddingTop: $(this).parent('.controls').find('>*[placeholder]').css('paddingTop'),
					paddingBottom: $(this).parent('.controls').find('>*[placeholder]').css('paddingBottom'),
					paddingLeft: $(this).parent('.controls').find('>*[placeholder]').css('paddingLeft'),
					paddingRight: $(this).parent('.controls').find('>*[placeholder]').css('paddingRight'),
					borderTopWidth: $(this).parent('.controls').find('>*[placeholder]').css('borderTopWidth'),
					borderBottomWidth: $(this).parent('.controls').find('>*[placeholder]').css('borderBottomWidth'),
					borderLeftWidth: $(this).parent('.controls').find('>*[placeholder]').css('borderLeftWidth'),
					borderRightWidth: $(this).parent('.controls').find('>*[placeholder]').css('borderRightWidth'),
					fontSize: $(this).parent('.controls').find('>*[placeholder]').css('fontSize'),
					color: $(this).parent('.controls').find('>*[placeholder]').css('color')
				})
			})
		}
		<?php endif; ?>
	})
</script>

<form class="mod_as_contact_form" id="contact-form_<?php echo $module->id; ?>" novalidate >
	<div class="mod_as_contact_form_message" id="message_<?php echo $module->id; ?>"></div>
	<fieldset>
    	<?php if($params->get('pre-text')): ?>
    	<div class="pretext">
        	<p>
            	<?php echo $params->get('pre-text'); ?>
            </p>
        </div>
        <?php endif; ?>
        
		<div class="row-fluid">
        
			<!-- Name Field -->
			<div class="control-group control-group-input <?php echo $params->get('errors_position');?> span4">
				<?php if(!$labels_pos): ?>
                <label for="inputName_<?php echo $module->id; ?>"><?php echo $params->get('name_name'); ?></label>
                <?php endif; ?>

				<div class="controls">
					<input name="name" type="text" class="mod_as_contact_form_input" id="inputName_<?php echo $module->id; ?>"
					<?php if($labels_pos): ?> placeholder="<?php echo $params->get('name_name'); ?>"<?php endif; ?> required>
				</div>
			</div>

            <!-- Email Field -->
            <?php if($params->get('email_publish')): ?>			  
            <div class="control-group control-group-input <?php echo $params->get('errors_position');?> span4">
            	<?php if(!$labels_pos): ?>
            	<label for="inputEmail_<?php echo $module->id; ?>"><?php echo $params->get('email_name'); ?></label>
            	<?php endif; ?>
            
            	<div class="controls">
            		<input name="email" type="email" class="mod_as_contact_form_input" id="inputEmail_<?php echo $module->id; ?>"
					<?php if($labels_pos): ?> placeholder="<?php echo $params->get('email_name'); ?>"<?php endif; ?> <?php echo $params->get('email_req'); ?>>
            	</div>
            </div>
            <?php endif; ?>
            
            <!-- Phone Field -->
			<?php if($params->get('phone_publish')): ?>
            <div class="control-group control-group-input <?php echo $params->get('errors_position');?> span4">
            	<?php if(!$labels_pos): ?>
            	<label for="inputEmail_<?php echo $module->id; ?>"><?php echo $params->get('phone_name'); ?></label>
            	<?php endif; ?>
            
            	<div class="controls">
            		<input name="phone" type="text" class="mod_as_contact_form_input" id="inputPhone_<?php echo $module->id; ?>"
					<?php if($labels_pos): ?> placeholder="<?php echo $params->get('phone_name'); ?>"<?php endif; ?> <?php echo $params->get('phone_req'); ?>>
            	</div>
            </div>
            <?php endif; ?>
            
		</div>
        
        <!-- Subject Field -->
        <?php if($params->get('subject_publish')): ?>
        <div class="control-group control-group-input <?php echo $params->get('errors_position');?>">
        	<?php if(!$labels_pos): ?>
        	<label for="selectSubject_<?php echo $module->id; ?>"><?php echo $params->get('subject_name'); ?></label>
        	<?php endif; ?>
            
        	<div class="controls">
        		<input name="type" type="text" class="mod_as_contact_form_input" id="selectSubject_<?php echo $module->id; ?>"
				<?php if($labels_pos): ?> placeholder="<?php echo $params->get('subject_name'); ?>"<?php endif; ?> required>
        	</div>
        </div>
        <?php endif; ?>

		<!-- Message Field -->
		<div class="control-group control-group-textarea <?php echo $params->get('errors_position');?>">
			<?php if(!$labels_pos): ?>
			<label for="inputMessage_<?php echo $module->id; ?>"><?php echo $params->get('message_name'); ?></label>
			<?php endif; ?>
            
			<div class="controls">
				<textarea name="message" class="mod_as_contact_form_textarea" id="inputMessage_<?php echo $module->id; ?>"
				<?php if($labels_pos): ?> placeholder="<?php echo $params->get('message_name'); ?>"<?php endif; ?> required></textarea>
			</div>
		</div>

		<!-- Captcha Field -->        
		<?php if( $params->get('captcha_req')==1): ?>
		<div class="controls" id="recaptcha_<?php echo $module->id; ?>">
			<?php $publickey = $params->get('public_key'); echo recaptcha_get_html($publickey); ?>
			<div class="mod_as_contact_form_recaptcha_message" id="recaptcha_message_<?php echo $module->id; ?>"></div>
		</div> 
        <?php endif; ?>
        
        <!-- Submit Button -->
		<?php if($params->get('admin_email')): ?>
        <div class="control-group control-group-button">
	        <div class="controls">
    		    <?php if($params->get('clear_publish')): ?>
        		<button type="reset" name="button" id="clear_<?php echo $module->id; ?>" value="Clear" class="btn btn-primary mod_as_contact_form_btn">
					<?php echo $params->get('clearbtn_name');?>
                </button>
				<?php endif; ?>        
                
                <button type="submit" name="button" value="Send" class="btn btn-primary mod_as_contact_form_btn"><?php echo $params->get('submitbtn_name');?></button>
        	</div>
        </div>
		
		<?php else: ?>
		<p><?php echo JText::_('MOD_ASCONTACT_FORM_FIELD_ENTER_ADMIN_EMAIL'); ?></p>
		<?php endif; ?>
        
	</fieldset>
</form>