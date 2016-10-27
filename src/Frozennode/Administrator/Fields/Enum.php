<?php
namespace Frozennode\Administrator\Fields;

use Illuminate\Database\Query\Builder as QueryBuilder;

class Enum extends Field {

	/**
	 * The options used for the enum field
	 *
	 * @var array
	 */
	protected $rules = array(
		'options' => 'required|array|not_empty',
	);

	/**
	 * Builds a few basic options
	 */
	public function build()
	{
		parent::build();

		$options = $this->suppliedOptions;

		$dataOptions = $options['options'];
		$options['options'] = array();
// echo '<br/>';echo '<br/>';echo '<br/>';var_dump($options);
		//iterate over the options to create the options assoc array
		foreach ($dataOptions as $key => $val)
		{
			$options['options'][] = array(
				'id' => empty($options['use_value']) ? $key : $val,		// 使用key或val. edit by ta_shuo at 2016/10/24
				'text' => $val,
			);
		}

		$this->suppliedOptions = $options;
	}

	/**
	 * Fill a model with input data
	 *
	 * @param \Illuminate\Database\Eloquent\model	$model
	 * @param mixed									$input
	 */
	public function fillModel(&$model, $input)
	{
		$model->{$this->getOption('field_name')} = $input;
	}

	/**
	 * Sets the filter options for this item
	 *
	 * @param array		$filter
	 *
	 * @return void
	 */
	public function setFilter($filter)
	{
		parent::setFilter($filter);

		$this->userOptions['value'] = $this->getOption('value') === '' ? null : $this->getOption('value');
	}

	/**
	 * Filters a query object
	 *
	 * @param \Illuminate\Database\Query\Builder	$query
	 * @param array									$selects
	 *
	 * @return void
	 */
	public function filterQuery(QueryBuilder &$query, &$selects = null)
	{
		//run the parent method
		parent::filterQuery($query, $selects);

		//if there is no value, return
		if ($this->getFilterValue($this->getOption('value'))===false)
		{
			return;
		}

		$query->where($this->config->getDataModel()->getTable().'.'.$this->getOption('field_name'), '=', $this->getOption('value'));
	}
}