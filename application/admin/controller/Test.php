<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/13
 * Time: 17:18
 */

namespace app\admin\controller;


use app\api\controller\Upload;
use org\UeditorUpload;
use think\Db;
use think\Loader;

class Test extends Base
{
    public function index(){
        $allData = file_get_contents(PUBLIC_PATH.'/data.json');
        $allData = json_decode($allData,true);
        dump(count(json_decode(session('list'),true)));die;
//        session('number',null);
//        session('list',null);die;
        $i = session('number')?session('number'):0;
        $ii = 0;
        for ($i;$i<count($allData);$i++ ){
            $ii++;
            if($ii > 100){
                session('number',$i);
                echo '修复数据'.$i.'条;<script>window.location.reload();</script>';die;
            }else{
                $mobiles = explode('/',$allData[$i]['mobiles']);
                $allData[$i]['mobile'] = '';
                $allData[$i]['phone'] = '';
                foreach ($mobiles as $k=>$v){
                    if(strlen($v) == 11){
                        $allData[$i]['mobile'] = $v;
                    }else{
                        $allData[$i]['phone'] .= $allData[$i]['area_code']?$allData[$i]['area_code'].'-'.$v.' ':$v.' ';
                    }
                }
                $whereOr = $allData[$i]['address'] ?"address='".trim($allData[$i]['address'])."'":'';
//                echo $whereOr;die;
                $sql = "UPDATE `oc_resthome` SET `mobile` = '".$allData[$i]['mobile']."' , `phone` = '".$allData[$i]['phone']."' WHERE `name` LIKE '%".$allData[$i]['name']."%' OR `address`='".$allData[$i]['address']."' ";
                $row = Db::table('oc_resthome')->query($sql);
//                $row = Db::table('oc_resthome')->where('name','like','%'.$allData[$i]['name'].'%')->whereOr($whereOr)->update([
//                    'mobile'=>$allData[$i]['mobile'],
//                    'phone'=>$allData[$i]['phone'],
//                ]);

                if(empty($row) ){
                    $arr = json_decode(session('list'),true);
                    $kk = $arr ? count($arr): 0;
                    $arr[$kk] = $allData[$i];
                    session('list',json_encode($arr));
                }
            }
        }
        die;
        //将文件写入数据库



       return $this->fetch();
    }

    /**
     * 将数据库数据导出为excel文件
     */
    function downLoadExcle()
    {
        $user = Db::query("select * from user");
        Loader::import('PHPExcel.PHPExcel');
        Loader::import('PHPExcel.PHPExcel.IOFactory.PHPExcel_IOFactory');
        Loader::import('PHPExcel.PHPExcel.Reader.Excel2007');
        $objPHPExcel = new \PHPExcel();
        //设置每列的标题
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', '用户名')
            ->setCellValue('C1', '密码')
            ->setCellValue('D1', '标志');
        //存取数据  这边是关键
        foreach ($user as $k => $v) {
            $num = $k + 2;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $num, $v['id'])
                ->setCellValue('B' . $num, $v['username'])
                ->setCellValue('C' . $num, $v['password'])
                ->setCellValue('D' . $num, $v['right']);
        }
        //设置工作表标题
        $objPHPExcel->getActiveSheet()->setTitle('我的文档');
        //设置列的宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=用户信息.xlsx");//设置文件标题
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        exit;
    }
    /**
     * @param $filepathname
     * 将excel文件导入数据库
     * 使用iconv转换字符集防止文件名为中文时乱码
     */
    function uploadExcel($filepathname)
    {
        $file_path =$filepathname;
        $file_path = iconv('utf-8', 'gbk', $file_path);
//        Loader::import('PHPExcel.PHPExcel.Reader.Excel2007');
//        Loader::import('PHPExcel.PHPExcel.Reader.Excel5');
//        $PHPReader = new \PHPExcel_Reader_Excel2007();
        $PHPReader = new \PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($file_path)) {
            $PHPReader = new \PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($file_path)) {
                return;
            }
        }
        $objPHPExcel = $PHPReader->load($file_path, $encode = 'utf-8');
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();//获取总行数
        for ($i = 2; $i <= $highestRow; $i++) {
            $data['name'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
//            $data['right1'] = $objPHPExcel->getActiveSheet()->getCell("D" . $i)->getValue();
//            $data['right2'] = $objPHPExcel->getActiveSheet()->getCell("E" . $i)->getValue();
//            $data['right4'] = $objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();
//            $data['right3'] = $objPHPExcel->getActiveSheet()->getCell("G" . $i)->getValue();
//            $data['right5'] = $objPHPExcel->getActiveSheet()->getCell("H" . $i)->getValue();
//            $data['right6'] = $objPHPExcel->getActiveSheet()->getCell("I" . $i)->getValue();
//            $data['right7'] = $objPHPExcel->getActiveSheet()->getCell("J" . $i)->getValue();
//            $data['right8'] = $objPHPExcel->getActiveSheet()->getCell("K" . $i)->getValue();
            $data['address'] = $objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();
            $data['area_code'] = $objPHPExcel->getActiveSheet()->getCell("G" . $i)->getValue();
            $data['mobiles'] = $objPHPExcel->getActiveSheet()->getCell("H" . $i)->getValue();
//            $data['mobile'] = '';
//            $data['phone'] = '';
//            $data['right12'] = $objPHPExcel->getActiveSheet()->getCell("N" . $i)->getValue();
//            $data['right13'] = $objPHPExcel->getActiveSheet()->getCell("O" . $i)->getValue();
//            $data['right14'] = $objPHPExcel->getActiveSheet()->getCell("P" . $i)->getValue();
//            $data['right15'] = $objPHPExcel->getActiveSheet()->getCell("Q" . $i)->getValue();
//            $data['right16'] = $objPHPExcel->getActiveSheet()->getCell("R" . $i)->getValue();
//            $data['right17'] = $objPHPExcel->getActiveSheet()->getCell("S" . $i)->getValue();
//            $data['right18'] = $objPHPExcel->getActiveSheet()->getCell("T" . $i)->getValue();
//            $data['right22'] = $objPHPExcel->getActiveSheet()->getCell("U" . $i)->getValue();
//            $data['right23'] = $objPHPExcel->getActiveSheet()->getCell("V" . $i)->getValue();
//            $data['right24'] = $objPHPExcel->getActiveSheet()->getCell("W" . $i)->getValue();
//            $data['right25'] = $objPHPExcel->getActiveSheet()->getCell("X" . $i)->getValue();
//            $data['right26'] = $objPHPExcel->getActiveSheet()->getCell("Y" . $i)->getValue();
//            $data['right27'] = $objPHPExcel->getActiveSheet()->getCell("Z" . $i)->getValue();
//            file_put_contents(PUBLIC_PATH.'/data.json', json_encode($data));
            if(!empty($data['mobiles'])){
                $allData[] = $data;
            }
        }
        
        echo  json_encode($allData);die;
        //将文件写入数据库
        foreach ($allData as $key => $value) {
            $mobiles = explode('/',$value['mobiles']);
            $phone = '';
            foreach ($mobiles as $k=>$v){
                if(strlen($v) == 11){
                    $allData[$key]['mobile'] = $v;
                }else{
                    $allData[$key]['phone'] .= $value['area_code'].'-'.$v.' ';
                }
            }

            Db::table('oc_resthome')->where(['name'=>$value['name']])->update([
                'mobile'=>$allData[$key]['mobile'],
                'phone'=>$allData[$key]['phone'],
            ]);
        }
    }
    /**
     * 文件上传
     */
    function uploadFile()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['ext'=>'xlsx,xls,cvs'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if ($info) {
//                echo $info->getPathname(); 获取文件路径
            //将文件写入数据库
            $this->uploadExcel($info->getPathname());
        } else {
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
}