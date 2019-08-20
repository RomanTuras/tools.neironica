/**
 * Main function of "Maze"
 * Starting only when "maze" template is attached
 * Depends from classes:
 */
$(function () {
    let settingsMazeObject = { //default settings for "Maze"
        'wall': 3,
        'tunnel': 10,
    };
    const keyMaze = "maze-generator";
    let wallColor = $("#inputWallColor").val();
    let widthMaze = $("#inputRowsMaze").val();
    let heigthMaze = $("#inputColsMaze").val();
    let point = $("#inputPoint").val();
    let bgColor = $("#inputBgColor").val();

    let beginX = 0; //red point coordinates in maze
    let beginY = 0;

    setStartPount(point);


    if ($("#maze").length) {
        setupControlsMaze();
    }

    $("#generate-maze").click(function () {
        $("#maze-canvas").css("background", bgColor);
        mapGen("#maze-canvas", widthMaze, heigthMaze, 0, 0, wallColor, point);
    });

    $("#inputWallColor").change(function () {
        wallColor = this.value;
    });

    $("#inputBgColor").change(function () {
        bgColor = this.value;
        $("#maze-canvas").css("background", bgColor);
    });

    $("#inputRowsMaze").change(function () {
        widthMaze = this.value;
    });

    $("#inputColsMaze").change(function () {
        heigthMaze = this.value;
    });


    $("#inputPoint").change(function () {
        point = this.value;
        setStartPount(point)
    });

    $("#rangeWallMaze").change(function () {
        settingsMazeObject.wall = parseInt(this.value);
        LocalStorageHelper.saveFontSettings(keyMaze, settingsMazeObject);
    });

    $("#rangeTunnelMaze").change(function () {
        settingsMazeObject.tunnel = parseInt(this.value);
        LocalStorageHelper.saveFontSettings(keyMaze, settingsMazeObject);
    });

    function setStartPount(point) {
        switch (point) {
            case "center":
                beginX = Math.round(widthMaze / 2) - 1;
                beginY = Math.round(heigthMaze / 2) - 1;
                break;
            case "left-bottom":
                beginX = 0;
                beginY = parseInt(heigthMaze - 1);
                break;
            case "right":
                beginX = parseInt(widthMaze - 1);
                beginY = parseInt(heigthMaze - 1);
                break;
            default:
                beginX = 0;
                beginY = 0;
        }
    }



    /**
     * Setting controls from local storage or by default
     */
    function setupControlsMaze() {
        if (LocalStorageHelper.getFontSettings(keyMaze) != null) {
            settingsMazeObject.wall = LocalStorageHelper.getFontSettings(keyMaze).wall;
            settingsMazeObject.tunnel = LocalStorageHelper.getFontSettings(keyMaze).tunnel;
        }
        $("#rangeWallMaze").val(settingsMazeObject.wall);
        $("#rangeTunnelMaze").val(settingsMazeObject.tunnel);


    }

    function mapGen(b, c, e, a, m, wallColor, point) {

        const _side_width = settingsMazeObject.tunnel;
        const _side_height = settingsMazeObject.tunnel;
        const _wall = settingsMazeObject.wall;
        const _witdh = _side_width + _wall;
        const _height = _side_height + _wall;

        // Функция управления персонажем
        function character(pointX, pointY) {

            // Получаем цвет пикселя из промежутка между текущей ячейкой и той, в сторону которой персонаж должен передвинуться
            // var h = d.getImageData(_witdh * currentPointX + 7 + 6 * pointX, _height * currentPointY + 7 + 6 * pointY, 1, 1);
            // Если цвет пикселя черный, то не перемещаем персонажа (обнуляем dx (a) и dy (b)), иначе увеличиваем количество шагов
            // 0 == h.data[0] && 0 == h.data[1] && 0 == h.data[2] && 255 == h.data[3] ? pointX = pointY = 0 : //document.querySelector("#step").innerHTML = Math.floor(document.querySelector("#step").innerHTML) + 1;
            // Закрашиваем персонажа
            d.clearRect(_witdh * currentPointX + _wall, _height * currentPointY + _wall, _side_width, _side_height);
            // Меняем его текушие координаты
            currentPointX += pointX;
            currentPointY += pointY;
            beginX = currentPointX;
            beginY = currentPointY;
            // Вновь отрисовываем его
            d.fillRect(_wall + _witdh * currentPointX, _wall + _height * currentPointY, _side_width, _side_height);
            // Если персонаж вышел за пределы лабиринта, то генерируем новый лабиринт и начинаем игру сначала
            // currentPointX >= c && mapGen("#maze-canvas", c, e, 0, m + 1)
        }

        // Выбираем область рисования
        b = document.querySelector(b);
        var d = b.getContext("2d");
        // И вписываем количество шагов и пройденных лабиринтов
        // document.querySelector("#step").innerHTML = Math.floor(a);
        // document.querySelector("#complete").innerHTML = Math.floor(m);
        // Зададим ширину и высоту области лабиринта
        b.width = _witdh * c + _wall;
        b.height = _height * e + _wall;
        // И закрасим в черный цвет
        d.fillStyle = wallColor;
        d.fillRect(0, 0, _witdh * c + _wall, _height * e + _wall);

        // Объявим массивы для хранения значения множества текущей ячейки, для значения стенки справа и для значения стенки снизу
        a = Array(c);
        b = Array(c);
        var k = Array(c),
            // Текущее множество
            q = 1;

        // d.fillStyle = "#00ee00";
        // Цикл по строкам
        for (cr_l = 0; cr_l < e; cr_l++) {
            // Проверка принадлежности ячейки в строке к какому-либо множеству
            for (i = 0; i < c; i++)
                0 == cr_l && (a[i] = 0), d.clearRect(_witdh * i + _wall, _height * cr_l + _wall, _side_width, _side_height), k[i] = 0, 1 == b[i] && (b[i] = a[i] = 0), 0 == a[i] && (a[i] = q++);
            // 0 == cr_l && (a[i] = 0), d.ellipse(_witdh * i + _wall, _height * cr_l + _wall, _side_width / 2, _side_height / 2, 0, 0, 2 * Math.PI), k[i] = 0, 1 == b[i] && (b[i] = a[i] = 0), 0 == a[i] && (a[i] = q++);
            // d.fill();

            // Создание случайным образом стенок справа и снизу
            for (i = 0; i < c; i++) {
                k[i] = Math.floor(2 * Math.random()), b[i] = Math.floor(2 * Math.random());

                if ((0 == k[i] || cr_l == e - 1) && i != c - 1 && a[i + 1] != a[i]) {
                    var l = a[i + 1];
                    for (j = 0; j < c; j++) a[j] == l && (a[j] = a[i]);
                    d.clearRect(_witdh * i + _wall, _height * cr_l + _wall, _side_width + _wall + 2, _side_height)
                    // d.ellipse(_witdh * i + _wall, _height * cr_l + _wall, _side_width / 2, (_side_height + _wall + 2) / 2, 0, 0, 2 * Math.PI)
                }
                cr_l != e - 1 && 0 == b[i] && d.clearRect(_witdh * i + _wall, _height * cr_l + _wall, _side_width, _side_height + _wall + 2)
                // cr_l != e - 1 && 0 == b[i] && d.ellipse(_witdh * i + _wall, _height * cr_l + _wall, _side_width / 2, (_side_height + _wall + 2) / 2, 0, 0, 2 * Math.PI)
            }

            // Проверка на замкнутые области.
            for (i = 0; i < c; i++) {
                var p = l = 0;
                for (j = 0; j < c; j++) a[i] == a[j] && 0 == b[j] ? p++ : l++;
                0 == p && (b[i] = 0, d.clearRect(_witdh * i + _wall, _height * cr_l + _wall, _side_width, _side_height + _wall + 2))
                // 0 == p && (b[i] = 0, d.ellipse(_witdh * i + _wall, _height * cr_l + _wall, _side_width / 2, (_side_height + _wall + 2) / 2, 0, 0, 2 * Math.PI))
            }
        }

        // Рисуем выход из лабиринта
        d.clearRect(_witdh * c, _wall, _side_width + _wall + 2, _side_height);
        // Обнуляем текущие координаты персонажа
        var currentPointX = 0,
            currentPointY = 0;
        // Задаем крассный цвет
        d.fillStyle = "red";
        // И ставим персонажа в начало лабиринта
        character(beginX, beginY);
        // Ожидаем нажатия стрелок
        document.body.onkeydown = function (a) {
            36 < a.keyCode && 41 > a.keyCode && character((a.keyCode - 38) % 2, (a.keyCode - 39) % 2)
        }
    }

});
