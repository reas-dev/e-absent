<?php

namespace App\Exports;

use App\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ReportExport implements FromCollection, WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $participants = Participant::all();
        foreach ($participants as $participant) {
            $attendances = $participant->attendances;
            $participant->attend = 0;
            $participant->permit = 0;
            $participant->late = 0;
            $participant->invalid = 0;
            foreach ($attendances as $attendance) {
                if ($attendance->status == 1){
                    $participant->attend++;
                }
                else if ($attendance->status == 2){
                    $participant->permit++;
                }
                else if ($attendance->status == 3 || $attendance->status == 4){
                    $participant->late++;
                }
                else if ($attendance->status == 0){
                    $participant->invalid++;
                }
            }

        }
        return $participants;
    }

    public function headings(): array
    {
        return ["id", "user_id", "nik", "name", "place", "code", "phone", "deleted_at", "created_at", "updated_at", "attend", "permit", "late", "invalid"];
    }
}
