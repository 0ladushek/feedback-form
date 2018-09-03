<?php

namespace App\Models;

use App\Loger;
use App\MagicTrait;
use App\MultiException;

/**
 * Class Model
 * @package App\Models
 * @property const TABLE
 */


abstract class Model
{

    use MagicTrait;

    const TABLE = '';

    public function insert()
    {
        $rows = $values = [];
        foreach ($this->data as $key => $val) {
            if($key == 'id') {
                continue;
            }
            $rows[] = $key;
            $values[$key] = $val;
        }
        $sql = 'INSERT INTO ' . static::TABLE . ' (' .  implode(', ', $rows) . ') ' .
            'VALUES ' . '(:' . implode(', :', $rows) . ')';
        $db = new \App\Db;
        $db->execute($sql, $values);
        $this->data['id'] = $db->lastInsertId();
        return $sql;
    }
}