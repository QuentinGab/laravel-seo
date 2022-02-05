<?php

namespace RalphJSmit\Laravel\SEO\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class PageWithOverrides extends Model
{
    use HasSEO;

    protected $guarded = [];

    protected $table = 'pages';

    public static array $overrides = [];

    public function getSEOImageUrl(): string
    {
        return secure_asset('public/storage/images/test.jpg');
    }
}