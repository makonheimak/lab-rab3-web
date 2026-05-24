<?php

namespace MaksimYurash\EcommerceSuite\Models\Concerns;

trait UsesPackageTablePrefix
{
    public function getTable(): string
    {
        if (isset($this->table)) {
            return $this->table;
        }

        $base = $this->packageTableName ?? parent::getTable();

        return config('ecommerce-suite.table_prefix', 'mshop_') . $base;
    }
}
