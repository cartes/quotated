<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder {
    public function run() {
        $cats = [
            [
                'title' => 'Automoviles',
                'slug' => 'automoviles',
                'cat_parent' => null,
                'order' => 2
            ],
            [
                'title' => 'Productos congelados',
                'slug' => 'productos_congelados',
                'cat_parent' => null,
                'order' => 0
            ],
            [
                'title' => 'Productos frescos',
                'slug' => 'productos_frescos',
                'cat_parent' => null,
                'order' => 1
            ],
            [
                'title' => 'Propiedades',
                'slug' => 'propiedades',
                'cat_parent' => null,
                'order' => 3
            ],
            [
                'title' => 'Embarcaciones',
                'slug' => 'embarcaciones',
                'cat_parent' => null,
                'order' => 4
            ],
            [
                'title' => 'Equipamientos oficina',
                'slug' => 'equipamientos_oficina',
                'cat_parent' => null,
                'order' => 5
            ],
            [
                'title' => 'Equipamiento profesional',
                'slug' => 'equipamiento_profesional',
                'cat_parent' => null,
                'order' => 6
            ],
            [
                'title' => 'Infraestructura',
                'slug' => 'infraestructura',
                'cat_parent' => null,
                'order' => 7
            ],
            [
                'title' => 'Otros',
                'slug' => 'otros',
                'cat_parent' => null,
                'order' => 8
            ],
        ];
        foreach ($cats as $category) {
            Category::create($category);
        }

    }
}

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

        factory(\App\User::class, 5)->create()
            ->each(function (\App\User $user) {
                factory(\App\Buyer::class, 1)->create(['user_id' => $user->id]);
                factory(\App\Seller::class, 1)->create(['user_id' => $user->id]);

                $user->image()->save(factory(\App\Image::class)->make());
        });

        factory(\App\User::class, 5)->create()
            ->each(function (\App\User $user) {
                factory(\App\Buyer::class, 1)->create(['user_id' => $user->id]);

                $user->image()->save(factory(\App\Image::class)->make());

            });

        $this->call(CategorySeeder::class);

        factory(\App\Product::class, 5)->create()->each(function (\App\Product $p) {
            factory(\App\ProductCar::class, 1)->create(['product_id' => $p->id]);
            $p->status()->create(['status' => 1]);
            $p->images()->save(factory(\App\Image::class)->make());
        });
        factory(\App\Product::class, 5)->create()->each(function (\App\Product $p) {
            $p->status()->create(['status' => 1]);
            factory(\App\ProductEstate::class, 1)->create(['product_id' => $p->id]);
        });

        factory(\App\Search::class, 50)->create();

    }
}
