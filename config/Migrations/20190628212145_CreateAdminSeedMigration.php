<?php
use Migrations\AbstractMigration;
use Cake\Auth\DefaultPasswordHasher;

class CreateAdminSeedMigration extends AbstractMigration
{
    public function up()
    {
        $faker = \Faker\Factory::create();
        $populator = new Faker\ORM\CakePhp\Populator($faker);

        $populator->addEntity('Users', 1, [
            'first_name' => 'Alvaro',
            'last_name' => 'Orellana',
            'email' => 'alvaro.orellana01@gmail.com',
            'password' => function (){
                $hasher = new DefaultPasswordHasher();
                return $hasher->hash('secret');
            },
            'role' => 'admin',
            'active' => 1,
            'created' => function() use($faker){
                return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
            },
            'modified' => function() use($faker){
                return $faker->dateTimeBetween($startDate = 'now', $endDate = 'now');
            }
        ]);

        $populator->execute();
    }
}
