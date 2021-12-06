<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
  
    protected $primaryKey= 'task_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'task_title',
        'description',
        'assigned_member_id',
        'estimate_hr',
        'estimate_start_date',
        'estimate_finish_date'

    ];

    public function project() {
        return $this->belongsTo(Project::class, 'project_id', 'project_id')->withTrashed();
    }
    public function employee() {
        return $this->belongsTo(Employee::class, 'assigned_member_id', 'employee_id');
    }
}
