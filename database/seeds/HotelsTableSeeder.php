<?php

use Illuminate\Database\Seeder;

class HotelsTableSeeder extends Seeder
{
    private $fileUri = "database/csv/property-data.csv";

    private $keys = ['name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!file_exists(base_path($this->fileUri))) return;

        $this->import($this->fileUri);
    }

    private function import($file)
    {
        $allData = array_map('str_getcsv', file(base_path($file)));
        array_shift($allData);
        foreach ($allData as $row) {
            $data = array_combine($this->keys, $row);

            DB::table('hotels')->insert($data);
        }
    }
}
