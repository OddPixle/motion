<?PHP 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('image') ?? $request->file('file');
    
        if ($file) {
            $path = $file->store('uploads', 'public');
    
            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => asset('storage/' . $path),
                ]
            ]);
        }
    
        return response()->json([
            'success' => 0,
            'message' => 'No image uploaded',
        ]);
    }
    
}
