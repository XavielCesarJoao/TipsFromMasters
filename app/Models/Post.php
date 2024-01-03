<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gravarRegistroNaBd($request, $img): bool
    {
        try {
            self::create([
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'body' => $request->body,
                'min_to_read' => $request->min_to_read,
                'image_path' => $img,
                'is_published' => $request->is_published === 'on',
            ]);

            return true;
        } catch (\Exception $ex) {
        }

        return false;
    }

    public static function atualizarRegisto(Request $request, $id)
    {
        self::where('id', $id)->update([
          'title' => $request->title,
          'excerpt' => $request->excerpt,
          'body' => $request->body,
          'min_to_read' => $request->min_to_read,
          'image_path' => $request->image,
          'is_published' => $request->is_published === 'on',
        ]);
    }
}
