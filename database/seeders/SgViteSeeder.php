<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SgVite;

class SgViteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 读取 JSON 文件
        $jsonFile = '
        [
            {
                "name": "典韋",
                "camp": "魏",
                "cost": 7,
                "cavalry": "B",
                "shieldbearer": "S",
                "archer": "C",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "曹操",
                "camp": "魏",
                "cost": 7,
                "cavalry": "S",
                "shieldbearer": "S",
                "archer": "A",
                "spearman": "A",
                "artillery": "B"
            },
            {
                "name": "劉備",
                "camp": "蜀",
                "cost": 7,
                "cavalry": "S",
                "shieldbearer": "S",
                "archer": "A",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "馬超",
                "camp": "蜀",
                "cost": 7,
                "cavalry": "S",
                "shieldbearer": "B",
                "archer": "B",
                "spearman": "S",
                "artillery": "B"
            },
            {
                "name": "諸葛亮",
                "camp": "蜀",
                "cost": 7,
                "cavalry": "C",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "S",
                "artillery": "S"
            },
            {
                "name": "關羽",
                "camp": "蜀",
                "cost": 7,
                "cavalry": "S",
                "shieldbearer": "A",
                "archer": "C",
                "spearman": "S",
                "artillery": "C"
            },
            {
                "name": "張昭",
                "camp": "吳",
                "cost": 7,
                "cavalry": "C",
                "shieldbearer": "C",
                "archer": "C",
                "spearman": "B",
                "artillery": "C"
            },
            {
                "name": "陸遜",
                "camp": "吳",
                "cost": 7,
                "cavalry": "C",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "A",
                "artillery": "A"
            },
            {
                "name": "孟獲",
                "camp": "群",
                "cost": 7,
                "cavalry": "S",
                "shieldbearer": "S",
                "archer": "B",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "于吉",
                "camp": "群",
                "cost": 7,
                "cavalry": "C",
                "shieldbearer": "B",
                "archer": "C",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "董卓",
                "camp": "群",
                "cost": 7,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "S",
                "spearman": "B",
                "artillery": "C"
            },
            {
                "name": "呂布",
                "camp": "群",
                "cost": 7,
                "cavalry": "S",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "陳群",
                "camp": "魏",
                "cost": 6,
                "cavalry": "C",
                "shieldbearer": "B",
                "archer": "B",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "曹植",
                "camp": "魏",
                "cost": 6,
                "cavalry": "B",
                "shieldbearer": "B",
                "archer": "C",
                "spearman": "C",
                "artillery": "B"
            },
            {
                "name": "許褚",
                "camp": "魏",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "B",
                "spearman": "S",
                "artillery": "C"
            },
            {
                "name": "張郃",
                "camp": "魏",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "B",
                "spearman": "S",
                "artillery": "A"
            },
            {
                "name": "曹仁",
                "camp": "魏",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "B",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "甄姬",
                "camp": "魏",
                "cost": 6,
                "cavalry": "C",
                "shieldbearer": "C",
                "archer": "B",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "程昱",
                "camp": "魏",
                "cost": 6,
                "cavalry": "S",
                "shieldbearer": "C",
                "archer": "A",
                "spearman": "C",
                "artillery": "A"
            },
            {
                "name": "荀彧",
                "camp": "魏",
                "cost": 6,
                "cavalry": "C",
                "shieldbearer": "C",
                "archer": "B",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "徐晃",
                "camp": "魏",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "C",
                "spearman": "A",
                "artillery": "B"
            },
            {
                "name": "夏侯惇",
                "camp": "魏",
                "cost": 6,
                "cavalry": "S",
                "shieldbearer": "A",
                "archer": "C",
                "spearman": "A",
                "artillery": "B"
            },
            {
                "name": "龐德",
                "camp": "魏",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "B",
                "artillery": "B"
            },
            {
                "name": "鍾會",
                "camp": "魏",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "A",
                "artillery": "A"
            },
            {
                "name": "陳到",
                "camp": "蜀",
                "cost": 6,
                "cavalry": "C",
                "shieldbearer": "B",
                "archer": "B",
                "spearman": "S",
                "artillery": "B"
            },
            {
                "name": "黃忠",
                "camp": "蜀",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "S",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "趙雲",
                "camp": "蜀",
                "cost": 6,
                "cavalry": "S",
                "shieldbearer": "A",
                "archer": "A",
                "spearman": "S",
                "artillery": "C"
            },
            {
                "name": "張飛",
                "camp": "蜀",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "C",
                "spearman": "S",
                "artillery": "C"
            },
            {
                "name": "孫權",
                "camp": "吳",
                "cost": 6,
                "cavalry": "S",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "甘寧",
                "camp": "吳",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "A",
                "archer": "S",
                "spearman": "S",
                "artillery": "S"
            },
            {
                "name": "呂蒙",
                "camp": "吳",
                "cost": 6,
                "cavalry": "B",
                "shieldbearer": "B",
                "archer": "A",
                "spearman": "S",
                "artillery": "S"
            },
            {
                "name": "太史慈",
                "camp": "吳",
                "cost": 6,
                "cavalry": "S",
                "shieldbearer": "C",
                "archer": "S",
                "spearman": "B",
                "artillery": "C"
            },
            {
                "name": "孫堅",
                "camp": "吳",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "B",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "周瑜",
                "camp": "吳",
                "cost": 6,
                "cavalry": "B",
                "shieldbearer": "A",
                "archer": "S",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "許攸",
                "camp": "群",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "A",
                "archer": "A",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "田豐",
                "camp": "群",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "B",
                "spearman": "A",
                "artillery": "A"
            },
            {
                "name": "呂玲綺",
                "camp": "群",
                "cost": 6,
                "cavalry": "S",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "祝融夫人",
                "camp": "群",
                "cost": 6,
                "cavalry": "S",
                "shieldbearer": "A",
                "archer": "A",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "兀突骨",
                "camp": "群",
                "cost": 6,
                "cavalry": "S",
                "shieldbearer": "S",
                "archer": "C",
                "spearman": "B",
                "artillery": "C"
            },
            {
                "name": "公孫瓚",
                "camp": "群",
                "cost": 6,
                "cavalry": "S",
                "shieldbearer": "C",
                "archer": "S",
                "spearman": "C",
                "artillery": "B"
            },
            {
                "name": "袁紹",
                "camp": "群",
                "cost": 6,
                "cavalry": "B",
                "shieldbearer": "A",
                "archer": "S",
                "spearman": "B",
                "artillery": "S"
            },
            {
                "name": "張角",
                "camp": "群",
                "cost": 6,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "S",
                "spearman": "B",
                "artillery": "A"
            },
            {
                "name": "曹純",
                "camp": "魏",
                "cost": 5,
                "cavalry": "S",
                "shieldbearer": "C",
                "archer": "B",
                "spearman": "B",
                "artillery": "C"
            },
            {
                "name": "于禁",
                "camp": "魏",
                "cost": 5,
                "cavalry": "A",
                "shieldbearer": "S",
                "archer": "B",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "樂進",
                "camp": "魏",
                "cost": 5,
                "cavalry": "S",
                "shieldbearer": "A",
                "archer": "B",
                "spearman": "S",
                "artillery": "S"
            },
            {
                "name": "鄧艾",
                "camp": "魏",
                "cost": 5,
                "cavalry": "A",
                "shieldbearer": "B",
                "archer": "A",
                "spearman": "S",
                "artillery": "S"
            },
            {
                "name": "夏侯淵",
                "camp": "魏",
                "cost": 5,
                "cavalry": "S",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "B",
                "artillery": "A"
            },
            {
                "name": "郭嘉",
                "camp": "魏",
                "cost": 5,
                "cavalry": "B",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "王平",
                "camp": "蜀",
                "cost": 5,
                "cavalry": "B",
                "shieldbearer": "B",
                "archer": "S",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "徐庶",
                "camp": "蜀",
                "cost": 5,
                "cavalry": "S",
                "shieldbearer": "B",
                "archer": "A",
                "spearman": "B",
                "artillery": "B"
            },
            {
                "name": "黃蓋",
                "camp": "吳",
                "cost": 5,
                "cavalry": "B",
                "shieldbearer": "A",
                "archer": "S",
                "spearman": "A",
                "artillery": "B"
            },
            {
                "name": "程普",
                "camp": "吳",
                "cost": 5,
                "cavalry": "B",
                "shieldbearer": "A",
                "archer": "A",
                "spearman": "S",
                "artillery": "B"
            },
            {
                "name": "孫策",
                "camp": "吳",
                "cost": 5,
                "cavalry": "S",
                "shieldbearer": "B",
                "archer": "A",
                "spearman": "S",
                "artillery": "A"
            },
            {
                "name": "李儒",
                "camp": "群",
                "cost": 5,
                "cavalry": "S",
                "shieldbearer": "B",
                "archer": "A",
                "spearman": "B",
                "artillery": "B"
            },
            {
                "name": "高順",
                "camp": "群",
                "cost": 5,
                "cavalry": "C",
                "shieldbearer": "S",
                "archer": "B",
                "spearman": "C",
                "artillery": "S"
            },
            {
                "name": "馬騰",
                "camp": "群",
                "cost": 5,
                "cavalry": "S",
                "shieldbearer": "C",
                "archer": "B",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "文醜",
                "camp": "群",
                "cost": 5,
                "cavalry": "A",
                "shieldbearer": "A",
                "archer": "S",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "華雄",
                "camp": "群",
                "cost": 5,
                "cavalry": "S",
                "shieldbearer": "B",
                "archer": "B",
                "spearman": "A",
                "artillery": "C"
            },
            {
                "name": "顏良",
                "camp": "群",
                "cost": 5,
                "cavalry": "A",
                "shieldbearer": "A",
                "archer": "B",
                "spearman": "S",
                "artillery": "C"
            },
            {
                "name": "華陀",
                "camp": "群",
                "cost": 5,
                "cavalry": "C",
                "shieldbearer": "C",
                "archer": "C",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "左慈",
                "camp": "群",
                "cost": 5,
                "cavalry": "C",
                "shieldbearer": "C",
                "archer": "C",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "曹丕",
                "camp": "魏",
                "cost": 4,
                "cavalry": "A",
                "shieldbearer": "A",
                "archer": "S",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "黃月英",
                "camp": "蜀",
                "cost": 4,
                "cavalry": "C",
                "shieldbearer": "C",
                "archer": "C",
                "spearman": "C",
                "artillery": "S"
            },
            {
                "name": "法正",
                "camp": "蜀",
                "cost": 4,
                "cavalry": "B",
                "shieldbearer": "S",
                "archer": "A",
                "spearman": "A",
                "artillery": "A"
            },
            {
                "name": "大喬",
                "camp": "吳",
                "cost": 4,
                "cavalry": "C",
                "shieldbearer": "C",
                "archer": "B",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "貂蟬",
                "camp": "群",
                "cost": 4,
                "cavalry": "B",
                "shieldbearer": "C",
                "archer": "B",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "司馬徽",
                "camp": "群",
                "cost": 4,
                "cavalry": "C",
                "shieldbearer": "C",
                "archer": "B",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "小喬",
                "camp": "吳",
                "cost": 3,
                "cavalry": "C",
                "shieldbearer": "C",
                "archer": "B",
                "spearman": "C",
                "artillery": "C"
            },
            {
                "name": "蔡文姬",
                "camp": "群",
                "cost": 3,
                "cavalry": "B",
                "shieldbearer": "C",
                "archer": "C",
                "spearman": "C",
                "artillery": "C"
            }
        ]
        ';
        $jsonData = json_decode($jsonFile, true);

        // 插入数据
        foreach ($jsonData as $data) {
            SgVite::create($data);
        }
    }
}
