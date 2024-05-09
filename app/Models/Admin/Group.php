<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Group_session;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\GroupPatientAssignment;
use App\Models\Admin\GroupDoctorAssignment;
use App\Models\Admin\PatientApoms;

class Group extends Model
{

    protected $fillable = [
        'group_name',
        'group_details',
        'start_session_date',
        'end_session_date',
        'total_session',
        'group_type',
        'schedule'
    ];
    use HasFactory;

    public function group_session()
    {
        return $this->hasMany(Group_session::class, 'group_id', 'id');
    }

    public function groupPatientAssignments()
    {
        return $this->hasMany(GroupPatientAssignment::class, 'group_id');
    }


    public function groupDoctorAssignments()
    {
        return $this->hasMany(GroupDoctorAssignment::class);
    }

    public function groupPatientApom()
    {
        return $this->hasMany(PatientApoms::class);
    }
}
