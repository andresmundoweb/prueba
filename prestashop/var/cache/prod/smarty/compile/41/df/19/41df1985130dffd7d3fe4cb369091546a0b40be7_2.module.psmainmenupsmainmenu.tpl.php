<?php
/* Smarty version 3.1.33, created on 2019-09-02 11:37:13
  from 'module:psmainmenupsmainmenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d6d45398fc423_66067511',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '41df1985130dffd7d3fe4cb369091546a0b40be7' => 
    array (
      0 => 'module:psmainmenupsmainmenu.tpl',
      1 => 1566570714,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5d6d45398fc423_66067511 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'menu' => 
  array (
    'compiled_filepath' => '/html/var/cache/prod/smarty/compile/41/df/19/41df1985130dffd7d3fe4cb369091546a0b40be7_2.module.psmainmenupsmainmenu.tpl.php',
    'uid' => '41df1985130dffd7d3fe4cb369091546a0b40be7',
    'call_name' => 'smarty_template_function_menu_4508563875d6d45398ca263_40002878',
  ),
));
$_smarty_tpl->_assignInScope('_counter', 0);?>


<div data-html2canvas-ignore class="menu js-top-menu position-static hidden-sm-down" id="_desktop_top_menu">
    <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'menu', array('nodes'=>$_smarty_tpl->tpl_vars['menu']->value['children']), true);?>

    <div class="clearfix"></div>
</div>
<?php }
/* smarty_template_function_menu_4508563875d6d45398ca263_40002878 */
if (!function_exists('smarty_template_function_menu_4508563875d6d45398ca263_40002878')) {
function smarty_template_function_menu_4508563875d6d45398ca263_40002878(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('nodes'=>array(),'depth'=>0,'parent'=>null), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

    <?php if (count($_smarty_tpl->tpl_vars['nodes']->value)) {?>
      <ul class="top-menu" <?php if ($_smarty_tpl->tpl_vars['depth']->value == 0) {?>id="top-menu"<?php }?> data-depth="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['depth']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nodes']->value, 'node');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['node']->value) {
?>
            <li class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value['type'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['node']->value['current']) {?> current <?php }?>" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value['page_identifier'], ENT_QUOTES, 'UTF-8');?>
">
            <?php $_smarty_tpl->_assignInScope('_counter', $_smarty_tpl->tpl_vars['_counter']->value+1);?>
              <a
                class="<?php if ($_smarty_tpl->tpl_vars['depth']->value >= 0) {?>dropdown-item<?php }
if ($_smarty_tpl->tpl_vars['depth']->value === 1) {?> dropdown-submenu<?php }?>"
                href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value['url'], ENT_QUOTES, 'UTF-8');?>
" data-depth="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['depth']->value, ENT_QUOTES, 'UTF-8');?>
"
                <?php if ($_smarty_tpl->tpl_vars['node']->value['open_in_new_window']) {?> target="_blank" <?php }?>
              >
                <?php if (count($_smarty_tpl->tpl_vars['node']->value['children'])) {?>
                                    <?php $_smarty_tpl->_assignInScope('_expand_id', mt_rand(10,100000));?>
                  <span class="pull-xs-right hidden-lg-up">
                    <span data-target="#top_sub_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_expand_id']->value, ENT_QUOTES, 'UTF-8');?>
" data-toggle="collapse" class="navbar-toggler collapse-icons">
                      <i class="fa fa-angle-down add" aria-hidden="true"></i>
                      <i class="fa fa-angle-up remove" aria-hidden="true"></i>
                    </span>
                  </span>
                <?php }?>
                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value['label'], ENT_QUOTES, 'UTF-8');?>

              </a>
              <?php if (count($_smarty_tpl->tpl_vars['node']->value['children'])) {?>
              <div <?php if ($_smarty_tpl->tpl_vars['depth']->value === 0) {?> class="sub-menu js-sub-menu collapse"<?php } else { ?> class="child-menu collapse"<?php }?> id="top_sub_menu_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_expand_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'menu', array('nodes'=>$_smarty_tpl->tpl_vars['node']->value['children'],'depth'=>$_smarty_tpl->tpl_vars['node']->value['depth'],'parent'=>$_smarty_tpl->tpl_vars['node']->value), true);?>

                <?php if (count($_smarty_tpl->tpl_vars['node']->value['image_urls']) && $_smarty_tpl->tpl_vars['depth']->value === 0) {?>
                  <div class="category-thumbnail">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['node']->value['image_urls'], 'image_url');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['image_url']->value) {
?>
                      <img class="cat-img" src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image_url']->value, ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value['label'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['node']->value['label'], ENT_QUOTES, 'UTF-8');?>
">
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </div>
                <?php }?>
              </div>
              <?php }?>
            </li>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </ul>
    <?php }
}}
/*/ smarty_template_function_menu_4508563875d6d45398ca263_40002878 */
}
