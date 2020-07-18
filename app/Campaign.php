<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    public function search(Array $data)
    {
        $sql = $this->where(function ($query) use($data) {
            if (isset($data['id']))
                $query->where('id',$data['id']);

            if (isset($data['name']))
                $query->where('name','LIKE','%'.$data['name'].'%');

            if (isset($data['description']))
                $query->where('description','LIKE','%'.$data['description'].'%');

            if (isset($data['filters']))
                $query->where('filters','LIKE','%'.$data['filters'].'%');

            if (isset($data['active']))
                $query->where('active','LIKE','%'.$data['active'].'%');

            if (isset($data['duration']))
                $query->where('duration','LIKE','%'.$data['duration'].'%');

            if (isset($data['created_at']))
                $query->where('created_at','LIKE','%'.$data['created_at'].'%');

            if (isset($data['finished_at']))
                $query->where('finished_at','LIKE','%'.$data['finished_at'].'%');

        });//->toSql();dd($sql);

        return $sql;

    }
}
