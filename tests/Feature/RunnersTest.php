<?php

namespace Tests\Feature;

use Tests\TestCase;

class RunnersTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function store_runners()
    {
        $this->withoutExceptionHandling();
        $jsonRequest = [
            [
                "name" => "Cláudia Clarice Benedita Campos",
                "cpf" => "590.561.818-66",
                "birthday" => "2003-05-23"
            ],
            [
                "name" => "Vera Liz Moraes",
                "cpf" => "458.679.725-85",
                "birthday" => "2003-02-13"
            ],
            [
                "name" => "Francisco Fernando Giovanni da Luz",
                "cpf" => "102.926.374-46",
                "birthday" => "2003-02-25"
            ],
            [
                "name" => "Benjamin Ryan Tiago Caldeira",
                "cpf" => "716.102.843-48",
                "birthday" => "2003-04-10"
            ],
            [
                "name" => "Pedro Henry Renan Monteiro",
                "cpf" => "024.316.993-07",
                "birthday" => "2002-09-01"
            ],
            [
                "name" => "Leandro Marcelo Paulo Peixoto",
                "cpf" => "825.536.619-91",
                "birthday" => "1986-02-13"
            ],
            [
                "name" => "Ayla Mariana Luciana Vieira",
                "cpf" => "012.374.308-79",
                "birthday" => "1982-07-02"
            ],
            [
                "name" => "Sebastiana Bárbara Teixeira",
                "cpf" => "579.834.217-45",
                "birthday" => "1977-03-27"
            ],
            [
                "name" => "Alexandre Luís Gomes",
                "cpf" => "861.242.873-40",
                "birthday" => "1944-01-08"
            ],
            [
                "name" => "Isis Fernanda Pereira",
                "cpf" => "180.879.742-63",
                "birthday" => "1963-05-07"
            ],
            [
                "name" => "Tatiane Antônia Jéssica Brito",
                "cpf" => "359.352.841-03",
                "birthday" => "1970-07-20"
            ],
            [
                "name" => "Catarina Andreia dos Santos",
                "cpf" => "706.506.198-11",
                "birthday" => "1970-09-03"
            ],
            [
                "name" => "Osvaldo Alexandre Thales da Paz",
                "cpf" => "254.439.821-33",
                "birthday" => "1970-02-20"
            ],
            [
                "name" => "Miguel Heitor Campos",
                "cpf" => "596.017.199-62",
                "birthday" => "1970-04-15"
            ],
            [
                "name" => "Patrícia Rayssa Costa",
                "cpf" => "159.785.707-60",
                "birthday" => "1970-08-22"
            ],
            [
                "name" => "Diego Anderson Diogo Freitas",
                "cpf" => "046.067.479-00",
                "birthday" => "1957-05-09"
            ],
            [
                "name" => "Yasmin Mirella Elisa Almeida",
                "cpf" => "837.125.094-05",
                "birthday" => "1957-11-08"
            ],
            [
                "name" => "Alexandre Giovanni Baptista",
                "cpf" => "994.018.719-06",
                "birthday" => "1957-12-02"
            ],
            [
                "name" => "Levi Rodrigo Baptista",
                "cpf" => "781.234.097-02",
                "birthday" => "1957-08-24"
            ],
            [
                "name" => "Ana Ester Silvana Barros",
                "cpf" => "197.404.784-92",
                "birthday" => "1957-03-11"
            ]

        ];

        $this->json('POST', route('runners.store'), $jsonRequest)
            ->assertStatus(200);
    }
}
