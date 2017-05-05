<?php

namespace Waredesk\Mappers\Product\Variant;

use Waredesk\Collections\Products\Variants\Options;
use Waredesk\Models\Product\Variant\Option;

class OptionsMapper
{
    public function map(Options $options, array $data): Options
    {
        foreach ($data as $optionData) {
            $options->add((new OptionMapper())->map(new Option(), $optionData));
        }
        return $options;
    }
}
