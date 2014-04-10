<?php

class EditableProvider extends GtcCodeProvider
{
    /**
     * @param CActiveRecord   $modelClass
     * @param CDbColumnSchema $column
     */
    public function generateColumn($modelClass, $column, $controller = null)
    {
        
        if (strtoupper($column->dbType) == 'DATETIME') {
            return null;
        }

        if (is_null($controller)) {
            $controller = $this->codeModel->controller;
        }
        
        if ($column->isForeignKey) {

            $suggestIdentifier = $this->codeModel->provider()->suggestIdentifier($modelClass);
            $model             = CActiveRecord::model($modelClass);
            $table             = $model->getTableSchema();
            $fk                = $table->foreignKeys[$column->name];
            
            // We have to look into relations to find the correct model class (i.e. if models are generated with table prefix)
            foreach ($model->relations() as $key => $value) {
                // omit relations with array definition
                if (is_array($value[2])) {
                    continue;
                }

                if (strcasecmp($value[2], $column->name) == 0) {
                    $relname  = $key;
                    $relation = $value;
                }
            }

            if (!isset($relation)) {
                return "'" . $column->name . "'";
            }   

            $relatedModel     = CActiveRecord::model($relation[1]);
            $relatedModelName = $relation[1];
            $fcolumns         = $relatedModel->attributeNames();            
            
            //return null; //$provider->generateValueField($modelClass, $column);

            return "array(
                'class' => 'editable.EditableColumn',
                'name' => '{$column->name}',
                'value' => 'CHtml::value(\$data, \'{$relname}." . $suggestIdentifier . "\',\'Click to edit\')',                    
                'editable' => array(
                    'type' => 'select',
                    'url' => \$this->createUrl('/{$controller}/editableSaver'),
                    'source' => CHtml::listData({$relatedModelName}::model()->findAll(array('limit' => 1000)), '{$fcolumns[0]}', '{$suggestIdentifier}'),                        
                    //'placement' => 'right',
                )
            )";
            
        } elseif (substr(strtoupper($column->dbType), 0, 4) == 'ENUM') {
            return "array(
                    'class' => 'editable.EditableColumn',
                    'name' => '{$column->name}',
                    'value' => '\$data->getEnumLabel(\'{$column->name}\',\$data->{$column->name},\'Click to edit\')',
                    'editable' => array(
                        'type' => 'select',
                        'url' => \$this->createUrl('/{$controller}/editableSaver'),
                        'source' => \$model->getEnumFieldLabels('{$column->name}'),
                        //'placement' => 'right',
                    ),
                   'filter' => \$model->getEnumFieldLabels('{$column->name}'),
                )";
            
        } elseif (strtoupper($column->dbType) == 'TEXT') {
            return "array(
                'class' => 'editable.EditableColumn',
                'name' => '{$column->name}',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => \$this->createUrl('/{$controller}/editableSaver'),
                    //'placement' => 'right',
                )
            )";
            
        } elseif(strtoupper($column->dbType) == 'DATE') {
            return "array(
                'class' => 'editable.EditableColumn',
                'name' => '{$column->name}',
                'editable' => array(
                    'type' => 'date',
                    'url' => \$this->createUrl('/{$controller}/editableSaver'),
                    //'placement' => 'right',
                )
            )";
        } else {
            return "array(
                'class' => 'editable.EditableColumn',
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
                            'EditableField',
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