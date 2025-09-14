<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CatatanTekananDarah;
use App\Models\PengingatObat;

return new class extends Migration
{
    public function up()
    {
        // Get all blood pressure records
        $records = CatatanTekananDarah::whereNull('pengingat_obat_id')->get();

        foreach ($records as $record) {
            // Find active reminder at the time of blood pressure record
            $pengingat = PengingatObat::where('user_id', $record->user_id)
                ->where('status', 'aktif')
                ->where('created_at', '<=', $record->created_at)
                ->latest()
                ->first();

            if ($pengingat) {
                $record->update([
                    'pengingat_obat_id' => $pengingat->id
                ]);
            }
        }
    }

    public function down()
    {
        CatatanTekananDarah::whereNotNull('pengingat_obat_id')
            ->update(['pengingat_obat_id' => null]);
    }
};
