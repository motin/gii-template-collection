<?php
echo "<?php\n";
echo "\$this->breadcrumbs[Yii::t('".$this->messageCatalog."', \$model->modelLabel, 2)] = array('index');\n";
echo "?>";
?>

<?="<?php \$this->renderPartial(\"/_item/elements/flowbar\", array(\"model\" => \$model)); ?>"?>

<?php echo '<?php $this->widget("\TbBreadcrumbs", array("links" => $this->breadcrumbs)) ?>'; ?>

<!--<h1>
    <?=
    "
    <?php echo Yii::t('{$this->messageCatalog}','{$this->class2name($this->modelClass)}'); ?>
    <small>
        <?php echo Yii::t('{$this->messageCatalog}','View')?> #<?php echo \$model->{$this->tableSchema->primaryKey} ?>
    </small>
    ";
    ?>

</h1>-->

<?=
"    <?php if (Yii::app()->user->checkAccess('{$this->modelClass}.*')): ?>
        <div class=\"admin-container hide\">
            <?php \$this->renderPartial(\"_toolbar\", array(\"model\" => \$model)); ?>
        </div>
    <?php endif; ?>\n";
?>

<?="<?php \$this->renderPartial(\"_view\", array(\"data\" => \$model)); ?>"?>

<!--
<?php
echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$this->tableSchema->primaryKey}')); ?>:</b>\n";
echo "<?php echo CHtml::link(CHtml::encode(\$model->{$this->tableSchema->primaryKey}), array('view', '{$this->tableSchema->primaryKey}' => \$model->{$this->tableSchema->primaryKey})); ?>\n    <br />\n\n";
$count = 0;
foreach ($this->tableSchema->columns as $column) {
    if ($column->isPrimaryKey)
    continue;
    if (++$count == 7)
    echo "<?php /*\n";
    echo "<b><?php echo CHtml::encode(\$model->getAttributeLabel('{$column->name}')); ?>:</b>\n";
    if ($column->name == 'createtime'
    or $column->name == 'updatetime'
    or $column->name == 'timestamp') {
    echo "    echo Yii::app()->getDateFormatter()->formatDateTime(\$model->{$column->name}, 'medium', 'medium'); ?>\n    <br />\n\n";
    } else {
    echo "<?php echo CHtml::encode(\$model->{$column->name}); ?>\n<br />\n\n";
    }
}
if ($count >= 7)
    echo "    */\n    ?>\n";
?>
-->
