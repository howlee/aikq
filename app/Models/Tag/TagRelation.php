<?php
/**
 * Created by PhpStorm.
 * User: 11247
 * Date: 2019/2/18
 * Time: 15:14
 */

namespace App\Models\Tag;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class TagRelation extends Model
{
    const kTypeArticle = 1, kTypeVideo = 2, kTypePlayBack = 3;//1：文章，2：视频/集锦，3：录像/回放
    const kTypeArray = [self::kTypeArticle, self::kTypeVideo, self::kTypePlayBack];

    public static function hasTag($type, $source_id, $tag_id) {
        $query = self::query()->where("type", $type)->where("source_id", $source_id);
        $query->where("tag_id", $tag_id);
        return $query->count() > 0;
    }

    public static function saveRelation($type, $source_id, $tag_id) {
        $relation = new TagRelation();
        $relation->type = $type;
        $relation->source_id = $source_id;
        $relation->tag_id = $tag_id;
        $relation->save();
        return $relation;
    }

    /**
     * 一级标签只有一个
     * @param $type
     * @param $source_id
     * @param $sport
     */
    public static function saveFirstRelation($type, $source_id, $sport) {
        $query = self::query()->where("type", $type)->where("source_id", $source_id);
        $query->where(function ($orQuery) {
            $orQuery->where("tag_id", Tag::kSportFootball);
            $orQuery->orWhere("tag_id", Tag::kSportBasketball);
        });
        $firstRelation = $query->first();
        if (isset($firstRelation)) {
            if ($firstRelation->tag_id != $sport) {
                $firstRelation->tag_id = $sport;
                $firstRelation->save();
            }
        } else {
            self::saveRelation($type, $source_id, $sport);
        }
    }

    /**
     * 保存标签关系
     * @param $sport
     * @param $type   关系类型，1：文章，2：视频，3：录像
     * @param $source_id  类型的ID
     * @param array $tags  标签数组 格式：["match"=>[ ["tag_id"=>xxx, "name"=>xx, "level"=>x],... ],
     *                                      "team"=>[ ["tag_id"=>xx, "name"=>xx, "id"=>xx, "level"=>xxx],.. ],
     *                                      "player"=>[ ["tag_id"=>xx, "name"=>xx, "level"=>x],.. ] ]
     */
    protected static function saveTagRelation($sport, $type, $source_id, array $tags) {
        if (!is_numeric($source_id) || $source_id < 1 || !in_array($type, self::kTypeArray)
            || !isset($tags) || count($tags) == 0 || !isset($sport) ) {
            return;
        }
        Log::info($tags);
        //竞技标签
        self::saveFirstRelation($type, $source_id, $sport);

        //赛事标签保存
        $matches = isset($tags["match"]) ? $tags["match"] : [];
        foreach ($matches as $match) {
            //判断是否有标签
            $tag_id = $match["tag_id"];
            $hasTag = self::hasTag($type, $source_id, $tag_id);
            if (!$hasTag) {
                self::saveRelation($type, $source_id, $tag_id);
            }
        }

        //球队标签保存
        $teams = isset($tags["team"]) ? $tags["team"] : [];
        foreach ($teams as $team) {
            $tag_id = $team["tag_id"];
            if (empty($tag_id)) {//无标签ID
                $team_name = $team["name"];
                $tag = Tag::saveTag($team_name, $sport, Tag::kLevelThree);//新标签保存，旧标签获取对象
                if (isset($tag)) {
                    $tag_id = $tag->id;
                }
            }
            if (!empty($tag_id)) {
                $hasTag = self::hasTag($type, $source_id, $tag_id);//判断是否有标签
                if (!$hasTag) {
                    self::saveRelation($type, $source_id, $tag_id);
                }
            }
        }

        //球员标签
        $players = isset($tags["player"]) ? $tags["player"] : [];
        foreach ($players as $player) {
            $tag_id = $team["tag_id"];
            if (empty($tag_id)) {
                $player_name = $player["name"];

                $tag = Tag::saveTag($player_name, $sport, Tag::kLevelFour);//新标签保存，旧标签获取对象
                if (isset($tag)) {
                    $tag_id = $tag->id;
                }
            }
            if (!empty($tag_id)) {
                $hasTag = self::hasTag($type, $source_id, $tag_id);//判断是否有标签
                if (!$hasTag) {
                    self::saveRelation($type, $source_id, $tag_id);
                }
            }
        }

    }

    /**
     * 保存文章关系标签
     * @param $sport
     * @param $source_id
     * @param array $tags
     */
    public static function saveArticleTagRelation($sport, $source_id, array $tags) {
        self::saveTagRelation($sport,self::kTypeArticle, $source_id, $tags);
    }

    /**
     * 保存文章关系标签
     * @param $sport
     * @param $source_id
     * @param array $tags
     */
    public static function savePlayBackTagRelation($sport, $source_id, array $tags) {
        self::saveTagRelation($sport,self::kTypePlayBack, $source_id, $tags);
    }

    /**
     * 保存视频关系标签
     * @param $sport
     * @param $source_id
     * @param array $tags
     */
    public static function saveVideoTagRelation($sport, $source_id, array $tags) {
        self::saveTagRelation($sport,self::kTypeVideo, $source_id, $tags);
    }


    public static function getTagRelations($type, $source_id) {
        $query = self::query();
        $query->join("tags", "tags.id", "=", "tag_relations.tag_id");
        $query->where("type", $type);
        $query->where("source_id", $source_id);
        $query->orderBy("tags.level");
        $query->selectRaw("tag_relations.id");
        $query->addSelect(["tag_relations.id", "tag_relations.tag_id", "tags.name", "tags.level", "tags.tid"]);
        $tags = $query->get();
        $array = [];
        foreach ($tags as $tag) {
            $level = $tag["level"];
            if ($level == Tag::kLevelOne) {
                $array["sport"] = $tag;
            } else if ($level == Tag::kLevelTwo) {
                $array["match"][] = $tag;
            } else if ($level == Tag::kLevelThree) {
                $array["team"][] = $tag;
            } else if ($level == Tag::kLevelFour) {
                $array["player"][] = $tag;
            }
        }
        return $array;
    }

}