<?php

namespace App\Policies;

use App\Reply;
use App\RoleService;
use App\Service;
use App\User;
use App\UserChannelRole;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        // admin can do anything
        if($user->group_id == 1){
            return true;
        }
    }

    /**
     * Determine whether the user can view any replies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function view(User $user, Reply $reply)
    {
        //
    }

    /**
     * Determine whether the user can create replies.
     *
     * @param \App\User $user
     * @param int $channel_id
     * @return mixed
     */
    public function create(User $user, int $channel_id)
    {
        $service = Service::where('name', 'create_reply')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    /**
     * Determine whether the user can update the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function update(User $user, Reply $reply)
    {
        //
    }

    /**
     * Determine whether the user can delete the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function delete(User $user, Reply $reply)
    {
        $service = Service::where('name', 'delete_reply')->first();
        $user_channel_role = UserChannelRole::where(['user_id' => $user->id, 'channel_id' => $reply->channel_id])->first();

        if(!$user_channel_role){
            return Response::deny();
        } else {
            return is_null(RoleService::where(['role_id' => $user_channel_role->role_id, 'service_id' => $service->id]))
                ? Response::deny() : Response::allow();
        }
    }

    /**
     * Determine whether the user can restore the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function restore(User $user, Reply $reply)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the reply.
     *
     * @param  \App\User  $user
     * @param  \App\Reply  $reply
     * @return mixed
     */
    public function forceDelete(User $user, Reply $reply)
    {
        //
    }
}