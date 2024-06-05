<?php

namespace App\Http\Controllers;

use App\Domain\Entities\Debt;
use App\Domain\Entities\Debtor;
use App\Domain\Services\DebtNotifier;
use App\Domain\ValueObjects\DebtAmount;
use App\Domain\ValueObjects\DebtDueDate;
use App\Domain\ValueObjects\DebtId;
use App\Domain\ValueObjects\DebtorName;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\GovernmentId;
use App\Presentation\Http\Controllers\Controller;
use Generator;
use Illuminate\Http\Request;


class BillingController extends Controller
{
    public function __construct(
        private readonly DebtNotifier $debtNotifier,
    ) {
    }

    public function processBillingCsv(Request $request)
    {
        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file')->getRealPath();

            $debts = $this->parseCsv($file);

            foreach ($debts as $debt) {
                $this->debtNotifier->notify($debt);
            }

            return response()->json(['message' => 'File processed successfully']);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    private function parseCsv($filePath): Generator
    {
        if (($handle = fopen($filePath, 'r')) !== false) {
            fgetcsv($handle);
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $debtorName = new DebtorName($data[0]);
                $governMentId = new GovernmentId($data[1]);
                $email = new Email($data[2]);
                $debtAmount = new DebtAmount($data[3]);
                $debtDueDate = new DebtDueDate($data[4]);
                $debtId = new DebtId($data[5]);

                $debtor = new Debtor(
                    name: $debtorName,
                    email: $email,
                    governmentId: $governMentId,
                );

                yield new Debt(
                    id: $debtId,
                    amount: $debtAmount,
                    dueDate: $debtDueDate,
                    debtor: $debtor,
                );
            }

            fclose($handle);
        }
    }
}