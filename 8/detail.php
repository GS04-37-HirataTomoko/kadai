<h1>&lt;旅行先アンケート&gt;</h1>
<form method="post" action=<?=$action?>>
<div class="container">
    <div class="flex1">
        <p>①あなたの情報</p>
        <p>お名前:
            <input type="text" name="name" size="15" placeholder="くま太郎" value=<?=$name?>>
        </p>
        <p>MAIL:
            <input type="email" name="email" size="15" placeholder="kuma.taro@.jp" value=<?=$email?>>
        </p>
        <p>年齢(半角数字):
            <input type="text" name="age" size="15" placeholder="20" value=<?=$age?>>
        </p>
        <?php
        $url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        $path = explode('/', $url);
        if("input_data.php" == end($path)){
          echo '<p><a href="output_data.php">結果だけをみる</a></p>';
        }
         ?>
    </div>
    <div class="flex2">
        <p>②旅行したことのある都道府県を選択してください</p>
        <p>（複数選択可)</p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="1">北海道
                </label>
            </div>
        </p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary ">
                    <input type="checkbox" name="arr[]" value="2">青森
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="3">岩手
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="4">宮城
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="5">秋田
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="6">山形
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="7">福島
                </label>
            </div>
        </p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-success ">
                    <input type="checkbox" name="arr[]" value="8">茨城
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="9">栃木
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="10">群馬
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="11">埼玉
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="12">千葉
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="13">東京
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="14">神奈川
                </label>
            </div>
        </p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="15">新潟
                </label>
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="16">富山
                </label>
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="17">石川
                </label>
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="18">福井
                </label>
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="19">山梨
                </label>
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="20">長野
                </label>
            </div>
        </p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="21">岐阜
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="22">静岡
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="23">愛知
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="24">三重
                </label>
            </div>
        </p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="25">滋賀
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="26">京都
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="27">大阪
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="28">兵庫
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="29">奈良
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="30">和歌山
                </label>
            </div>
        </p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="31">鳥取
                </label>
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="32">島根
                </label>
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="33">岡山
                </label>
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="34">広島
                </label>
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="35">山口
                </label>
            </div>
        </p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="36">徳島
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="37">香川
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="38">愛媛
                </label>
                <label class="btn btn-primary">
                    <input type="checkbox" name="arr[]" value="39">高知
                </label>
            </div>
        </p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="40">福岡
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="41">佐賀
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="42">長崎
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="43">熊本
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="44">大分
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="45">宮崎
                </label>
                <label class="btn btn-success">
                    <input type="checkbox" name="arr[]" value="46">鹿児島
                </label>
            </div>
        </p>
        <p>
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-info">
                    <input type="checkbox" name="arr[]" value="47">沖縄
                </label>
            </div>
        </p>
    </div>
    <div class="flex1">
        <p>③ぽちっと</p>
        <p>
            <input type="submit" class="btn btn-warning" value="回答する">
        </p>
    </div>
</div>
</form>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
