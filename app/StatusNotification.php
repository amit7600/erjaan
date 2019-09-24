<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusNotification extends Model
{
    Protected $table = 'complain_notification';

    Protected $fillable = [
    	'status_template','sms_template','email_template','users','status','send_to_customer','customer_email_template','customer_sms_template'
    ];
}
