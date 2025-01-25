<?php  

namespace App\Models;  

use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  

class HomeStatus extends Model  
{  
    use HasFactory;  

    // تحديد اسم الجدول إذا لم يكن مطابقًا لاسم النموذج بصيغة الجمع  
    protected $table = 'home_status';  

    // تحديد المفتاح الأساسي إذا لم يكن 'id'  
    protected $primaryKey = 'ID';  

    // تمكين التلقائية في تعبئة القيم  
    public $timestamps = false;  

    // حقل قابل للتعبئة  
    protected $fillable = ['status'];  

     // Define the relationship with the Family model
     public function families()
     {
         return $this->hasMany(Family::class, 'Home_Condition', 'ID');
     }
}