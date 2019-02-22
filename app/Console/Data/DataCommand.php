<?php
/**
 * Created by PhpStorm.
 * User: 11247
 * Date: 2018/4/10
 * Time: 10:28
 */

namespace App\Console\Data;


use App\Http\Controllers\IntF\AikanQController;
use App\Http\Controllers\PC\Data\DataController;
use App\Http\Controllers\PC\Live\SubjectController;
use App\Models\Subject\SubjectLeague;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data_cache:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '专题数据页面静态化';

    /**
     * Create a new command instance.
     * HotMatchCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $leagues = SubjectLeague::getAllLeagues();
        $aiCon = new DataController();
        foreach ($leagues as $league) {
            $this->staticSubjectHtml($aiCon, $league);
        }
        $aiCon->staticIndex(new Request());
    }

    public function staticSubjectHtml(DataController $aiCon, SubjectLeague $sl) {
        $html = $aiCon->dataDetailHtml(new Request(), $sl);
        if (!empty($html)) {
            $name_en = $sl->name_en;
            Storage::disk("public")->put("/www/$name_en/data/index.html", $html);
        }

        //手机
//        $con = new \App\Http\Controllers\Mobile\Subject\SubjectController();
//        echo $sl->name_en;
//        $con->staticSubjectHtml(new Request(),$sl->name_en);
    }

}