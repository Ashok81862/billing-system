<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('units')->truncate();

        $unit_weight = [
            ['Milligram', 'Milligrams', 'MG', 'MGs'],
            ['Gram', 'Grams', 'GM', 'GMs'],
            ['Kilogram', 'Kilograms', 'KG', 'KGs'],
            ['Quintal', 'Quintals', 'Quintal', 'Quintals'],
            ['Tonne', 'Tonnes', 'Tonne', 'Tonnes'],
            ['Tola', 'Tola', 'Tola', 'Tolas'],
            ['Carat', 'Carats', 'CT', 'CT']
        ];

        $unit_liquid = [
            ['Millilitre', 'Millilitre', 'ML', 'ML'],
            ['Litre', 'Litres', 'L', 'L'],
            ['Gallon', 'Gallons', 'Gallon', 'Gallons'],
        ];

        $unit_length = [
            ['Millimeter', 'Millimeters', 'MM', 'MM'],
            ['Centimeter', 'Centimeters', 'CM', 'CM'],
            ['Meter', 'Meters', 'M', 'M'],
            ['Kilometer', 'Kilometers', 'KM', 'KM'],
            ['Inch', 'Inches', 'IN', 'IN'],
            ['Feet', 'Feet', 'FT', 'FT'],
        ];

        $unit_other = [
            ['Carton', 'Cartons', 'Carton', 'Cartons'],
            ['Packet', 'Packets', 'Packet', 'Packets'],
            ['Piece', 'Pieces', 'Piece', 'Pieces'],
            ['Bottle', 'Bottles', 'Bottle', 'Bottles'],
            ['Bag', 'Bags', 'Bag', 'Bags']
        ];

        // Join Arrays
        $units = array_merge($unit_weight, $unit_liquid, $unit_length, $unit_other);

        // Format to database values
        $all_units = collect($units)->map(function ($unit) {
            return [
                'singular_name' => $unit[0],
                'plural_name' => $unit[1],
                'singular_abbr' => $unit[2],
                'plural_abbr' => $unit[3]
            ];
        });

        // Put it all at once (is faster than create() )
        Unit::insert($all_units->toArray());
    }
}
