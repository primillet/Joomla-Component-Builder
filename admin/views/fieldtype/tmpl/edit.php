<?php
/**
 * @package    Joomla.Component.Builder
 *
 * @created    30th April, 2015
 * @author     Llewellyn van der Merwe <http://www.joomlacomponentbuilder.com>
 * @github     Joomla Component Builder <https://github.com/vdm-io/Joomla-Component-Builder>
 * @copyright  Copyright (C) 2015 - 2019 Vast Development Method. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
$componentParams = $this->params; // will be removed just use $this->params instead
?>
<script type="text/javascript">
	// waiting spinner
	var outerDiv = jQuery('body');
	jQuery('<div id="loading"></div>')
		.css("background", "rgba(255, 255, 255, .8) url('components/com_componentbuilder/assets/images/import.gif') 50% 15% no-repeat")
		.css("top", outerDiv.position().top - jQuery(window).scrollTop())
		.css("left", outerDiv.position().left - jQuery(window).scrollLeft())
		.css("width", outerDiv.width())
		.css("height", outerDiv.height())
		.css("position", "fixed")
		.css("opacity", "0.80")
		.css("-ms-filter", "progid:DXImageTransform.Microsoft.Alpha(Opacity = 80)")
		.css("filter", "alpha(opacity = 80)")
		.css("display", "none")
		.appendTo(outerDiv);
	jQuery('#loading').show();
	// when page is ready remove and show
	jQuery(window).load(function() {
		jQuery('#componentbuilder_loader').fadeIn('fast');
		jQuery('#loading').hide();
	});
</script>
<div id="componentbuilder_loader" style="display: none;">
<form action="<?php echo JRoute::_('index.php?option=com_componentbuilder&layout=edit&id='. (int) $this->item->id . $this->referral); ?>" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">

	<?php echo JLayoutHelper::render('fieldtype.details_above', $this); ?>
<div class="form-horizontal">

	<?php echo JHtml::_('bootstrap.startTabSet', 'fieldtypeTab', array('active' => 'details')); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'fieldtypeTab', 'details', JText::_('COM_COMPONENTBUILDER_FIELDTYPE_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('fieldtype.details_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('fieldtype.details_right', $this); ?>
			</div>
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('fieldtype.details_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'fieldtypeTab', 'database_defaults', JText::_('COM_COMPONENTBUILDER_FIELDTYPE_DATABASE_DEFAULTS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('fieldtype.database_defaults_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('fieldtype.database_defaults_right', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php if ($this->canDo->get('field.access')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'fieldtypeTab', 'fields', JText::_('COM_COMPONENTBUILDER_FIELDTYPE_FIELDS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('fieldtype.fields_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php $this->ignore_fieldsets = array('details','metadata','vdmmetadata','accesscontrol'); ?>
	<?php $this->tab_name = 'fieldtypeTab'; ?>
	<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>

	<?php if ($this->canDo->get('fieldtype.delete') || $this->canDo->get('core.edit.created_by') || $this->canDo->get('fieldtype.edit.state') || $this->canDo->get('core.edit.created')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'fieldtypeTab', 'publishing', JText::_('COM_COMPONENTBUILDER_FIELDTYPE_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('fieldtype.publishing', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('fieldtype.publlshing', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php if ($this->canDo->get('core.admin')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'fieldtypeTab', 'permissions', JText::_('COM_COMPONENTBUILDER_FIELDTYPE_PERMISSION', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<fieldset class="adminform">
					<div class="adminformlist">
					<?php foreach ($this->form->getFieldset('accesscontrol') as $field): ?>
						<div>
							<?php echo $field->label; echo $field->input;?>
						</div>
						<div class="clearfix"></div>
					<?php endforeach; ?>
					</div>
				</fieldset>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php echo JHtml::_('bootstrap.endTabSet'); ?>

	<div>
		<input type="hidden" name="task" value="fieldtype.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</div>
</form>
</div>

<script type="text/javascript">

// #jform_datalenght listeners for datalenght_vvvvwcc function
jQuery('#jform_datalenght').on('keyup',function()
{
	var datalenght_vvvvwcc = jQuery("#jform_datalenght").val();
	var has_defaults_vvvvwcc = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcc(datalenght_vvvvwcc,has_defaults_vvvvwcc);

});
jQuery('#adminForm').on('change', '#jform_datalenght',function (e)
{
	e.preventDefault();
	var datalenght_vvvvwcc = jQuery("#jform_datalenght").val();
	var has_defaults_vvvvwcc = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcc(datalenght_vvvvwcc,has_defaults_vvvvwcc);

});

// #jform_has_defaults listeners for has_defaults_vvvvwcc function
jQuery('#jform_has_defaults').on('keyup',function()
{
	var datalenght_vvvvwcc = jQuery("#jform_datalenght").val();
	var has_defaults_vvvvwcc = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcc(datalenght_vvvvwcc,has_defaults_vvvvwcc);

});
jQuery('#adminForm').on('change', '#jform_has_defaults',function (e)
{
	e.preventDefault();
	var datalenght_vvvvwcc = jQuery("#jform_datalenght").val();
	var has_defaults_vvvvwcc = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcc(datalenght_vvvvwcc,has_defaults_vvvvwcc);

});

// #jform_datadefault listeners for datadefault_vvvvwce function
jQuery('#jform_datadefault').on('keyup',function()
{
	var datadefault_vvvvwce = jQuery("#jform_datadefault").val();
	var has_defaults_vvvvwce = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwce(datadefault_vvvvwce,has_defaults_vvvvwce);

});
jQuery('#adminForm').on('change', '#jform_datadefault',function (e)
{
	e.preventDefault();
	var datadefault_vvvvwce = jQuery("#jform_datadefault").val();
	var has_defaults_vvvvwce = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwce(datadefault_vvvvwce,has_defaults_vvvvwce);

});

// #jform_has_defaults listeners for has_defaults_vvvvwce function
jQuery('#jform_has_defaults').on('keyup',function()
{
	var datadefault_vvvvwce = jQuery("#jform_datadefault").val();
	var has_defaults_vvvvwce = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwce(datadefault_vvvvwce,has_defaults_vvvvwce);

});
jQuery('#adminForm').on('change', '#jform_has_defaults',function (e)
{
	e.preventDefault();
	var datadefault_vvvvwce = jQuery("#jform_datadefault").val();
	var has_defaults_vvvvwce = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwce(datadefault_vvvvwce,has_defaults_vvvvwce);

});

// #jform_datatype listeners for datatype_vvvvwcg function
jQuery('#jform_datatype').on('keyup',function()
{
	var datatype_vvvvwcg = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwcg = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcg(datatype_vvvvwcg,has_defaults_vvvvwcg);

});
jQuery('#adminForm').on('change', '#jform_datatype',function (e)
{
	e.preventDefault();
	var datatype_vvvvwcg = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwcg = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcg(datatype_vvvvwcg,has_defaults_vvvvwcg);

});

// #jform_has_defaults listeners for has_defaults_vvvvwcg function
jQuery('#jform_has_defaults').on('keyup',function()
{
	var datatype_vvvvwcg = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwcg = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcg(datatype_vvvvwcg,has_defaults_vvvvwcg);

});
jQuery('#adminForm').on('change', '#jform_has_defaults',function (e)
{
	e.preventDefault();
	var datatype_vvvvwcg = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwcg = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcg(datatype_vvvvwcg,has_defaults_vvvvwcg);

});

// #jform_has_defaults listeners for has_defaults_vvvvwch function
jQuery('#jform_has_defaults').on('keyup',function()
{
	var has_defaults_vvvvwch = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var datatype_vvvvwch = jQuery("#jform_datatype").val();
	vvvvwch(has_defaults_vvvvwch,datatype_vvvvwch);

});
jQuery('#adminForm').on('change', '#jform_has_defaults',function (e)
{
	e.preventDefault();
	var has_defaults_vvvvwch = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var datatype_vvvvwch = jQuery("#jform_datatype").val();
	vvvvwch(has_defaults_vvvvwch,datatype_vvvvwch);

});

// #jform_datatype listeners for datatype_vvvvwch function
jQuery('#jform_datatype').on('keyup',function()
{
	var has_defaults_vvvvwch = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var datatype_vvvvwch = jQuery("#jform_datatype").val();
	vvvvwch(has_defaults_vvvvwch,datatype_vvvvwch);

});
jQuery('#adminForm').on('change', '#jform_datatype',function (e)
{
	e.preventDefault();
	var has_defaults_vvvvwch = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var datatype_vvvvwch = jQuery("#jform_datatype").val();
	vvvvwch(has_defaults_vvvvwch,datatype_vvvvwch);

});

// #jform_datatype listeners for datatype_vvvvwci function
jQuery('#jform_datatype').on('keyup',function()
{
	var datatype_vvvvwci = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwci = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwci(datatype_vvvvwci,has_defaults_vvvvwci);

});
jQuery('#adminForm').on('change', '#jform_datatype',function (e)
{
	e.preventDefault();
	var datatype_vvvvwci = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwci = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwci(datatype_vvvvwci,has_defaults_vvvvwci);

});

// #jform_has_defaults listeners for has_defaults_vvvvwci function
jQuery('#jform_has_defaults').on('keyup',function()
{
	var datatype_vvvvwci = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwci = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwci(datatype_vvvvwci,has_defaults_vvvvwci);

});
jQuery('#adminForm').on('change', '#jform_has_defaults',function (e)
{
	e.preventDefault();
	var datatype_vvvvwci = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwci = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwci(datatype_vvvvwci,has_defaults_vvvvwci);

});

// #jform_store listeners for store_vvvvwck function
jQuery('#jform_store').on('keyup',function()
{
	var store_vvvvwck = jQuery("#jform_store").val();
	var datatype_vvvvwck = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwck = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwck(store_vvvvwck,datatype_vvvvwck,has_defaults_vvvvwck);

});
jQuery('#adminForm').on('change', '#jform_store',function (e)
{
	e.preventDefault();
	var store_vvvvwck = jQuery("#jform_store").val();
	var datatype_vvvvwck = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwck = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwck(store_vvvvwck,datatype_vvvvwck,has_defaults_vvvvwck);

});

// #jform_datatype listeners for datatype_vvvvwck function
jQuery('#jform_datatype').on('keyup',function()
{
	var store_vvvvwck = jQuery("#jform_store").val();
	var datatype_vvvvwck = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwck = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwck(store_vvvvwck,datatype_vvvvwck,has_defaults_vvvvwck);

});
jQuery('#adminForm').on('change', '#jform_datatype',function (e)
{
	e.preventDefault();
	var store_vvvvwck = jQuery("#jform_store").val();
	var datatype_vvvvwck = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwck = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwck(store_vvvvwck,datatype_vvvvwck,has_defaults_vvvvwck);

});

// #jform_has_defaults listeners for has_defaults_vvvvwck function
jQuery('#jform_has_defaults').on('keyup',function()
{
	var store_vvvvwck = jQuery("#jform_store").val();
	var datatype_vvvvwck = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwck = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwck(store_vvvvwck,datatype_vvvvwck,has_defaults_vvvvwck);

});
jQuery('#adminForm').on('change', '#jform_has_defaults',function (e)
{
	e.preventDefault();
	var store_vvvvwck = jQuery("#jform_store").val();
	var datatype_vvvvwck = jQuery("#jform_datatype").val();
	var has_defaults_vvvvwck = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwck(store_vvvvwck,datatype_vvvvwck,has_defaults_vvvvwck);

});

// #jform_datatype listeners for datatype_vvvvwcl function
jQuery('#jform_datatype').on('keyup',function()
{
	var datatype_vvvvwcl = jQuery("#jform_datatype").val();
	var store_vvvvwcl = jQuery("#jform_store").val();
	var has_defaults_vvvvwcl = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcl(datatype_vvvvwcl,store_vvvvwcl,has_defaults_vvvvwcl);

});
jQuery('#adminForm').on('change', '#jform_datatype',function (e)
{
	e.preventDefault();
	var datatype_vvvvwcl = jQuery("#jform_datatype").val();
	var store_vvvvwcl = jQuery("#jform_store").val();
	var has_defaults_vvvvwcl = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcl(datatype_vvvvwcl,store_vvvvwcl,has_defaults_vvvvwcl);

});

// #jform_store listeners for store_vvvvwcl function
jQuery('#jform_store').on('keyup',function()
{
	var datatype_vvvvwcl = jQuery("#jform_datatype").val();
	var store_vvvvwcl = jQuery("#jform_store").val();
	var has_defaults_vvvvwcl = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcl(datatype_vvvvwcl,store_vvvvwcl,has_defaults_vvvvwcl);

});
jQuery('#adminForm').on('change', '#jform_store',function (e)
{
	e.preventDefault();
	var datatype_vvvvwcl = jQuery("#jform_datatype").val();
	var store_vvvvwcl = jQuery("#jform_store").val();
	var has_defaults_vvvvwcl = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcl(datatype_vvvvwcl,store_vvvvwcl,has_defaults_vvvvwcl);

});

// #jform_has_defaults listeners for has_defaults_vvvvwcl function
jQuery('#jform_has_defaults').on('keyup',function()
{
	var datatype_vvvvwcl = jQuery("#jform_datatype").val();
	var store_vvvvwcl = jQuery("#jform_store").val();
	var has_defaults_vvvvwcl = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcl(datatype_vvvvwcl,store_vvvvwcl,has_defaults_vvvvwcl);

});
jQuery('#adminForm').on('change', '#jform_has_defaults',function (e)
{
	e.preventDefault();
	var datatype_vvvvwcl = jQuery("#jform_datatype").val();
	var store_vvvvwcl = jQuery("#jform_store").val();
	var has_defaults_vvvvwcl = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcl(datatype_vvvvwcl,store_vvvvwcl,has_defaults_vvvvwcl);

});

// #jform_has_defaults listeners for has_defaults_vvvvwcm function
jQuery('#jform_has_defaults').on('keyup',function()
{
	var has_defaults_vvvvwcm = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var store_vvvvwcm = jQuery("#jform_store").val();
	var datatype_vvvvwcm = jQuery("#jform_datatype").val();
	vvvvwcm(has_defaults_vvvvwcm,store_vvvvwcm,datatype_vvvvwcm);

});
jQuery('#adminForm').on('change', '#jform_has_defaults',function (e)
{
	e.preventDefault();
	var has_defaults_vvvvwcm = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var store_vvvvwcm = jQuery("#jform_store").val();
	var datatype_vvvvwcm = jQuery("#jform_datatype").val();
	vvvvwcm(has_defaults_vvvvwcm,store_vvvvwcm,datatype_vvvvwcm);

});

// #jform_store listeners for store_vvvvwcm function
jQuery('#jform_store').on('keyup',function()
{
	var has_defaults_vvvvwcm = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var store_vvvvwcm = jQuery("#jform_store").val();
	var datatype_vvvvwcm = jQuery("#jform_datatype").val();
	vvvvwcm(has_defaults_vvvvwcm,store_vvvvwcm,datatype_vvvvwcm);

});
jQuery('#adminForm').on('change', '#jform_store',function (e)
{
	e.preventDefault();
	var has_defaults_vvvvwcm = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var store_vvvvwcm = jQuery("#jform_store").val();
	var datatype_vvvvwcm = jQuery("#jform_datatype").val();
	vvvvwcm(has_defaults_vvvvwcm,store_vvvvwcm,datatype_vvvvwcm);

});

// #jform_datatype listeners for datatype_vvvvwcm function
jQuery('#jform_datatype').on('keyup',function()
{
	var has_defaults_vvvvwcm = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var store_vvvvwcm = jQuery("#jform_store").val();
	var datatype_vvvvwcm = jQuery("#jform_datatype").val();
	vvvvwcm(has_defaults_vvvvwcm,store_vvvvwcm,datatype_vvvvwcm);

});
jQuery('#adminForm').on('change', '#jform_datatype',function (e)
{
	e.preventDefault();
	var has_defaults_vvvvwcm = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	var store_vvvvwcm = jQuery("#jform_store").val();
	var datatype_vvvvwcm = jQuery("#jform_datatype").val();
	vvvvwcm(has_defaults_vvvvwcm,store_vvvvwcm,datatype_vvvvwcm);

});

// #jform_has_defaults listeners for has_defaults_vvvvwcn function
jQuery('#jform_has_defaults').on('keyup',function()
{
	var has_defaults_vvvvwcn = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcn(has_defaults_vvvvwcn);

});
jQuery('#adminForm').on('change', '#jform_has_defaults',function (e)
{
	e.preventDefault();
	var has_defaults_vvvvwcn = jQuery("#jform_has_defaults input[type='radio']:checked").val();
	vvvvwcn(has_defaults_vvvvwcn);

});




<?php
	$app = JFactory::getApplication();
?>
function JRouter(link) {
<?php
	if ($app->isSite())
	{
		echo 'var url = "'.JURI::root().'";';
	}
	else
	{
		echo 'var url = "";';
	}
?>
	return url+link;
}
</script>
