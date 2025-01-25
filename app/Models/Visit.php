<?php  

    namespace App\Models;  

    use Illuminate\Database\Eloquent\Factories\HasFactory;  
    use Illuminate\Database\Eloquent\Model;  

    class Visit extends Model  
    {  
        use HasFactory;  

        protected $table = 'visit';  

        protected $fillable = [  
            'Family_ID',  
            'Date',  
            'Comment',  
            'Visiting_Officer'
        ];  

        public function visitsChecklists()  
        {  
            return $this->hasMany(VisitsChecklist::class, 'visit_id');  
        }  

        public function family()  
        {  
            return $this->belongsTo(Family::class, 'Family_ID');  
        }  
    }