<?php
/* Smarty version 4.3.4, created on 2024-07-25 13:28:28
  from '/var/www/sugarcrm/core/general/views/templates/content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66a252fc0cb2c0_97855170',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '171c2be16b2227661ebd08825b09ee02a2e5498d' => 
    array (
      0 => '/var/www/sugarcrm/core/general/views/templates/content.tpl',
      1 => 1721914103,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a252fc0cb2c0_97855170 (Smarty_Internal_Template $_smarty_tpl) {
?><h4>Dashboard</h4><br>
<div class="row text-center">
    <div class="col">
        <div class="card">
            <h5 class="card-header">Increase Cover Cases</h5>
            <div class="card-body">
                <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['totalNumOfIncreaseCoverCases']->value;?>
</h5>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <h5 class="card-header">Decrease Cover Cases</h5>
            <div class="card-body">
                <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['totalNumOfDecreaseCoverCases']->value;?>
</h5>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <h5 class="card-header">Cancel Cover Cases</h5>
            <div class="card-body">
                <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['totalNumOfCancelCoverCases']->value;?>
</h5>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row text-center">
    <div class="col">
        <div class="card">
            <h5 class="card-header">Last Created Policy</h5>
            <div class="card-body">
                <h5 class="card-title"><?php echo $_smarty_tpl->tpl_vars['lastCreatedPolicyName']->value;?>
</h5>
            </div>
        </div>
    </div>
</div>
<?php }
}
