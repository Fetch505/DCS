<?php

namespace App\Models\Permissions;

use App\Models\{Permission, Role, User};

trait HasPermissionTrait
{
  public function hasPermissionTo($permission)
  {
    // get permissions based on role or individual permissions
    return $this->hasPermissionThroughRoles($permission) || $this->hasPermission($permission);
  }

  protected function hasPermissionThroughRoles($permission)
  {
    foreach ($permission->roles as $role) {
      if($this->hasRole($role->name) ) {
        return true;
      }
    }

    return false;
  }

  protected function hasPermission($permission)
  {
    // check whether it has a relationship in users_permissions table
    return (bool) $this->permissions->where('name', $permission->name)->count();
  }

  public function role() {
      return $this->belongsTo(Role::class);
  }

  public function permissions() {
    return $this->belongsToMany(Permission::class, 'users_permissions');
  }

  public function hasRole($role)
  {
    if ($this->role->name == $role) {
      return true;
    }

    return false;
  }

}
