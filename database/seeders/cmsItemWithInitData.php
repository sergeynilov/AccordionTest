<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class cmsItemWithInitData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('cms_items')->delete();

/*        $table->string('title', 255);
        $table->string('key', 255)->unique();
        $table->mediumText('text');
        $table->foreignId('author_id')->references('id')->on('users')->onDelete('CASCADE');
        $table->boolean('published')->default(false);*/

        \DB::table('cms_items')->insert(array(
            0 =>
                array(
                    'id'    => 1,
                    'title' => 'Top currencies list',
                    'key'   => 'main_page_currencies_list_block_header',
                    'text'  => 'Top currencies list lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam,',
                    'author_id'=> 1,
                    'published'=> true,
                ),           // images/main_page_top_header.webp
            1 =>
                array(
                    'id'    => 2,
                    'title' => 'Main page Top Header',
                    'key'   => 'main_page_top_header_block',
                    'text'  => 'Main page top header block lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ',
                    'author_id'=> 4,
                    'published'=> true,
                ),
            2 =>
                array(
                    'id'    => 3,                             //
                    'title' => 'Trusted sources',
                    'key'   => 'trusted_sources_block_header',
                    'text'  => 'Currency data delivered are sourced from financial data providers and banks, including the European Central Bank. lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                    'author_id'=> 4,
                    'published'=> true,
                ),
            3 =>
                array(
                    'id'    => 4,
                    'title' => 'Currency rates service',
                    'key'   => 'currency_rates_service',
                    'text'  => '<p><strong>Currency rates</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>
<p><strong>Currency rates</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>',
                    'author_id'=> 1,
                    'published'=> true,
                ),
            4 =>
                array(
                    'id'    => 5,
                    'title' => 'What People Says, About Us',
                    'key'   => 'what_people_says_about_us',
                    'text'  => 'At Currency rates it\'s important to gain feedback on the service we deliver to you. We can continuously relay back where progress is being made to reinforce lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam,',
                    'author_id'=> 2,
                    'published'=> true,
                ),

            5 =>
                array(
                    'id'    => 6,
                    'title' => 'Contact us',
                    'key'   => 'main_page_contact_us_block',
                    'text'  => '<p><strong>Contact us</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>

<p><strong>Contact us</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>
',
                    'author_id'=> 2,
                    'published'=> true,
                ),

            6 =>
                array(
                    'id'    => 7,
                    'title' => 'Our authors',
                    'key'   => 'main_page_our_authors_block',
                    'text'  => 'Our authors ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla...',
                    'author_id'=> 1,
                    'published'=> true,
                ),

            7 =>
                array(
                    'id'    => 8,
                    'title' => 'Register information',
                    'key'   => 'register_information_block',
                    'text'  => 'Register information ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla...',
                    'author_id'=> 1,
                    'published'=> false,
                ),

            8 =>
                array(
                    'id'    => 9,
                    'title' => 'Our rules',
                    'key'   => 'our_rules_block',
                    'text'  => '<p><strong>Our rules</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>

<p><strong>Our rules</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>

<p><strong>Our rules</strong> description <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... <p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><p>Lorem <strong>ipsum dolor sit</strong> amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis <strong>nostrud exercitation</strong> ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla... </p><ul>
    <li>1st point lorem ipsum</li>
    <li>2nd point lorem ipsum</li>
    <li>3rd point lorem ipsum</li>
</ul></p>

',
                    'author_id'=> 1,
                    'published'=> true,
                ),


        ));


        \DB::table('media')->insert(array(
            array(
                'id'                    => 4,
                'model_type'            => 'App\\Models\\CMSItem',
                'model_id'              => 2,
                'uuid'                  => '2g49a505-676e-4zaa-b89u-2638738a391e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22de6791bca17184093c285e1c4b4b5',
                'file_name'             => 'main_page_top_header.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 334698,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 11,
            )
        ));

        \DB::table('media')->insert(array(
            array(
                'id'                    => 5,
                'model_type'            => 'App\\Models\\CMSItem',
                'model_id'              => 3,
                'uuid'                  => '2g490u05-676e-4zaa-b89u-26037389r91e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22d9u791bca17we4093c28re1c4b4b5',
                'file_name'             => 'trusted_sources.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 46996,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 12,
            )
        ));

        \DB::table('media')->insert(array(
            array(
                'id'                    => 6,
                'model_type'            => 'App\\Models\\CMSItem',
                'model_id'              => 4,
                'uuid'                  => '2g4iru05-676e-4zaa-b89u-2i737e29r91e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22d9u791bca17we4093c28re1c4b4b5',
                'file_name'             => 'currency_rates_service.jpg',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 179451,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 13,
            )
        ));

        \DB::table('media')->insert(array(
            array(
                'id'                    => 7,
                'model_type'            => 'App\\Models\\CMSItem',
                'model_id'              => 5,
                'uuid'                  => '2g4io605-676e-4zaa-bi0u-2ia07e21r91e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22d9u791bca17we4093c28re1c4b4b5',
                'file_name'             => 'what_people_says_about_us.webp',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 17918,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 14,
            )
        ));

        // our_rules_block
        \DB::table('media')->insert(array(
            array(
                'id'                    => 21,
                'model_type'            => 'App\\Models\\CMSItem',
                'model_id'              => 9,
                'uuid'                  => '2g4iu505-676e-406a-bi0u-u7a07e29391e',
                'collection_name'       => config('app.media_app_name'),
                'name'                  => 'b22d9u791bca17we4093c28re1c4b4b5',
                'file_name'             => 'our_rules.png',
                'mime_type'             => 'image/png',
                'disk'                  => 'public',
                'conversions_disk'      => 'public',
                'size'                  => 29691,
                'manipulations'         => '[]',
                'custom_properties'     => '[]',
                'generated_conversions' => '[]',
                'responsive_images'     => '[]',
                'order_column'          => 15,
            )
        ));

        /*        \DB::table('media')->insert(array(
                    array(
                        'id'              => 7,
                        'model_type'            => 'App\\Models\\CMSItem',
                        'model_id'              => ,
                        'uuid'                  => '2g4io605-676e-4zaa-bi0u-2ia07e21r91e',
                        'collection_name'       => config('app.media_app_name'),
                        'name'                  => 'b22d9u791bca17we4093c28re1c4b4b5',
                        'file_name'             => '',
                        'mime_type'             => 'image/png',
                        'disk'                  => 'public',
                        'conversions_disk'      => 'public',
                        'size'                  => 17918,
                        'manipulations'         => '[]',
                        'custom_properties'     => '[]',
                        'generated_conversions' => '[]',
                        'responsive_images'     => '[]',
                        'order_column'          => 13,
                    )
                ));*/

    }
}
