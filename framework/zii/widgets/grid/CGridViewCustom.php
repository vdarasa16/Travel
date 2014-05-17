<?php

Yii::import('zii.widgets.grid.CGridView');

class CGridViewCustom extends CGridView
{

	protected function initColumns()
	{
		if ($this->columns === array())
		{
			if ($this->dataProvider instanceof CActiveDataProvider)
				$this->columns = $this->dataProvider->model->attributeNames();
			else if ($this->dataProvider instanceof IDataProvider)
			{
				// use the keys of the first row of data as the default columns
				$data = $this->dataProvider->getData();
				if (isset($data[0]) && is_array($data[0]))
					$this->columns = array_keys($data[0]);
			}
		}

		$tokenColumn[] = array(
			'header' => 'No.',
			'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)."."',
			'htmlOptions' => array('style' => 'width: 40px; text-align: center;')
		);

		foreach ($this->columns as $i => $column)
			$tokenColumn[] = $column;

		$this->columns = $tokenColumn;
		$id = $this->getId();
		foreach ($this->columns as $i => $column)
		{
			if (is_string($column))
				$column = $this->createDataColumn($column);
			else
			{
				if (!isset($column['class']))
					$column['class'] = 'CDataColumn';
				$column = Yii::createComponent($column, $this);
			}
			if (!$column->visible)
			{
				unset($this->columns[$i]);
				continue;
			}
			if ($column->id === null)
				$column->id = $id . '_c' . $i;
			$this->columns[$i] = $column;
		}

		foreach ($this->columns as $column)
			$column->init();
	}

}
