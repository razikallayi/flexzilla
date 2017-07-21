<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Models\Property::class, function (Faker\Generator $faker) {
	// $faker->addProvider(new Faker\Provider\en_US\Person($faker));
    $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
    $slug = str_slug($title);
    $typeId = App\Models\PropertyType::inRandomOrder()->first()->id;
    return [
        'title'           => $title,    
        'slug'            => $slug,   
        'description'     => $faker->realText(200,2),          
        'category_id'     => ['1','2','3'][array_rand (['1','2','3'])],          
        'property_type_id'=> $typeId,               
        'price'           => $faker->randomNumber(6),    
        'rental_period'   => ['Monthly','Yearly'][array_rand (['Monthly','Yearly'])],            
        'address_1'       => $faker->streetName,        
        'address_2'       => $faker->streetAddress,        
        'city'            => $faker->city,   
        'country'         => $faker->country,      
        'bedroom'         => $faker->randomNumber(1),      
        'bathroom'        => $faker->randomNumber(1),       
        'area'            => $faker->randomNumber(3),   
        'contact_number'  => $faker->e164PhoneNumber,             
        'email'           => $faker->unique()->safeEmail,
        'furnished'       => ['1','2','3'][array_rand (['1','2','3'])],        
        'latitude'        => $faker->latitude,       
        'longitude'       => $faker->longitude,        
        'title_ar'        => $faker->title,       
        'description_ar'  => $faker->realText(200,2),             
        'is_featured'     => $faker->boolean,          
        'is_published'    => $faker->boolean,           
    ];

    // imageUrl($width = 640, $height = 480)
});


$factory->define(App\Models\Media::class, function (Faker\Generator $faker) {
    return [
       'image' => 'EC7wwefzipvBqPy1489838131.png',
       'video' => null,
       'table_name' => 'properties',
       'item_id' => $faker->numberBetween($min = 0, $max = 50),
    ];
});
