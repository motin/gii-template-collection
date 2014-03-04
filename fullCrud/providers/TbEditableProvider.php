<?php

class TbEditableProvider extends GtcCodeProvider
{
    /**
     * @param CActiveRecord   $modelClass
     * @param CDbColumnSchema $column
     */
    public function generateColumn($modelClass, $column, $controller = null)
    {
        if (is_null($controller)) {
            $controller = $this->codeModel->controller;
        }
        if ($column->isForeignKey) {
            return null; //$provider->generateValueField($modelClass, $column);
        } elseif (strtoupper($column->dbType) == 'TEXT') {
            return "#'{$column->name}'"; // comment text fields
        } else {
            return "array(
                'class' => 'TbEditableColumn',
                'name' => '{$column->name}',
                'editable' => array(
                    'url' => \$this->createUrl('/{$controller}/editableSaver'),
                    //'placement' => 'right',
                )
            )";
        }
    }

    public function generateAttribute($modelClass, $column, $view = false)
    {
        if ($column->isForeignKey) {
            return null;
        } elseif ($column->name) {
            $code = "array(
                        'name' => '{$column->name}',
                        'type' => 'raw',
                        'value' => \$this->widget(
                            'TbEditableField',
                            array(
                                'model' => \$model,
                                'attribute' => '{$column->name}',
                                'url' => \$this->createUrl('/{$this->codeModel->controller}/editableSaver'),
                            ),
                            true
                        )
                    ),\n";
        } else {
            $code = null;
        }
        return $code;
    }

}