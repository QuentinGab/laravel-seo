<?php

namespace RalphJSmit\Laravel\SEO\Tags;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use RalphJSmit\Laravel\SEO\Support\MetaTag;
use RalphJSmit\Laravel\SEO\Support\OpenGraphTag;
use RalphJSmit\Laravel\SEO\Support\RenderableCollection;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class OpenGraphTags extends Collection implements Renderable
{
    use RenderableCollection;

    public static function initialize(SEOData $SEOData): static
    {
        $collection = new static();

        if ( $SEOData->title ) {
            $collection->push(new OpenGraphTag('title', $SEOData->title));
        }

        if ( $SEOData->description ) {
            $collection->push(new OpenGraphTag('description', $SEOData->description));
        }

        if ( $SEOData->image ) {
            $collection->push(new OpenGraphTag('image', $SEOData->image));

            $collection->push(new OpenGraphTag('image:width', $SEOData->imageMeta->width));
            $collection->push(new OpenGraphTag('image:height', $SEOData->imageMeta->height));
        }

        $collection->push(new OpenGraphTag('url', url()->current()));

        if ( $SEOData->site_name ) {
            $collection->push(new OpenGraphTag('site_name', $SEOData->site_name));
        }

        if ( $SEOData->type ) {
            $collection->push(new OpenGraphTag('type', $SEOData->type));
        }

        if ( $SEOData->published_time && $SEOData->type === 'article' ) {
            $collection->push(new MetaTag('article:published_time', $SEOData->published_time->toIso8601String()));
        }

        if ( $SEOData->modified_time && $SEOData->type === 'article' ) {
            $collection->push(new MetaTag('article:modified_time', $SEOData->modified_time->toIso8601String()));
        }

        if ( $SEOData->section && $SEOData->type === 'article' ) {
            $collection->push(new MetaTag('article:section', $SEOData->section));
        }

        if ( $SEOData->tags && $SEOData->type === 'article' ) {
            foreach ($SEOData->tags as $tag) {
                $collection->push(new MetaTag('article:tag', $tag));
            }
        }

        return $collection;
    }
}