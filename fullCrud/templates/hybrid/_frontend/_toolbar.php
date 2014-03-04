<div class="btn-toolbar">
    <div class="btn-group">
        <?php
        echo '<?php
        switch ($this->action->id) {
            case "index":
                $this->widget("\TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Manage"),
                    "icon" => "glyphicon-edit",
                    "url" => array("admin")
                ));
                $this->widget("\TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Add"),
                    "icon" => "glyphicon-edit",
                    "url" => array("add")
                ));
                break;
            case "view":
                $this->widget("\TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Manage"),
                    "icon" => "glyphicon-edit",
                    "url" => array("admin")
                ));
                $this->widget("\TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Edit"),
                    "icon" => "glyphicon-edit",
                    "url" => array("continueAuthoring", "id" => $model->{$model->tableSchema->primaryKey})
                ));
                $this->widget("\TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Update"),
                    "icon" => "glyphicon-edit",
                    "url" => array("update", "id" => $model->{$model->tableSchema->primaryKey})
                ));
                $this->widget("\TbButton", array(
                    "label" => Yii::t("' . $this->messageCatalog . '", "Delete"),
                    "type" => "danger",
                    "icon" => "glyphicon-remove icon-white",
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