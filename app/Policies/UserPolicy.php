<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    //更新权限验证
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    //删除权限验证：  is_admin=1 , 不能自己删除自己 ==> 满足现实删除按钮
    public function destroy(User $currentUser, User $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
