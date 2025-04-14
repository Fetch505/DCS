<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Models\Permissions\HasPermissionTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements   JWTSubject
{
    use Notifiable, HasPermissionTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','status','address','city','zipcode','country','fax','notes',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function companyName()
    {
        $company = $this->belongsTo(User::class,'company_id')
                        ->select('name');
        return $company;
    }

    public function inspectionReviews()
    {
        return $this->hasMany(InspectionReview::class,'inspector_id');
    }

    public function inspectorProjects()
    {
        return $this->hasMany(Project::class,'inspector_id');
    }

    public function supervisorProjects()
    {
        return $this->hasMany(Project::class,'supervisor_id');
    }

    public function customer() {//making one to one relationship b/w user and customer
      return $this->hasOne(Customer::class, 'user_id');
    }

    public function agency() {
      return $this->belongsTo(EmployAgency::class, 'employment_agency_id');
    }

    public function shift() {
      return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function company() {
      return $this->belongsTo(Company::class, 'company_id');
    }

    public function worker_type() {
      return $this->belongsTo(WorkerType::class, 'worker_type_id');
    }

    public function days()
    {//days are the numbers of jobs assigned to specific user
        return $this->hasMany(Day::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function companyAllowedSickLeaves($id)
    {
      return (bool) $this->where('id', '=', $id)->first()->allow_leaves;
    }

     public function leaves()
      {
        return $this->belongsToMany(Leave::class)
                    ->latest();
      }

      public function isInspector()
      {
        return (bool) $this->permissions->where('name','=','give feedback')->count();
      }

}
