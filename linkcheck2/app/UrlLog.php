<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlLog extends Model
{
  #  protected $table = 'url_logs';
 	protected $fillable = ['url', 'domain', 'link_code','target_url','anchor_text','nofollow','links_on_page', 'created_at', 'updated_at'];

}
