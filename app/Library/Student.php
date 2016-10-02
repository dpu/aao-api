<?php

namespace App\Library;

use Illuminate\Support\Facades\DB;
use Xu42\Qznjw2014\Qznjw2014;


class Student
{
    /**
     * 获取 id 字段
     * @param $username
     * @return int | null
     */
    public function getId( $username )
    {
        $modelStudent = new \App\Models\Student;

        $student = $modelStudent->where( ['username' => $username] )->first();

        $id = $student ? $student->id : null;

        return $id;
    }


    /**
     * 获取 id, 如果没有则插入数据库后获取id
     * @param $username
     * @param $password
     * @return bool|mixed
     */
    public function getIdOrSave( $username, $password )
    {
        $thisId = $this->getId( $username );

        $id = $thisId ? $thisId : $this->save( $username, $password );

        return $id;
    }


    /**
     * 保存一条数据
     * @param $username
     * @param $password
     * @return mixed|null
     */
    public function save( $username, $password )
    {
        $modelStudent = new \App\Models\Student;

        $modelStudent->username = $username;
        $modelStudent->password = $password;

        $save = $modelStudent->save();

        $id = $save ? $modelStudent->id : null;

        return $id;
    }

}