var app = angular.module('Biz2Credit',['ui.bootstrap']);
app.controller('Login',['$http','$scope',function($http,$scope){
    $scope.init = function(author_id) {
        if(author_id) location.href = "index.php";
    }
    $scope.login = function(usr,passwd){
        Ajax(getURL(),"POST",[['login',true],['username',usr],['password',passwd]],[],$scope,$http,function(s,d){
            if(s) location.href = "index.php";
            else if(d.msg) alert(d.msg);
            else alert("Something Went Wrong. Please Try Again!");
        });
    }
}]);
app.controller('addEditStories',['$scope','$http','$uibModalInstance',function($scope,$http,$uibModalInstance){
    $scope.uib = $uibModalInstance;
    $scope.$watch('story',function(n,o){
        if(n != o){
            angular.forEach(n,function(v,k){
                if(["location","content","selected_base"].indexOf(k) >=0 && n[k] )n[k] = v.replace(/^\s+/g,'');
            });
        }
    },true)
}]);
app.controller('EditStories',['$scope','$http','$uibModal',function($scope,$http,$uibModal){
    $scope.init = function(author_id) {
        if(author_id) {
            Ajax(getURL(),"POST",[['editStories',true]],[],$scope,$http,function(s,d){
                if(s) angular.extend($scope,d);
                else if(d.msg) alert(d.msg);
                else alert("Something Went Wrong. Please Try Again!");
            });
        } else location.href = "login.php";
            
    }
    $scope.addNew = (story) => {
        if(story) $scope.story = angular.copy(story);
        else delete $scope.story;
        openModal($uibModal,$scope,"addEditStories.html","addEditStories","static",false,"md",[]).result.then(function(r){
            if(r) angular.extend($scope,r);
        })
    }
    $scope.saveStories = (stories,uib)=>{
        Ajax(getURL(),"POST",[['addStory', true],['data',angular.toJson(stories)]],[],$scope,$http,function(s,d){
            if(s) uib.close(d);
        });
    }
    $scope.deleteStory = (stories)=>{
        if(!confirm("Are you sure to delete this story?")) return;
        Ajax(getURL(),"POST",[['deleteStory', true],['data',angular.toJson(stories)]],[],$scope,$http,function(s,d){
            if(s) angular.extend($scope,d);
            else if(d.msg) alert(d.msg);
            else alert("Something Went Wrong. Please Try Again!");
        });
    }
}]);
app.controller('index',['$scope','$http','$filter',function($scope,$http,$filter){
    $scope.limit = 10;
    $scope.pageNo = 1
    $scope.stories = [];
    $scope.searchedStories = []
    $scope.sortings = {
        "Old to New":{
            "orderBy":"date_modified",
            "reserve":true
        },
        "New to Old":{
            "orderBy":"date_modified"            
        }
    }
    $scope.getStories = function(){
        Ajax(getURL(),"POST",[['getStories', true]],[],$scope,$http,function(s,d){
            if(s) {
                $scope.stories = d.data;
                $scope.searchedStories = angular.copy($scope.stories)
            } else if(d.msg) alert(d.msg);
            else alert("Something Went Wrong. Please Try Again!");
        });
    }
    $scope.startPage = function(){
        $scope.pageNo = 1
    }
    $scope.nextPage = function(pageNo){
        if(pageNo < $scope.totalPages) $scope.pageNo += 1;
    }
    $scope.prevPage =function(pageNo){
        if(pageNo > 1) $scope.pageNo -= 1
    }
    $scope.$watch('pageNo',function(n,o){
        if(n) {
            start = (n -1) * $scope.limit
            $scope.filterStories = $scope.searchedStories.slice(start,start+$scope.limit)
        }
    })
    $scope.$watch('searchedStories',function(n,o){
        if(n){
            $scope.totalStories = n.length;
            $scope.totalPages = Math.ceil($scope.totalStories / $scope.limit);
            $scope.pageNo = 1;
            $scope.filterStories = n.slice(0,$scope.limit)
        } else $scope.searchedStories = [];
    },true)
    $scope.setFilterStories = function(search) {
        $scope.searchedStories = $filter('filter')($scope.stories, search);
    }
    $scope.init = function() {
        $scope.getStories();
    }
}]);
app.controller('single',['$http','$scope',function($http,$scope){
    $scope.init = function(id) {
        if(id) {
            Ajax(getURL(),"POST",[['getSingleStory', true],['story_id', id]],[],$scope,$http,function(s,d){
                if(s) angular.extend($scope,d);
                else {
                    alert("No Story Found!");
                    location.href = "index.php";
                }
            });
        } else location.href = "index.php";
    }
}]);
Ajax = function(u,m,d,i,scope,h,f,func,timeout){
    if(!scope.isBusy){
    	scope.isBusy = true;
    	if(angular.isUndefined(scope.func) && angular.isDefined(func)) scope.func = angular.copy(func);
    	if(m == 'GET'){
    	    var req = h.get(u);
    	    req.then(function(r){
                scope.isBusy = false;
    	    	if(r.data) f(true,r.data);
    	    });
    	} else {
    	    var fd = new FormData();
    	    if(d.length > 0) angular.forEach(d,function(v,k){ fd.append(v[0],v[1]); });
    	    if(i != {}) angular.forEach(i,function(v,k){ fd.append(k,v); });
    	    var options = {method:"POST",url:u,data:fd,headers:{"Content-Type": undefined}};
    	    if(angular.isDefined(timeout)) options['timeout'] = timeout;
    	    var req = h(options);
    	    req.then(function(r){
    	        scope.isBusy = false;
                if(angular.isDefined(f)){
                    if(typeof r.data != 'object') f(r.data);
                    else  f(r.data.status,r.data,r.data)
                }else alert("Something went wrong please try agian after some time");
    	    },function(){
    	        scope.isBusy = false;
    	        if(angular.isDefined(f)) f(false,{'error':"Timeout : Connection Lost to Server."});
    	    });
    	}
    } else alert("Please wait request is already is process");
}
openModal = function (uib,scope,template,ctrl,backdrop,keyboard,size,data) {
    return uib.open({
        animation: true,
        templateUrl: template,
        controller: ctrl,
        backdrop: backdrop,
        keyboard: keyboard,
        scope:scope,
        size: size,
        resolve: {
            data: function () {
                return data;
            }
        }
    });
};
getURL = function() {
    return "http://localhost:9000/database/api.php";
}