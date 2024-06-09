<?php

namespace App\Infraestructure\Repositories\Eloquent;

use App\Domain\Entities\Debt;
use App\Domain\Repositories\DebtRepository;
use App\Domain\ValueObjects\DebtId;
use App\Domain\ValueObjects\DebtStatus;
use App\Infraestructure\Models\Debt as ModelsDebt;

class EloquentDebtRepository implements DebtRepository
{
    public function __construct(private ModelsDebt $model)
    {
    }

    public function store(Debt $debt): void
    {
        $model = $this->model->newInstance();

        $model->transaction_id = $debt->transactionId->value;
        $model->amount = $debt->amount->value;
        $model->status = $debt->status()->value;
        $model->due_date = $debt->dueDate->value;
        $model->debtor_name = $debt->debtor->name->value;
        $model->debtor_email = $debt->debtor->email->value;
        $model->debtor_government_id = $debt->debtor->governmentId->value;

        $model->save();

        $debt->created(new DebtId($model->id));
    }

    public function update(Debt $debt): void
    {
        $this->model->where('id', $debt->id()->value)
            ->update([
                'status' => $debt->status()->value,
            ]);
    }

    public function fetchOverdue(int $expireDays, int $count): array
    {
        $today = now();
        $expireDay = now()->subDays($expireDays);

        return $this->model
            ->where(function($query) use ($today) {
                $query->where('status', DebtStatus::created()->value)
                    ->where('due_date', '<', $today);
            })
            ->orWhere(function($query) use ($expireDay) {
                $query->where('status', DebtStatus::charged()->value)
                    ->where('updated_at', '<', $expireDay);
            })
            ->take($count)
            ->get()
            ->toArray();
    }
}