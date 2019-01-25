<?php

namespace DKulyk\Nova;

use Laravel\Nova\Card;
use Laravel\Nova\Filters\Filter;

class FilterCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = 'full';

    /**
     * NovaFilterTool constructor.
     * @param Filter|string $filter
     */
    public function __construct($filter)
    {
        parent::__construct(null);

        if ($filter instanceof Filter) {
            $filter = $filter->key();
        }

        $this->withMeta(['filter' => $filter]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'dkulyk-nova-filter-card';
    }

//    public function authorize(Request $request)
//    {
//        return $request instanceof ResourceIndexRequest && parent::authorize($request);
//    }
}
