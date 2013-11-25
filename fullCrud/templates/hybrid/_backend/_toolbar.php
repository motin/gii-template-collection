<div class="btn-toolbar">
    <div class="btn-group">
        <?=
        '<?php
        switch ($this->action->id) {
            case "create":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Manage"),
                    "icon" => "icon-list-alt",
                    "url" => array("admin")
                ));
                break;
            case "admin":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Add"),
                    "icon" => "icon-plus",
                    "url" => array("add")
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Create"),
                    "icon" => "icon-plus",
                    "url" => array("create")
                ));
                break;
            case "view":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Manage"),
                    "icon" => "icon-list-alt",
                    "url" => array("admin")
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Edit"),
                    "icon" => "icon-edit",
                    "url" => array("continueAuthoring", "id" => $model->{$model->tableSchema->primaryKey})
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Update"),
                    "icon" => "icon-edit",
                    "url" => array("update", "id" => $model->{$model->tableSchema->primaryKey})
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Create"),
                    "icon" => "icon-plus",
                    "url" => array("create")
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Delete"),
                    "type" => "danger",
                    "icon" => "icon-remove icon-white",
                    "htmlOptions" => array(
                        "submit" => array("delete", "id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => (Yii::app()->request->getParam("returnUrl")) ? Yii::app()->request->getParam("returnUrl") : $this->createUrl("admin")),
                        "confirm" => Yii::t("' . $this->messageCatalog . '", "Do you want to delete this item?"))
                ));
                break;
            case "update":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Manage"),
                    "icon" => "icon-list-alt",
                    "url" => array("admin")
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "View"),
                    "icon" => "icon-eye-open",
                    "url" => array("view", "id" => $model->{$model->tableSchema->primaryKey})
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Delete"),
                    "type" => "danger",
                    "icon" => "icon-remove icon-white",
                    "htmlOptions" => array(
                        "submit" => array("delete", "id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => (Yii::app()->request->getParam("returnUrl")) ? Yii::app()->request->getParam("returnUrl") : $this->createUrl("admin")),
                        "confirm" => Yii::t("' . $this->messageCatalog . '", "Do you want to delete this item?"))
                ));
                break;
        }
        ?>';
        ?>
    </div>
    <?php echo "<?php if (\$this->action->id == 'admin'): ?>" ?>

        <div class="btn-group">
            <?=
            "<?php
            \$this->widget('bootstrap.widgets.TbButton', array(
                'label' => Yii::t('{$this->messageCatalog}', 'Search'),
                'icon' => 'icon-search',
                'htmlOptions' => array('class' => 'search-button')
            ));?>";
            ?>

        </div>

<?php
        $model = new $this->modelClass;
        if ($model->relations() !== array()): ?>

        <div class="btn-group">
            <?=
            "<?php
            \$this->widget('bootstrap.widgets.TbButtonGroup', array(
                'buttons' => array(
                    array(
                        'label' => Yii::t('" . $this->messageCatalog . "', 'Relations'),
                        'icon' => 'icon-search',
                        'items' => array(";

                        // render relation links
                        $relationLinks = array();
                        foreach ($model->relations() AS $key => $relation) {
                            $relationLinks[] = "array('label' => '{$key} - {$relation[1]}', 'url' => array('" . $this->resolveController($relation) . "/admin'))";
                        }
                        echo implode(", ", $relationLinks);

                        echo "
                        )
                    ),
                ),
            ));
            ?>";
            ?>
        </div>

<?php endif; ?>

    <?php echo "<?php endif; ?>" ?>
</div>

<?= "<?php if (\$this->action->id == 'admin'): ?>" ?>

    <div class="search-form" style="display:none">
        <?= "<?php \$this->renderPartial('_search', array(
            'model' => \$model,
        )); ?>\n"; ?>
    </div>
<?= "<?php endif; ?>" ?>
