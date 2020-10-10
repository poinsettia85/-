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



//echo $addr1[1];
	

} 

 catch (exception $e) {

    echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';

}
 
?> 






















<html>
<head>
    <meta charset="utf-8">
    <title>주소로 장소 표시하기</title>
    
</head>
<body>
 <input type="checkbox" id="chkUseDistrict" onclick="setOverlayMapTypeId()" /> 지적편집도 정보 보기
<div id="map" style="width:100%;height:1000px;"></div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=ff7fafa1487c29a28a00b1303331b991&libraries=services"></script>   
<script>



var count = ["<?=$number?>"]
//var test = new Array();
//var test = Array();

//var test = ["<?=$addr1[i]?>"]


//alert (number);


	//test = "<?=$addr1[1]?>";
	//alert (test);


var number = new Array();
var number = Array();


var address = new Array();
var address = Array();





	<?for($i=0;$i<$number;$i++){?>
		
		
	number[<?=$i?>] = "<?=$number[$i+1]?>";
	address[<?=$i?>] = "<?=$addr1[$i+1]?>";
	
	
	
		
		<?}?>


//alert (text1);



var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = {
        center: new daum.maps.LatLng(33.450701, 126.570667), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };  

// 지도를 생성합니다    
var map = new daum.maps.Map(mapContainer, mapOption); 

// 주소-좌표 변환 객체를 생성합니다
var geocoder = new daum.maps.services.Geocoder();

//var i = "제주특별자치도 제주시 첨단로 242";  



  
  
  
  
  
//-----------------------------------------------------------------------
  

//var test2 = (test);
//alert (test[0]);  
//alert (test[1]); 
//var test3 = test2.split(",");  
//alert (test3[1]); 
//alert (test2);
//alert (test2);
//for (var i in test2) {

//var empList = new Array( "길음동543-7" , "길음동1279-1");

//var empList = new Array(test);

//alert (test);
//alert (empList);





//------------------------------------------------------------------------------



var bounds = new daum.maps.LatLngBounds(); 

var text1 = new Array();
var text1 = Array();

var text2 = new Array();
var text2 = Array();

var coords = new Array();
var coords = Array();

var bound = new Array();
var bound = Array();








<?for($i=0;$i<$number;$i++){?>
	geocoder.addressSearch('<?=$addr1[$i+1]?>', function(result, status) {

			// 검색이 없으면 
			 if (status === daum.maps.services.Status.ZERO_RESULT) {

//alert (<?=$addr1[$i+1]?>);





 //document.write('<?=$addr1[$i+1]?>');






alert ("주소에러 : "+'<?=$i+1?>'+". "+ '<?=$addr1[$i+1]?>');

			 }
			 
			
			
			 
	})		 
<?}?>

  





var bounds = new daum.maps.LatLngBounds(); 




<?for($i=0;$i<$number;$i++){?>

	geocoder.addressSearch('<?=$addr1[$i+1]?>', function(result, status) {





		
			// 정상적으로 검색이 완료됐으면 
			 if (status === daum.maps.services.Status.OK) {


  

				var coords = new daum.maps.LatLng(result[0].y, result[0].x);
			 
			
//alert (coords[1]);
//alert (coords[0]);
				// 결과값으로 받은 위치를 마커로 표시합니다
				
				//bounds.extend(coords);
			//alert (coords);
			
			
			/*	
				var circle = new daum.maps.Circle({
					center : coords,  // 원의 중심좌표 입니다 
					radius: 5, // 미터 단위의 원의 반지름입니다 
					strokeWeight: 3, // 선의 두께입니다 
					strokeColor: 'red', // 선의 색깔입니다
					strokeOpacity: 1, // 선의 불투명도 입니다 1에서 0 사이의 값이며 0에 가까울수록 투명합니다
					strokeStyle: 'line', // 선의 스타일 입니다
					 
				}); 

			circle.setMap(map); 	
			*/	
				

					//	alert (text1[i]);
				
				var content = '<span class="left"></span><span class="center"><b><font color="#ff0000">'+'<?=$addr2[$i+1]?>'+""+'<?=$addr3[$i+1]?>'+'</font></b></span><span class="right"></span>';
				
				var customOverlay = new daum.maps.CustomOverlay({
				position: coords,
				content: content,
				yAnchor: 1.5
								
				});

				// 커스텀 오버레이를 지도에 표시합니다
				customOverlay.setMap(map);
					
				
				
				
				
				

				var imageSrc = 'http://poinsettia85.ivyro.net/원.png', // 마커이미지의 주소입니다    
					imageSize = new daum.maps.Size(25, 25), // 마커이미지의 크기입니다
					imageOption = {offset: new daum.maps.Point(11, 11)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.
					  
				// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
				var markerImage = new daum.maps.MarkerImage(imageSrc, imageSize, imageOption);
				   

				// 마커를 생성합니다
				var marker = new daum.maps.Marker({
					position: coords, 
					image: markerImage // 마커이미지 설정 
				});

				// 마커가 지도 위에 표시되도록 설정합니다
				marker.setMap(map);  
						
// 지도를 재설정할 범위정보를 가지고 있을 LatLngBounds 객체를 생성합니다				
bounds.extend(coords);
//alert (i);

map.setBounds(bounds);

//alert (i);





				
				//map.setCenter(coords);
		 






	


	



		}

	
	

	
	
		
	});









<?}?>








function setOverlayMapTypeId(maptype) {
    
	var chkUseDistrict1 = document.getElementById('chkUseDistrict');
	
	var changeMaptype;
    
    // maptype에 따라 지도에 추가할 지도타입을 결정합니다
    if (chkUseDistrict1.checked) {
        
		
		changeMaptype = daum.maps.MapTypeId.USE_DISTRICT;  

 // maptype에 해당하는 지도타입을 지도에 추가합니다
    map.addOverlayMapTypeId(changeMaptype);
    
    // 지도에 추가된 타입정보를 갱신합니다
    currentTypeId = changeMaptype; 		
        
    }
	
	
	
	else   {
        

		map.removeOverlayMapTypeId(currentTypeId);    
		
		
		 // maptype에 해당하는 지도타입을 지도에 추가합니다
   // map.addOverlayMapTypeId(changeMaptype);
    
    // 지도에 추가된 타입정보를 갱신합니다
    currentTypeId = changeMaptype; 
        
    }
		
	
    
    // 이미 등록된 지도 타입이 있으면 제거합니다
	
	
  //  else (currentTypeId) {
 //       map.removeOverlayMapTypeId(currentTypeId);    
  //  }














/*


   var clusterer = new daum.maps.MarkerClusterer({
        map: map, // 마커들을 클러스터로 관리하고 표시할 지도 객체 
        averageCenter: true, // 클러스터에 포함된 마커들의 평균 위치를 클러스터 마커 위치로 설정 
        minLevel: 10 // 클러스터 할 최소 지도 레벨 
    });
 
    // 데이터를 가져오기 위해 jQuery를 사용합니다
    // 데이터를 가져와 마커를 생성하고 클러스터러 객체에 넘겨줍니다
    $.get("/download/web/data/chicken.json", function(data) {
        // 데이터에서 좌표 값을 가지고 마커를 표시합니다
        // 마커 클러스터러로 관리할 마커 객체는 생성할 때 지도 객체를 설정하지 않습니다
        var markers = $(data.positions).map(function(i, position) {
            return new daum.maps.Marker({
                position : new daum.maps.LatLng(position.lat, position.lng)
            });
        });

        // 클러스터러에 마커들을 추가합니다
        clusterer.addMarkers(markers);
    });

*/














    
          
}


  


//alert ("지도 개발중~!");
//alert (<?=$addr1[1]?>);

//}

</script>
</body>
</html>

