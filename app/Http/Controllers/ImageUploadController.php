<?PHP 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');

            return response()->json([
                'success' => 1,
                'file' => [
                    'url' => asset('storage/' . $path),
                ]
            ]);
        }

        return response()->json([
            'success' => 0,
            'error' => ['message' => 'Image upload failed.']
        ]);
    }
}
