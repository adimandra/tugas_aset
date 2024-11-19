<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class Asset extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'kode_aset', 'nama_aset', 'kategori_id','keterangan', 'link_aset', 'tipe_file', 'gambar', 'previous_file_name', 'deleted'
    ];
    protected $dates = ['deleted_at'];

    protected $table = 'assets'; // Ganti dengan nama tabel yang sesuai

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($asset) {
            Log::info('Deleting asset:', ['id' => $asset->id, 'file' => $asset->link_aset]);

            if ($asset->link_aset) {
                $oldFileName = public_path('Gambar/' . $asset->link_aset);
                $newFileName = public_path('Gambar/deleted_' . $asset->link_aset);

                if (File::exists($oldFileName)) {
                    File::move($oldFileName, $newFileName);

                    Log::info('File renamed:', ['old' => $oldFileName, 'new' => $newFileName]);

                    $asset->previous_file_name = $asset->link_aset;
                    $asset->link_aset = 'deleted_' . $asset->link_aset;
                    $asset->save();
                } else {
                    Log::warning('File does not exist:', ['file' => $oldFileName]);
                }
            }
        });
    }

    public function getLinkAsetAttribute($value)
    {
        return url('Gambar/' . $value);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class,'kategori_id','id');
    }

}
