<?php

namespace App\Http\Controllers\DlpuNews;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class DlpuNewsController extends BaseController
{
    protected $dlpuNewsObj = null;

    function __construct()
    {
        $this->dlpuNewsObj = new \Xu42\DlpuNews\DlpuNews();
    }

    /**
     * 新闻动态
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentEvents()
    {
        $currentEvents = $this->dlpuNewsObj->currentEvents();

        return response()->json( ['message' => 'Success', 'data' => $currentEvents], 200 );
    }

    /**
     * 通知公告
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotice()
    {
        $notice = $this->dlpuNewsObj->notice();

        return response()->json( ['message' => 'Success', 'data' => $notice], 200 );
    }

    /**
     * 教务文件
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTeachingFiles()
    {
        $teachingFiles = $this->dlpuNewsObj->teachingFiles();

        return response()->json( ['message' => 'Success', 'data' => $teachingFiles], 200 );
    }

}
