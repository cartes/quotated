<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        Storage::deleteDirectory('users');
        Storage::deleteDirectory('products');

        Storage::makeDirectory('users');
        Storage::makeDirectory('products');

        factory(\App\Role::class, 1)->create(['name' => 'admin']);
        factory(\App\Role::class, 1)->create(['name' => 'user']);

        factory(\App\User::class,1)->create([
            'name' => 'Cristian',
            'surname' => 'Cartes',
            'email' => 'cristiancartesa@gmail.com',
            'slug' => 'cristian-cartes-1',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::ADMIN,
        ])->each(function (\App\User $user) {
            factory(\App\Buyer::class, 1)->create(['user_id' => $user->id]);
        });

        factory(\App\User::class, 1)->create([
            'name' => 'buyer',
            'surname' => 'smith',
            'email' => 'buyer@email.com',
            'password' => bcrypt('secret'),
            'role_id' => \App\Role::USER
        ])->each(function (\App\User $user) {
            factory(\App\Buyer::class, 1)->create((['user_id' => $user->id]));

            $user->image()->save(factory(\App\Image::class)->make());
        });

        factory(\App\User::class, 10)->create()
            ->each(function (\App\User $user) {
                factory(\App\Buyer::class, 1)->create(['user_id' => $user->id]);
                factory(\App\Seller::class, 1)->create(['user_id' => $user->id]);

                $user->image()->save(factory(\App\Image::class)->make());
        });

        factory(\App\User::class, 20)->create()
            ->each(function (\App\User $user) {
                factory(\App\Buyer::class, 1)->create(['user_id' => $user->id]);

                $user->image()->save(factory(\App\Image::class)->make());

            });

        factory(\App\Category::class, 15)->create();

        factory(\App\Product::class, 10)->create()->each(function (\App\Product $p) {
            factory(\App\ProductCar::class, 1)->create(['product_id' => $p->id]);
            $p->images()->save(factory(\App\Image::class)->make());
        });
        factory(\App\Product::class, 10)->create()->each(function (\App\Product $p) {
            factory(\App\ProductEstate::class, 1)->create(['product_id' => $p->id]);
        });
        factory(\App\Product::class, 20)->create()->each(function (\App\Product $p) {
            factory(\App\ProductService::class, 1)->create(['product_id' => $p->id]);
        });
        factory(\App\Product::class, 20)->create()->each(function (\App\Product $p) {
            factory(\App\ProductMeta::class, 1)->create(['product_id' => $p->id]);
        });

        factory(\App\Search::class, 50)->create();

    }
}
