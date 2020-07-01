<?php

namespace App;

use Illuminate\Support\Facades\Redis;

class Visits
{
    protected $thread;

    public function __construct($thread)
    {
        $this->thread = $thread;
    }

    public function record()
    {
        return Redis::incr($this->cacheKey());
    }

    public function reset()
    {
        return Redis::del($this->cacheKey());
    }

    public function count()
    {
        return Redis::get($this->cacheKey()) ?? 0;

    }

    protected function cacheKey()
    {
        return "threads.{$this->thread->id}.visits";
    }
}
