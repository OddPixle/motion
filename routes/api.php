<?PHP
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageUploadController;

Route::post('/upload-image', [ImageUploadController::class, 'upload']);
