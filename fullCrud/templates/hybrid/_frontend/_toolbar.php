<div class="btn-toolbar">
    <div class="btn-group">
        <?php
        echo '<?php
        switch ($this->action->id) {
            case "index":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Manage"),
                    "icon" => "icon-edit",
                    "url" => array("admin")
                ));
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Add"),
                    "icon" => "icon-edit",
                    "url" => array("add")
                ));
            case "view":
                $this->widget("bootstrap.widgets.TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Manage"),
                    "icon" => "icon-edit",
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
</div>