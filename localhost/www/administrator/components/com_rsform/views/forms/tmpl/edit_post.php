<?php
/**
* @package RSForm! Pro
* @copyright (C) 2007-2014 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');

JText::script('RSFP_POST_NAME_PLACEHOLDER');
JText::script('RSFP_POST_VALUE_PLACEHOLDER');
?>
<fieldset>
<legend><?php echo JText::_('RSFP_POST_TO_LOCATION'); ?></legend>
<table width="100%" class="com-rsform-table-props">
	<tr>
		<td width="25%" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_POST_ENABLED'); ?></td>
		<td><?php echo $this->lists['post_enabled']; ?></td>
	</tr>
	<tr>
		<td width="25%" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_POST_SILENT'); ?></td>
		<td><?php echo $this->lists['post_silent']; ?></td>
	</tr>
	<tr>
		<td width="25%" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_POST_METHOD'); ?></td>
		<td><?php echo $this->lists['post_method']; ?></td>
	</tr>
	<tr>
		<td width="25%" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_POST_URL'); ?></td>
		<td><input class="rs_inp rs_80" name="form_post[url]" value="<?php echo $this->escape($this->form_post->url); ?>" size="105" /></td>
	</tr>
</table>
<legend><?php echo JText::_('RSFP_POST_TO_LOCATION_ADVANCED'); ?></legend>
<table width="100%" class="com-rsform-table-props" id="com-rsform-post-fields">
	<thead>
	<tr>
		<th class="text-left" align="left" colspan="3"><button type="button" onclick="RSFormPro.Post.addField();" class="btn btn-primary"><?php echo JText::_('RSFP_ADD_POST_VALUE'); ?></button></th>
	</tr>
	<tr>
		<th><?php echo JText::_('RSFP_POST_NAME'); ?></th>
		<th colspan="2"><?php echo JText::_('RSFP_POST_VALUE'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php if (!empty($this->form_post->fields) && is_array($this->form_post->fields)) { ?>
		<?php foreach ($this->form_post->fields as $field) { ?>
		<tr>
			<td><input type="text" class="rs_inp rs_80" name="form_post[name][]" placeholder="<?php echo $this->escape(JText::_('RSFP_POST_NAME_PLACEHOLDER')); ?>" value="<?php echo $this->escape($field->name); ?>" /></td>
			<td><input type="text" class="rs_inp rs_80" name="form_post[value][]" placeholder="<?php echo $this->escape(JText::_('RSFP_POST_VALUE_PLACEHOLDER')); ?>" value="<?php echo $this->escape($field->value); ?>" /></td>
			<td><button type="button" onclick="RSFormPro.Post.deleteField.call(this);" class="btn btn-danger btn-mini"><i class="rsficon rsficon-remove"></i></button></td>
		</tr>
		<?php } ?>
	<?php } ?>
	</tbody>
</table>
</fieldset>