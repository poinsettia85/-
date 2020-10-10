<!DOCTYPE html>


<?php

$upload_dir = 'upload/map.xlsx';


$upload_file = $upload_dir ;
//$upload_file = $upload_dir . basename($_FILES['userfile']['name'] );


if ( move_uploaded_file($_FILES['userfile']['tmp_name'], $upload_file) ) {

echo $_FILES['userfile']['name'];
echo " ";
echo "업로드 성공";

} else {

echo $_FILES['userfile']['name'];
echo " ";
echo "업로드 실패" ;
exit;

}


//echo '<br>';

//echo $_FILES['userfile']['name'];


 
require_once "{$_SERVER['DOCUMENT_ROOT']}/Classes/PHPExcel.php"; // PHPExcel.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.

$objPHPExcel = new PHPExcel();

require_once "{$_SERVER['DOCUMENT_ROOT']}/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.

$filename = "{$_SERVER['DOCUMENT_ROOT']}/upload/map.xlsx"; // 읽어들일 엑셀 파일의 경로와 파일명을 지정한다.

try {

  // 업로드 된 엑셀 형식에 맞는 Reader객체를 만든다.

    $objReader = PHPExcel_IOFactory::createReaderForFile($filename);

    // 읽기전용으로 설정

    $objReader->setReadDataOnly(true);

    // 엑셀파일을 읽는다

    $objExcel = $objReader->load($filename);

    // 첫번째 시트를 선택

    $objExcel->setActiveSheetIndex(0);

    $objWorksheet = $objExcel->getActiveSheet();

    $rowIterator = $objWorksheet->getRowIterator();

    foreach ($rowIterator as $row) { // 모든 행에 대해서

               $cellIterator = $row->getCellIterator();

               $cellIterator->setIterateOnlyExistingCells(false); 

    }

    $maxRow = $objWorksheet->getHighestRow();

	
	
	for ($i = 0 ; $i <= $maxRow ; $i++) {

               $number = $objWorksheet->getCell('A' . $i)->getValue(); // A열 마지막번호 구하기
                             
		}
	
	
	
	for ($i = 0 ; $i <= $number ; $i++) {
    $name[] = $objWorksheet->getCell('A' . $i)->getValue(); // A열
    $addr1[] = $objWorksheet->getCell('B' . $i)->getValue(); // B열
    $addr2[] = $objWorksheet->getCell('C' . $i)->getValue(); // C열
    $addr3[] = $objWorksheet->getCell('D' . $i)->getValue(); // D열
    $addr4[] = $objWorksheet->getCell('E' . $i)->getValue(); // E열
    $reg_date_tmp = $objWorksheet->getCell('F' . $i)->getValue(); // F열
    $reg_date[] = PHPExcel_Style_NumberFormat::toFormattedString($reg_date_tmp, 'YYYY-MM-DD');
	
		}



//echo $addr4[1];
	

} 

 catch (exception $e) {

    echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';

}
 
?> 



<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>간단한 지도 표시하기</title>
	
	<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
	
	
	<input type="checkbox" id="chkUseDistrict" onclick="setOverlayMapTypeId()" /> 지적편집도 정보 보기
	
	
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=dtv2hk8agm"></script>
	
	
	
	<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=dtv2hk8agm&submodules=geocoder"></script>


	
	
</head>
<body>
<div id="map" style="width:100%;height:1000px;"></div>

<script>
var map = new naver.maps.Map('map', {
    center: new naver.maps.LatLng(37.604930, 127.020825)
    
    }
);



// 지적편집도 관련

var cadastralLayer = new naver.maps.CadastralLayer();

function setOverlayMapTypeId(maptype) {
    
	var chkUseDistrict1 = document.getElementById('chkUseDistrict');
	
	var changeMaptype;
    
    if (chkUseDistrict1.checked) {
        		
		cadastralLayer.setMap(map);
	        
    }
	
	else   {
//alert ("1");

	cadastralLayer.setMap(null);
	
	};

}
	
var address = ["길음동525-90", "쌍문동88-4"];    

var centerlatlng = [];

var point3 = [];






<?for($i=0;$i<$number;$i++){?>










//alert (address[i]);


//주소 좌표 변환



naver.maps.Service.geocode({ query: '<?=$addr1[$i+1]?>' }, function(status, response) {
    if (status === naver.maps.Service.Status.ERROR) {
        return alert('Something wrong!');
    }


 if (response.v2.meta.totalCount === 0) {
            alert('주소검색 안됨 : (' + '<?=$name[$i+1]?>' +') ' + '<?=$addr1[$i+1]?>' );
        }

 if (response.v2.meta.totalCount > 1) {
            alert('2개 이상의 동일주소 검색됨 : (' + '<?=$name[$i+1]?>' +') ' + '<?=$addr1[$i+1]?>' );
        }




//alert (JSON.stringify(response));

    // 성공 시의 response 처리
//alert (<?=$i?>);
	
	
var item = response.v2.addresses[0];
var point = new naver.maps.Point(item.x, item.y);	
var point2 = new naver.maps.LatLng(item.y, item.x);

centerlatlng.push(new naver.maps.LatLng(item.y, item.x));

//alert (centerlatlng);

//(lat:37.6047708,lng:127.0206169),(lat:37.650472,lng:127.0353223),(lat:37.6036359,lng:127.1447931)








//alert (<?=$i?>);

//alert (<?=$number-1?>);

//var dokdo2 = new naver.maps.LatLngBounds.bounds(new naver.maps.LatLng(37.6047708, 127.0206169),new naver.maps.LatLng(37.650472, 127.0353223),new naver.maps.LatLng(37.6036359, 127.1447931));

//map.fitBounds(dokdo2);

//alert (dokdo2);
//alert (<?=$number?>);

if (<?=$i?> === <?=$number-1?>) {


//concat, push

var dokdo3 = new naver.maps.LatLngBounds.bounds(centerlatlng[0], centerlatlng[1]);

map.fitBounds(dokdo3);

}

//alert (JSON.stringify(dokdo3));

//alert (<?=$number?>);

//alert (<?=$i?>);


// 원그리기 


var circle = {
    position: point,
    map: map,
    icon: {
        url: 'http://poinsettia85.ivyro.net/원.png',
        size: new naver.maps.Size(50, 50),
        origin: new naver.maps.Point(0, 0),
		scaledSize: new naver.maps.Size(25, 25),
        anchor: new naver.maps.Point(11, 12)
    }
};

var marker = new naver.maps.Marker(circle);









//'+'<?=$i?>'+'


// 텍스트 색 입히기

if ('<?=$addr4[$i+1]?>'=="빨") {

var content = '<span class="left"></span><span class="center"><b><font color="red">'+'<?=$addr2[$i+1]?>'+""+'<?=$addr3[$i+1]?>'+'</font></b></span><span class="right"></span>';

}

else if ('<?=$addr4[$i+1]?>'=="주") {

var content = '<span class="left"></span><span class="center"><b><font color="orange">'+'<?=$addr2[$i+1]?>'+""+'<?=$addr3[$i+1]?>'+'</font></b></span><span class="right"></span>';

}

else if ('<?=$addr4[$i+1]?>'=="노") {

var content = '<span class="left"></span><span class="center"><b><font color="yellow">'+'<?=$addr2[$i+1]?>'+""+'<?=$addr3[$i+1]?>'+'</font></b></span><span class="right"></span>';

}

else if ('<?=$addr4[$i+1]?>'=="초") {

var content = '<span class="left"></span><span class="center"><b><font color="green">'+'<?=$addr2[$i+1]?>'+""+'<?=$addr3[$i+1]?>'+'</font></b></span><span class="right"></span>';

}

else if ('<?=$addr4[$i+1]?>'=="파") {

var content = '<span class="left"></span><span class="center"><b><font color="blue">'+'<?=$addr2[$i+1]?>'+""+'<?=$addr3[$i+1]?>'+'</font></b></span><span class="right"></span>';

}

else if ('<?=$addr4[$i+1]?>'=="남") {

var content = '<span class="left"></span><span class="center"><b><font color="navy">'+'<?=$addr2[$i+1]?>'+""+'<?=$addr3[$i+1]?>'+'</font></b></span><span class="right"></span>';

}

else if ('<?=$addr4[$i+1]?>'=="보") {

var content = '<span class="left"></span><span class="center"><b><font color="purple">'+'<?=$addr2[$i+1]?>'+""+'<?=$addr3[$i+1]?>'+'</font></b></span><span class="right"></span>';

}

else {

var content = '<span class="left"></span><span class="center"><b><font color="red">'+'<?=$addr2[$i+1]?>'+""+'<?=$addr3[$i+1]?>'+'</font></b></span><span class="right"></span>';

}

// 텍스트 삽입



var text = new naver.maps.Marker({
    position: point,
    map: map,
    icon: {
        content: content,
        anchor: new naver.maps.Point(10, 30),
    },
    draggable: false
});




});



<?}?>


//test = "<?=$addr1[1]?>";
//alert (<?=$addr3[1]?>);





</script>
</body>
</html>