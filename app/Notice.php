<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model {

    protected $fillable = [
        'provider_id',
        'infringing_title',
        'infringing_link',
        'original_link',
        'original_description',
        'template',
        'content_removed'
    ];

    /**
     * A notice belongs to a provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo('App\Provider', 'provider_id');
    }

    /**
     * A notice belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('app\User');
    }


    /**
     * Get the email address for the creipoment of the dmca
     *
     * @return mixed
     */
    public function getRecipientEmail()
    {
        return $this->recipient->copyright_email;
    }

    /**
     * Get the email address of the owner of the notice
     *
     * @return mixed1
     */
    public function getOwnerEmail()
    {
        return $this->user->email;
    }

}
