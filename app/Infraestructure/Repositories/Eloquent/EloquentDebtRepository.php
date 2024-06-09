<?php

namespace App\Infraestructure\Repositories\Eloquent;

use App\Domain\Entities\Debt;
use App\Domain\Repositories\DebtRepository;
use App\Infraestructure\Models\Debt as ModelsDebt;

class EloquentDebtRepository implements DebtRepository
{
    public function __construct(private ModelsDebt $model)
    {
    }

    public function store(Debt $debt): void
    {
        $model = $this->model->newInstance();

        $model->id = $debt->id->value;
        $model->amount = $debt->amount->value;
        $model->status = $debt->status()->value;
        $model->due_date = $debt->dueDate->value;
        $model->debtor_name = $debt->debtor->name->value;
        $model->debtor_email = $debt->debtor->email->value;
        $model->debtor_government_id = $debt->debtor->governmentId->value;

        $model->save();
    }
}