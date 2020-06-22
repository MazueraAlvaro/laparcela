<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
            "name" => "Frutas",
            "code" => "fruits",
            "description" => "Se denomina fruta a aquellos frutos comestibles obtenidos de plantas cultivadas o silvestres
                              que, por su sabor generalmente dulce-acidulado, su aroma intenso y agradable y sus propiedades
                              nutritivas, suelen consumirse mayormente en su estado fresco, como jugo o como postre
                              (y en menor medida, en otras preparaciones), una vez alcanzada la madurez organoléptica,
                              o luego de ser sometidos a cocción​"
        ]);

        \App\Models\Category::create([
            "name" => "Pulpa de Fruta",
            "code" => "pulps",
            "description" => "100% Pulpa de Fruta Natural, con la riqueza y nutrientes de las frutas de nuestra tierra
                              Colombiana."
        ]);

        \App\Models\Category::create([
            "name" => "Verduras",
            "code" => "vegetables",
            "description" => "Las verduras son hortalizas cuyo color predominante es el verde.​ Sin embargo, el uso
                              popular suele extender su significado a otras partes comestibles de las plantas, como
                              hojas, inflorescencias y tallos.​ El vocablo verdura no es de carácter científico ni
                              botánico, tratándose de una denominación popular con un significado que varía de una
                              cultura a otra, pudiendo en ocasiones ser sinónimo de hortalizas o equivalente a vegetales
                              que no lleven el sabor dulce o ácido de las frutas (de allí que se hable de frutas y verduras)."
        ]);
    }
}
