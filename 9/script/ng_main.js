angular.module("MyApp", ["ngSanitize", "ui.ace"])
    .config(["$locationProvider", function($locationProvider) {
        // このオプションをセットする必要あり（但し要HTML5対応ブラウザ）
        $locationProvider.html5Mode(true);
    }])
    .run(["$rootScope", function($scope) {
        $scope.edit_js = "";
        $scope.edit_css = "section{background-color: #e6e6fa;}#aaa{color: red;}";
    }])
    .controller('LoginDataCtrl', function($scope, $location) {
        this.guest = false;
        this.lguser = true;
        this.paramName = "name";
        this.username = $location.search()[this.paramName];
        if(angular.isUndefined(this.username)){
          this.username = 'Guest';
          this.guest = true;
          this.lguser = false;
        };
        // this.click_logout = function(){
        //   console.log("ログアウト");
        //   $window.location.href = '../php/logout.php';
        // };
    });
