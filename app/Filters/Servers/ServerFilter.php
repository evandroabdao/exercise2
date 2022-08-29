<?php

namespace App\Filters\Servers;

use App\Enums\ColumnsEnum;
use App\Filters\Base\BaseFilter;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Decimal;
use Ramsey\Uuid\Type\Integer;

class ServerFilter extends BaseFilter
{
    /**
     * Filter servers by any column.
     *
     * @param $value
     *
     * @return void
     */
    public function f($value)
    {
        $rows = [];

        foreach ($this->data as $row) {
            $model = Str::of($row[ColumnsEnum::COLUMN_MODEL])->toString();
            if (str_contains($model, $value)) {
                $rows[] = $row;
            }
        }

        $this->data = $rows;
    }

    /**
     * Filter servers by any column.
     *
     * @param $value
     *
     * @return void
     */
    public function storage($value)
    {
        $rows = [];

        $args = explode(',', $value);
        if (count($args)==1) {
            $min = 0;
            $max = self::toGB($args[0]);
        } else {
            $min = self::toGB($args[0]);
            $max = self::toGB($args[1]);
        }

        foreach ($this->data as $row) {
            $totalStorage = self::calculateStorage(Str::of($row[ColumnsEnum::COLUMN_HDD])->before(search: 'B')->toString());
            if ($totalStorage >= $min && $totalStorage <= $max) {
                $rows[] = $row;
            }
        }

        $this->data = $rows;
    }

    /**
     * Filter servers by any column.
     *
     * @param $value
     *
     * @return void
     */
    public function ram($value)
    {
        $rows = [];

        $args = explode(',', $value);

        foreach ($this->data as $row) {
            $column = Str::of($row[ColumnsEnum::COLUMN_RAM])->toString();
            foreach ($args as $val) {
                if (str_starts_with($column, $val)) {
                    $rows[] = $row;
                    continue;
                }
            }
        }

        $this->data = $rows;
    }

    /**
     * Filter servers by harddisk type.
     *
     * @param $value
     *
     * @return void
     */
    public function hdd($value)
    {
        $rows = [];

        $value = strtoupper($value);

        foreach ($this->data as $row) {
            $model = Str::of($row[ColumnsEnum::COLUMN_HDD])->toString();
            if (str_contains($model, $value)) {
                $rows[] = $row;
            }
        }

        $this->data = $rows;
    }

    /**
     * Filter servers by location.
     *
     * @param $value
     *
     * @return void
     */
    public function location($value)
    {
        $rows = [];

        $value = strtoupper($value);

        foreach ($this->data as $row) {
            $model = Str::of($row[ColumnsEnum::COLUMN_LOCATION])->toString();
            if (str_contains(strtoupper($model), $value)) {
                $rows[] = $row;
            }
        }

        $this->data = $rows;
    }

    /**
     * Calculate the total storage.
     *
     * @param $value
     *
     * @return int
     */
    private function calculateStorage($value):int
    {
        $value = self::toGB($value);

        $numbers = explode('x', $value);

        return count($numbers) > 1 ? (int)$numbers[0]*(int)$numbers[1] : 0;
    }

    /**
     * Convert string to integer GB.
     *
     * @param $value
     *
     * @return string
     */
    private function toGB($value):string
    {
        return $value = str_replace(['T', 'G', 'B'], ['000', '', ''], $value);
    }
}
