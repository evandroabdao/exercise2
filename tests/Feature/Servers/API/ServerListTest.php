<?php

namespace Tests\Feature\Servers\API;

use Tests\TestCase;

class VendorListTest extends TestCase
{
    const ROUTE_LIST = 'servers.list';
    const COLUMN_MODEL = 0;
    const COLUMN_RAM = 1;
    const COLUMN_HDD = 2;
    const COLUMN_LOCATION = 3;
    const COLUMN_PRICE = 4;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Tests if the servers list is returning records.
     *
     * @return void
     */
    public function test_it_lists_servers()
    {
        $response = $this->get(route(self::ROUTE_LIST));
        $response
            ->assertOk();
    }

    /**
     * Tests if the filter by storage is filtering.
     *
     * @return void
     */
    public function test_it_filters_servers_by_storage()
    {
        $filter = '0,250GB';

        $response = $this->get(route(self::ROUTE_LIST) . '?' . http_build_query([
                'storage' => $filter,
            ]));
        $response->assertOk();
    }

    /**
     * Tests if the filter by memory ram is filtering.
     *
     * @return void
     */
    public function test_it_filters_servers_by_ram()
    {
        $filter2GB = '2GB';
        $filter4GB = '4GB';

        $response = $this->get(route(self::ROUTE_LIST) . '?' . http_build_query([
                'ram' => $filter2GB.",".$filter4GB,
            ]));
        $response->assertOk();

        $data = json_decode($response->getContent());

        //Verify if is there any different record from the filter
        foreach ($data as $row) {
            if (!(str_starts_with($row[self::COLUMN_RAM], $filter2GB) || str_starts_with($row[self::COLUMN_RAM], $filter4GB))) {
                $this->assertTrue(str_starts_with($row[self::COLUMN_RAM], $filter2GB) || str_starts_with($row[self::COLUMN_RAM], $filter4GB));
                continue;
            }
        }
    }

    /**
     * Tests if the filter by harddisk type is filtering.
     *
     * @return void
     */
    public function test_it_filters_servers_by_hdd()
    {
        $filter = 'SAS';

        $response = $this->get(route(self::ROUTE_LIST) . '?' . http_build_query([
                'hdd' => $filter,
            ]));
        $response->assertOk();

        $data = json_decode($response->getContent());

        //Verify if is there any different record from the filter
        foreach ($data as $row) {
            if (!str_contains($row[self::COLUMN_HDD], $filter)) {
                $this->assertTrue(str_contains($row[self::COLUMN_HDD], $filter));
                continue;
            }
        }
    }

    /**
     * Tests if the filter by location is filtering.
     *
     * @return void
     */
    public function test_it_filters_servers_by_location()
    {
        $filter = 'Hong KongHKG-10';

        $response = $this->get(route(self::ROUTE_LIST) . '?' . http_build_query([
                'location' => $filter,
            ]));
        $response->assertOk();

        $data = json_decode($response->getContent());

        //Verify if is there any different record from the filter
        foreach ($data as $row) {
            if (!str_contains($row[self::COLUMN_LOCATION], $filter)) {
                $this->assertTrue(str_contains($row[self::COLUMN_LOCATION], $filter));
                continue;
            }
        }
    }

    /**
     * Tests if the filter by 2GB of ram doesn't return any record.
     *
     * @return void
     */
    public function test_it_retuns_0_records_filtering_by_2GB_ram()
    {
        $filter = '2GB';

        $response = $this->get(route(self::ROUTE_LIST) . '?' . http_build_query([
                'ram' => $filter,
            ]));
        $response
            ->assertOk()
            ->assertJsonCount(0);
    }
}
