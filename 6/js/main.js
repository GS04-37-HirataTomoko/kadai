$(function() {
    //{"count":[csv上の数],"code":[地域のコード], "name": [地域の名前], "color":[地域につける色], "prefectures":[地域に含まれる都道府県のコード]}
    let areas = [{
        "count": 0,
        "code": 1,
        "name": "北海道地方",
        "color": "#006600",
        "prefectures": [1]
    }, {
        "count": 0,
        "code": 2,
        "name": "東北地方",
        "color": "#1a801a",
        "prefectures": [2, 3, 4, 5, 6, 7]
    }, {
        "count": 0,
        "code": 3,
        "name": "関東地方",
        "color": "#4d9933",
        "prefectures": [8, 9, 10, 11, 12, 13, 14]
    }, {
        "count": 0,
        "code": 4,
        "name": "北陸・甲信越地方",
        "color": "#66b34d",
        "prefectures": [15, 16, 17, 18, 19, 20]
    }, {
        "count": 0,
        "code": 5,
        "name": "東海地方",
        "color": "#80cc66",
        "prefectures": [21, 22, 23, 24]
    }, {
        "count": 0,
        "code": 6,
        "name": "近畿地方",
        "color": "#99e680",
        "prefectures": [25, 26, 27, 28, 29, 30]
    }, {
        "count": 0,
        "code": 7,
        "name": "中国地方",
        "color": "#b3ff99",
        "prefectures": [31, 32, 33, 34, 35]
    }, {
        "count": 0,
        "code": 8,
        "name": "四国地方",
        "color": "#000000",
        "prefectures": [36, 37, 38, 39]
    }, {
        "count": 0,
        "code": 9,
        "name": "九州地方",
        "color": "#FFF000",
        "prefectures": [40, 41, 42, 43, 44, 45, 46]
    }, {
        "count": 0,
        "code": 10,
        "name": "沖縄地方",
        "color": "#000FFF",
        "prefectures": [47]
    }];

    Promise.resolve()
        .then(function() {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: 'data/data.csv',
                    cache: false,
                    success: function(data) {
                        resolve(data);
                    }
                });
            })
        })
        .then(function(value) {
            createMap(parseCsv(value));
        })
        .catch(function(error) {
            console.error(error);
        });

    function createMap(vote) {
        $.map(vote, vateCalc);
        colerMapping();

        $("#map").japanMap({
            areas: areas, //上で設定したエリアの情報
            selection: "prefecture", //選ぶことができる範囲(県→prefecture、エリア→area)
            borderLineWidth: 0.25, //線の幅
            drawsBoxLine: false, //canvasを線で囲む場合はtrue
            movesIslands: true, //南西諸島を左上に移動させるときはtrue、移動させないときはfalse
            showsAreaName: false, //エリア名を表示しない場合はfalse
            width: 1000, //canvasのwidth。別途heightも指定可。
            backgroundColor: "#ffffff", //canvasの背景色
            font: "MS Mincho", //地図に表示する文字のフォント
            fontSize: 12, //地図に表示する文字のサイズ
            fontColor: "areaColor", //地図に表示する文字の色。"areaColor"でエリアの色に合わせる
            fontShadowColor: "black", //地図に表示する文字の影の色
            onSelect: function(data) { //選択範囲をクリックしたときに実行
                //data.area.nameは選択したエリアの名前
            },
        });
    }

    function parseCsv(value) {
        let csvData = [];
        const LF = String.fromCharCode(10);
        const lines = value.split(LF);

        lines.forEach(line => {
            let cells = line.split(",")
            cells.splice(0, 2);
            if (cells.length != 0) {
                cells.forEach(cell => csvData.push(cell))
            }
        });
        return csvData
    }

    function vateCalc(val, i) {

        switch (val) {
            case "1":
                areas[0].count = areas[0].count + 1;
                return "1"
                break;
            case "2":
            case "3":
            case "4":
            case "5":
            case "6":
            case "7":
                areas[1].count = areas[1].count + 1;
                return "2"
                break;
            case "8":
            case "9":
            case "10":
            case "11":
            case "12":
            case "13":
            case "14":
                areas[2].count = areas[2].count + 1;
                return "3"
                break;
            case "15":
            case "16":
            case "17":
            case "18":
            case "19":
            case "20":
                areas[3].count = areas[3].count + 1;
                return "4"
                break;
            case "21":
            case "22":
            case "23":
            case "24":
                areas[4].count = areas[4].count + 1;
                return "5"
                break;
            case "25":
            case "26":
            case "27":
            case "28":
            case "29":
            case "30":
                areas[5].count = areas[5].count + 1;
                return "6"
                break;
            case "32":
            case "33":
            case "34":
            case "35":
                areas[6].count = areas[6].count + 1;
                return "7"
                break;
            case "36":
            case "37":
            case "38":
            case "39":
                areas[7].count = areas[7].count + 1;
                return "8"
                break;
            case "40":
            case "41":
            case "42":
            case "43":
            case "44":
            case "45":
            case "46":
                areas[8].count = areas[8].count + 1;
                return "9"
                break;
            case "47":
                areas[9].count = areas[9].count + 1;
                return "10"
                break;
            default:
        }

    }

    function colerMapping() {
        // 30票以上 #006600
        // 20票以上　#1a801a
        // 10～20票　#4d9933
        // 5～10票  #66b34d
        // 2～5票  #80cc66
        // 1票     #99e680
        // 0票     #b3ff99
        areas.forEach(area => {
            if (area.hasOwnProperty("count") && area.hasOwnProperty("color")) {
                if (area.count >= 30) {
                    area.color = "#006600";
                } else if (20 <= area.count && area.count < 30) {
                    area.color = "#1a801a";
                } else if (10 <= area.count && area.count < 20) {
                    area.color = "#4d9933";
                } else if (5 <= area.count && area.count < 10) {
                    area.color = "#66b34d";
                } else if (1 < area.count && area.count < 5) {
                    area.color = "#80cc66";
                } else if (area.count == 1) {
                    area.color = "#99e680";
                } else if (area.count == 0) {
                    area.color = "#b3ff99";
                }
            }
        })
    }

});
