<?php
require 'functions.php';
use QL\QueryList;

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'date';
$page = isset($_GET['page']) ? $_GET['page'] :1;
$prev = $page > 1 ? $page -1 : '#';
$newUrl = $baseUrl . '-/list/=/limit=30/';

//搜索时，变更baseurl
$searchStr = isset($_GET['searchstr']) ? $_GET['searchstr'] : false;
if($searchStr){
    $newUrl = 'http://www.dmm.co.jp/search/=/searchstr='.$searchStr.'/';
}

$n1 = isset($_GET['n1']) ? $_GET['n1'] : false;
if($n1){
    $newUrl .= "n1=$n1/";
    $n2 = isset($_GET['n2']) ? $_GET['n2'] : false;
    if($n2){
        $newUrl .= "n2=$n2/";
    }
}

if(isset($sort)){
    $newUrl .= "sort=$sort/";
}
if($page >1){
    $newUrl = $newUrl . "page=$page/";
}else{
    $page =1;
}
//echo $newUrl;
$html = "";
$html = getHtml($newUrl);

//采集规则
$rules = [
    'title' => ['.flb-works-detail dt','text','-span'],
    'img' => ['img','src'],
    'video' => ['.ds-btn-play a','href']
];
if($searchStr){
    $rules = [
        'title' => ['.ttl-list','text'],
        'img' => ['img','src'],
        'video' => ['.btn a','href']
    ];
}
$ql = QueryList::html($html)->rules($rules)->range('.flb-works')->query();
$data = $ql->getData()->all();

$datas = [];
$num = 0;
foreach($data as $d){
    if($d['video'] != null){
        for($i = 0; $i < $num; $i++){
            if(strcmp($datas[$i]['video'], $d['video']) == 0) break;
        }
        if($i < $num) continue;
        $d['img'] = str_replace('ps.','pl.',$d['img']);
        $d['id'] = preg_replace('/.*\/([^\/]*)\/.*/','$1',$d['video']);
        $datas[$num] = $d;
        $num = $num +1;
    }
}
//print_r($data);
$titleList=[
    'date'=>'最近更新',
    "ranking"=>'人气最佳',
    "saleranking_asc"=>'销量排序',
    "review_rank"=>'评价排序'
];

$options = [
    [ 'key' => 'DgRJTglEBQ4GpoD6%2CYyI%2Cqs_' , 'value' => '単体作品' ],
    [ 'key' => 'DgRJTglEBQ4GwP6dl5O1ktnA0ZPD' , 'value' => 'ハイビジョン-HDTV' ],
    [ 'key' => 'DgRJTglEBQ4Go%2Cn42fG9iM8_' , 'value' => '独占配信' ],
    [ 'key' => 'DgRJTglEBQ4G0MH%2Azg__' , 'value' => '巨乳' ],
    [ 'key' => 'DgRJTglEBQ4G2P6FxA__' , 'value' => '熟女' ],
    [ 'key' => 'DgRJTglEBQ4G2vyC%2AQ__' , 'value' => '人妻' ],
    [ 'key' => 'DgRJTglEBQ4GpteF45LR' , 'value' => '中出し' ],
    [ 'key' => 'DgRJTglEBQ4GpPaH%2Cg__' , 'value' => '素人' ],
    [ 'key' => 'DgRJTglEBQ4GVmGZlQI2' , 'value' => '3P・4P' ],
    [ 'key' => 'DgRJTglEBQ4G0IKG24aq' , 'value' => '騎乗位' ],
    [ 'key' => 'DgRJTglEBQ4GwOidipOulsek24uI87A_' , 'value' => 'ベスト・総集編' ],
    [ 'key' => 'DgRJTglEBQ4GUYrGh%2ADW%2Cd%2AAjNj58w__' , 'value' => '4時間以上作品' ],
    [ 'key' => 'DgRJTglEBQ4G2MaD4Y%2Cd99k_' , 'value' => '女子校生' ],
    [ 'key' => 'DgRJTglEBQ4GwYyc%2CfTYkrTAkZPx' , 'value' => 'その他フェチ-恋物' ],
    [ 'key' => 'DgRJTglEBQ4G0dqK2w__' , 'value' => '企画' ],
    [ 'key' => 'DgRJTglEBQ4Grc%2AGnIuR' , 'value' => '美少女' ],
    [ 'key' => 'DgRJTglEBQ4GpuWFxA__' , 'value' => '痴女' ],
    [ 'key' => 'DgRJTglEBQ4GoMGDkJfAk6%2CBiJKd' , 'value' => '盗撮・のぞき' ],
    [ 'key' => 'DgRJTglEBQ4G09CH9feMg84_' , 'value' => '近親相姦' ],
    [ 'key' => 'DgRJTglEBQ4GwOSdlJOP' , 'value' => 'フェラ-口交' ],
    [ 'key' => 'DgRJTglEBQ4GwOCdl5Pckos_' , 'value' => 'パイズリ-ML' ],
    [ 'key' => 'DgRJTglEBQ4GoZ2H0pLL' , 'value' => '潮吹き' ],
    [ 'key' => 'DgRJTglEBQ4G2pqc0g__' , 'value' => '辱め' ],
    [ 'key' => 'DgRJTglEBQ4GwPudwJO3' , 'value' => 'ナンパ' ],
    [ 'key' => 'DgRJTglEBQ4G2dudgJPL' , 'value' => '手コキ' ],
    [ 'key' => 'DgRJTglEBQ4G3IX6mA__' , 'value' => '拘束' ],
    [ 'key' => 'DgRJTglEBQ4GwJud%2AZOtlt0_' , 'value' => 'オナニー手淫' ],
    [ 'key' => 'DgRJTglEBQ4G0diE%2Cg__' , 'value' => '顔射' ],
    [ 'key' => 'DgRJTglEBQ4GwO6d%2AIGp' , 'value' => 'ミニ系-萝莉' ],
    [ 'key' => 'DgRJTglEBQ4GwN2diQ__' , 'value' => 'レズ-女同' ],
    [ 'key' => 'DgRJTglEBQ4G3umd7ZOV' , 'value' => '指マン' ],
    [ 'key' => 'DgRJTglEBQ4GwJ%2Ad0JON' , 'value' => 'ギャル-少女' ],
    [ 'key' => 'DgRJTglEBQ4GoYWOhpfA8rqr2g__' , 'value' => '調教・奴隷' ],
    [ 'key' => 'DgRJTglEBQ4GwJ6dwJOt' , 'value' => 'クンニ-舔阴' ],
    [ 'key' => 'DgRJTglEBQ4Gosqc2ZfAgbqizQ__' , 'value' => '縛り・緊縛' ],
    [ 'key' => 'DgRJTglEBQ4GwIKdipOxko0_' , 'value' => 'コスプレ-角色扮演' ],
    [ 'key' => 'DgRJTglEBQ4GwPidnpODkoDAxZOPnI6Y3g__' , 'value' => 'ドキュメンタリー记录' ],
    [ 'key' => 'DgRJTglEBQ4G1un4i%2C%2AY' , 'value' => '学生服' ],
    [ 'key' => 'DgRJTglEBQ4Gqd%2ALg5fA%2AMvY5g__' , 'value' => '野外・露出' ],
    [ 'key' => 'DgRJTglEBQ4GKn0_' , 'value' => 'OL' ],
    [ 'key' => 'DgRJTglEBQ4GwP6d0o3Fk4s_' , 'value' => 'ハメ撮り-猎奇' ],
    [ 'key' => 'DgRJTglEBQ4G1c31w5fAkq7EipP5jqs_' , 'value' => '淫乱・ハード系' ],
    [ 'key' => 'DgRJTglEBQ4GwJOd%2AZON' , 'value' => 'アナル-肛门' ],
    [ 'key' => 'DgRJTglEBQ4Gg4b74g__' , 'value' => '羞恥' ],
    [ 'key' => 'DgRJTglEBQ4Grc%2C%2Azg__' , 'value' => '美乳' ],
    [ 'key' => 'DgRJTglEBQ4G2peO%2A4nBltg_' , 'value' => '職業色々' ],
    [ 'key' => 'DgRJTglEBQ4GwZvy35LTk5I_' , 'value' => 'お母さん-妈妈' ],
    [ 'key' => 'DgRJTglEBQ4GwZuD45LTk5I_' , 'value' => 'お姉さん-姐姐' ],
    [ 'key' => 'DgRJTglEBQ4GwIid35OVkqHEig__' , 'value' => 'スレンダー苗条' ],
    [ 'key' => 'DgRJTglEBQ4GNnw_' , 'value' => 'SM' ],
    [ 'key' => 'DgRJTglEBQ4GwPid2pO4' , 'value' => 'ドラマ-剧情' ],
    [ 'key' => 'DgRJTglEBQ4GqMGAwQ__' , 'value' => '乱交' ],
    [ 'key' => 'DgRJTglEBQ4GoPSd7Q__' , 'value' => '電マ' ],
    [ 'key' => 'DgRJTglEBQ4G2p2d5pPBkqA_' , 'value' => '尻フェチ' ],
    [ 'key' => 'DgRJTglEBQ4GwJyd0JO2iY%2CEkP%2CH%2A8uHjA__' , 'value' => 'キャバ嬢・風俗嬢' ],
    [ 'key' => 'DgRJTglEBQ4Gr83%2CkQ__' , 'value' => '放尿' ],
    [ 'key' => 'DgRJTglEBQ4GpZjxzQ__' , 'value' => '制服' ],
    [ 'key' => 'DgRJTglEBQ4GrOX24g__' , 'value' => '不倫' ],
    [ 'key' => 'DgRJTglEBQ4G2oOE25KMlsfahIrYnY2djg__' , 'value' => '寝取り・寝取られ' ],
    [ 'key' => 'DgRJTglEBQ4GwPad4JODlt3f2P%2C6' , 'value' => 'デビュー作品-首次亮相' ],
    [ 'key' => 'DgRJTglEBQ4G0MH%2AzpOzksbA9w__' , 'value' => '巨乳フェチ' ],
    [ 'key' => 'DgRJTglEBQ4GwIqZj5OPlt2syA__' , 'value' => 'セーラー服-水手服' ],
    [ 'key' => 'DgRJTglEBQ4GwJWdwJOhksLEipOK' , 'value' => 'インディーズ-印度' ],
    [ 'key' => 'DgRJTglEBQ4GwOCdwJPfkqk_' , 'value' => 'パンスト-丝袜' ],
    [ 'key' => 'DgRJTglEBQ4GwNidwJPeksbA3JeM' , 'value' => 'ランジェリー内衣' ],
    [ 'key' => 'DgRJTglEBQ4GwO%2Ad8JPTlt3Ajg__' , 'value' => 'マッサージ-按摩' ],
    [ 'key' => 'DgRJTglEBQ4GwOCdl5O3kpI_' , 'value' => 'パイパン-光头' ],
    [ 'key' => 'DgRJTglEBQ4G2MaD4fSB99k_' , 'value' => '女子大生' ],
    [ 'key' => 'DgRJTglEBQ4GqvPxzZfA%2AoDV1w__' , 'value' => '和服・浴衣' ],
    [ 'key' => 'DgRJTglEBQ4GwOGdl5Ow' , 'value' => 'バイブ' ],
    [ 'key' => 'DgRJTglEBQ4GwIad8JPJktjA%2CJOUnJc_' , 'value' => 'シックスナイン-69' ],
    [ 'key' => 'DgRJTglEBQ4G1c2A3w__' , 'value' => '淫語' ],
    [ 'key' => 'DgRJTglEBQ4G2MaOho2z' , 'value' => '女教師' ],
    [ 'key' => 'DgRJTglEBQ4G2Mb1lpO%2CktjA%2CpeW%2AImE2qjj' , 'value' => '女優ベスト・総集編' ],
    [ 'key' => 'DgRJTglEBQ4G1%2AeK9JfAi4Lf%2CA__' , 'value' => '花嫁・若妻' ],
    [ 'key' => 'DgRJTglEBQ4G2tT71g__' , 'value' => '水着' ],
    [ 'key' => 'DgRJTglEBQ4GwJOdl5OvkorEkIHt%2CtmGrw__' , 'value' => 'アイドル・芸能人-偶像·艺人' ],
    [ 'key' => 'DgRJTglEBQ4GwZuc0ZKnk4I_' , 'value' => 'おもちゃ-玩具' ],
    [ 'key' => 'DgRJTglEBQ4G0faA3f%2A%2AlsfA%2CJeMnN0_' , 'value' => '看護婦・ナース' ],
    [ 'key' => 'DgRJTglEBQ4GwYWc8JLJk5I_' , 'value' => 'ごっくん' ],
    [ 'key' => 'DgRJTglEBQ4Gweec8JLNk9A_' , 'value' => 'ぶっかけ' ],
    [ 'key' => 'DgRJTglEBQ4GwOCd2pOmksXAj2Jm' , 'value' => 'パラダイスTV' ],
    [ 'key' => 'DgRJTglEBQ4G3uGZlf2D' , 'value' => '姉・妹' ],
    [ 'key' => 'DgRJTglEBQ4GwJWd2pO4kqDAnA__' , 'value' => 'イラマチオ-深喉' ],
    [ 'key' => 'DgRJTglEBQ4GwJ%2Ad2ZOEktc_' , 'value' => 'ギリモザ' ],
    [ 'key' => 'DgRJTglEBQ4GpuWM8g__' , 'value' => '痴漢' ],
    [ 'key' => 'DgRJTglEBQ4GoNuB9Q__' , 'value' => '投稿' ],
    [ 'key' => 'DgRJTglEBQ4GwJmdipOg' , 'value' => 'エステ' ],
    [ 'key' => 'DgRJTglEBQ4GwOCdwJOnkog_' , 'value' => 'パンチラ-裙子' ],
    [ 'key' => 'DgRJTglEBQ4GrP7%2AzpfA%2C5ijyw__' , 'value' => '貧乳・微乳' ],
    [ 'key' => 'DgRJTglEBQ4Gq%2AmMnA__' , 'value' => '輪姦' ],
    [ 'key' => 'DgRJTglEBQ4GwI6dmJOPhqakygUAmJd2JCQ_' , 'value' => 'タカラ映像30％OFF' ],
    [ 'key' => 'DgRJTglEBQ4GwNyZj5PRkobAxQ__' , 'value' => 'ローション' ],
    [ 'key' => 'DgRJTglEBQ4Gp%2C%2C50%2CWDlsfA4JPbnLo_' , 'value' => '体操着・ブルマ' ],
    [ 'key' => 'DgRJTglEBQ4G2daM4g__' , 'value' => '主観' ],
    [ 'key' => 'DgRJTglEBQ4Gweyc8JKnk4LB3A__' , 'value' => 'ぽっちゃり' ],
    [ 'key' => 'DgRJTglEBQ4GwJWd0pfaktnA5ZP3nM4_' , 'value' => 'イメージビデオ' ],
    [ 'key' => 'DgRJTglEBQ4G0PDy3w__' , 'value' => '義母' ],
    [ 'key' => 'DgRJTglEBQ4GwdCcn5Kr' , 'value' => 'めがね-眼镜' ],
    [ 'key' => 'DgRJTglEBQ4GqP%2Ad55OVlsfWkoWA9Mb%2CnA__' , 'value' => '洋ピン・海外輸入' ],
    [ 'key' => 'DgRJTglEBQ4Gppfyhg__' , 'value' => '脱糞' ],
    [ 'key' => 'DgRJTglEBQ4G1erymfe48Z8_' , 'value' => '異物挿入' ],
    [ 'key' => 'DgRJTglEBQ4G3Nj01w__' , 'value' => '拷問' ],
    [ 'key' => 'DgRJTglEBQ4G1cr%2CkQ__' , 'value' => '飲尿' ],
    [ 'key' => 'DgRJTglEBQ4Gu4D8gQ__' , 'value' => '浣腸' ]
    ];
    
echo $twig->render('index.html', array('title' => $titleList[$sort],'page'=>$page,'sort'=>$sort,'data'=>$datas,'options'=>$options));

?>
