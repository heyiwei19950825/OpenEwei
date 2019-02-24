{
"name": [
"td:eq(1)",
"text",
"学校名称"
],
"name_en":[
"td:eq(2)",
"text",
"学校英文名称"
],"state":[
"td:eq(3)",
"text",
"国家"
],"link":[
"td:eq(1)>a",
"href",
"详情地址",
{
"school_name": [
"#wikiContent>h1",
"text",
"学校名称"
],
"country": [
"tbody:eq(0)>tr:eq(1)>td:eq(1)",
"text",
"国家"
],
"province": [
"tbody:eq(0)>tr:eq(2)>td:eq(1)",
"text",
"州省"
],
"city": [
"tbody:eq(0)>tr:eq(3)>td:eq(1)",
"text",
"城市"
],
"motto": [
"tbody:eq(0)>tr:eq(4)>td:eq(1)",
"text",
"校训"
],
"motto_cn": [
"tbody:eq(0)>tr:eq(5)>td:eq(1)",
"text",
"汉译"
],
"character": [
"tbody:eq(0)>tr:eq(6)>td:eq(1)",
"text",
"性质"
],
"founded_year": [
"tbody:eq(0)>tr:eq(7)>td:eq(1)",
"text",
"成立年份"
],
"area": [
"tbody:eq(0)>tr:eq(8)>td:eq(1)",
"text",
"校园"
],
"people_number": [
"tbody:eq(0)>tr:eq(9)>td:eq(1)",
"text",
"学生人数"
],
"ben_people_number": [
"tbody:eq(0)>tr:eq(10)>td:eq(1)",
"text",
"本科人数"
],
"yan_people_number": [
"tbody:eq(0)>tr:eq(11)>td:eq(1)",
"text",
"研究生人数"
],
"shi_shen_ratio": [
"tbody:eq(0)>tr:eq(12)>td:eq(1)",
"text",
"师生比"
],
"international_student_ratio": [
"tbody:eq(0)>tr:eq(13)>td:eq(1)",
"text",
"国际学生比例"
],
"category": [
"tbody:eq(0)>tr:eq(14)>td:eq(1)",
"text",
"学校分类"
],
"group": [
"tbody:eq(0)>tr:eq(15)>td:eq(1)",
"text",
"学校集团"
],
"certification": [
"tbody:eq(0)>tr:eq(16)>td:eq(1)",
"text",
"认证机构"
],
"web_site": [
"tbody:eq(0)>tr:eq(17)>td:eq(1)",
"text",
"网址"
],
"describe": [
"#content",
"html",
"校园介绍",
{},
"~<p>(.*)<p><strong>校园环境~isU"
        ],
        "environment": [
        "#content",
        "html",
        "校园环境",
        {},
        "~<p><strong>校园环境</strong></p>(.*)<p><strong>(图书馆|院系设置)~isU"
        ],
        "library": [
        "#content",
        "html",
        "图书馆",
        {},
        "~<p><strong>图书馆</strong></p>(.*)<p><strong>院系设置~isU"
        ],
        "remark": [
        "#content",
        "html",
        "申请点评",
        {},
        "~<h2>申请点评(.*)<h1>本科申请~isU"
                ],
                "ben_apply": [
                "#content",
                "html",
                "本科申请",
                {},
                "~<h1>本科申请(.*)<h2>教学质量~isU"
                        ],
                        "ben_teach_quality": [
                        "#content",
                        "html",
                        "教学质量",
                        {},
                        "~<h2>教学质量(.*)<h2>申请说明~isU"
                                ],
                                "ben_apply_explain": [
                                "#content",
                                "html",
                                "申请说明",
                                {},
                                "~<h2>申请说明(.*)<h2>转学申请~isU"
                                        ],
                                        "ben_change_apply": [
                                        "#content",
                                        "html",
                                        "转学申请",
                                        {},
                                        "~<h2>转学申请(.*)<h2>专业设置~isU"
                                                ],
                                                "ben_profession_site": [
                                                "#content",
                                                "html",
                                                "专业设置",
                                                {},
                                                "~<h2>专业设置(.*)<h1>研究生申请~isU"
                                                        ],
                                                        "yan_apply_site": [
                                                        "#content",
                                                        "html",
                                                        "研究生 院系设置",
                                                        {},
                                                        "~<h1>研究生申请(.*)<p><strong>基本要求~isU"
        ],
        "yan_basic": [
        "#content",
        "html",
        "研究生 基本要求",
        {},
        "~<p><strong>基本要求(.*)<p><strong>申请说明~isU"
        ],
        "yan_profession_detail": [
        "#content",
        "html",
        "研究生 专业详情",
        {},
        "~<h1>研究生申请(.*)</div>~isU"
            ]
            }
            ]
            }