angular.module("MyApp", ["ngSanitize", "ui.ace"])
    .config(["$locationProvider", function($locationProvider) {
        // このオプションをセットする必要あり（但し要HTML5対応ブラウザ）
        $locationProvider.html5Mode(true);
    }])
    .run(["$rootScope", function($scope) {
        $scope.edit_js = "<section></section>";
        $scope.edit_css = "section{background-color: #e6e6fa;box-shadow:5px 5px 0px -2px;margin:10px;}#aaa{color: red;}";
    }])
    .controller('LoginDataCtrl', function($scope, $location) {
        this.guest = false;
        this.lguser = true;
        this.paramName = "name";
        this.username = $location.search()[this.paramName];
        if (angular.isUndefined(this.username)) {
            this.username = 'Guest';
            this.guest = true;
            this.lguser = false;
        };
        // this.click_logout = function(){
        //   console.log("ログアウト");
        //   $window.location.href = '../php/logout.php';
        // };
    })
    .filter('unsafe', function($sce) {
        return function(val) {
            return $sce.trustAsHtml(val);
        };
    });
