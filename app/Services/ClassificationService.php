<?php

namespace App\Services;

use App\Repositories\Contracts\ClassificationRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class ClassificationService
{
    private $repo;

    public function __construct(ClassificationRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function store()
    {
        return $this->repo->store();
    }

    public function getClassificationByAge()
    {
        /* *
         * A listagem de classificações por idade deve apresentar as posições dos
         * candidatos dentro dos seguintes grupos em cada tipo de prova:
         * o 18 – 25 anos
         * o 25 – 35 anos
         * o 35 – 45 anos
         * o 45 – 55 anos
         * o Acima de 55 anos
         * Por exemplo, as colocações de 18 -25 na prova de 3km apresentarão os 1º,2º, 3º, ...,
         * nesta faixa de idade, o mesmo para as outras faixas e tipos de provas.
         * */



    }

    public function getGeneralClassification()
    {
        /* *
         * A listagem de classificações gerais deve ser separada por tipos de provas.
         * */
    }
}
