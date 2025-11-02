<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\User;

    class Project extends Model
    {
        protected $guarded = [];

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
    }
