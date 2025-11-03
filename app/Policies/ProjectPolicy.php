<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    /**
     * Create a new policy instance.
     */

    public function view(User $user, Project $project) : bool{
        return $user->id === $project->user_id;
    }

    public function update(User $user, Project $project) : bool{
        return $user->id === $project->user_id;
    }


    public function delete(User $user, Project $project) : bool{
        return $user->id === $project->user_id;
    }
}
