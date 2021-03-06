<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Hp-search</title>
    <style>
        h2 {text-align: center;}
        div {text-align: center;}

        #DIV1{
        width:45%;
        line-height:50px;
        border:6px blue solid;
        float:left;
        }
        #DIV2{
        width:45%;
        line-height:50px;
        border:6px green solid;
        float:left;
        }
</style>
    </style>
</head>
<body>
    <h2></h2>
    <div class="container">
        
    </div>
    <div>
        <div>
            <a href="http://127.0.0.1/index.php">回首頁</a>
        </div>
        <div id="DIV1">
            <h3>Filiter</h4>
            <p>縣市(city)
                <select id="myParentSelect" name="city">
                <option value="">請選擇</option>
                    <?php
                    // 取得第一層option資料
                    include("config.php");
                    $query = "SELECT distinct city FROM forselect;";
                    $result = $mysql->query($query);
                
                    //echo '<option value="taipei">taipei</option>"\n"';       
                    while ($row = $result->fetch_assoc() ) {
                        echo '<option value="' . $row["city"] . '">' . $row["city"] . '</option>' . "\n";
                        }
                    ?>
                </select>
            </p>
            <p>區域(district)
                <select id="myFirstChildSelect" name="district">
                    <option value="">請選擇</option>
                </select>
            </p>
            <p>時間(trade_date)
                <select name="year">
                    <option value="106">106</option>
                    <option value="107">107</option>
                    <option value="108">108</option>
                    <option value="109">109</option>
                </select>
                年
                <select name="month">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                月
            </p>
            <p>建物型態(state)
                <select name="state">
                    <option value="1,1,1">套房(1 房 1 廳 1 衛)</option>
                </select>
            </p>
        </div>
        <div id="DIV2">
            <p>query result 可以滑動的介面、顯示總共幾筆</p>
        </div>
        <div style="clear:both;"></div>
        <div>
            <div id="DIV1">
                <h3>圖表選擇</h3>
                <p>X 軸
                    <select>
                        <option value="district">地區</option>
                    </select><br>
                    Y 軸
                    <select>
                        <option value="price">房價</option>
                    </select><br>
                    類型
                    <select>
                        <option value="hist">長條圖</option>
                    </select><br>
                </p>
            </div>
            <div id="DIV2">
                <p>圖像顯示區</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/2.2.0/metisMenu.min.js"></script>

    <!-- <?php $mysql->close(); ?> -->
    <script>
    $(function() {
        $('#myParentSelect').change(function() {
            //更動第一層時第二層清空
            $('#myFirstChildSelect').empty().append("<option value=''>請選擇</option>");
            var i = 0;
            $.ajax({
                type: "GET",
                url: "action.php",
                data: {
                    lv: $('#myParentSelect option:selected').val()
                },
                datatype: "json",
                success: function(result) {
                    //當第一層回到預設值時，第二層回到預設位置
			console.log(result);
			console.log(result.length);
			console.log(typeof result);	
		    if (result == "") {
                        $('#myFirstChildSelect').val($('option:first').val());
                    }
			//依據第一層回傳的值去改變第二層的內容
			result = JSON.parse(result);
			console.log(result);
			console.log(typeof result[0]['region']);
                    while (i < result.length) {
                        $("#myFirstChildSelect").append("<option value='" + i + "'>" + result[i]['region'] + "</option>");
                        i++;
		    }
	           //alert('Successfully called');
			
                },
                error: function(xhr, status, msg) {
                    console.error(xhr);
			console.error(msg);
			//alert('failed called');
                }
            });
        });
    });
    </script>

</body>
</html>