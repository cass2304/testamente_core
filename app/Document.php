<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  protected $primaryKey = 'document_id';
  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'tbl_documents';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['user_id', 'step'];

  public $timestamps = false;
}
