<?php
/**
 * Created by PhpStorm.
 * User: 贺宜伟【ewei】
 * Date: 2018/10/22
 * Time: 13:31
 */

$base = 'http://w2.pdoca.com/';

return [
    //用户
    'user'           =>[
        'list'           => $base.'api/User/managelist',
        'save'           => $base.'api/User/add',
        'info'           => $base.'api/User/userDetail',
        'update'         => $base.'api/User/modifye',
        'statistics'     => $base.'api/User/statistics',
        'delete'         => $base.'api/User/delete',
        'update_status'  => $base.'api/User/update_status',
        'old'            => [
            'list'           => $base.'api/elder/managelist',
            'save'           => $base.'api/elder/add',
            'info'           => $base.'api/elder/elderDetail',
            'update'         => $base.'api/elder/modifye',
            'statistics'     => $base.'api/elder/statistics',
            'delete'         => $base.'api/elder/delete',
            'update_status'  => $base.'api/elder/update_status',
        ]
    ],

    //机构中心接口
   'resthome'           =>[
       'list'           => $base.'api/resthome/managelist',
       'save'           => $base.'api/resthome/add',
       'info'           => $base.'api/resthome/detail',
       'update'         => $base.'api/resthome/modifye',
       'statistics'     => $base.'api/resthome/statistics',
       'delete'         => $base.'api/resthome/delete',
       'update_status'  => $base.'api/resthome/update_status',
   ],
    //机构统计
    'resthome_statistics'           =>[
        'list'           => $base.'api/resthome_statistics/managelist',
    ],
    //机构执照
    'resthome_license'           =>[
        'list'           => $base.'api/resthome/managelist',
        'save'           => $base.'api/resthome/add',
        'info'           => $base.'api/resthome/detail',
        'update'         => $base.'api/resthome/modifye',
        'statistics'     => $base.'api/resthome/statistics',
        'delete'         => $base.'api/resthome/delete',
        'update_status'  => $base.'api/resthome/update_status',
    ],
    //机构执照
    'resthome_job'           =>[
        'list'           => $base.'api/job/managelist',
        'save'           => $base.'api/job/add',
        'info'           => $base.'api/job/detail',
        'update'         => $base.'api/job/modifye',
        'statistics'     => $base.'api/job/statistics',
        'delete'         => $base.'api/job/delete',
        'update_status'  => $base.'api/job/update_status',
    ],
    //预约
    'book'           =>[
        'list'           => $base.'api/resthome/managelist',
        'save'           => $base.'api/resthome/add',
        'info'           => $base.'api/resthome/detail',
        'update'         => $base.'api/resthome/modifye',
        'statistics'     => $base.'api/resthome/statistics',
        'delete'         => $base.'api/resthome/delete',
        'update_status'  => $base.'api/resthome/update_status',
    ],
    //试住
    'experience'           =>[
        'list'           => $base.'api/resthome/managelist',
        'save'           => $base.'api/resthome/add',
        'info'           => $base.'api/resthome/detail',
        'update'         => $base.'api/resthome/modifye',
        'statistics'     => $base.'api/resthome/statistics',
        'delete'         => $base.'api/resthome/delete',
        'update_status'  => $base.'api/resthome/update_status',
    ],
    //文章
    'article'           =>[
        'list'           => $base.'api/Article/list',
        'save'           => $base.'api/Article/add',
        'info'           => $base.'api/Article/Detail',
        'update'         => $base.'api/Article/modifye',
        'statistics'     => $base.'api/Article/statistics',
        'delete'         => $base.'api/Article/delete',
        'update_status'  => $base.'api/Article/update_status',
    ],
    //文章
    'article_comment'           =>[
        'list'           => $base.'api/resthome/managelist',
        'save'           => $base.'api/resthome/add',
        'info'           => $base.'api/resthome/detail',
        'update'         => $base.'api/resthome/modifye',
        'statistics'     => $base.'api/resthome/statistics',
        'delete'         => $base.'api/resthome/delete',
        'update_status'  => $base.'api/resthome/update_status',
    ],
    //机构评论
    'resthome_comment'           =>[
        'list'           => $base.'api/resthome/managelist',
        'save'           => $base.'api/resthome/add',
        'info'           => $base.'api/resthome/detail',
        'update'         => $base.'api/resthome/modifye',
        'statistics'     => $base.'api/resthome/statistics',
        'delete'         => $base.'api/resthome/delete',
        'update_status'  => $base.'api/resthome/update_status',
    ],
    //指南评论
    'guide_comment'           =>[
        'list'           => $base.'api/resthome/managelist',
        'save'           => $base.'api/resthome/add',
        'info'           => $base.'api/resthome/detail',
        'update'         => $base.'api/resthome/modifye',
        'statistics'     => $base.'api/resthome/statistics',
        'delete'         => $base.'api/resthome/delete',
        'update_status'  => $base.'api/resthome/update_status',
    ],
    //用户反馈
    'user_feedback'           =>[
        'list'           => $base.'api/resthome/managelist',
        'save'           => $base.'api/resthome/add',
        'info'           => $base.'api/resthome/detail',
        'update'         => $base.'api/resthome/modifye',
        'statistics'     => $base.'api/resthome/statistics',
        'delete'         => $base.'api/resthome/delete',
        'update_status'  => $base.'api/resthome/update_status',
    ],
    //机构反馈
    'resthome_feedback'           =>[
        'list'           => $base.'api/resthome/managelist',
        'save'           => $base.'api/resthome/add',
        'info'           => $base.'api/resthome/detail',
        'update'         => $base.'api/resthome/modifye',
        'statistics'     => $base.'api/resthome/statistics',
        'delete'         => $base.'api/resthome/delete',
        'update_status'  => $base.'api/resthome/update_status',
    ],

    //机构反馈
    'banner'           =>[
        'list'           => $base.'api/banner/managelist',
        'save'           => $base.'api/banner/add',
        'info'           => $base.'api/banner/detail',
        'update'         => $base.'api/banner/modifye',
        'statistics'     => $base.'api/banner/statistics',
        'delete'         => $base.'api/banner/delete',
        'update_status'  => $base.'api/banner/update_status',
    ],

    //品牌列表
    'brand'=>[
        'list'  => $base.'api/resthome/brand'
    ],

    //数据字典
    'dict'      => $base.'api/basic/type_all',
    //服务字典
    'server'      => $base.'api/basic/service_all',

    //省份数据集合
    'province'  => [
        'district'          => $base.'api/city/chinacity',
    ]

];