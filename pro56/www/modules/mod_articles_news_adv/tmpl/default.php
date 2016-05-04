<?php
/**
 * Articles Newsflash Advanced
 *
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 
 * 
*/

defined('_JEXEC') or die;
?>
<div class="mod-newsflash-adv mod-newsflash-adv__<?php echo $moduleclass_sfx; ?>">

  <?php if ($params->get('pretext')): ?>
    <div class="pretext">
      <?php echo $params->get('pretext') ?>
    </div>
  <?php endif; ?>  

  <?php for ($i = 0, $n = count($list); $i < $n; $i ++) :
    $item = $list[$i]; 

    $class="";
    if($i == $n-1){
      $class="lastItem";
    } ?>

    <div class="item item_num<?php echo $i; ?> item__module <?php echo $class; ?>">
      <?php require JModuleHelper::getLayoutPath('mod_articles_news_adv', '_item'); ?>
    </div>
  <?php endfor; ?>

  <div class="clearfix"></div>

 
</div>
